<!DOCTYPE html>
<html >
<head>
<meta charset="UTF-8">
    <!-- <link type="text/css" href="../css/railway_select.css" rel="stylesheet"/> -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <link rel="stylesheet" href="../../libs/jquery-accordion-image-menu-master/accordionImageMenu.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="../../libs//jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="../../libs/Wookmark/jquery.wookmark.js" type="text/javascript"></script>
    <script src="../../libs/ImgWheel-master/jquery.ImgWheel.min.js"></script>
    <script src="../../libs/jquery_animate_colors/jquery.animate-colors.js"></script>
   	<script src="../../libs/btn_plugin/btn_plugin.js"></script>
   	<script src="../../libs/jquery-accordion-image-menu-master/jquery.accordionImageMenu.min.js"></script>
  

</head>

	
<body>
        <?php		
            $start_station = htmlspecialchars($_GET['station']);
            $railway_name = "";
        ?>    
    
	<script type="text/javascript">
                var railway_name = '<?php echo $railway_name; ?>';

		var railway_name = 'odpt.Railway:TokyoMetro.Hibiya';

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

	<div id="header">行き先を決めてください</div>

        <form action="../../src_train/php/train.php" method="post">
	<div id="contents" >
		<div id="tiles" style="position: relative">
			<ul　id="list">
				<?php
					require 'metro.php';
					$metro = new metro();
                                        $start_station_info = $metro->station($start_station);
                                        $start_code = reset($start_station_info)->{"odpt:stationCode"};
                                        $start_code = "T01"; //trainページのテスト用
                                        $connecting_railway = $metro->connectingMetroRailway(reset($start_station_info));
                                        var_dump($connecting_railway);
                                        //ここに路線名(日本語)から路線名(sameAs)に変換する何かを記述
                                        
                                        $railway = "odpt.Railway:TokyoMetro.Tozai";
					$stations = $metro->stations($railway);
					foreach ($stations as $key=>$value) {
						$end_code = $value["odpt:stationcode"];
						echo '<li id="li">';
					 	echo '<input type="hidden" name="start" value="'.$start_code.'">';
					 	echo '<input type="hidden" name="end" value="'.$end_code.'">';
                                                echo '<input type="hidden" name="railway" value='.$railway.'>';
						echo '<button name="send_button" type="submit" class="btn btn-1 btn-1d">';
     					echo '<span class="text">';
     					echo '<div class="station_jp_name">',$value["station_jp_name"],'</div>';
     					echo '<div class="station_eng_name">',$value["station_eng_name"],'</div>';
     					echo '</span>';
     					echo '<span class="back">';
         				echo '<span class="left"></span>';
         				echo '<span class="right"></span>';
     					echo '</span>';
						echo '</button>';
						echo '</li>';	
					}	
				?>
			</ul>
		</div>
	</div>
	</form>

	

	<script type="text/javascript">
  		$(document).ready(new function() {
    		var options = {
      			autoResize: true, // ブラウザの拡大縮小に合わせて要素を自動でリサイズするかどうか
      			container: $('#contents'), // CSSを適用している要素を指定
      			offset: 40, // 要素間の隙間を指定
      			itemWidth: 600 // 各要素の幅を指定 
    		};
    	var handler = $('#tiles li'); // レンガ状にする要素を指定
       
    	handler.wookmark(options); // wookmarkをオプション付きで実行
		});
	</script>

	

</body>
</html>