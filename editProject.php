<?php
//編集画面表示用
require_once ('utils.php');
require_once ('class/DBManager.php');
// ログイン済みかを確認後、ユーザIDを取得
$userId = getUserID ();
$project_id = $_GET['id'];
// DB管理オブジェクトの取得
$db = DBManager::instance ();

//プロジェクト名と概要をDBから持ってきて入れる（テキストボックスに）。
$query = <<<EOT
	SELECT
		title,
		body
	FROM
		projects
	WHERE
		project_id = '%s'
EOT;
$query = sprintf ( $query, $project_id );
// 実行
$db->exec ( $query );
while ( $row = $db->fetch () ) {
	$temppro = $row;
}
$title = $temppro['title'];
$body = $temppro['body'];
//ユーザを配列で持ってきて所属ユーザの欄はそのままprotan
$query = <<<EOT
	SELECT
		users.user_id,
		name
	FROM
		users,project_members
	WHERE
		users.user_id = project_members.user_id and
		project_id = '%s'
EOT;
$query = sprintf ( $query, $project_id );
// 実行
$db->exec ( $query );
while ( $row = $db->fetch () ) {
	$enable_user[] = $row;
}


//それ以外はalluser - protan
//マネージャ
//ばぐっぽい
$query = <<<EOT
	SELECT
		A.user_id,
		name
	FROM
		users as A
	where not exists(
	SELECT
		*
	FROM
		users as B,project_members
	WHERE
        A.user_id = B.user_id and
		B.user_id = project_members.user_id and
		project_members.project_id = '%s' and
		B.role_flag = '%s') and A.role_flag = '%s'
EOT;
$query = sprintf ( $query, $project_id,"2","2");
// 実行
$db->exec ( $query );
while ( $row = $db->fetch () ) {
	$managers[] = $row;
}


//開発者
$query = <<<EOT
	SELECT
		A.user_id,
		name
	FROM
		users as A
	where not exists(
	SELECT
		*
	FROM
		users as B,project_members
	WHERE
        A.user_id = B.user_id and
		B.user_id = project_members.user_id and
		project_id = '%s' and
		B.role_flag = '%s') and A.role_flag = '%s'
EOT;
$query = sprintf ( $query, $project_id,"1","1");
// 実行
$db->exec ( $query );
while ( $row = $db->fetch () ) {
	$developers[] = $row;
}


//協力会社
$query = <<<EOT
	SELECT
		A.user_id,
		name
	FROM
		users as A
	where not exists(
	SELECT
		*
	FROM
		users as B,project_members
	WHERE
        A.user_id = B.user_id and
		B.user_id = project_members.user_id and
		project_id = '%s' and
		B.role_flag = '%s') and A.role_flag = '%s'
EOT;
$query = sprintf ( $query, $project_id,"0","0");
// 実行
$db->exec ( $query );
while ( $row = $db->fetch () ) {
	$partners[] = $row;
}

//で問題のユーザインサートだが、一回担当テーブルを消して
//再度インサートがいいのかも
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



$smarty->assign ( 'title', "プロジェクトの編集" );
$smarty->assign ( 'names', $_SESSION['username'] );
$smarty->assign ( 'project_title', $title );
$smarty->assign ( 'project_body', $body );
$smarty->assign ( 'project_id', $project_id );
$smarty->assign ( 'enable_users', $enable_user );
$smarty->assign ( 'managers', $managers );
$smarty->assign ( 'developers', $developers );
$smarty->assign ( 'partners', $partners );
$smarty->display ( 'view/editProject.tpl' );


?>