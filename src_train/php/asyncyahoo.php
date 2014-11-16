<?php
require '../../src/php/metro.php';
require '../../src_street/php/YahooPlaceInfo.php';

$station_jp_name = htmlspecialchars($_GET['name']);

$metro = new metro();
$stationInfo = reset($metro->station($station_jp_name));

$yahoo = new YahooPlaceInfo();
$placeInfo = $yahoo->getPlaceInfo($stationInfo->{"geo:lat"}, $stationInfo->{"geo:long"});

//駅周辺の大規模施設
echo '<span id="building">';            
foreach ($yahoo->getSymbolBuilding($placeInfo) as $name){
    echo '<p style="font-size:1.2em;">' .$name .'</p>';
}
echo '</span>';

//駅周辺のエリア
echo '<span id="area">';            
foreach ($yahoo->getSymbolArea($placeInfo) as $name){
    echo '<p style="font-size:1.2em;">' .$name .'</p>';
}
echo '</span>';