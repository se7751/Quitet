<?php
require_once ('utils.php');
require_once ('class/DBManager.php');
// ログイン済みかを確認後、ユーザIDを取得
$userId = getUserID ();
$db = DBManager::instance();
//使うデータをそろえます。
$tantou = $_POST['choose'];
$ticket_title = $_POST['title'];
$toukousya_id = $_SESSION['user_id'];
$insert_to_pro_id = $_SESSION ['ch_project_id'];
$ticket_body = $_POST['body'];
$state =$_POST['state'];
$kijitu =$_POST['kijitu'];
$priority =$_POST['priority'];
$category =$_POST['category'];
$file_name =$_FILES["upfile"]["name"];

// クエリを作成
$format = <<<EOT
	INSERT INTO tickets
		(user_id,project_id,title ,body ,kijitu,state ,priority,category,file_name)
	values
		('%s', '%s','%s', '%s','%s', '%s','%s', '%s','%s')
EOT;
$query = sprintf ( $format,$toukousya_id,$insert_to_pro_id,$ticket_title,$ticket_body,$kijitu,$state,$priority,$category,$file_name );
// クエリ発行
$db->exec ( $query );


//担当者の関連付け
//関連付けを行うチケットを探してくる（ここバグ）
$query = <<<EOT
	SELECT
		ticket_id
	FROM
		tickets
	where
		title = '%s' and body = '%s'
EOT;
$query = sprintf ( $query, $ticket_title,$ticket_body);
$db->exec ( $query );

// データをフェッチ後、サニタイズ
while ( $row = $db->fetch () ) {
	$ticketids [] = sanitate ( $row );
}


$TANTOUUSER = explode(',',$_POST['choose']);
foreach ($TANTOUUSER as $tan){
	$format = <<<EOT
		INSERT INTO ticket_tantou
			values ('%s', '%s')
EOT;
$query = sprintf($format,$ticketids[0]['ticket_id'],$tan);
	$db->exec ( $query );
}
echo "UPLOAD";
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



$url = sprintf('Location: %s', "viewTickets.php?project_id=".$insert_to_pro_id);
header($url);
exit;

?>