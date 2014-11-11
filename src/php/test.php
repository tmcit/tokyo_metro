<?php
	
	require 'metro.php';
	$metro = new metro();
	$station = $metro->stations("odpt.Railway:TokyoMetro.Hibiya");
	print_r($station);
	// print_r ($metro->searchStation(35.698683, 139.774219, 2000));