<?php

require_once('setting/define.php');
require_once('class/Log.php');
require_once('class/Request.php');

// テンプレートエンジンの読み込みと初期化
require_once('Smarty-3.0.8\libs\Smarty.class.php');
$smarty = new Smarty();

/**
 * ログイン画面へリダイレクト
 */
function redirect_to_login() {

	$url = sprintf('Location: %s', URL_LOGIN);
	header($url);
	exit;
}

/**
 * 投稿画面へリダイレクト
 */
function redirect_to_board() {

	$url = sprintf('Location: %s', URL_BOARD);
	header($url);
	exit;
}

/**
 * ログイン済みかを確認後、ユーザIDを返す
 * @return string ユーザID
 */
function getUserID() {

	// ログイン済みかを確認
	session_start();
	if (isset($_SESSION['user_id'])) {

		// セッション情報からユーザIDを取得
		return $_SESSION['user_id'];
	} else {

		// ログイン画面へリダイレクト
		redirect_to_login();
	}
}

/**
 * 表示用にサニタイズ
 * @param mix $target
 * @return mix $target サニタイズ結果
 */
function sanitate($target) {

	// 引数が配列かを判定
	if (is_array($target)) {

		// array_map(関数，配列): 配列を関数で再帰処理
		return array_map('sanitate', $target);
	}

	// ゼロバイト文字による攻撃へ対応します（バイナリセーフ)
	$target = str_replace('\0', '', $target);

	// データベース保存時に追加したバックスラッシュを除去
	$target = stripslashes($target);

	// タグや記号をエスケープしてタグ文字列を無効化
	$target = htmlspecialchars($target, ENT_QUOTES, 'UTF-8');

	return $target;
}

/**
 * DB用にサニタイズ
 * @param mix $target
 * @return mix $target サニタイズ結果
 */
function escepe_to_db($target) {

	if (is_array($target)) {

		return array_map('escepe_to_db', $target);
	}

	if (!is_numeric($target)) {

		// mysqlへ登録する際に問題となる記号をエスケープ
		// 改行コード(\n,\r）やEOFはエスケープしない
		$target = mysql_real_escape_string($target);
	}

	return $target;
}