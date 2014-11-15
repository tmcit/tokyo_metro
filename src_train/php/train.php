<!DOCTYPE html>
<head>
	<meta charset="UTF-8">
	<script type="text/javascript" src="../../libs/jquery/jquery-2.1.1.min.js"></script>
	
        <!-- Bootstrap -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">

        <!--toastr-->
        <link href="../../libs/toastr/toastr.css" rel="stylesheet"/>
        <script src="../../libs/toastr/toastr.js"></script>    
        <link href="../../libs/toastr/toast-custom.css" rel="stylesheet"/>
        
        <!--cookie-->
        <script type="text/javascript" src="../../libs/jquery-cookie/jquery.cookie.js"></script>
        
        <!--original-->
        <script type="text/javascript" src="../javascript/train.js"></script>
        <link rel="stylesheet" href="../css/door_animation.css">        
        <link rel="stylesheet" href="../css/train.css">    
        <link rel="stylesheet" href="../css/led.css">    
        
	<title></title>
</head>
<body>
    
    <?php
        require '../../src/php/metro.php';
        
        //乗車駅
        if(!isset($_COOKIE["start"])){
            if (isset($_POST["start"])){
                $start = htmlspecialchars($_POST["start"]);
                setcookie("start", $start);
            }
        }
        else{
            $start = htmlspecialchars($_COOKIE["start"]);
        }
        
        //降車駅
        //初回アクセス時にGETして、以後はGETの値をCookieに書き込んだものを使用
        if(!isset($_COOKIE["end"])){
            if (isset($_POST["end"])){
                $end = htmlspecialchars($_POST["end"]);
                setcookie("end", $end);
            }
        }
        else{
            $end = htmlspecialchars($_COOKIE["end"]);
        }
        
        //在線位置
        $offset = startOffset($start, !direction($start, $end));
        if (isset($_COOKIE["offset"])){
            $offset = htmlspecialchars($_COOKIE["offset"]);
        }
        setcookie("offset", $offset + 1);
        
        $metro = new metro();
        if (isset($_POST["railway"])) {
            $stationArray =  $metro->stations(htmlspecialchars($_POST["railway"]));
        }
        
        $railway = $stationArray[0]["railway_jp_name"];        
        $color = $stationArray[0]["color_code"];
        
        //方向転換
        if(direction($start, $end)){
            $stationArray = array_reverse($stationArray);
        }
        $printStation = array_reverse(array_slice($stationArray, $offset, 5));
    ?>

    <div class="wrapper">
        
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

                <div class="led">
                <?php
                    foreach ($printStation as $key => $array) {
                        if($array == end($printStation)){
                            $nextStation = nextStation($printStation);
                        }
                    }
                
                    //在線駅のナンバーをspanのidに設定
                    $nowStation = end($printStation);            
                    echo '<span id="' .$nowStation["odpt:stationcode"] .'">';

                    echo "次は　" .$nextStation["station_jp_name"] ."（".$nextStation["odpt:stationcode"]."）";
                    echo "　　Next　" .$nextStation["station_eng_name"] ."（".$nextStation["odpt:stationcode"]."）";
                    echo '</span>';
                ?>
                </div>
            </div>
        </div>
        
        <div class="contents_right">
            <div class="line" style="background: <?php echo $color; ?>"></div>
            <ul class="station">
            <?php                
                foreach ($printStation as $key => $array) {
                    //在線駅は色を変える
                    if($array == end($printStation)){
                        echo '<li><div class="circle" style="background: #333;"></div>';
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
        //次の駅(=最後から1つ前の要素)を取得
        function nextStation($printStation) {
            if(count($printStation) > 1){
                array_pop($printStation);
            }
            return end($printStation);
        }
        
        //進行方向の設定
        function direction($start, $end){
            return strnatcmp($start, $end) < 0;
        }
        
        /**
         * 乗車駅のoffsetを取得
         * @param type $start 乗車駅(駅コード)
         * @param type $reverse 方向が反転するかどうか
         * @return type offsetの値
         */
        function startOffset($start, $reverse) {            
            $startNum = intval(substr($start, 1));            
            //駅ナンバーは1から始まるので-1する
            if($reverse === false) {
                return $startNum - 1;
            }
            else {
                return getStationLength($start) - $startNum;
            }            
        }
        
        /**
         * 現在の駅から路線を判別し、その路線における駅コードの最大値を取得します。
         * @param type $railwayCode 駅コード
         * @return type 駅コードの最大値
         */
        function getStationLength($railwayCode) {
            $stationLength = [
                "G" => "19",
                "M" => "25",
                "m" => "03", //m03-m05
                "H" => "21",
                "T" => "23",
                "C" => "20",
                "Y" => "24",
                "Z" => "14",
                "N" => "19",
                "F" => "16"
            ];
            return intval($stationLength[$railwayCode[0]]);
        }
    ?>
    
    <script type="text/javascript">
        //ドア画像が読み込まれたとき、ドア画像のwidthを取得
        var width;
        var element = $('#left img');
        element.on('load', function () {
            var img = new Image();
            img.src = element.attr('src');
            width = img.width;

            //frameからスライドしたドアがはみ出さない様にするため
            var fixdiv = document.getElementsByClassName("door");
            fixdiv.style.width = width * 2 + "px";
        });
    </script>
    
    <script type="text/javascript">
        //setTimeout("reload()", 3000);
        
        if (isArrival()){
            setTimeout("arrival()", 100);

            $.removeCookie("start");
            $.removeCookie("end");
            $.removeCookie("offset");
        }
        else {
            setTimeout("toast()", 1000);
        }

        function arrival(){
            toastr.info("ストリートビューを開始します。", "目的の駅に到着しました。");
            
            setTimeout("doorOpen()", 2000);
            setTimeout("fadeOut()", 3000);
        }

        function doorOpen(){
            $('.door_container').find('#left').animate({ right: width }, { queue: false, duration: 1000 });
            $('.door_container').find('#right').animate({ left: width }, { queue: false, duration: 1000 });            
        }

        function fadeOut(){
            $('body').animate(
            { backgroundColor: "#fff" }, {
                "duration": 1000, queue: false
            });
            $('body').animate(
            { "opacity": 0 }, {
                "duration": 1000, queue: false,
                complete: function () {
                    location.href = "./toStreetview.php?stationCode=" + $('.led span').attr("id");
                }
            });
        }

        function toast(){
            title = '<div class="toast_title">' + '通知テスト' + "</div>";
            msg = '<div class="toast_msg">接続路線表示したり<br>飛び降りボタン設置したりする</div>';
            toastr.options = {"timeOut": "5000", "positionClass": "toast-top-center"};
            toastr.info(msg, title);
        }

        //目的の駅に到着したかどうか
        function isArrival(){
            end = $.cookie("end");
            return $('.led span').attr("id").indexOf(end) !== -1;
        }
                
        function reload() {
            location.reload();
        }
    </script>
</body>
</html>