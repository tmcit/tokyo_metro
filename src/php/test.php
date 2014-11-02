<?php
	require 'getStreetImage.php';
	require 'metro.php';
	$metro = new metro();
	$gsi = new GetStreetImage();

	// $json = file_get_contents('../json/tokyo_metro_json/metro_stationDict.json');
	// $json = mb_convert_encoding($json, 'UTF8', 'ASCII,JIS,UTF-8,EUC-JP,SJIS-WIN');
	// $datas = json_decode($json, true);
	// foreach ($datas as $key => $value) {
		# code...
		// $metro_data = array('rdf:type'=>'odpt:Station',  'dc:title'=>$value);
		// $metro_data = $metro->get_datapoints( $metro_data );
	  //	var_dump($metro_data[0]->{'odpt:exit'}[0]);
		// $metro_place_data = array('rdf:type' => '{ug:Poi}'); 
		// $metro_place_data = $metro->get_places($metro_place_data, $metro_data[0]->{'odpt:exit'}[0]);
		// $streat_image_data = array('size' => '300x300', 'location' => $metro_data[0]->{'geo:lat'}.','.$metro_data[0]->{'geo:long'}, 'heading' => '151.78', 'pitch' => '-0.76', 'sensor' => 'false');
		// $streat_image_data = array('size' => '500x500', 'location' => $metro_place_data[0]->{'geo:lat'}.','.$metro_place_data[0]->{'geo:long'} , 'heading' => '151.78', 'pitch' => '-0.76', 'sensor' => 'false');
		// $url = $gsi->get_street_image($streat_image_data);
		// echo "<img src=$url>",$value;
	// }
	// foreach ($metro->searchStation(35.678156, 139.705678, 10000) as $key => $value) {
		// echo $value->{'dc:title'};
	// }
	print_r($metro->searchStation(35.678156, 139.705678, 10000));