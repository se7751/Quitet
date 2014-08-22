<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<title>ログビューア</title>
	</head>
	<body>
		<h1>ログ一覧</h1>
		<hr />
		{foreach from=$logs item=log}
			<pre>{$log}</pre>
			<hr style="margin-top: 15px" />
		{/foreach}
	</body>
</html>
