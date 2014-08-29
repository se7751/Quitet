<?php
echo '<meta charset="UTF-8" />';
require_once ('utils.php');
require_once ('class/DBManager.php');
// ログイン済みかを確認後、ユーザIDを取得
$userId = getUserID ();
if($_SESSION ['ch_project_id'] == ""){

}
$db = DBManager::instance ();
$ch_ticket_id = $_GET['ticket_id'];
$_SESSION['ch_ticket_id']=$ch_ticket_id;


//チケットidを所持するproject_idとnameを持ってくる
$query = <<<EOT
	SELECT
		projects.project_id,
		projects.title
	FROM
		projects,tickets
	WHERE
		projects.project_id = tickets.project_id and
		tickets.ticket_id = '%s'
EOT;
$query = sprintf ( $query, $ch_ticket_id );
$db->exec ( $query );

// データをフェッチ後、サニタイズ
while ( $row = $db->fetch () ) {

	$projects [] = sanitate ( $row );
}


$_SESSION ['ch_project_id'] = $projects [0]['project_id'];
$_SESSION ['ch_project_title'] = $projects [0]['title'];



//チケットの中身を持ってくる処理
$query = <<<EOT
	SELECT
		*
	FROM
		tickets
	where
		ticket_id = '%s'
EOT;
$query = sprintf ( $query, $_SESSION ['ch_ticket_id'] );
$db->exec ( $query );

// データをフェッチ後、サニタイズ
while ( $row = $db->fetch () ) {
	$ticket [] = sanitate ( $row );
}
$id = $ticket[0]['ticket_id'];
$tit = $ticket[0]['title'];

//チケットの担当者を持ってくる処理
$query = <<<EOT
	SELECT
		users.name
	FROM
		ticket_tantou,users
	WHERE
		ticket_tantou.user_id = users.user_id and
		ticket_tantou.ticket_id = '%s'
EOT;
$query = sprintf ( $query, $ch_ticket_id );
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
 * $user[$i++]['users'] = $temp;
*/
// 元のprojectsにmember一覧を追加
$ticket [0] ['members'] = $temp;




//チケットのコメントを持ってくる処理
$query = <<<EOT
	SELECT
		comennt_id,
		ticket_id,
		comments.user_id,
		comment,
		comments.created,
		file_name,
		name
	FROM
		comments,users
	where
		comments.user_id = users.user_id and
		ticket_id = '%s'
EOT;
$query = sprintf ( $query, $_SESSION ['ch_ticket_id'] );
$db->exec ( $query );

// データをフェッチ後、サニタイズ
while ( $row = $db->fetch () ) {
	$comennts [] = sanitate ( $row );
}
if(empty($comennts)){
	$comennts[0]['comennt_id'] = "";
}
//チケットの作成者を持ってくる処理
$query = <<<EOT
	SELECT
		users.name
	FROM
		tickets,users
	WHERE
		tickets.user_id = users.user_id and
		tickets.ticket_id = '%s'
EOT;
$query = sprintf ( $query, $ch_ticket_id );
// 実行
$db->exec ( $query );
// データをフェッチ後、サニタイズ
$tmp = "";
while ( $row = $db->fetch () ) {
	$tmp [] = sanitate ( $row );
}
$ticket[0]['create_user']=$tmp[0]['name'];


$smarty->assign ( 'title', $tit);
$smarty->assign ( 'ticket_id', $id);
$smarty->assign ( 'names', $_SESSION['username'] );
$smarty->assign ( 'comments', $comennts );
$smarty->assign ( 'ticket', $ticket );
$smarty->assign ( 'ch_project_title', $_SESSION ['ch_project_title'] );
$smarty->assign ( 'ch_project_id', $_SESSION ['ch_project_id'] );
$smarty->display ( 'view/viewTicket.tpl' );
?>