function post_form() {

	var form_contents = {
		station_name : $(':text[name="station_name"]').val()
	};

	$.ajax({
		type: 'POST',
		url: './form.php',
		cache: false,
		data: form_contents,
		success: function(html)	{
			// データの受け渡しに成功したときに実行される処理はここに記述する.
		},
		error: function() {
			// エラーが返ってきたときの処理
		}
	});
}