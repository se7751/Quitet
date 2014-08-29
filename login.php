<?php

require_once('utils.php');
require_once('class/DBManager.php');

// DB管理オブジェクトの取得
$db = DBManager::instance();

// POSTされたデータを取得
$loginName = escepe_to_db(Request::getPost('user_id'));
$password = escepe_to_db(Request::getPost('password'));

// クエリを作成
$format = <<<EOT
	SELECT
           user_id
		, password
		, name
		, role_flag
	FROM
		users
	WHERE
		user_id = '%s'
EOT;
$query = sprintf($format, $loginName);

// クエリ発行
$db->exec($query);

// レコード数から妥当なユーザかを判定
if ($db->getRowCnt() <= 0) {

	Log::out('unknown user: ' . $loginName);
} else {

	// データを取得
	$row = $db->fetch();

	// IDとパスワードが一致するか判定
	if ($loginName == $row['user_id'] && $password == $row['password']) {

		Log::out('login successful: ' . $loginName);

		// セッション情報にユーザIDをセット
		session_start();
		$_SESSION['username'] = $row['name'];//ヘッダに表示させるユーザー名
        $_SESSION['user_id'] = $row['user_id'];//ログイン時のユーザID
        $_SESSION['role_flag'] = $row['role_flag'];//権限フラグ
        $_SESSION ['ch_project_title']="";
        $_SESSION['sort']="ticket_id";
        $_SESSION['sort_order']="asc";
        $_SESSION['flag']=0;


		// 投稿一覧へリダイレクト
		redirect_to_board();
	} else {

		Log::out('invarid login: ' . $loginName);
	}
}

// ログイン画面へリダイレクト
redirect_to_login();
