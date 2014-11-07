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
    <body bgcolor="#ffffff">
        <?php
            require '../../src/php/metro.php';

            $lat = htmlspecialchars($_GET['lat']);
            $lng = htmlspecialchars($_GET['lng']);
            
            $metro = new metro();
            $station = $metro->searchStation($lat, $lng, 1000);
            
            //echo '<div id="header">1km圏内にある東京メトロの駅情報</div>';
            
            echo '<div class="station">';
            foreach ($station as $key) {
                echo '<div class="info">';
                    echo '<h2 class="title">' .$key->{"dc:title"} .'</h2>';
                    echo '<h4 class="alpha">' .toAlphabet($key->{"owl:sameAs"}) .'</h4>';
                    foreach (getRailwayColorArray($key) as $railway => $color) {                        
                        echo '<div class="railway" style="background-color:' .$color .';">' .$railway .'</div>';                        
                    }                    
                echo '</div>';
            }
            echo '</div>';            
            //echo '<div id="footer">1km圏内で、' .count($station) .' 駅見つかりました。</div>';
        ?>
        
        <?php
        //hoge.fuga:hoge.foo みたいな文字列の一番最後のドット以降(foo)を取得する
        function toAlphabet($sameAs) {
            $index = strrpos($sameAs, ".");
            return substr($sameAs, $index + 1);
        }
        
        //路線名とテーマカラーのArrayを取得する
        //引数にstdClassをとる
        function getRailwayColorArray($station) {
            //odpt:railwayの路線名と、対応するカラーコードを配列に格納
            $railway = $station->{"odpt:railway"};            
            $railwayArray = array(
                $railway => getColor($railway)
            );            
            //接続路線の中に含まれるメトロ路線名とカラーコードを追加
            foreach ($station->{"odpt:connectingRailway"} as $key => $value) {
                if(isMetro($value)){
                    $railwayArray[$value] = getColor($value);
                }
            }
            return $railwayArray;
        }
        
        //メトロ線かどうか
        function isMetro($railway){
            if (strpos($railway, "odpt.Railway:TokyoMetro") === false){
                return false;
            }
            return true;
        }
        
        //メトロ路線名に対応するカラーコードを取得する
        function getColor($railway){
            $color = [
                "Ginza" => "#FF9500",
                "Marunouchi" => "#F62E36",
                "Hibiya" => "#B5B5AC",
                "Tozai"  => "#009BBF",
                "Chiyoda" => "#00BB85",
                "Yurakucho" => "#C1A470",
                "Hanzomon" => "#8F76D6",
                "Namboku" => "#00AC9B",
                "Fukutoshin" => "#9C5E31"
            ];   
            return $color[toAlphabet($railway)];
        }
        ?>
    </body>
</html>