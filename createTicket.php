<?php
require_once ('utils.php');
require_once ('class/DBManager.php');
// ログイン済みかを確認後、ユーザIDを取得
$userId = getUserID ();

// DB管理オブジェクトの取得
$db = DBManager::instance ();

$managers = "";
$developers = "";
$partners = "";

$i = 0;
for($i = 2; $i > - 1; $i--) {
	$query = <<<EOT
	SELECT
		project_members.user_id,
		name
	FROM
		users,project_members
	WHERE
		users.user_id = project_members.user_id and
		users.role_flag = '%s'and
		project_id = '%s'
EOT;
	$query = sprintf ( $query, $i ,$_SESSION ['ch_project_id']);
	// 実行
	$db->exec ( $query );
	// データをフェッチ後、サニタイズ
	$tmp = "";
	while ( $row = $db->fetch () ) {
		if ($i == "2") {
			$managers[] = sanitate ( $row );

		} else if ($i == "1") {
			$developers[] = sanitate ( $row );
		} else if ($i == "0") {
			$partners[]  = sanitate ( $row );
		}
		//$tmp [] = sanitate ( $row );
	}/*
	if(is_array($tmp)){


	foreach ( $tmp as $tmps ) {
	if ($i == "2") {
	$managers[] = $tmps ['name'];
	} else if ($i == "1") {
	$developers[] = $tmps ['name'];
	} else if ($i == "0") {
	$partners[]  = $tmps ['name'];
	}
	}
	}
	*/
	if(empty($managers)){
		$managers [0]['name']= "";
	}
	if(empty($developers)){
		$developers [0]['name']= "";
	}
	if(empty($partners)){
		$partners [0]['name']= "";
	}
}


$smarty->assign ( 'names', $_SESSION['username'] );
$smarty->assign ( 'title', $_SESSION ['ch_project_title']."　―　チケット作成" );
$smarty->assign ( 'managers', $managers );
$smarty->assign ( 'developers', $developers );
$smarty->assign ( 'partners', $partners );

$smarty->assign ( 'ch_project_title', $_SESSION ['ch_project_title'] );
$smarty->assign ( 'ch_project_id', $_SESSION ['ch_project_id'] );
$smarty->assign ( 'user_id', $_SESSION['user_id'] );
$smarty->display ( 'view/addTicket.tpl' );
?>