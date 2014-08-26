/**
 * 画面読み込み時の設定
 */
$(function(){

	// entryボタンクリック時のイベントを定義
	$("#entry").click(function(){

		var title = $('#title').val(); // titleの値を取得
		var body = $('#body').val(); // bodyの値を取得

		if (title == '' || body == '') {

			// エラーメッセージを表示
			$('#err_msg').html("タイトルと本文を書いてから投稿してください。");
		} else {

			// サブミット
			$("form").submit();
		}
	});
});

/**
 * 削除確認ダイアログ
 */
function del_confirm(url) {

	if (confirm("削除してよろしいですか？")) {
		location.href = url;
	}
	return false;
}