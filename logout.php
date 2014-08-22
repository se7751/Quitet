<?php

require_once('utils.php');

// セッション情報を確認
session_start();
if (isset($_SESSION['user_id'])) {

	// セッション情報からユーザIDを削除
	unset($_SESSION['user_id']);

	// セッションを破棄
	session_destroy();
}

// ログイン画面へリダイレクト
redirect_to_login();
