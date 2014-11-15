<?php
	require 'metro.php';
	$metro = new metro();
		// $railway_name = $_POST[''];
		// $start_station = $_POST[''];
	// print_r($metro->searchStationExit("35.692123", "139.673997","1000"));
	print_r($metro->stations("odpt.Railway:TokyoMetro.Marunouchi"));
	// $dc_title = "上野";
	// $railway_name = $metro->station($dc_title)[0]->{"odpt:railway"};
	// $connecting_railway_name = $metro->station($dc_title)[0]->{"odpt:connectingRailway"};

	// $array = array($railway_name);
	// $array = array_merge($array, $connecting_railway_name);
	// foreach ($array as $key => $value) {
		# code...
		// if ($value == null)
			// unset($array[$key]);

	// }
	// print_r($array);
	// print (count($array));
	// print $metro->railway_eng("銀座線");
	// ?>