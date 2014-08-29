<?php

	require_once ('utils.php');
	require_once ('class/DBManager.php');
	// ログイン済みかを確認後、ユーザIDを取得
	$userId = getUserID ();
	$ticket_id = $_GET['ticket_id'];
	// DB管理オブジェクトの取得
	$db = DBManager::instance ();
	$project_id = $_SESSION ['ch_project_id'];
	//1まず最初にチケットの情報を持ってくる

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
	//2チケット担当者を持ってくる
	$query = <<<EOT
	SELECT
		users.user_id,
		name
	FROM
		users,ticket_tantou
	WHERE
		users.user_id = ticket_tantou.user_id and
		ticket_id = '%s'
EOT;
	$query = sprintf ( $query, $ticket_id );
	// 実行
	$db->exec ( $query );
	while ( $row = $db->fetch () ) {
		$enable_user[] = $row;
	}
	//3チケット担当者候補を持ってくる とりあえず、ロールID同一でプロ-enable
	//整理
	//	プロジェクト担当　－　ENABLE USER
	//マネージャ
	//ばぐっぽい
	$query = <<<EOT
	select A.user_id,name
from users as A,project_members
where A.user_id = project_members.user_id
and not exists
(SELECT
    *
FROM
    users as B,ticket_tantou
WHERE
    A.user_id = B.user_id and
    B.user_id = ticket_tantou.user_id and
        ticket_id = '%s'
)and project_id = '%s' and role_flag = '%s'
EOT;
	$query = sprintf ( $query, $ticket_id,$project_id,"2");
	// 実行
	$db->exec ( $query );
	while ( $row = $db->fetch () ) {
		$managers[] = $row;
	}


	//開発者
	$query = <<<EOT
	select A.user_id,name
from users as A,project_members
where A.user_id = project_members.user_id
and not exists
(SELECT
    *
FROM
    users as B,ticket_tantou
WHERE
    A.user_id = B.user_id and
    B.user_id = ticket_tantou.user_id and
        ticket_id = '%s'
)and project_id = '%s' and role_flag = '%s'
EOT;
	$query = sprintf ( $query, $ticket_id,$project_id,"1");
	// 実行
	$db->exec ( $query );
	while ( $row = $db->fetch () ) {
		$developers[] = $row;
	}


	//協力会社
	$query = <<<EOT
	select A.user_id,name
from users as A,project_members
where A.user_id = project_members.user_id
and not exists
(SELECT
    *
FROM
    users as B,ticket_tantou
WHERE
    A.user_id = B.user_id and
    B.user_id = ticket_tantou.user_id and
        ticket_id = '%s'
)and project_id = '%s' and role_flag = '%s'
EOT;
	$query = sprintf ( $query, $ticket_id,$project_id,"0");
	// 実行
	$db->exec ( $query );
	while ( $row = $db->fetch () ) {
		$partners[] = $row;
	}


	if(empty($enable_user)){
		$enable_user[0]['name'] = "";
	}
	if(empty($managers)){
		$managers[0]['name'] = "";
	}
	if(empty($developers)){
		$developers[0]['name'] = "";
	}
	if(empty($partners)){
		$partners[0]['name'] = "";
	}

	$smarty->assign ( 'title', "チケット編集");
	$smarty->assign ( 'ticket_id', $ticket_id);
	$smarty->assign ( 'names', $_SESSION['username'] );
	$smarty->assign ( 'ticket', $ticket );
	$smarty->assign ( 'ch_project_title', $_SESSION ['ch_project_title'] );
	$smarty->assign ( 'ch_project_title', $_SESSION ['ch_project_title'] );
	$smarty->assign ( 'ch_project_id', $_SESSION ['ch_project_id'] );
	$smarty->assign ( 'enable_users', $enable_user );
	$smarty->assign ( 'managers', $managers );
	$smarty->assign ( 'developers', $developers );
	$smarty->assign ( 'partners', $partners );

	$smarty->display ( 'view/editTicket.tpl' );
?>
