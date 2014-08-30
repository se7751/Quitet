<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="view.css" type="text/css" />
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/common.js"></script>
		<title>Quintet</title>
	</head>
	<body>
		<!-- ヘッダ -->
		<div id="header">
			<h1></h1> <!--プロジェクト名-->
			<div id="menu">
				<a>あなたは</a><a>{$names}</a> <!--ユーザ名-->
				<a>でログインしています。</a> | <a href="logout.php">ログアウト</a>
			</div>
			
		<div id="tub">	
			<ul>
			<li class="on"><a href="">プロジェクト</a></li>
			<li class="off"><a href="">チケット</a></li>
			<li class="off"><a href="">チケット作成</a></li>
			<li class="off"><a href="">検索</a></li>
		    </ul>
			
	   </div>
		</div>
		
		
		<!-- コンテンツ -->
		<div id="wholewapper">
			<p id="right_align">
				<a href="">新規投稿</a>
			</p>
			<!-- posts配列から投稿内容を取り出して表示 -->
			{foreach from=$posts item=post}
				<div class="post">
					<!-- 投稿タイトル -->
					<div class="title">
						<a href=""><h2>{$post.title}</h2></a>
						<div class="buttons">
							
						
						     <!-- 投稿本文 -->
					<div class="body">
						<p id="left_align">{$post.body|nl2br}</p>
					</div>
					     <p id="left_align">	<progress value="0.5"></50>
							<progress value="50" max="100">進捗率 50%</progress></p>   
					   <p> <strong>{$post.name}</strong> / {$post.created}
							{if ($userId == $post.user_id)}
								<a href="edit.php?id={$post.id}" class="edit">[編集]</a>
								<a href="#" class="delete" onclick="del_confirm('delete.php?id={$post.id}');">[削除]</a>
							{/if}
							
							
						     </p>
						</div>
					</div>
					
					<!-- <div class="comments"> -->
						<!-- post.comments配列から投稿内容を取り出して表示 -->
					<!--	{foreach from=$post.comments item=comment} -->
							<!-- コメントタイトル -->
					<!--		<h3 class="comments_header">{$comment.title}</h3>
							<p>
								<strong>{$comment.name}</strong> / {$comment.modified}
								{if ($userId == $comment.user_id)}
									<a href="editComment.php?id={$comment.id}" class="edit">[編集]</a>
									<a href="#" class="delete" onclick="del_confirm('deleteComment.php?id={$comment.id}');">[削除]</a>
								{/if}
							</p>  -->
							<!-- コメント本文 -->
						<!--	<p class="comments_body">
								{$comment.comment|nl2br}
							</p>
						{/foreach}
					</div>
				</div>
			{/foreach}
		</div>  -->
		<!-- フッタ -->
		<div id="footer">
			&copy; Quintet
		</div>
	</body>
</html>
