<?php
echo '<meta charset="UTF-8" />';
require_once ('utils.php');
require_once ('class/DBManager.php');
// ログイン済みかを確認後、ユーザIDを取得
$userId = getUserID ();
$db = DBManager::instance ();


if(isset($_GET['project_id'])){//プロジェクトを消す
	echo "PROJECT DELETE";
	$query = <<<EOT
	DELETE
	FROM
		projects
	where
		project_id = '%s'
EOT;
	$query = sprintf ( $query, $_GET['project_id'] );
	$db->exec ( $query );
	$url = sprintf('Location: %s', "board.php");
	header($url);
	exit;
}elseif (isset($_GET['ticket_id']) && !isset($_GET['file_name'])){//チケットを消す
	echo "TICKET DELETE";
	$query = <<<EOT
	DELETE
	FROM
		tickets
	where
		ticket_id = '%s'
EOT;
	$query = sprintf ( $query, $_GET['ticket_id'] );
	$db->exec ( $query );
	$url = sprintf('Location: %s', "viewTickets.php?project_id=".$_SESSION ['ch_project_id']);
	header($url);
	exit;
}elseif (isset($_GET['ticket_id']) && isset($_GET['file_name'])){//チケットのファイルを消す
	echo "TICKET FILE DELETE";
	$query = <<<EOT
	UPDATE
		tickets
	SET
		file_name =""
	where
		ticket_id = '%s'
EOT;
	$query = sprintf ( $query, $_GET['ticket_id'] );
	$db->exec ( $query );
	unlink("view/".$_GET['file_name']);
	$url = sprintf('Location: %s', "viewTicket.php?ticket_id=".$_SESSION ['ch_ticket_id']);
	header($url);
	exit;
}//コメントのファイルを消す

/*


$smarty->assign ( 'names', $_SESSION['username'] );
$smarty->assign ( 'comments', $comennts );
$smarty->assign ( 'ticket', $ticket );
$smarty->assign ( 'ch_project_title', $_SESSION ['ch_project_title'] );
$smarty->assign ( 'ch_project_title', $_SESSION ['ch_project_title'] );
$smarty->assign ( 'ch_project_id', $_SESSION ['ch_project_id'] );
$smarty->display ( 'view/viewTicket.tpl' );
*/
?>