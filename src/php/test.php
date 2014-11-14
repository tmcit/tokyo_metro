<?php
	require 'metro.php';
	$metro = new metro();
		// $railway_name = $_POST[''];
		// $start_station = $_POST[''];
		
	$dc_title = "上野";
	$railway_name = $metro->station($dc_title)[0]->{"odpt:railway"};
	$connecting_railway_name = $metro->station($dc_title)[0]->{"odpt:connectingRailway"};

	$array = array($railway_name);
	$array = array_merge($array, $connecting_railway_name);
	foreach ($array as $key => $value) {
		# code...
		if ($value == null)
			unset($array[$key]);

	}
	// print_r($array);
	// print (count($array));
	print $metro->railway_eng("銀座線");
	?>