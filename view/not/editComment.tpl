<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8" />
		<link rel="stylesheet" href="css/edit.css" type="text/css" />
		<script type="text/javascript" src="js/jquery.js"></script>
		<script type="text/javascript" src="js/common.js"></script>
		<title>コメントの編集</title>
	</head>
	<body>
		<h1>コメントの編集</h1>
		<form action="editComment.php" method="post">
			<!-- コメントテーブルに格納する投稿ID -->
			<input type="hidden" name="id" value="{$id}" />
			<table>
				<thead>
					<tr>
						<td colspan="2">
							<div id="err_msg">&nbsp;</div>
						</td>
					</tr>
				</thead>
				<tbody>
					<tr>
						<th>タイトル</th>
						<td>
							<input type="text" name="title" id="title" value="{$row.title}" />
						</td>
					</tr>
					<tr>
						<th>本文</th>
						<td>
							<textarea name="body" id="body" cols="40" rows="8">{$row.comment}</textarea>
						</td>
					</tr>
					<tr>
						<td colspan="2" class="right_align">
							<input type="button" id="entry" value="決定" />
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</body>
</html>
