<?php
	var_dump($_POST);
	require_once ('utils.php');
	require_once ('class/DBManager.php');
	// ログイン済みかを確認後、ユーザIDを取得
	$userId = getUserID ();
	$file_name =$_FILES["upfile"]["name"];
	$db = DBManager::instance();
	//使うデータをそろえます。
	// クエリを作成
	$format = <<<EOT
	INSERT INTO comments
		(ticket_id,user_id,comment,file_name)
	values
		('%s','%s', '%s','%s')
EOT;
	$query = sprintf ( $format,$_POST['ticket_id'],$_SESSION['user_id'],$_POST['body'],$file_name );
	// クエリ発行
	$db->exec ( $query );
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
	$url = sprintf('Location: %s', "viewTicket.php?ticket_id=".$_POST['ticket_id']);
	header($url);
	exit;
?>