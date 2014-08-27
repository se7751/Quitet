<?php
echo '<meta charset="UTF-8" />';
require_once ('utils.php');
require_once ('class/DBManager.php');
// ログイン済みかを確認後、ユーザIDを取得
$userId = getUserID ();

if(empty($_SESSION ['ch_project_title'])){
	$smarty->assign ( 'ch_project_title', "　　　" );
	$smarty->assign ( 'ch_project_id', "");
}else {
	$smarty->assign ( 'ch_project_title', $_SESSION ['ch_project_title']);
	$smarty->assign ( 'ch_project_id', $_SESSION ['ch_project_id'] );
}

$smarty->assign ( 'names', $_SESSION['username'] );
$smarty->assign ( 'title', "検索" );


$smarty->display ( 'view/viewSearch.tpl' );
?>