<!DOCTYPE html>
<html>
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
        <li class="off" id="tickettab"><a href="viewTickets.php?project_id={$ch_project_id}">チケット</a></li>
        <li class="on" id="newtickettab"><a href="createTicket.php?project_id={$ch_project_id}">チケット作成</a></li>
        <li class="off" id="searchtab"><a href="viewSearch.php">検索</a></li>
        </ul>
        </div>
        </div>
        <!-- ヘッダ -->
        <!--jqueryにてカレンダー機能を使うための読み込みURL -->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/jquery-ui.min.js"></script>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1/i18n/jquery.ui.datepicker-ja.min.js"></script>
        <!--カレンダーのレイアウトをgoogle鯖から読み込み -->
        <link type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/ui-lightness/jquery-ui.css" rel="stylesheet" />
        <link type="text/css" rel="stylesheet" href="http://code.jquery.com/ui/1.10.3/themes/cupertino/jquery-ui.min.css" />
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
        <script type="text/javascript" src="http://code.jquery.com/ui/1.10.3/jquery-ui.min.js"></script>
        <!--iso-->
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/i18n/jquery-ui-i18n.min.js"></script>
	<body></br>
	<div id="saku">
		<h1>チケット作成</h1>
		<form action="excCreateTicket.php" method="post" name="newProject" onSubmit="return check()" enctype="multipart/form-data">
		<input type="hidden" name="choose"/>
			<!-- コメントテーブルに格納する投稿ID -->
			<input type="hidden" name="id" value="33" />
			<table id="test">
					<tr>
						<th>タイトル</th>
						<td><input type="text" name="title" id="title" /></td>
					</tr>
					<tr>
						<th>ステータス</th>
						<td>
							<select name="state">
							<option value="新規">新規</option>
							<option value="作業中">作業中</option>
							<option value="完了">完了</option>
							</select>
						</td>
						<tr>
						<th>カテゴリー</th>
						<td>
							<select name="category">
							<option value="要件定義">要件定義</option>
							<option value="設計">設計</option>
							<option value="実装">実装</option>
							<option value="テスト">テスト</option>
							</select>
						</td>
						</tr>
					</tr>

					<tr>
						<th>優先度</th>
						<td>
							<select name="priority">
							<option value="通常">通常</option>
							<option value="至急">至急</option>
							<option value="高">高</option>
							<option value="低">低</option>
							</select>
						</td>
					</tr>

					<tr>
						<th>期日</th>
						<td>
							<input type="text" name="kijitu" id="date" size="10" />

						</td>
					</tr>

					<tr>
						<th>詳細</th>
						<td><textarea name="body" id="body" cols="40" rows="8"></textarea></td>
					</tr>

					<tr>
						<th>ファイル</th>
						<td><input type="file" name="upfile"></td>
					</tr>

			</table>
			<table>
    <tr>
        <td align="center">
            担当者<br />
            <select name="member" size="20" multiple>
            </select>
        </td>
        <td>
            <input type="button" value="←" onClick="moveForm(this.form, 'manager', 'member')" /><br>
            <input type="button" value="→" onClick="moveForm(this.form, 'member', 'manager')" />
        </td>
        <td align="center">
            マネージャー<br />
            <select name="manager" size="20" multiple>
            	{foreach from=$managers item=manager}
                {if ($manager.name!= "")}
                <option value="{$manager.user_id}">{$manager.name}
                    {/if}
                {/foreach}
            </select>
        </td>
        <td>
            <input type="button" value="→" onClick="moveForm(this.form, 'member', 'developer')" /><br>
            <input type="button" value="←" onClick="moveForm(this.form, 'developer', 'member')" />
        </td>
        <td align="center">
            開発者<br />
            <select name="developer" size="20" multiple>
                {foreach from=$developers item=developer}{if ($developer.name!= "")}
                <option value="{$developer.user_id}">{$developer.name} {/if}
                {/foreach}
            </select>
        </td>
		 <td>
            <input type="button" value="→" onClick="moveForm(this.form, 'member', 'partner')" /><br>
            <input type="button" value="←" onClick="moveForm(this.form, 'partner', 'member')" />
        </td>
		 <td align="center">
            協力会社<br />
            <select name="partner" size="20" multiple>
                {foreach from=$partners item=partner}{if ($partner.name!= "")}
                <option value="{$partner.user_id}">{$partner.name}{/if}
                {/foreach}
            </select>
        </td>

   		<script type="text/javascript">

   		var element = document.getElementById("selectest");
		element.onclick = myFunc;
		function myFunc(){
		var o = document.forms['newProject'].elements['member'].options;

		var v = new Array();
		var t = new Array();

		for(var i = 0; i < o.length; i++) {
		v[i] = o[i].value;
		t[i] = o[i].text;
		}

		//alert(v);
		//alert(t);
		document.forms["newProject"].elements["choose"].value = v;
		}
		</script>
	</tr>
		<tr>
			<td colspan="2" class="right_align">
				<button onclick="myFunc();" id="selectest" >送信ボタン</button>
			</td>
		</tr>
	</table>
		</form>
	</div>



			<!-- フッダ -->
		<div id="footer">
			&copy; Quintet
		</div>
<script type="text/javascript">
        $(function() {
        $.datepicker.setDefaults($.datepicker.regional['ja']);
        $('#date').datepicker({ dateFormat: 'yy/mm/dd' });
        });
        </script>


        <script type="text/javascript">
        function check(){
        var flag = 0;

        if(document.ticket.title.value == ""){
        flag = 1;
        }
        else if(document.ticket.body.value == ""){
        flag = 1;
        }

        if(flag){
        window.alert('未入力項目があります。');
        return false;

        }
        else{
        return true;
        }
        }
        </script>
        <script language="JavaScript" type="text/javascript">
        <!--
        function moveForm( form, from_name, to_name ) {
        var from_options = form.elements[from_name].options;
        var to_options = form.elements[to_name].options;

        for(i = 0 ; i < from_options.length; i++) {
        if(!from_options[i].selected || !from_options[i].text)
        continue;

        var addFlag = true;

        for(j = 0; j < to_options.length; j++) {
        if(to_options[j].text == from_options[i].text) {
            addFlag = false;
            break;
        }
        }

        if(addFlag)
        to_options[to_options.length] = new Option(from_options[i].text, from_options[i].value);
        from_options[i] = null;
        i--;
        }
        }
        //-->
        </script>
</html>
