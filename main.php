<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>東京メトロ</title>
</head>
<body>
	<!--<form name="form" method="POST" action="receive.php">-->
        <form name="form" method="POST" action="mediation.php">
	<?php
		$json = file_get_contents("./tokyo_metro_json/metro_stationDict.json");
		$json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
		$data = json_decode($json,true);
		foreach ($data as $key => $value) {
			echo "<input type='radio' name='station' value=$value>", $value, '</br>';
		}
		echo "<input type='submit' value='送信'>";
	?>
	</form>
</body>
</html>
