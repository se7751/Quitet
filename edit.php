<?php
echo '<meta charset="UTF-8" />';
require_once ('utils.php');
require_once ('class/DBManager.php');
// ログイン済みかを確認後、ユーザIDを取得
$userId = getUserID ();
echo "Projectname:" . Request::getPost ( 'title' );
echo "Gaiyou" . Request::getPost ( 'body' );
echo "Members" . Request::getPost ( 'choose' );

$eee = Request::getPost ( 'choose' );
$sample = explode ( ',', $eee );

// データがPOSTされた？ (YES => DB登録 / NO => フォーム表示)
if (Request::hasPost ()) {

	// DB管理オブジェクトの取得
	$db = DBManager::instance ();

	// POSTされたデータを取得
	$protitle = escepe_to_db ( Request::getPost ( 'title' ) );
	$probody = escepe_to_db ( Request::getPost ( 'body' ) );
	// クエリを作成
	$format = <<<EOT
	INSERT INTO projects
		(title,body)
	values
		('%s', '%s')
EOT;
	$query = sprintf ( $format, $protitle, $probody );

	// クエリ発行
	$db->exec ( $query );

	// プロジェクトID拾ってくる
	//ここの拾い方かなりまずい。。バグあり
	$query = <<<EOT
	SELECT
		projects.project_id
	FROM
		projects
	WHERE
		projects.title = '%s' and projects.body = '%s'
EOT;
	$query = sprintf ( $query, $protitle, $probody );
	$db->exec ( $query );
	// データをフェッチ後、サニタイズ
	$tmp = "";
	while ( $row = $db->fetch () ) {
		$name [] = $row;
	}
	$nowProID = $name [0] ['project_id'];
	foreach ( $sample as $a ) {
		// クエリを作成
		$format = <<<EOT
	INSERT INTO project_members
		(project_id,user_id)
	values
		('%s', '%s')
EOT;
		$query = sprintf ( $format, $nowProID, $a );
		$db->exec ( $query );
	}

	// 投稿一覧へリダイレクト
	redirect_to_board();
}
?>