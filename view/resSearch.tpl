<!DOCTYPE html>
<html>
    <head> 
        <meta charset="UTF-8" />
		<link rel="stylesheet" href="css/view.css" type="text/css" />
		<link rel="stylesheet" href="css/itiran.css" type="text/css" />
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
        <li class="off" id="tickettab"><a href="viewTickets.php?project_id={$ch_project_id}">チケット</a></li>
        <li class="off" id="newtickettab"><a href="createTicket.php?project_id={$ch_project_id}">チケット作成</a></li>
        <li class="off" id="searchtab"><a href="viewSearch.php">検索</a></li>
        </ul>
        </div>
        </div>
        <!-- ヘッダ -->
    </head>
	<br/><h2></h2>

<!-- 進捗率 -->
	<div id="roadmap">
		<p>進捗率</p>
		<progress value="{$sintyoku}" max="100">50%</progress>
		<p class="percent">{$sintyoku}%</p>
		<p class="progress-info">
			{$total} チケット&nbsp;
			({$owari}件完了&#8212;{$untotal}件未完了)
		</p>
	</div><br/>

<!-- 絞り込み -->
	<div id="sibori">
		<p>・絞り込み</p>
		<form action=".php" method="post">
			<input type="hidden" name="id" value="33" />
			<table>
					<tr>
						<th>ステータス</th>
						<th>優先度</th>
						<th>期日</th>
					</tr>

					<tr>
						<th>
							<select name="Status1">
							<option value="Status1">新規</option>
							<option value="Status2">解決</option>
							<option value="Status3">フィーバック</option>
							<option value="Status4">終了</option>
							<option value="Status5">却下</option>
							</select>
						</th>

						<th>
							<select name="primary1">
							<option value="primary1">通常</option>
							<option value="primary2">低</option>
							<option value="primary3">高</option>
							<option value="primary4">至急</option>
							</select>
						</th>

						<th>
							<input type="text" name="title" id="title" />
						</th>

						<th>
							<BUTTON type="submit">検索</BUTTON>
						</th>
			</table>

		<form action="#" method="post">
			<!-- チケット -->
			<input type="hidden" name="id" value="33" />
				<form accept-charset="UTF-8" action="#" method="post"><div style="margin:0;padding:0;display:inline">
			<input name="utf8" type="hidden" value="&#x2713;" />

		<div class="autoscroll">
			<br/><h5>{$ch_project_title} チケット一覧</h5>
			<table width="80%" class="list_issues">
			<tr>
				<th title="並び替え &quot;#&quot;"><a href="#" class="sort desc">ID</a></th>
				<th title="並び替え &quot;ステータス&quot;"><a href="#">ステータス</a></th>
				<th title="並び替え &quot;優先度&quot;"><a href="#">優先度</a></th>
				<th title="並び替え &quot;タイトル&quot;"><a href="#">タイトル</a></th>
				<th title="並び替え &quot;期日&quot;"><a href="#">期日</a></th>
			</tr>

	<tbody>
		{foreach from=$tickets item=ticket}
		{if ($ticket.ticket_id != "")}
		{if ($ticket.priority == "至急")}
		<tr style="background: red;">
		{else}
		<tr id="issue-100"  class="tiketo">
		{/if}
			<td class="id"><a href="viewTicket.php?ticket_id={$ticket.ticket_id}">{$ticket.ticket_id}</a></td>
			<td class="status">{$ticket.state}</td>
			<td class="priority">{$ticket.priority}</td>
			<td class="subject"><a href="viewTicket.php?ticket_id={$ticket.ticket_id}">{$ticket.title}</a></td>
			<td class="updated_on">{$ticket.kijitu}</td>
		</tr>
		{/if}
		{/foreach}
	</tbody>
	</table>
</div>

<br/><br/><p class="pagination">
	<span class="current page">1</span>
		<a href="#" class="page">2</a>
		<a href="#" class="page">3</a>
	<span class="spacer">...</span>
		<a href="#" class="page">24</a>
		<a href="#" class="next">次 ≫</a>
	<span class="items">(1～15表示/200件)</span> <span class="per-page">1ページに: <span>15</span>,
		<a href="#">30</a>,
		<a href="#">50</a>
	</span>
</p>

			<!-- フッダ -->
		<div id="footer">
			&copy; Quintet
		</div>
</html>
