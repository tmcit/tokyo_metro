<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link type="text/css" href="../css/station.css" rel="stylesheet" />
        
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">
        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    </head>
    <body>
        <?php
            require '../../src/php/metro.php';

            $lat = htmlspecialchars($_GET['lat']);
            $lng = htmlspecialchars($_GET['lng']);
            
            $metro = new metro();
            $station = $metro->searchStation($lat, $lng, 1000);
            
            echo '<div id="header">近くにある東京メトロの駅情報</div>';            
            echo '<div class="station">';
            foreach ($station as $key) {
                echo '<div class="info">';
                    echo '<div class="dist">およそ' .nearlyDistance($key->{"geo:lat"}, $key->{"geo:long"}).'m先</div>';
                    echo '<h2 class="title">' .$key->{"dc:title"} .'</h2>';
                    echo '<h4 class="alpha">' .toAlphabet($key->{"owl:sameAs"}) .'</h4>';
                    foreach (getRailwayColorArray($key, $metro) as $railway => $color) {                        
                        echo '<div class="railway" style="background-color:' .$color .';">' .$railway .'</div>';                        
                    }                    
                echo '</div>';
            }
            echo '</div>';            
            echo '<div id="footer">1km圏内で、' .count($station) .' 駅見つかりました。</div>';
        ?>
        
        <?php
        //hoge.fuga:hoge.foo みたいな文字列の一番最後のドット以降(foo)を取得する
        function toAlphabet($sameAs) {
            $index = strrpos($sameAs, ".");
            return substr($sameAs, $index + 1);
        }
        
        //路線名とテーマカラーのArrayを取得する
        //引数にstdClassをとる
        function getRailwayColorArray($station, $metro) {
            //odpt:railwayの路線名と、対応するカラーコードを配列に格納
            $railway = $station->{"odpt:railway"};            
            $railwayArray = array(
                $railway => $metro->getColor($railway)
            );            
            //接続路線の中に含まれるメトロ路線名とカラーコードを追加
            foreach ((array)$station->{"odpt:connectingRailway"} as $key => $value) {
                if($value !== NULL){
                    $railwayArray[$value] = $metro->getColor($value);
                }
            }
            return $railwayArray;
        }
        ?>
        
        <?php
        //一の位で四捨五入
        function nearlyDistance($lat, $lng){
            return round(distance($lat, $lng, htmlspecialchars($_GET['lat']), htmlspecialchars($_GET['lng'])), -1);            
        }

        //2点間の緯度経度を計算
        function distance($lat1, $lng1, $lat2, $lng2){            
            $lat1 = toRadian($lat1);
            $lat2 = toRadian($lat2);
            $lng1 = toRadian($lng1);
            $lng2 = toRadian($lng2);
            
            $latave = ($lat1 + $lat2) / 2;
            $latdiff = $lat1 - $lat2;
            $lngdiff = $lng1 - $lng2;
            
            $meridian = 6335439 / sqrt(pow(1 - 0.006694 * sin($latave) * sin($latave) , 3));
            $primevertical = 6378137 / sqrt(1 - 0.006694 * sin($latave) * sin($latave));
            
            $x = $meridian * $latdiff;
            $y = $primevertical * cos($latave) * $lngdiff;
            
            return sqrt(pow($x, 2) + pow($y, 2));
        }
                
        //ラジアンに変換
        function toRadian($num){
            return $num * pi() / 180;
        }
        ?>
    </body>
</html>