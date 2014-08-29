<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="css/view.css" type="text/css" />
        <link rel="stylesheet" href="css/sakusei.css" type="text/css" />
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
        <li class="off" id="protab"><a href="board.php">プロジェクト</a></li>
        <li class="on" id="tickettab"><a href="viewTickets.php?project_id={$ch_project_id}">チケット</a></li>
        <li class="off" id="newtickettab"><a href="createTicket.php?project_id={$ch_project_id}">チケット作成</a></li>
        <li class="off" id="searchtab"><a href="viewSearch.php">検索</a></li>
        </ul>
        </div>
        </div>
        <!-- ヘッダ -->
    </head>
    <body></br>
		<form action="editComment.php" method="post">
            </form>
		<div id="option">
			<a href="editTicket.php?ticket_id={$ticket_id}" class="project">編集</a>
            <a href="#" class="delete" onclick="del_confirm('delete.php?ticket_id={$ticket_id}');">[削除]</a>
		</div>
			<input type="hidden" name="id" value="33" />
			<table class="attributes">
				<tr>{foreach from=$ticket item=tic}
					<h2>{$tic.title}</h2>
					<th class="status">ステータス:</th>
					<td class="status">{$tic.state}</td>

					<th class="start-date">作成日:</th>
					<td class="start-date">{$tic.created}</td></tr>

					<th class="priority">優先度:</th>
					<td class="priority">{$tic.priority}</td>

					<th class="due-date">更新日:</th>
					<td class="due-date">{$tic.modified}</td></tr>

					<th class="assigned-to">期日:</th>
					<td class="assigned-to">{$tic.kijitu}</td>
                    
					<th class="a">担当者:</td>
					<td class="assigned-to">{$tic.members}</td>
    
                    

					<tr><th class="category">カテゴリー:</th><td class="category">{$tic.category}</td>
					<tr><th class="fixed-version">ファイル:</th><td class="fixed-version">
					<a href="view/{$tic.file_name}" class="user active">{$tic.file_name}</a>
					{if ($tic.file_name != "")}
                    <a href="#" class="delete" onclick="del_confirm('delete.php?ticket_id={$ticket_id}&file_name={$tic.file_name}');">[削除]</a>
					{/if}
                        <th class="a">作成者:</td>
					<td class="assigned-to">{$tic.create_user}</td>
					{/foreach}
				</tr>
			</table></br>

	<!-- 概要 -->
			<div id="gaiyo">
				<h3>概要</h3>
					<div id="hyouji" class="gaiyo">
						<div id="note-1">
							<p>{$tic.body}</p>
						</div>
					</div>
			</div></br></br>

	<!-- 投稿欄 -->
			<div id="history">
				<h3>コメント</h3>
					<div id="sc">
						{foreach from=$comments item=com}
						{if ($com.comennt_id != "")}
						<h4>投稿者:<a href="#" class="user active">{$com.name}</a></h4>
						<p>{$com.comment}</p><h5>投稿日時：{$com.created}</h5>
						<a href="view/{$com.file_name}" class="user active">{$com.file_name}</a>
					{if ($com.file_name != "")}
                    <a href="#" class="delete" onclick="del_confirm('delete.php?ticket_id={$ticket_id}&file_name={$com.file_name}&comment_id={$com.comennt_id}');">[削除]</a>
					{/if}<br/><a href="#" class="delete" onclick="del_confirm('delete.php?ticket_id={$ticket_id}&comment_id={$com.comennt_id}');">[コメントを削除]</a>
						
                <hr>
						{/if}
						{/foreach}
					</div>
				<!-- フッダ -->
					<div id="footer">
						&copy; sample
					</div>
			</div>


	<!-- コメント投稿 -->
			<div id="coment">
				<h3>コメント投稿</h3>
					<div id="kome">
                        <form action="excAddComments.php" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="ticket_id" value="{$ticket_id}" />
						<textarea name="body" id="body" cols="30" rows="8"></textarea><br>
								<pre>ファイル<input type="file" name="upfile"></pre>
								<input type="submit" id="entry" value="送信" />
                        </form>
					</div>
			</div>
		
	</body>
</html>
