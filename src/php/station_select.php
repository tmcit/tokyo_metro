<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>東京メトロぶらり旅</title>
</head>
<body>
	<?php
		require 'metro.php';
		// $input_data = $_POST['station'];
		// $metro = new metro();
		$metro = new metro();
		$prm = array('rdf:type'=>'odpt:Station', 'dc:title'=>'上野');
		$array = $metro->get_datapoints($prm);
		echo '乗り換え可能路線一覧';
		foreach ($array as $value) {
			// print_r($value->{'odpt:connectingRailway'});
			foreach ($value->{'odpt:connectingRailway'} as $value) {
			//	print_r ($metro->cut_word($value)[1]);
			$metro->cut_word($value);
				// print $value;	
				echo '</br>';
			}

		}
	?>
</body>
</html>