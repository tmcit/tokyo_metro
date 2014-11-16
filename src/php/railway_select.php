<!DOCTYPE html>
<html >
<head>
<meta charset="UTF-8">
<title>東京メトロ de ぶらり旅</title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../libs/liquidslider-master/css/liquid-slider.css"/>
    
    <!-- Optional theme -->
    <!-- Latest compiled and minified JavaScript -->
    <link rel="stylesheet" href="../../libs/jquery-accordion-image-menu-master/accordionImageMenu.css" />
    <script src="../../libs/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="../../libs/liquidslider-master/src/js/jquery.liquid-slider.js"></script>
    <script src="../../libs/jquery-touchSwipe/jquery.touchSwipe.min.js"></script>
    <!-- // <script src="../../libs/Wookmark/jquery.wookmark.js" type="text/javascript"></script> -->
    <!-- // <script src="../../libs/ImgWheel-master/jquery.ImgWheel.min.js"></script> -->
    <script src="../../libs/jquery_animate_colors/jquery.animate-colors.js"></script>
    <script src="../../libs/btn_plugin/btn_plugin.js"></script>
    <!-- // <script src="../../libs/jquery-accordion-image-menu-master/jquery.accordionImageMenu.min.js"></script> -->

    <link rel="stylesheet" href="../css/railway_select.css" />
    <script>
        $(document).ready(function() {
            $('body').fadeIn(1300);
        });

    </script>
    
</head>
<body>
	<?php		
                $start_station = htmlspecialchars($_GET['station']);
                //$start_station = "上野";       	
        ?>    

	<?php
		require 'metro.php';		
                $metro = new metro();
                
                //駅名に一致する駅情報のうち先頭の要素を取得し、全ての接続路線を取得
		$start_station_info = reset($metro->station($start_station));
                $connecting_railway = $metro->connectingMetroRailway($start_station_info);
                
                //路線が既に設定されている場合は、その路線のみを取得(welcomeページ)
                if(isset($_GET['railway'])){
                    $connecting_railway = [htmlspecialchars($_GET['railway'])];
                }
	?>

     <script type="text/javascript">
        $(function() {
            $("button").click(function() {
                $("body").fadeOut(200);
            });
        });
    </script>


	<div id="header">行き先を決めてください</div>
        
        <div class="liquid-slider" id="slider">
            <?php // 路線の数だけタブ生成
            foreach ($connecting_railway as $index => $railway) {
            ?>
                <div id="contents">
                    <h2 class="title" ><?php echo $railway ?></h2>
                    <div id="tiles">
                        <ul>
                        <?php
                        $end_railway = $metro->railway_eng($railway);
                        $stations = $metro->stations($end_railway);
                        //路線に対応する乗車駅の駅コード取得
                        $start_code = matchStationCode($stations, $start_station);
                        //タブごとにに駅を表示
                        foreach ($stations as $key => $value) {
                            $end_code = $value["odpt:stationcode"];
                        ?>
                            <li>
                                <form action="../../src_train/php/train.php" method="post">
                                    <input type="hidden" name="start" value="<?php echo $start_code ?>">
                                    <input type="hidden" name="end" value="<?php echo $end_code ?>">
                                    <input type="hidden" name="railway" value="<?php echo $end_railway ?>">
                                    <button id="button" name="send_button" type="submit" class="btn btn-1 btn-1d" onclick="fadeOut()">
                                        <span class="text">
                                            <div class="station_jp_name"><?php echo $value["station_jp_name"] ?></div>
                                            <div class="station_eng_name"><?php echo $value["station_eng_name"] ?></div>
                                        </span>
                                        <span class="back">
                                            <span class="left"></span>
                                            <span class="right"></span>
                                        </span>
                                    </button>
                                </form>
                            </li>
                        <?php } ?>
                        </ul>
                    </div>
                </div>
            <?php } ?>
        </div>

        <?php
                /**
                 * 路線内の駅名配列から、任意の日本語の駅名に対応する駅コードを提供します。
                 * @param type $stations 路線内全ての駅名の配列。
                 * @param type $station_jp_name 日本語の駅名。
                 * @return type 駅コード。
                 */
                function matchStationCode($stations, $station_jp_name) {
                    foreach ($stations as $key => $value) {
                        if ($value["station_jp_name"] === $station_jp_name){
                            return $value["odpt:stationcode"];
                        }
                    }
                }
        ?>
        
   
	<script>
		setTimeout("slider()", 5);                
                function slider(){
                    $('#slider').liquidSlider({
                        autoHeight: true,
                        slideEaseFunction: "easeInOutExpo",
                        autoSlide: false,
                        dynamicArrows: true,
    	           		dynamicArrowsGraphical: true,
    		          	dynamicArrowLeftText: "&#171; left",
    		          	dynamicArrowRightText: "right &#187;",
    		          	hideSideArrows: false,
    	           		hoverArrows: true,
    	           		panelTitleSelector: "h2.title",
    	           		navElementTag: "div",
    		          	responsive: true,
   			           	mobileNavigation: true,
    		          	mobileNavDefaultText: 'Menu',
                    });
                } 
	</script>
        
        <script type="text/javascript">
            //#slider-nav-ul のロード後にchangeColor()を呼び出したいが、$()で上手くいかないので適当に待つ
            setTimeout("changeColor()", 5);
            
            var themeColor = {
                "銀座線":"#FF9500",
                "丸ノ内線":"#F62E36",
                "日比谷線":"#B5B5AC",
                "東西線" :"#009BBF",
                "千代田線":"#00BB85",
                "有楽町線":"#C1A470",
                "半蔵門線":"#8F76D6",
                "南北線":"#00AC9B",
                "副都心線":"#9C5E31"
            };
            
            function changeColor(){
                //タブ選択部分の各li要素に対する処理
                $('#slider-nav-ul li').each(function(){
                    var railway = $(this).text();                    
                    for (var key in themeColor){
                        if (railway === key) {
                            //背景色の変更
                            $(this).children("a").css({"background-color": themeColor[key]});
                            $(this).children("a").css({"color": "#fff"});

                        }
                    }                    
                });
                
                //div#contents 配下の色変更
                $('div #contents').each(function(){
                    var railway = $(this).find("h2").text(); 
                    for (var key in themeColor){
                        if (railway === key) {
                            $(this).css({"background-color": themeColor[key]});
                            $(this).find(".btn-1").css({"background": themeColor[key]});
                            $(this).find(".btn-1d .back span").css({"background": themeColor[key]});
                        }
                    }                    
                });
                

                //hoverは上で指定することが出来ない
                $(".btn-1").hover(
                    function(){
                        //既にbtnに設定されている色を割り当てる
                        var color = $(this).css("background-color");
                        $(this).css("color", color);
                    }, 
                    function(){
                        $(this).css("color", "#fff");
                    }
                );
            }
        </script>
</body>
</html>