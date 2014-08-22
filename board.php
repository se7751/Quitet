<?php

require_once('utils.php');
require_once('class/DBManager.php');

//ログイン済みかを確認後、ユーザIDを取得
$userId = getUserID();

// DB管理オブジェクトの取得
$db = DBManager::instance();
$db2 = DBManager::instance();
if ($_SESSION['role_flag'] == "2" || $_SESSION['role_flag'] == "1"){//開発者とマネージャーの場合
$query = <<<EOT
	SELECT
		project_id
		, title
		, body
		, created
	FROM
		projects
EOT;
}elseif ($_SESSION['role_flag'] == "0") {//協力会社の場合
	$query = <<<EOT
	SELECT
		projects.project_id
		, title
		, body
		, created
	FROM
		projects,project_members
	WHERE
		projects.project_id = project_members.project_id and
		project_members.user_id = '%s'
EOT;
$query = sprintf($query, $_SESSION['user_id']);
}
$db->exec($query);

// データをフェッチ後、サニタイズ
while ($row = $db->fetch()) {

	$projects[] = sanitate($row);
}


/*
// 各ポストにひもづくコメントデータを格納
for ($i = 0; $i < count($projects); $i++) {

	$projects[$i]['project_members'] = getComments($projects[$i]['id']);
}
 * */
$i=0;
//1プロジェクトに携わるメンバを抽出する処理
//IDを抽出
foreach ($projects as $minipro) {
		//ProIDを抽出
		$cid = $minipro['project_id'];
		//Queryつくる
		$query = <<<EOT
	SELECT
		name
	FROM
		project_members,users
	WHERE
		project_members.user_id = users.user_id and
		project_members.project_id = '%s'
EOT;
		$query = sprintf($query, $cid);
		//実行
		$db->exec($query);
		// データをフェッチ後、サニタイズ
		$tmp ="";
		while ($row = $db2->fetch()) {
			 $tmp[] = sanitate($row);
		}
		$k=0;
		$temp="";
		foreach ($tmp as $name){
			$temp = $temp.$name['name'].",";
		}
		/*$user[$i++]['users'] = $temp;
		var_dump($temp);
		
		*/
		//	元のprojectsにmember一覧を追加
		$projects[$i]['members'] = $temp;
		$i++;
		}


/*
echo $projects[$i]['project_id'];
$aaa = $projects[0];
var_dump($aaa);
echo "ok".$aaa['project_id'];
*/






//selectでユーザ名を持ってきて回す
/*
foreach ($projects as $key => $value) {
	var_dump($key);
}
*/


/*
for($i=1;count($projects);$i++){
	echo $projects[$i]['name'];
}
var_dump($projects);
foreach ($projects as $key => $value) {
	$query = <<<EOT
	SELECT
		name
	FROM
		project_members,users
	WHERE
		project_members.user_id = users.user_id and
		project_members.project_id = '%s'
EOT;
$query = sprintf($query, $key);
$db2->exec($query);
// データをフェッチ後、サニタイズ
$tmp ="";
while ($row = $db2->fetch()) {
	 $tmp[] = sanitate($row);
}
$k=0;
$temp="";
foreach ($tmp as $key => $value){
	$temp = $temp.$tmp[$k++]['name'].' , ';
}
$user[$i++]['users'] = $temp;
var_dump($temp);
$i++;
}
*/

// 投稿一覧を表示
$smarty->assign('role_flag',  $_SESSION['role_flag']);
$smarty->assign('userId', $userId);
if(isset($projects)){
	$smarty->assign('projects', $projects);
}else{
	$projects[0]['project_id'] = "";
	$projects[0]['title'] = "表示できるプロジェクトがありません";
	$projects[0]['body'] = "";
	$projects[0]['created'] = "";
	$smarty->assign('projects', $projects);
}
$smarty->assign('names', $_SESSION['username']);
$smarty->display('view/board.tpl');

/**
 * 投稿に該当するコメントを取得
 * @param string $id 投稿ID
 * @return array コメント配列
 */
/*
function getComments($id) {

	$db = DBManager::instance();

	$format = <<<EOT
	SELECT
		comments.id
		, comments.user_id
		, comments.title
		, comments.comment
		, users.name
		, comments.modified
	FROM
		comments
			INNER JOIN users
				ON comments.user_id = users.id
	WHERE
		post_id = '%d'
EOT;
	$query = sprintf($format, $id);

	$db->exec($query);

	$comments = array();
	while ($row = $db->fetch()) {

		$comments[] = $row;
	}
	return $comments;
}
*/