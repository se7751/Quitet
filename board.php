<?php
require_once ('utils.php');
require_once ('class/DBManager.php');

// ログイン済みかを確認後、ユーザIDを取得
$userId = getUserID ();

// DB管理オブジェクトの取得
$db = DBManager::instance ();
$db2 = DBManager::instance ();
if ($_SESSION ['role_flag'] == "2" || $_SESSION ['role_flag'] == "1") { // 開発者とマネージャーの場合
	$query = <<<EOT
	SELECT
		project_id
		, title
		, body
		, created
	FROM
		projects
EOT;
} elseif ($_SESSION ['role_flag'] == "0") { // 協力会社の場合
	$query = <<<EOT
	SELECT
		projects.project_id
		, title
		, body
		, created
	FROM
		projects,project_members
	WHERE
		projects.project_id = project_members.project_id and
		project_members.user_id = '%s'
EOT;
	$query = sprintf ( $query, $_SESSION ['user_id'] );
}
$db->exec ( $query );

// データをフェッチ後、サニタイズ
while ( $row = $db->fetch () ) {

	$projects [] = sanitate ( $row );
}

/*
 * // 各ポストにひもづくコメントデータを格納 for ($i = 0; $i < count($projects); $i++) { $projects[$i]['project_members'] = getComments($projects[$i]['id']); }
 */
$i = 0;
// 1プロジェクトに携わるメンバを抽出する処理
// IDを抽出
foreach ( $projects as $minipro ) {
	// ProIDを抽出
	$cid = $minipro ['project_id'];
	// Queryつくる
	$query = <<<EOT
	SELECT
		name
	FROM
		project_members,users
	WHERE
		project_members.user_id = users.user_id and
		project_members.project_id = '%s'
EOT;
	$query = sprintf ( $query, $cid );
	// 実行
	$db->exec ( $query );
	// データをフェッチ後、サニタイズ
	$tmp = "";
	while ( $row = $db->fetch () ) {
		$tmp [] = sanitate ( $row );
	}
	$k = 0;
	$temp = "";
	// $tmpがnullすなわち参加メンバ0だとエラーでる
	if (is_array ( $tmp )) {
		foreach ( $tmp as $name ) {
			$temp = $temp . $name ['name'] . ",";
		}
	} else {
	}

	/*
	 * $user[$i++]['users'] = $temp; var_dump($temp);
	 */
	// 元のprojectsにmember一覧を追加
	$projects [$i] ['members'] = $temp;
	// プログレスバーに表示する数値を取得　完了でないチケット/完了チケット*100
	// Queryつくる
	$query = <<<EOT
	SELECT
		count(*) as total
	FROM
		projects,tickets
	WHERE
		projects.project_id = tickets.project_id and
		projects.project_id = '%s'
EOT;
	$query = sprintf ( $query, $cid );
	// 実行
	$db->exec ( $query );
	// データをフェッチ後、サニタイズ
	$tmp = "";
	while ( $row = $db->fetch () ) {
		$tmp [] = sanitate ( $row );
	}
	$projects [$i] ['total'] = $tmp[0]['total'];
	$total= $tmp[0]['total'];
	//
	$query = <<<EOT
	SELECT
		count(*) as untotal
	FROM
		projects,tickets
	WHERE
		projects.project_id = tickets.project_id and
		projects.project_id = '%s'and
		tickets.state != '完了'
EOT;
	$query = sprintf ( $query, $cid );
	// 実行
	$db->exec ( $query );
	// データをフェッチ後、サニタイズ
	$tmp = "";
	while ( $row = $db->fetch () ) {
		$tmp [] = sanitate ( $row );
	}
	$projects [$i] ['untotal'] = $tmp[0]['untotal'];
	$untotal = $tmp[0]['untotal'];
	if($total != 0){
		$projects [$i] ['sintyoku'] =  ($total - $untotal) / $total * 100;
	}else {
		$projects [$i] ['sintyoku'] = 0;
	}

	$i ++;
}

/*
 * echo $projects[$i]['project_id']; $aaa = $projects[0]; var_dump($aaa); echo "ok".$aaa['project_id'];
 */

// 投稿一覧を表示
$smarty->assign ( 'role_flag', $_SESSION ['role_flag'] );
$smarty->assign ( 'userId', $userId );
if (isset ( $projects )) {
	$smarty->assign ( 'projects', $projects );
} else {
	$projects [0] ['project_id'] = "#";
	$projects [0] ['title'] = "表示できるプロジェクトがありません";
	$projects [0] ['body'] = "";
	$projects [0] ['created'] = "";
	$smarty->assign ( 'projects', $projects );
}
$smarty->assign ( 'ch_project_title', "　　　　" );
$smarty->assign ( 'title', "プロジェクト一覧" );
$smarty->assign ( 'names', $_SESSION ['username'] );
$smarty->display ( 'view/viewProjects.tpl' );
?>