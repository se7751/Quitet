<?php
require_once ('utils.php');
require_once ('class/DBManager.php');
// ログイン済みかを確認後、ユーザIDを取得
$userId = getUserID ();
// DB管理オブジェクトの取得
$db = DBManager::instance ();

$_SESSION ['ch_project_id'] = $_GET ['project_id'];

// プロジェクト表示用にプロジェクト名を持ってくる
$query = <<<EOT
	SELECT
		title
	FROM
		projects
	where
		project_id = '%s'
EOT;
$query = sprintf ( $query, $_SESSION ['ch_project_id'] );
$db->exec ( $query );

// データをフェッチ後、サニタイズ
while ( $row = $db->fetch () ) {
	$projects [] = sanitate ( $row );
}
$_SESSION ['ch_project_title'] = $projects [0] ['title'];


	// 進捗表示機能のために数字を持ってくる処理を実装
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
	$query = sprintf ( $query, $_SESSION ['ch_project_id'] );
	// 実行
	$db->exec ( $query );
	// データをフェッチ後、サニタイズ
	$tmp = "";
	while ( $row = $db->fetch () ) {
		$tmp [] = sanitate ( $row );
	}
	$total = $tmp [0] ['total'];
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
	$query = sprintf ( $query, $_SESSION ['ch_project_id'] );
	// 実行
	$db->exec ( $query );
	// データをフェッチ後、サニタイズ
	$tmp = "";
	while ( $row = $db->fetch () ) {
		$tmp [] = sanitate ( $row );
	}
	$untotal = $tmp [0] ['untotal'];
	if ($total != 0) {
		$sintyoku = ($total - $untotal) / $total * 100;
	} else {
		$sintyoku = 0;
	}
	$owari = $total - $untotal;




	// 選択されたプロジェクトに紐づくチケットを持ってくる。
	$query = <<<EOT
	SELECT
		*
	FROM
		tickets
	where
		tickets.project_id = '%s'
EOT;
	$query = sprintf ( $query, $_SESSION ['ch_project_id'] );
	$db->exec ( $query );

	// データをフェッチ後、サニタイズ
	while ( $row = $db->fetch () ) {
		$tickets [] = sanitate ( $row );
	}
if(empty($tickets)){
		$tickets[0]['ticket_id'] = "";
	}


$smarty->assign ( 'title', $_SESSION ['ch_project_title']."　―　チケット一覧" );
$smarty->assign ( 'names', $_SESSION['username'] );
$smarty->assign ( 'tickets', $tickets );
$smarty->assign ( 'sintyoku', $sintyoku );
$smarty->assign ( 'untotal', $untotal );
$smarty->assign ( 'ch_project_id', $_SESSION ['ch_project_id'] );
$smarty->assign ( 'total', $total );
$smarty->assign ( 'owari', $owari );
$smarty->assign ( 'ch_project_title', $_SESSION ['ch_project_title'] );
$smarty->display ( 'view/viewTickets.tpl' );
?>
