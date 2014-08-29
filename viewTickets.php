<?php
require_once ('utils.php');
require_once ('class/DBManager.php');
// ログイン済みかを確認後、ユーザIDを取得
$userId = getUserID ();
// DB管理オブジェクトの取得
$db = DBManager::instance ();

$_SESSION ['ch_project_id'] = $_GET ['project_id'];


$_SESSION['flag']=1;
//ソート機能
if(isset($_GET['sort'])){//値があった場合
	if($_SESSION['sort_order' ]== "desc"){
		echo "asc sort";
		$_SESSION['sort_order']="asc";
	}elseif($_SESSION['sort_order']=="asc"){
		echo "desc sort";
		$_SESSION['sort_order']="desc";
	}
	$_SESSION['sort']=$_GET['sort'];
}




// プロジェクト表示用にプロジェクト名を持ってくる
$query = <<<EOT
	SELECT
		title
	FROM
		projects
	where
		project_id = '%s'
EOT;
$query = sprintf ( $query, $_SESSION ['ch_project_id'] );
$db->exec ( $query );

// データをフェッチ後、サニタイズ
while ( $row = $db->fetch () ) {
	$projects [] = sanitate ( $row );
}
$_SESSION ['ch_project_title'] = $projects [0] ['title'];


	// 進捗表示機能のために数字を持ってくる処理を実装
	// プログレスバーに表示する数値を取得　完了でないチケット/完了チケット*100
	// Queryつくる
	$query = <<<EOT
		SELECT
			count(*) as total
		FROM
			projects,tickets
		WHERE
			projects.project_id = tickets.project_id and
			projects.project_id = '%s'
EOT;
	$query = sprintf ( $query, $_SESSION ['ch_project_id'] );
	// 実行
	$db->exec ( $query );
	// データをフェッチ後、サニタイズ
	$tmp = "";
	while ( $row = $db->fetch () ) {
		$tmp [] = sanitate ( $row );
	}
	$total = $tmp [0] ['total'];
	//
	$query = <<<EOT
		SELECT
			count(*) as untotal
		FROM
			projects,tickets
		WHERE
			projects.project_id = tickets.project_id and
			projects.project_id = '%s'and
			tickets.state != '完了'
EOT;
	$query = sprintf ( $query, $_SESSION ['ch_project_id'] );
	// 実行
	$db->exec ( $query );
	// データをフェッチ後、サニタイズ
	$tmp = "";
	while ( $row = $db->fetch () ) {
		$tmp [] = sanitate ( $row );
	}
	$untotal = $tmp [0] ['untotal'];
	if ($total != 0) {
		$sintyoku = ($total - $untotal) / $total * 100;
	} else {
		$sintyoku = 0;
	}
	$owari = $total - $untotal;





	// 選択されたプロジェクトに紐づくチケットを持ってくる。
	$query = <<<EOT
	SELECT
		*
	FROM
		tickets
	where
		tickets.project_id = '%s' order by %s %s LIMIT %s , %s
EOT;




	if(empty($_SESSION['limit'])){//なにもプリセットされてない場合
		echo "IF1";
		$query = sprintf ( $query, $_SESSION ['ch_project_id'],$_SESSION['sort'],$_SESSION['sort_order'],0,10);
		$_SESSION['limit'] = 10;
	}else if(!empty($_GET['limit'])){//limitが指定されたとき
		echo "IF2";
		$_SESSION['limit'] = $_GET['limit'];
		$query = sprintf ( $query, $_SESSION ['ch_project_id'],$_SESSION['sort'],$_SESSION['sort_order'],0, $_GET['limit']);
	}else if(!empty($_GET['page'])){//pageが指定されたとき
		echo "IF3";
		//2*10 - 10-1
		//20 - 9
		//11
		$npages =($_GET['page'] * $_SESSION['limit']) - ($_SESSION['limit']);
		$query = sprintf ( $query, $_SESSION ['ch_project_id'],$_SESSION['sort'],$_SESSION['sort_order'],$npages, $_SESSION['limit']);
	}else {
		$_SESSION['limit'] = 10;
		$query = sprintf ( $query, $_SESSION ['ch_project_id'],$_SESSION['sort'],$_SESSION['sort_order'],0, $_SESSION['limit']);
	}
	var_dump($query);
	$db->exec ( $query );

	// データをフェッチ後、サニタイズ
	while ( $row = $db->fetch () ) {
		$tickets [] = sanitate ( $row );
	}
if(empty($tickets)){
		$tickets[0]['ticket_id'] = "";
	}

	//ページング処理は総チケット数を切り上げて
	$i;
	$pageNums;
	for($i=1;$i<=ceil($total*0.1*10/$_SESSION['limit']);$i++){
		$pageNums [$i-1]= $i;
	}
	if(empty($pageNums)){
		$pageNums [0]= "";
	}




$smarty->assign ( 'limit', $_SESSION['limit'] );
$smarty->assign ( 'pageNums', $pageNums );
$smarty->assign ( 'title', $_SESSION ['ch_project_title']."　―　チケット一覧" );
$smarty->assign ( 'names', $_SESSION['username'] );
$smarty->assign ( 'tickets', $tickets );
$smarty->assign ( 'sintyoku', $sintyoku );
$smarty->assign ( 'untotal', $untotal );
$smarty->assign ( 'ch_project_id', $_SESSION ['ch_project_id'] );
$smarty->assign ( 'total', $total );
$smarty->assign ( 'owari', $owari );
$smarty->assign ( 'ch_project_title', $_SESSION ['ch_project_title'] );
$smarty->display ( 'view/viewTickets.tpl' );
?>
