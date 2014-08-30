<?php
//プロジェクト編集用

require_once ('utils.php');
require_once ('class/DBManager.php');
// ログイン済みかを確認後、ユーザIDを取得
$userId = getUserID ();
// DB管理オブジェクトの取得
$db = DBManager::instance ();
echo '<meta charset="utf-8"/>';
var_dump($_POST);
$eee = Request::getPost ( 'choose' );
$sample = explode ( ',', $eee );
//UPDATEをprojectsに対してかける
$title = escepe_to_db ( Request::getPost ( 'title' ) );
$body = escepe_to_db ( Request::getPost ( 'body' ) );
$ticket_id = escepe_to_db ( Request::getPost ( 'id' ) );
$file_name = $_FILES["upfile"]["name"];
// クエリを作成
$format = <<<EOT
	UPDATE tickets
	SET
		title = '%s',
		body = '%s',
		state = '%s',
		category = '%s',
		priority = '%s',
		kijitu = '%s',
		modified = '%s',
		file_name = '%s'
	WHERE ticket_id = '%s'
EOT;
$query = sprintf ( $format,$title,$body,$_POST['state'],$_POST['category'],$_POST['priority'],$_POST['kijitu'],date('Y-m-d H:i:s'),$file_name,$ticket_id);
var_dump($query);
// クエリ発行
$db->exec ( $query );


//次にプロジェクトidに該当する行をproject_membersから消す
$query = <<<EOT
	DELETE
	FROM
		ticket_tantou
	where
		ticket_id = '%s'
EOT;
$query = sprintf ( $query, $ticket_id );
$db->exec ( $query );
//そしてメンバを入れる
var_dump($sample);
foreach ( $sample as $a ) {
	// クエリを作成
	$format = <<<EOT
	INSERT INTO ticket_tantou
		(ticket_id,user_id)
	values
		('%s', '%s')
EOT;
	$query = sprintf ( $format,$ticket_id, $a );
	$db->exec ( $query );
}

//ファイルアップロード処理
if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
	$str = "view/" . $_FILES["upfile"]["name"];
	$str = mb_convert_encoding($str, "SJIS", "AUTO");
	if (move_uploaded_file($_FILES["upfile"]["tmp_name"], $str)) {
		chmod("view/" . $_FILES["upfile"]["name"], 0644);
		echo "upload";
	}
}else {
	echo "NOT UPLOAD";
}
$url = sprintf('Location: %s', "viewTicket.php?ticket_id=".$ticket_id);
header($url);
exit;

?>