<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="css/view.css" type="text/css" />
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/common.js"></script>
		<!-- ヘッダ -->
        <title>{$title}</title>
        <div id="header">
        <h1>{$ch_project_title}</h1>
        <div id="menu">
        <a>あなたは</a> {$names}
        <a>でログインしています。</a> | <a href="logout.php">ログアウト</a>
        </div>
        <div id="tub">
        <ul>
        <li class="on" id="protab"><a href="board.php">プロジェクト</a></li>
        <li style="visibility:hidden background-color:#1B5090" class="off" id="tickettab" ><a style="visibility:hidden" href="viewTickets.php">チケット</a></li>
        <li class="off" id="newtickettab"><a style="visibility:hidden" href="createTicket.php">チケット作成</a></li>
        <li class="off" id="searchtab"><a href="viewSearch.php">検索</a></li>
        </ul>
        </div>
        </div>
        <!-- ヘッダ -->
	</head>
	<body>
    


		<!-- コンテンツ -->
		<div id="wholewapper">
			<p id="right_align">
			{if ($role_flag == "2")}
				<a href="createProject.php">新しいプロジェクト</a>
				{/if}
			</p>
			<!-- posts配列から投稿内容を取り出して表示 -->
			{foreach from=$projects item=project}
				<div class="post">
					<!-- 投稿タイトル -->
					<div class="title">
						<a href="viewTickets.php?project_id={$project.project_id}"><h2>{$project.title}</h2></a>
						<div class="buttons">


						     <!-- 投稿本文 -->
					<div class="body">
						<p id="left_align">{$project.body|nl2br}</p>
					</div>
					     <p id="left_align">
							<progress value="{$project.sintyoku}" max="100"></progress>進捗率{$project.sintyoku}%<br>参加者:{$project.members}</p>
					   <p> <strong>作成日</strong> / {$project.created}
							{if ($role_flag == "2")}
								<a href="editProject.php?id={$project.project_id}" class="edit">[編集]</a>
								<a href="#" class="delete" onclick="del_confirm('delete.php?project_id={$project.project_id}');">[削除]</a>
							{/if}

						     </p>
						</div>
					</div>


				</div>
			{/foreach}
		</div>
		<!-- フッタ -->
		<div id="footer">
			&copy; sample
		</div>
	</body>
</html>