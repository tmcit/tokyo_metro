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
        
        <script type="text/javascript" src="../../libs/timer/timer.js"></script>
        
        <!--original-->
        <script type="text/javascript" src="../javascript/train_css.js"></script>
        <link rel="stylesheet" href="../css/door_animation.css">        
        <link rel="stylesheet" href="../css/train.css">    
        <link rel="stylesheet" href="../css/led.css">    
        <link rel="stylesheet" href="../css/train_toast.css">    
        
	<title></title>
</head>
<body>
    
    <?php
        require '../../src/php/metro.php';
        require '../../src_street/php/YahooPlaceInfo.php';
        
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
                    <img src="../../img/door/door_frame.png" />
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
                    echo '<div id="arrival_led">' .$nowStation["station_jp_name"] .'</div>';
                    
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
                        hiddenOutputStationInfo($metro, $array, $railway);
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
        
        <div id="timer" class="btn btn-primary">
            <span id="pri">発車まで </span>
            <span id="CDT"></span>        
        </div>
    </div>   
    
    <?php
        //js読み取り用
        function hiddenOutputStationInfo($metro, $array, $rideRailway) {
            echo '<span style="display: none;">';
            
            //停車時のled表示内容
            echo '<span id="now">' .$array["station_jp_name"] .'</span>';
            
            //駅に接続する東京メトロの路線
            echo '<span id="conect_railway">';
            $stationInfo = reset($metro->station($array["station_jp_name"]));
            $connectingRailway = $metro->connectingMetroRailway($stationInfo);
            foreach ($connectingRailway as $index => $railway) {
                if ($railway === $rideRailway) { continue; }
                echo '<p style="font-size:1.2em;">' .$railway ."</p>";
            }
            echo '</span>';
            
            //駅周辺の大規模施設
            $yahoo = new YahooPlaceInfo();
            $placeInfo = $yahoo->getPlaceInfo($stationInfo->{"geo:lat"}, $stationInfo->{"geo:long"});
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
            
            echo '</span>';
        }    
    
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
        window.onload=function(){
            setZoom();
            
            if (isArrival()){
                $('#timer').css({"display": "none"});
                setTimeout("arrival(true)", 100);
            }
            else {                
                timer(10000);
                setTimeout("toast()", 1000);
            }
        };
        
        function timer(addsec){
            var tl = new Date();
            tl.setTime(tl.getTime() + addsec);
            var timer = new CountdownTimer('CDT', tl,'発車します！');
            timer.countDown();
        }
        function finish(){
            $('#pri').css({ display: "none" });
            setTimeout("reload()", 100);
        }

        function arrival(isArrival){
            $('.led span').css({ display: "none" });
            setTimeout("stopDisplay()", 1000);
            
            clearCookie();
            
            if (isArrival) {
                title = '<div class="toast_title">目的の駅に到着しました！</div>';
            }
            else {
                title = '<div class="toast_title">途中下車します！</div>';
            }
            msg = '<div class="toast_msg">徒歩でのぶらり旅を開始します。</div>';
            toastr.options = {"timeOut": "5000", "positionClass": "toast-top-right"};
            toastr.warning(msg, title);
            
            setTimeout("doorOpen()", 2500);
            setTimeout("fadeOut()", 3600);
        }
        
        //駅名中央表示を有効化
        function stopDisplay(){            
            $('#arrival_led').css({ display: "inherit" });
        }
        
        function clearCookie(){
            $.removeCookie("start");
            $.removeCookie("end");
            $.removeCookie("offset");
        }
        

        function doorOpen(){
            width -= 30;
            console.log(width);
            $('.door_container').find('#left').animate({ right: width }, { queue: false, duration: 1000 });
            $('.door_container').find('#right').animate({ left: width }, { queue: false, duration: 1000,
            complete: function () {
                setTimeout("doorOpen2()", 100);
            }});
        }        
        function doorOpen2(){
            width += 50;
            $('.door_container').find('#left').animate({ right: width }, { queue: false, duration: 500 });
            $('.door_container').find('#right').animate({ left: width }, { queue: false, duration: 500 });
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
            toastr.options = {"timeOut": "5000", "positionClass": "toast-bottom-right"};
            
            railway = $('#conect_railway').html();
            if (railway) {
                title = '<div class="toast_title">' + '乗り換え案内（東京メトロ）' + "</div>";
                msg = '<div class="toast_msg">' + railway + '</div>';                
                toastr.info(msg, title);
            }
            
            building = $('#building').html();
            if(building){
                title = '<div class="toast_title">' + '駅周辺の大規模施設' + "</div>";
                msg = '<div class="toast_msg">' + building + '</div>';                
                toastr.error(msg, title);
            }
            
            area = $('#area').html();
            if(area){
                title = '<div class="toast_title">' + '駅周辺のスポット' + "</div>";
                msg = '<div class="toast_msg">' + area + '</div>';                
                toastr.warning(msg, title);
            }
            
            title = '<div class="toast_title">' + '途中下車しますか？' + "</div>";
            button = '<div><button type="button" class="toast_btn" onclick=\'arrival()\'>途中下車する</button></div>';            
            toastr.success(button, title);
        }

        //目的の駅に到着したかどうか
        function isArrival(){
            end = $.cookie("end");
            return $('.led span').attr("id").indexOf(end) !== -1;
        }
                
        function reload() {
            if (!isArrival()) {
                location.reload();
            }
        }
    </script>
</body>
</html>