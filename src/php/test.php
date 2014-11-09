<?php
	
	require 'metro.php';
	$metro = new metro();
	$railway = $metro->station("上野")[0]->{"odpt:railway"};
	print_r();

	// print_r ($metro->searchStation(35.698683, 139.774219, 2000));