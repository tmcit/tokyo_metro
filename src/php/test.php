<?php
	
	require 'metro.php';
	$metro = new metro();
	
	// 引数に緯度、軽度、半径指定.駅情報の配列が返ってくる
	$array = $metro->searchStation(35.678156, 139.705678, 100);
	print($array[0]->{"dc:title"}."の位置は".$array[0]->{"geo:lat"}.",".$array[0]->{"geo:long"});
	print_r($metro->searchStationExit($array[0]->{"geo:lat"}, $array[0]->{"geo:long"}, 1000));

	// foreach ($metro->searchStationExit($array[0]->{"geo:lat"}, $array[0]->{"geo:long"}, 100) as $key => $value) {
		// print $value;;
	
	