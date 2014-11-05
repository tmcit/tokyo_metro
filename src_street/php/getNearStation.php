<?php
    error_reporting(E_ALL & ~E_NOTICE);
    /*
     * javascriptからphpの関数を間接的に叩くためのphp
     * 位置座標が送られてきたら、地下鉄の出口が付近にあるか判定する関数を叩く
     * 結果はtrue/falseの文字列をecho、それをjavascript側で読み取り判断
     */

    require '../../src/php/metro.php';
    
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
        
    $metro = new metro();
    $exit = $metro->searchStationExit($lat, $lng, 50);
    
    var_dump($exit);
    $isExist = IsNearStation($exit);    
    
    if($isExist){
        echo "\n***:true\n";
        echo $exit[0]->{"dc:title"} ."\n";
        echo $exit[0]->{"geo:lat"} ."\n";
        echo $exit[0]->{"geo:long"} ."\n";   
    }
    else{
        echo "\n***:" ."false" ."\n";
    }
    
/***********  function  *************/
function IsNearStation($exit) {
    return count($exit) > 0;
}
    
function OutputXML($exit, $isExist){
    $dom = new DOMDocument('1.0', 'UTF-8');
    $result = $dom->appendChild($dom->createElement('result'));

    //要素を追加
    $result->appendChild($dom->createElement('exist', $isExist));
    $result->appendChild($dom->createElement('name', $exit[0]->{"dc:title"}));
    $result->appendChild($dom->createElement('lat', $exit[0]->{"geo:lat"}));
    $result->appendChild($dom->createElement('lng', $exit[0]->{"geo:long"}));
    
    //出力
    $dom->formatOutput = true;
}
?>