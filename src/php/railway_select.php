<!DOCTYPE html>
<html >
<head>
<meta charset="UTF-8">
<title></title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../libs/liquidslider-master/css/liquid-slider.css"/>
    
    <!-- Optional theme -->
    <!-- Latest compiled and minified JavaScript -->
    <link rel="stylesheet" href="../../libs/jquery-accordion-image-menu-master/accordionImageMenu.css" />
    <script src="../../libs/jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="../../libs/liquidslider-master/src/js/jquery.liquid-slider.js"></script>
    <script src="../../libs/jquery-touchSwipe/jquery.touchSwipe.min.js"></script>
    <script src="../../libs/Wookmark/jquery.wookmark.js" type="text/javascript"></script>
    <script src="../../libs/ImgWheel-master/jquery.ImgWheel.min.js"></script>
    <script src="../../libs/jquery_animate_colors/jquery.animate-colors.js"></script>
    <script src="../../libs/btn_plugin/btn_plugin.js"></script>
    <script src="../../libs/jquery-accordion-image-menu-master/jquery.accordionImageMenu.min.js"></script>

    <link rel="stylesheet" href="../css/railway_select.css" />
</head>
<body>
    
	<script type="text/javascript">
		//var railway_name = 'odpt.Railway:TokyoMetro.Hibiya';

		if (railway_name == 'odpt.Railway:TokyoMetro.Ginza') {
			var d = document;
			var link = d.createElement('link');
			link.href = '../css/ginza_style.css';
			link.rel = 'stylesheet';
			link.type = 'text/css';
			var h = d.getElementsByTagName('head')[0];
			h.appendChild(link);
		}
		else if (railway_name == 'odpt.Railway:TokyoMetro.Marunouchi') {
			var d = document;
			var link = d.createElement('link');
			link.href = '../css/marunouchi_style.css';
			link.rel = 'stylesheet';
			link.type = 'text/css';
			var h = d.getElementsByTagName('head')[0];
			h.appendChild(link);
		}
		else if (railway_name == 'odpt.Railway:TokyoMetro.Hibiya') {
			var d = document;
			var link = d.createElement('link');
			link.href = '../css/hibiya_style.css';
			link.rel = 'stylesheet';
			link.type = 'text/css';
			var h = d.getElementsByTagName('head')[0];
			h.appendChild(link);
		}
		else if (railway_name == 'odpt.Railway:TokyoMetro.Tozai') {
			var d = document;
			var link = d.createElement('link');
			link.href = '../css/tozai_style.css';
			link.rel = 'stylesheet';
			link.type = 'text/css';
			var h = d.getElementsByTagName('head')[0];
			h.appendChild(link);
		}
		else if (railway_name == 'odpt.Railway:TokyoMetro.Chiyoda') {
			var d = document;
			var link = d.createElement('link');
			link.href = '../css/chiyoda_style.css';
			link.rel = 'stylesheet';
			link.type = 'text/css';
			var h = d.getElementsByTagName('head')[0];
			h.appendChild(link);
		}
		else if (railway_name == 'odpt.Railway:TokyoMetro.Yurakucho') {
			var d = document;
			var link = d.createElement('link');
			link.href = '../css/yurakutyo_style.css';
			link.rel = 'stylesheet';
			link.type = 'text/css';
			var h = d.getElementsByTagName('head')[0];
			h.appendChild(link);
		}
		else if (railway_name == 'odpt.Railway:TokyoMetro.Hanzomon') {
			var d = document;
			var link = d.createElement('link');
			link.href = '../css/hanzomon_style.css';
			link.rel = 'stylesheet';
			link.type = 'text/css';
			var h = d.getElementsByTagName('head')[0];
			h.appendChild(link);
		}
		else if (railway_name == 'odpt.Railway:TokyoMetro.Namboku') {
			var d = document;
			var link = d.createElement('link');
			link.href = '../css/nanboku_style.css';
			link.rel = 'stylesheet';
			link.type = 'text/css';
			var h = d.getElementsByTagName('head')[0];
			h.appendChild(link);
		}
		else if (railway_name == 'odpt.Railway:TokyoMetro.Fukutoshin') {
			var d = document;
			var link = d.createElement('link');
			link.href = '../css/fukutoshin_style.css';
			link.rel = 'stylesheet';
			link.type = 'text/css';
			var h = d.getElementsByTagName('head')[0];
			h.appendChild(link);
		};


	</script>

	<?php		
                //$start_station = htmlspecialchars($_GET['station']);
                $start_station = "上野";       	
        ?>    

	<?php
		require 'metro.php';		
                $metro = new metro();
                
                //駅名に一致する駅情報のうち先頭の要素を取得し、駅コードと全ての接続路線を取得
		$start_station_info = reset($metro->station($start_station));
                $start_code = $start_station_info->{"odpt:stationCode"};
                $connecting_railway = $metro->connectingMetroRailway($start_station_info);
	?>

	<!-- <div id="header">行き先を決めてください</div> -->
        <!--
	<?php
                //**********  下のHTMLをPHPメインに書くとこんな感じなver  ************
//               
//                
//		echo '<div class="liquid-slider" id="slider">';
//		// 駅の数だけタブ生成
//		foreach ($connecting_railway as $index => $railway) {
//                        echo '<div id="contents">';
//                        echo '<h2 class="title" >'.$railway.'</h2>';
//                        echo '<div id="tiles">';
//                        echo '<ul>';
//                        $stations = $metro->stations($metro->railway_eng($railway));
//                        // タブごとにに駅を表示
//                        foreach ($stations as $key => $value) {
//                                $end_code = $value["odpt:stationcode"];
//                                echo '<li>';
//                                echo '<form action="../../src_train/php/train.php" method="post">';
//                                echo '<input type="hidden" name="start" value="'.$start_code.'">';
//                                echo '<input type="hidden" name="end" value="'.$end_code.'">';
//                                echo '<button name="send_button" type="submit" class="btn btn-1 btn-1d">';
//                                echo '<span class="text">';
//                                echo '<div class="station_jp_name">',$value["station_jp_name"],'</div>';
//                                echo '<div class="station_eng_name">',$value["station_eng_name"],'</div>';
//                                echo '</span>';
//                                echo '<span class="back">';
//                                echo '<span class="left"></span>';
//                                echo '<span class="right"></span>';
//                                echo '</span>';
//                                echo '</button>';
//                                echo '</form>';
//                                echo '</li>';	
//                        }
//                        echo '</ul>';
//                        echo '</div>';
//                        echo '</div>';
//                }			
//                echo '</div>';
	?>
        -->
        
        <div class="liquid-slider" id="slider">
            <?php // 駅の数だけタブ生成
            foreach ($connecting_railway as $index => $railway) {
            ?>
                <div id="contents">
                    <h2 class="title" ><?php echo $railway ?></h2>
                    <div id="tiles">
                        <ul>
                        <?php // タブごとにに駅を表示
                        $stations = $metro->stations($metro->railway_eng($railway));                        
                        foreach ($stations as $key => $value) {
                            $end_code = $value["odpt:stationcode"];
                        ?>
                            <li>
                                <form action="../../src_train/php/train.php" method="post">
                                    <input type="hidden" name="start" value="<?php echo $start_code ?>">
                                    <input type="hidden" name="end" value="<?php echo $end_code ?>">
                                    <button name="send_button" type="submit" class="btn btn-1 btn-1d">
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
  		$(document).ready(new function() {
                    //woolmark();
                 });
                 
                function wookmark(){
                    var options = {
      			autoResize: true, // ブラウザの拡大縮小に合わせて要素を自動でリサイズするかどうか
      			container: $('#contents'), // CSSを適用している要素を指定
      			offset: 40, // 要素間の隙間を指定
      			itemWidth: 600,
      			itemHeight:300 // 各要素の幅を指定 
                    };
                    var handler = $('#tiles li'); // レンガ状にする要素を指定
                    handler.wookmark(options); // wookmarkをオプション付きで実行
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
                        }
                    }                    
                });
                
                //div#contents 配下の色変更
                $('div #contents').each(function(){
                    console.log(this);
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