<?php
	
	require 'metro_.php';
	$metro = new metro();
<<<<<<< HEAD
	$metro->station("上野");
=======
	// $metro->station_timetable('odpt.Station:TokyoMetro.Tozai.Otemachi');
	$metro->searchStation('35.678156', '139.705678','500');
>>>>>>> 5db62243f8a33abb916c89fd2e048f3cb80d3b1f
	// 引数に緯度、軽度、半径指定.駅情報の配列が返ってくる
	// $array = $metro->searchStation(35.678156, 139.705678, 100);
	// print($array[0]->{"dc:title"}."の位置は".$array[0]->{"geo:lat"}.",".$array[0]->{"geo:long"});
	// print_r($metro->searchStationExit($array[0]->{"geo:lat"}, $array[0]->{"geo:long"}, 1000));

	// foreach ($metro->searchStationExit($array[0]->{"geo:lat"}, $array[0]->{"geo:long"}, 100) as $key => $value) {
		// print $value;;

	// $prm = array('rdf:type'=>'odpt:Station', 'dc:title'=>'上野', 'odpt:railway'=>'odpt.Railway:TokyoMetro.Hibiya');
	// $array = $metro->get_datapoints($prm);

	// print_r($array);
	