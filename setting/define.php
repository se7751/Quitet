<?php

/**
 * DB関連の設定
 */
define('DB_HOST', 'localhost'); // MySQLが稼働するホスト名
define('DB_USER', 'root');  // MySQL上でのユーザ名
define('DB_PASSWORD', '');  // MySQL上でのパスワード
define('DB_NAME', 'ts');  // DB名

/**
 * ログ関連の設定
 */
define('LOG_CNT', 25); // ログの出力数
define('LOG_PATH', 'logs.log'); // ログファイルのパス
define('ROGO_PATH', 'images/TUBASA.jpg');

/**
 * リダイレクト先の設定
 */
define('URL_LOGIN', 'http://localhost/Quintet/'); // ログイン画面のURL
define('URL_BOARD', 'http://localhost/Quintet/board.php'); // 投稿一覧のURL


define('IMG_PATH', 'images/quintet-256.png'); // ログイン画面のパス