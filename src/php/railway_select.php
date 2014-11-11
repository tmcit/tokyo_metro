<!DOCTYPE html>
<html >
<head>
<meta charset="UTF-8">
    <link type="text/css" href="../css/railway_select.css" rel="stylesheet"/>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="../css/btn_style.css"/>
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="../../libs//jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="../../libs/Wookmark/jquery.wookmark.js" type="text/javascript"></script>
    <script src="../../libs/ImgWheel-master/jquery.ImgWheel.min.js"></script>
    <script src="../../libs/jquery_animate_colors/jquery.animate-colors.js"></script>
    <script src="../../libs/btn_plugin/btn_plugin.js"></script>
    <script>
		$(document).ready( function() {
  		$('#demo').ImgWheel();
		});
	</script>

</head>
<body bgcolor="#ddd">
	<div id="header">行き先を決めてください</div>

	<div id="contents">
		<div id="tiles" style="position: relative">
			<ul　id="list">
				<?php
					require 'metro.php';
					$metro = new metro();
					$stations = $metro->stations("odpt.Railway:TokyoMetro.Hibiya");
					foreach ($stations as $key=>$value) {
						echo '<li id="li">';
						echo '<button class="btn btn-1 btn-1d">';
     					echo '<span class="text">';
     					echo '<div class="station_jp_name">',$key,'</div>';
     					echo '<div class="station_eng_name">',$value[station_eng_name],'</div>';
     					echo '</span>';
     					// echo '</span>';
     					// ,$key,'</span>';
     					// echo '<span class="station_ja_name">',$key,'</span>';
     					// echo '<span class="station_eng_name">',$value[station_eng_name],'</span>';
     					echo '<span class="back">';
         				echo '<span class="left"></span>';
         				echo '<span class="right"></span>';
     					echo '</span>';
						echo '</button>';

						// echo '< class="tile">';
						// echo '<div class="station_name">',$key,'</div>';
						// echo '<div class="station_eng_name">',$value[station_eng_name],'</div>';
						// echo '</div>';
						echo '</li>';	
					}	
				?>
			</ul>
		</div>
	</div>


	<script type="text/javascript">
  		$(document).ready(new function() {
    		var options = {
      			autoResize: true, // ブラウザの拡大縮小に合わせて要素を自動でリサイズするかどうか
      			container: $('#contents'), // CSSを適用している要素を指定
      			offset: 50, // 要素間の隙間を指定
      			itemWidth: 600 // 各要素の幅を指定 
    		};
    	var handler = $('#tiles li'); // レンガ状にする要素を指定
       
    	handler.wookmark(options); // wookmarkをオプション付きで実行
		});
	</script>

	
	<script>
		$(function() {
  var SPEED = 300;/* スピード設定 */
 $(".btn-1d").enter(function() {
          $(this).find(".back span").stop().animate(/* マウスを乗せたとき */
               { "width" : "0%" }, SPEED);
     },function() {
          $(this).find(".back span").stop().animate(/* マウスが外れたとき */
               { "width" : "50%" }, SPEED);
     		});
		}
	</script>


</body>
</html>