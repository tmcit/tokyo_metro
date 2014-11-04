<?php
    /*
     * javascriptからphpの関数を間接的に叩くためのphp
     * 位置座標が送られてきたら、地下鉄の出口が付近にあるか判定する関数を叩く
     * 結果はtrue/falseの文字列をecho、それをjavascript側で読み取り判断
     */

    require '../../src/php/metro.php';
    
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    
    $metro = new metro();
    
    $isNearStation = TRUE;
    
    if($isNearStation){
        echo 'true';
    }
    else{
        echo 'false';
    }
?>