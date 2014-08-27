<?php
echo '<meta charset="UTF-8" />';
require_once ('utils.php');
require_once ('class/DBManager.php');
// ログイン済みかを確認後、ユーザIDを取得
$userId = getUserID ();
$db = DBManager::instance ();


if(isset($_GET['project_id'])){
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
}elseif (isset($_GET['ticket_id'])){
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
}

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