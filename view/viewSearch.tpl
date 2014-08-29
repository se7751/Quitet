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
        <li class="off" id="protab"><a href="board.php">プロジェクト</a></li>
            {if (!$ch_project_id == "")}
        <li class="off" id="tickettab"><a href="viewTickets.php?project_id={$ch_project_id}">チケット</a></li>
        <li class="off" id="newtickettab"><a href="createTicket.php?project_id={$ch_project_id}">チケット作成</a></li>
            {else}
        <li style="visibility:hidden background-color:#1B5090" class="off" id="tickettab" ><a style="visibility:hidden" href="viewTickets.php">チケット</a></li>
        <li class="off" id="newtickettab"><a style="visibility:hidden" href="createTicket.php">チケット作成</a></li>
            {/if}
        <li class="on" id="searchtab"><a href="viewSearch.php">検索</a></li>
        </ul>
        </div>
        </div>
        <!-- ヘッダ -->
    </head>
    <div id="wholewapper">
        <div id="serch" class="font">
            <td>検索ワード</th><td><input type="textbox" value=""></td>
            <td><input type="button" value="検索"></td>



            </div>

            <div id="serch_label" class="font">
            <th>プロジェクト・チケット一覧</th>

            <div>
            <th>○○件ヒット</th>
            </div>
            </div>	
            </br>
            <div id="return">

            <table border="1">
            <tr>
            <th>プロジェクト名</th><th>チケット名</th><th>概要</th>
            </tr>
            <tr>
            <th><a href="#">プロジェクト</a><!--ここにプロジェクト・チケットを表示--></th><th>aaaaaaaa</th><th>aaaaaaaa</th>
            </tr>
            </table>
            </div>




            </div>



			<!-- フッダ -->
		<div id="footer">
			&copy; sample
		</div>
</html>
