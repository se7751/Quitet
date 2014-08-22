<?php

require_once('./setting/define.php');

/**
 * ログ管理クラス
 */
class Log {

	/**
	 * ロギング (出力されたログは http://localhost/bbs/log.php で確認可能)
	 * @param string $msg ログ出力メッセージ
	 */
	public static function out($msg) {

		// 呼び出し元情報を取得
		$debug_array = debug_backtrace();

		// 呼び出し元ファイル名の取得
		$file = $debug_array[0]['file']; // 呼び出し元ファイルのフルパス
		$pos = strrpos($file, '\\') + 1; // 最後の区切り文字の位置
		$len = strlen($file) - $pos;  // ファイル名の文字列長
		$file = substr($file, $pos, $len);  // 呼び出し元ファイル名を切り出し
		// 呼び出し元ファイルの行数を取得
		$line = $debug_array[0]['line'];

		// ログメッセージの整形
		$now = date('y/m/d H:i:s');
		$msg = sprintf("[%s %s (%d)] %s\r\n", $now, $file, $line, $msg);

		// ファイルにログ出力
		error_log($msg, 3, LOG_PATH);
	}

	/**
	 * ログファイルから指定ログ数を読み込み配列として返す
	 * @return array $logs ログ配列
	 */
	public static function get() {

		// ログファイルを読み込み配列として格納
		$lines = file(LOG_PATH);

		// ログ出力の開始行設定 (表示が最大数に収まるように設定)
		$logs_cnt = 0;
		$start_line = 0;
		for ($i = count($lines) - 1; 0 <= $i; $i--) {

			// ログの開始を示す行？
			if (substr($lines[$i], 0, 1) == '[') {

				$logs_cnt++;
			}

			// ログ出力の最大数以上の場合に開始行を設定
			if (LOG_CNT <= $logs_cnt) {

				$start_line = $i;
				break;
			}
		}

		// ログ出力
		$index = -1;
		$logs = array();
		for ($i = $start_line; $i < count($lines); $i++) {

			// ログの開始を示す行？
			if (substr($lines[$i], 0, 1) == '[') {

				// 配列に新しい要素を追加
				$logs[] = $lines[$i];
				$index++;
			} else {

				// 配列の追加した要素に追記
				$logs[$index] .= $lines[$i];
			}
		}

		return $logs;
	}

}