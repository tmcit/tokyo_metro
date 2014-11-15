<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        
        <!--jQuery-->
        <script type="text/javascript" src="../../libs/jquery/jquery-2.1.1.min.js"></script>
        
        <!--jQueryUI-->
        <script type="text/javascript" src="../../libs/jquery-ui-1.11.2/jquery-ui-1.11.2/jquery-ui.js" ></script>        
        
        <!--Flip!-->
        <script type="text/javascript" src="../../libs/roncioso-Flip-jQuery/jquery.flip.min.js" ></script>        
        
        <!--original-->
        <link rel="stylesheet" href="../css/random_station.css"/>
        <script type="text/javascript" src="../javascript/random_station.js"></script>
    </head>
    <body>
        <?php
            $railway = htmlspecialchars($_GET['railway']);
            
            require '../../src/php/metro.php';
            $metro = new metro();
            
            //ランダムで駅を決定
            $stationArray =  $metro->stations($metro->railway_eng($railway));            
            $station = $stationArray[array_rand($stationArray)];
        ?>
        
        <div class="wrapper">
            <h1>あなたが今いる駅は…</h1>

            <div id="flipbox"></div>
            
            <div class="info" style="display: none;">
                <span id="railway"><?php echo $railway?></span>
                <span id="color"><?php echo $station["color_code"]?></span>
                <span id="station_jp"><?php echo $station["station_jp_name"]?></span>
                <span id="station_eng"><?php echo $station["station_eng_name"]?></span>
            </div>
            
            <p class="message">東京メトロに乗って、ぶらり旅を始めましょう！</p>
            
            <a href="#" class="btn" onClick="ride()">乗車する</a>
        </div>
    </body>
</html>
