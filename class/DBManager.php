<?php

require_once('./setting/define.php');
require_once('./class/Log.php');

/**
 * データベース管理クラス
 */
class DBManager {

	// DBManagerのインスタンス
	static $manager = null;
	// DB接続情報
	private $link = null;
	// クエリ発行結果
	private $result = null;

	/**
	 * コンストラクタ
	 */
	private function __construct() {

		// MySQLへ接続
		$this->link = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);

		// DB選択
		mysql_select_db(DB_NAME, $this->link);
	}

	/**
	 * DBManagerのインスタンスを取得
	 */
	public static function instance() {

		if (self::$manager == null) {
			self::$manager = new DBManager();
		}

		return self::$manager;
	}

	/**
	 * クエリ発行
	 * @param string $query クエリ
	 */
	public function exec($query) {

		// クエリをログ出力
		Log::out("QUERY EXEC:\n" . $query);

		// クエリ発行
		$this->result = mysql_query($query, $this->link);

		// 結果判定
		if (!$this->result) {

			// MySQLからエラー内容を取得
			$err = mysql_error();

			Log::out("QUERY ERROR:\n" . $err);
			$msg = sprintf('[ERROR]: %s', mysql_error());
			exit($msg); // 画面にエラー内容を表示
		}
	}

	/**
	 * クエリに対する該当行数の取得
	 * @return int 該当行数
	 */
	public function getRowCnt() {

		return mysql_num_rows($this->result);
	}

	/**
	 * データのフェッチ
	 * @return array 該当行
	 */
	public function fetch() {

		return mysql_fetch_assoc($this->result);
	}

}
