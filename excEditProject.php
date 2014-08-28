<?php
//プロジェクト編集用
require_once ('utils.php');
require_once ('class/DBManager.php');
// ログイン済みかを確認後、ユーザIDを取得
$userId = getUserID ();
// DB管理オブジェクトの取得
$db = DBManager::instance ();

var_dump($_POST);
$eee = Request::getPost ( 'choose' );
$sample = explode ( ',', $eee );
//UPDATEをprojectsに対してかける
$protitle = escepe_to_db ( Request::getPost ( 'title' ) );
$probody = escepe_to_db ( Request::getPost ( 'body' ) );
$proid = escepe_to_db ( Request::getPost ( 'project_id' ) );
// クエリを作成
$format = <<<EOT
	UPDATE projects
	SET title = '%s',body = '%s'
	WHERE project_id = '%s'
EOT;
$query = sprintf ( $format, $protitle, $probody,$proid);

// クエリ発行
$db->exec ( $query );


//次にプロジェクトidに該当する行をproject_membersから消す
$query = <<<EOT
	DELETE
	FROM
		project_members
	where
		project_id = '%s'
EOT;
$query = sprintf ( $query, $proid );
$db->exec ( $query );
//そしてメンバを入れる
var_dump($sample);
foreach ( $sample as $a ) {
	// クエリを作成
	$format = <<<EOT
	INSERT INTO project_members
		(project_id,user_id)
	values
		('%s', '%s')
EOT;
	$query = sprintf ( $format,$proid, $a );
	$db->exec ( $query );
}
$url = sprintf('Location: %s', "board.php");
header($url);
exit;
?>