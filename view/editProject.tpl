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
        <h1>{$title}</h1>
        <div id="menu">
        <a>あなたは</a> {$names}
        <a>でログインしています。</a> | <a href="logout.php">ログアウト</a>
        </div>
        <div id="tub">
        <ul>
        <li class="on" id="protab"><a href="board.php">プロジェクト</a></li>
        <li class="off" id="tickettab"><a href="viewTickets.php">チケット</a></li>
        <li class="off" id="newtickettab"><a href="createTicket.php">チケット作成</a></li>
        <li class="off" id="searchtab"><a href="viewSearch.php">検索</a></li>
        </ul>
        </div>
        </div>
        <!-- ヘッダ -->
	</head>
	<body>
		

		<form action="edit.php" id="newProject" method="post">
			<!-- 編集対象の投稿ID -->
			<input type="hidden" name="choose"/>
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
						<th>ここにエラーを表示</th>
					</tr>

					<tr>
						<th>プロジェクト名　</th>
						<td>
							<input type="text" name="title" id="title" value="{$project_title}" />
						</td>
					</tr>
					<tr>
						<th>概要</th>
						<td>
							<textarea name="body" id="body" cols="40" rows="8">{$project_body}</textarea>
						</td>
					</tr>

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
	<tr>

<table>
    <tr>
        <td align="center">
            所属ユーザー<br />
            <select name="enable_user" size="20" multiple>
                {foreach from=$enable_users item=enable_user}
                <option value="{$enable_user.user_id}">{$enable_user.name}
                {/foreach}
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
                <option value="{$manager.user_id}">{$manager.name}
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
                {foreach from=$developers item=developer}
                <option value="{$developer.user_id}">{$developer.name}
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
                {foreach from=$partners item=partner}
                <option value="{$partner.user_id}">{$partner.name}
                {/foreach}
            </select>
        </td>
        <button onclick="myFunc();" id="selectest" >送信ボタン</button>
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

		alert(v);
		alert(t);
		document.forms["newProject"].elements["choose"].value = v;
		}
		</script>
	</tr>
		<tr>
			<td colspan="2" class="right_align">
				<input type="button" id="entry" value="プロジェクト投稿" />
			</td>
		</tr>
	</table>
		</form>
	</body>
</html>
