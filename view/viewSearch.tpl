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
    <div id="wholewapper">
        <div id="serch" class="font">
            <td>検索ワード</th><td><input type="textbox" value=""></td>
            <td><input type="button" value="検索"></td>



            </div>

            <div id="serch_label" class="font">
            <th>プロジェクト・チケット一覧</th>

            <div>
            <th>○○件ヒット</th> <th>表示件数</th> 
            <th><select name="example">
            <option value="10件">10件</option>
            <option value="20件">20件</option>
            <option value="30件">30件</option>
            </select>
            </th>
            </div>
            </div>	
            </br>
            <div id="return">

            <table border="1">
            <tr>
            <th>タイトル</th><th>概要</th>
            </tr>
            <tr>
            <th><a href="チケット一覧.html">プロジェクト</a><!--ここにプロジェクト・チケットを表示--></th><th>ああああああああああああああ</th>
            </tr>
            </table>


            <p id="right_align">
            <div id="page"><a href="">1</a><a href="">⇒</a>
            </div></p>

            </div>




            </div>



			<!-- フッダ -->
		<div id="footer">
			&copy; sample
		</div>
</html>
