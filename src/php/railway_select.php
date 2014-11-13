<!DOCTYPE html>
<html >
<head>
<meta charset="UTF-8">
    <!-- <link type="text/css" href="../css/railway_select.css" rel="stylesheet"/> -->
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../libs/liquidslider-master/css/liquid-slider.css"/>
    <link rel="stylesheet" href="../css/railway_select.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">
    <!-- Latest compiled and minified JavaScript -->
    <link rel="stylesheet" href="../../libs/jquery-accordion-image-menu-master/accordionImageMenu.css">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="../../libs//jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
	<script src="../../libs/liquidslider-master/src/js/jquery.liquid-slider.js"></script>
  	<script src="../../libs/jquery-touchSwipe/jquery.touchSwipe.min.js"></script>
    <script src="../../libs/Wookmark/jquery.wookmark.js" type="text/javascript"></script>
    <script src="../../libs/ImgWheel-master/jquery.ImgWheel.min.js"></script>
    <script src="../../libs/jquery_animate_colors/jquery.animate-colors.js"></script>
   	<script src="../../libs/btn_plugin/btn_plugin.js"></script>
   	<script src="../../libs/jquery-accordion-image-menu-master/jquery.accordionImageMenu.min.js"></script>
  

</head>

	
<body>
	<?php
		require 'metro.php';
		$metro = new metro();
		// $railway_name = $_POST[''];
		// $start_station = $_POST[''];
		
		$dc_title = "上野";
		$railway_name = $metro->station($dc_title)[0]->{"odpt:railway"};
		$connecting_railway_name = $metro->station($dc_title)[0]->{"odpt:connectingRailway"};
		$array = array($railway_name);
		$array += array_merge($array, $connecting_railway_name);

	?>


	<script type="text/javascript">
		var railway_name = <?php echo $railway_name; ?>;

		// var railway_name = 'odpt.Railway:TokyoMetro.Hibiya';

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

	<div class="liquid-slider" id="slider">
		<div id="contents" >
			<?php
				foreach ($array as $key => $value) {
					echo '<h2 class="title" >'.$value.'</h2>';
					echo '<div id="tiles" style="position: relative">';
					echo '<ul　id="list">';
					// $stations = $metro->stations($railway_name);
					$stations = $metro->stations("odpt.Railway:TokyoMetro.Tozai");
					foreach ($stations as $key=>$value) {
						$stationcode = $value["odpt:stationcode"];
						$end_station = $value["station_jp_name"];
						echo '<li id="li">';
					 	echo '<input type="hidden" name="stationcode" value='.$stationcode.'>';
					 	echo '<input type="hidden" name="start_station" value='.$start_station.'>';
					 	echo '<input type="hidden" name="end_station" value='.$end_station.'>';
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
					echo '/ul>';
					echo '</div>';
				}
			?>	
		</div>;
	<div>;
	
			<!-- <form action="./test.php", method="post"> -->
				  
		

		

	<script>
		$(function() {
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
		});
 
	</script>


	

	<script type="text/javascript">
  		$(document).ready(new function() {
    		var options = {
      			autoResize: true, // ブラウザの拡大縮小に合わせて要素を自動でリサイズするかどうか
      			container: $('#contents'), // CSSを適用している要素を指定
      			offset: 40, // 要素間の隙間を指定
      			itemWidth: 600,
      			itemHeight:300 // 各要素の幅を指定 
    		};
    	var handler = $('#tiles li'); // レンガ状にする要素を指定
       
    	handler.wookmark(options); // wookmarkをオプション付きで実行
		});
	</script>

	

</body>
</html>