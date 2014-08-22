<?php

/**
 * HTTPリクエスト管理クラス
 */
class Request {

	/**
	 * POSTデータの有無を判定
	 * @return bool POSTデータの有無
	 */
	public static function hasPost($index = null) {

		if (isset($_SERVER['REQUEST_METHOD']) && strcasecmp($_SERVER['REQUEST_METHOD'], 'post') == 0) {
			return ($index != null ? isset($_POST[$index]) : true);
		}

		return false;
	}

	/**
	 * GETデータの有無を判定
	 * @return bool GETデータの有無
	 */
	public static function hasGet($index = null) {

		if (isset($_SERVER['REQUEST_METHOD']) && strcasecmp($_SERVER['REQUEST_METHOD'], 'get') == 0) {
			return ($index != null ? isset($_GET[$index]) : true);
		}

		return false;
	}

	/**
	 * POSTデータの取得
	 * @param string $index POST配列の添え字
	 * @param mix $default POSTデータが存在しなかった場合のデフォルト値
	 * @return type POSTされたデータ
	 */
	public static function getPost($index, $default = null) {

		return (isset($_POST[$index]) ? $_POST[$index] : $default);
	}

	/**
	 * GETデータの取得
	 * @param string $index GET配列の添え字
	 * @param mix $default GETデータが存在しなかった場合のデフォルト値
	 * @return type GETされたデータ
	 */
	public static function getGet($index, $default = null) {

		return (isset($_GET[$index]) ? $_GET[$index] : $default);
	}

}
