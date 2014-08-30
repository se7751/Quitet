<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="css/view.css" type="text/css" />
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/common.js"></script>
		<link type="text/css" rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/cupertino/jquery-ui.min.css" />
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
		<title>投稿一覧</title>
	</head>
	<body>
		<!-- ヘッダ -->
		<div id="header">
			<h1>投稿一覧</h1>
			<div id="menu">
				<a href="add.php">新規投稿</a> | <a href="logout.php">ログアウト</a><h4>{$names}</h4>
			</div>
		</div>
		<!-- コンテンツ -->
		<div id="wholewapper">
			<!-- 新規作成　ボタン -->
			{if ($role_flag == 2)}
			<a href="createProject.php" class="edit">プロジェクトの新規作成</a>
			{/if}
			<!-- projects配列から投稿内容を取り出して表示 -->
			{foreach from=$projects item=project}
				<div class="post">
					<!-- プロジェクトタイトル -->
					<div class="title">
                        <a href="changeProject.php?id={$project.project_id}"><h2>{$project.title}</h2></a>
                        作成日： {$project.created}
                        <div id="progress"></div>
						<!-- 編集　削除　ボタン(マネージャ以外表示させない) -->
						<div class="buttons">
						{if ($role_flag == 2)}
							<a href="#" class="edit">[編集]</a>
								<a href="#" class="delete" onclick="del_confirm('#');">[削除]</a>
						{/if}
						</div>
					</div>
					<!-- 参加メンバ -->
					参加メンバ:{$project.members}
					<!-- 概要 -->
					<!-- 概要 -->
					<div class="body">
					概要:{$project.body|nl2br}
					</div>

				</div>
			{/foreach}
		</div>
		<!-- フッタ -->
		<div id="footer">
			&copy; Quintet
		</div>
	</body>
</html>
