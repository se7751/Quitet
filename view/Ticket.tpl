<!DOCTYPE html>
<html>
	<meta charset="UTF-8" />
		<link rel="stylesheet" href="../view.css" type="text/css" />
		<link rel="stylesheet" href="sakusei.css" type="text/css" />

	<!-- ヘッダ -->
	<div id="header">
			<h1>れっどぶるー</h1> <!--プロジェクト名-->
			<div id="menu">
				<a>あなたは</a><a>____</a> <!--ユーザ名-->
				<a>でログインしています。</a> | <a href="logout.php">ログアウト</a>
			</div>
			
		<div id="tub">
			<div class="box1">
				<ul>
					<li class="on"><a href="">プロジェクト</a></li>
					<li class="off"><a href="">チケット</a></li>
					<li class="off"><a href="">チケット作成</a></li>
					<li class="off"><a href="ticketDitail.php">検索</a></li>
				</ul>
			</div>
		</div>
	</div>
		
	<title>チケット詳細</title>

	<body></br>
		<form action="editComment.php" method="post">
		
		<div id="option">
			<a href="#" class="project">編集</a>
			<a href="#" class="project">削除</a>
		</div>
			<input type="hidden" name="id" value="33" />
			<table class="attributes">
				<tr>
					<h2>チケットの名前</h2>
					<th class="status">ステータス:</th>
					<td class="status">新規</td>
					
					<th class="start-date">作成日:</th>
					<td class="start-date">2014/08/21</td></tr>
					
					<th class="priority">優先度:</th>
					<td class="priority">通常</td>
					
					<th class="due-date">更新日:</th>
					<td class="due-date">2014/08/21</td></tr>
					
					<th class="assigned-to">期日:</th>
					<td class="assigned-to">-</td>
					
					<th class="a">担当者:</td>
					<td class="assigned-to">山田,佐藤,田中</td>
					
					<tr><th class="category">カテゴリー:</th><td class="category">-</td>
					<tr><th class="fixed-version">ファイル:</th><td class="fixed-version">
					<a href="/demo/users/3" class="user active">背中.pdf</a>
					<input type="submit" id="entry" value="削除" /></td>
				</tr>
			</table></br>
			
	<!-- 概要 -->
			<div id="gaiyo">
				<h3>概要</h3>
					<div id="hyouji" class="gaiyo">
						<div id="note-1">
							<p>今は</p>
						</div>
					</div>
			</div></br></br>

	<!-- 投稿欄 -->
			<div id="history">
				<h3>投稿欄</h3>
					<div id="sc">
					
						<h4>投稿者:<a href="/demo/users/3" class="user active">伊藤 健太</a></h4>
						<p>今日はおいしかったです。</p><h5>投稿日時：2014/08/01</h5>
						<hr>
					
						<h4>投稿者:<a href="/demo/users/3" class="user active">伊藤 健太</a></h4>
						<p>今でしょ！</p><h5>投稿日時：2014/08/01</h5>
						<hr>
						
						<h4>投稿者:<a href="/demo/users/3" class="user active">伊藤 健太</a></h4>
						<p>今は何してる？</p><h5>投稿日時：2014/08/01</h5>
						<hr>
						
						<h4>投稿者:<a href="/demo/users/3" class="user active">伊藤 健太</a></h4>
						<p>今日は今日です。</p><h5>投稿日時：2014/08/01</h5>
						<hr>
					
						<h4>投稿者:<a href="/demo/users/3" class="user active">伊藤 健太</a></h4>
						<p>今は昨日です。</p><h5>投稿日時：2014/08/01</h5>
						<hr>
					
						<h4>投稿者:<a href="/demo/users/3" class="user active">伊藤 健太</a></h4>
						<p>今は昨日です。</p><h5>投稿日時：2014/08/01</h5>
						<hr>
					
						<h4>投稿者:<a href="/demo/users/3" class="user active">伊藤 健太</a></h4>
						<p>今は昨日です。</p><h5>投稿日時：2014/08/01</h5>
						<hr>
					
						<h4>投稿者:<a href="/demo/users/3" class="user active">伊藤 健太</a></h4>
						<p>今は昨日です。</p><h5>投稿日時：2014/08/01</h5>
						<hr>
					
						<h4>投稿者:<a href="/demo/users/3" class="user active">伊藤 健太</a></h4>
						<p>今は昨日です。</p><h5>投稿日時：2014/08/01</h5>
						<hr>
					</div>
				<!-- フッダ -->
					<div id="footer">
						&copy; Quintet
					</div>
			</div>


	<!-- コメント投稿 -->
			<div id="coment">
				<h3>コメント投稿</h3>
					<div id="kome">
						<textarea name="body" id="body" cols="30" rows="8">aiueo</textarea><br>
								<pre>ファイル<input type="file" name="example1"></pre>
								<input type="submit" id="entry" value="送信" />
					</div>
			</div>
		</form>
	</body>
</html>
