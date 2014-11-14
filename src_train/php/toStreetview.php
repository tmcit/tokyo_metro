<?php
require '../../src/php/metro.php';

$stationCode = htmlspecialchars($_GET["stationCode"]);

$reqArray = array(
    "rdf:type"=>"odpt:Station",
    "odpt:stationCode"=>$stationCode
);

$metro = new metro();
$stationInfo = $metro->searchStationFromRequestArray($reqArray);

//ランダムに出口情報を取り出す
$exitArray = reset($stationInfo)->{"odpt:exit"};
$exitCode = $exitArray[array_rand($exitArray)];

//出口の緯度経度を取得
$reqArray = array(
    "rdf:type"=>"ug:Poi",
    "@id"=>$exitCode
);
$exitInfo = $metro->searchStationExitFromRequestArray($reqArray);
$lat = reset($exitInfo)->{"geo:lat"};
$lng = reset($exitInfo)->{"geo:long"};

//Cookieで現在位置を保存した後、streetviewページに遷移
setcookie("streetLat", $lat, 0, "/");
setcookie("streetLng", $lng, 0, "/");
header('Location: ../../src_street/html/streetview.html') ;