<?php
echo '<meta charset="UTF-8" />';
require_once ('utils.php');
require_once ('class/DBManager.php');
// ログイン済みかを確認後、ユーザIDを取得
$userId = getUserID ();

// DB管理オブジェクトの取得
$db = DBManager::instance ();
if(isset($_POST['word'])){//検索クエリが投げられた場合
	//あくまで自分の属しているプロジェクトだけにしたほうが良いのでは
	//編集権限とかがめんどくさそう
	if($_SESSION['role_flag']== "0"){
		$query = <<<EOT
	SELECT
		projects.title as project_title,
		tickets.title,
		tickets.ticket_id,
		tickets.body
	FROM
		projects,tickets,project_members,users
	WHERE
		projects.project_id = tickets.project_id and
		project_members.project_id = projects.project_id and
		project_members.user_id = users.user_id and
		tickets.body like "%s" and
		users.user_id = "%s"
EOT;

		$query = sprintf ( $query,"%".$_POST['word']."%",$_SESSION['user_id']);
		$db->exec ( $query );
		// データをフェッチ後、サニタイズ
		while ( $row = $db->fetch () ) {
			$results [] = $row;
		}
		$query = <<<EOT
	SELECT
		count(*) as restotal
	FROM
		projects,tickets,project_members,users
	WHERE
		projects.project_id = tickets.project_id and
		project_members.project_id = projects.project_id and
		project_members.user_id = users.user_id and
		tickets.body like "%s" and
		users.user_id = "%s"
EOT;
		$query = sprintf ( $query,"%".$_POST['word']."%",$_SESSION['user_id']);
		$db->exec ( $query );
		// データをフェッチ後、サニタイズ
		while ( $row = $db->fetch () ) {
			$restotal [] = $row;
		}
	}else{
		$query = <<<EOT
	SELECT
		projects.title as project_title,
		tickets.title,
		tickets.ticket_id,
		tickets.body
	FROM
		projects,tickets
	WHERE
		projects.project_id = tickets.project_id and
		tickets.body like "%s"
EOT;
		$query = sprintf ( $query,"%".$_POST['word']."%");
		$db->exec ( $query );
		// データをフェッチ後、サニタイズ
		while ( $row = $db->fetch () ) {
			$results [] = $row;
		}
		$query = <<<EOT
	SELECT
		count(*) as restotal
	FROM
		projects,tickets
	WHERE
		projects.project_id = tickets.project_id and
		tickets.body like "%s"
EOT;
		$query = sprintf ( $query,"%".$_POST['word']."%");
		$db->exec ( $query );
		// データをフェッチ後、サニタイズ
		while ( $row = $db->fetch () ) {
			$restotal [] = $row;
		}
	}



}elseif (!isset($_POST['word'])){//検索クエリが投げられなかった場合
	$results [0]['ticket_id'] = "";
	$restotal[0]['restotal'] = "";
}


if(empty($results)){
	$results [0]['ticket_id']= "";
}






if(empty($_SESSION ['ch_project_title'])){
	$smarty->assign ( 'ch_project_title', "　　　" );
	$smarty->assign ( 'ch_project_id', "");
}else {
	$smarty->assign ( 'ch_project_title', $_SESSION ['ch_project_title']);
	$smarty->assign ( 'ch_project_id', $_SESSION ['ch_project_id'] );
}
$smarty->assign ( 'restotal', $restotal[0]['restotal'] );
$smarty->assign ( 'results', $results );
$smarty->assign ( 'names', $_SESSION['username'] );
$smarty->assign ( 'title', "検索" );


$smarty->display ( 'view/viewSearch.tpl' );
?>