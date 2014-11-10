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
    $exit = $metro->searchStationExit($lat, $lng, 20);    
    
    //var_dump($exit);
    $isExist = IsNearStation($exit);    
    
    if($isExist){
        echo "\n***:true\n";
        echo $exit[0]->{"dc:title"} ."\n";
        echo $exit[0]->{"geo:lat"} ."\n";
        echo $exit[0]->{"geo:long"} ."\n";
        $stations = $metro->searchStation($lat, $lng, 300);
        echo matchStation($stations, $exit[0]->{"@id"});
    }
    else{
        echo "\n***:" ."false" ."\n";
    }
    
/***********  function  *************/
function IsNearStation($exit) {
    return count($exit) > 0;
}

//現在の出口のidに一致する付近の駅を取得する
function matchStation($stations, $id){
    foreach ($stations as $station) {
        foreach ((array)$station->{"odpt:exit"} as $key => $exitId){
            if($exitId === $id){
                return $station->{"owl:sameAs"};
            }
        }
    }
}