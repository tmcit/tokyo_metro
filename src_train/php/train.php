<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<script type="text/javascript" src="../../libs/jquery/jquery-2.1.1.min.js"></script>
	
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">

        <script type="text/javascript" src="../javascript/train.js"></script>
        <link rel="stylesheet" href="../css/door_animation.css">
        
        <link rel="stylesheet" href="../css/train.css">    
        <link rel="stylesheet" href="../css/led.css">    
        
	<title></title>
</head>
<body>
    
    <?php
        require '../../src/php/metro.php';
        
        $offset = 0;
        
        $metro = new metro();
        $stationArray =  $metro->stations("odpt.Railway:TokyoMetro.Fukutoshin");
        
        $railway = $stationArray[0]["railway_jp_name"];        
        $color = $stationArray[0]["color_code"];
    ?>

    <div class="wrapper">
        
    <div class="contents_right">
        <div class="line" style="background: <?php echo $color; ?>"></div>
        <ul class="station">
        <?php
            $nextStation = "";
            //方向転換
            if(!true){
                $stationArray = array_reverse($stationArray);
            }        
            $printStation = array_reverse(array_slice($stationArray, $offset, 5));
            foreach ($printStation as $key => $array) {
                //今いる駅は色を変える
                if($array == end($printStation)){
                    echo '<li><div class="circle" style="background: #333;"></div>';
                    $nextStation = nextStation($printStation);
                }
                else {
                    echo '<li><div class="circle"></div>';
                }
                    echo '<div class="name"><p id="jp">' .$array["station_jp_name"] .'</p>';
                    echo '<p id="alpha">' .$array["station_eng_name"] .'</p></div>';
                    echo '</li>';
            }   
        ?>
        </ul>
    </div>
    </div>
    
    <?php
        function nextStation($printStation) {
            if(count($printStation) > 1){
                array_pop($printStation);
            }
            return end($printStation);
        }
    ?>

    <div class="contents_left" style="zoom: scale;">
    <div class="door_container" >        
        <div class="door" >
            <div id="left" >
                <img  src="../../img/door/door_left_s.png"  />
            </div>
            <div id="right">
                <img  src="../../img/door/door_right_s.png" />
            </div>
        </div>

        <div class="frame">
            <img src="../../img/door/door_frame1_s_shadow.png" />
        </div>
        
        <div class="led"><span>
        <?php
            echo "次は　" .$nextStation["station_jp_name"] ."（".$nextStation["odpt:stationcode"]."）";
            echo "　　Next　" .$nextStation["station_eng_name"] ."（".$nextStation["odpt:stationcode"]."）";
        ?>
        </span></div>
    </div>
    </div>
    
    <script type="text/javascript">
        //ドア画像が読み込まれたとき、ドア画像のwidthを取得
        var width;
        //var element = $('#left img');
        element.on('load', function () {
            var img = new Image();
            img.src = element.attr('src');
            width = img.width;

            //frameからスライドしたドアがはみ出さない様にするため
            var fixdiv = document.getElementsByClassName("door");
            fixdiv.style.width = width * 2 + "px";
        });

        jQuery(document).ready(function () {
            jQuery('.door_container').hover(function () {
                jQuery('.door_container').find('#left').animate({ right: width }, { queue: false, duration: 1000 });
                jQuery('.door_container').find('#right').animate({ left: width }, { queue: false, duration: 1000 });
                //jQuery('#door_container .door').animate({ 'opacity': 0 }, { queue: false, duration: 1000 });
            }, function () {
                jQuery('.door_container .door div').animate({ 'opacity': 1 }, { queue: false, duration: 1000 });
                jQuery('.door_container .door div').css({ 'left': 'auto', 'right': 'auto' });
            });
        });
    </script>
</body>
</html>