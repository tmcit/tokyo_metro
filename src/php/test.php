<?php
	
	require 'metro.php';
	$metro = new metro();
	
	// 引数に緯度、軽度、半径指定.駅情報の配列が返ってくる
	print_r($metro->searchStation(35.678156, 139.705678, 10000));