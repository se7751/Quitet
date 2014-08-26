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
		user_id,
		name
	FROM
		users
	WHERE
		users.role_flag = '%s'
EOT;
	$query = sprintf ( $query, $i );
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
}

$smarty->assign ( 'title', "新規プロジェクトの作成" );
$smarty->assign ( 'names', $_SESSION['username'] );
$smarty->assign ( 'managers', $managers );
$smarty->assign ( 'developers', $developers );
$smarty->assign ( 'partners', $partners );
$smarty->display ( 'view/addProject.tpl' );


?>