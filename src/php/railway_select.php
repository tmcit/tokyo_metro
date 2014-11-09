<!DOCTYPE html>
<html >
<head>
<meta charset="UTF-8">
    <link type="text/css" href="../css/railway_select.css" rel="stylesheet"/>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">
    <link rel="stylesheet" type="text/css" href="../css/component.css" />
    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="../../libs//jquery/jquery-2.1.1.min.js" type="text/javascript"></script>
    <script src="../../libs/Wookmark/jquery.wookmark.js" type="text/javascript"></script>
    <script src="../../libs/ImgWheel-master/jquery.ImgWheel.min.js"></script>
    <script>
	$(document).ready( function() {
  	$('#demo').ImgWheel();
	});
</script>

</head>
<body bgcolor="#ddd">
	<div id="header">行き先を決めてください</div>

	<div id="demo">
 		<div class="image-container">
			<img src="../../img/door/close.png" height="3500" width="3000" alt="">
  		</div>
	</div>


	<!-- <div id="contents"> -->

		<!-- <div class="left_contetnts"> -->
			<!-- <div class="station_name">西日暮里</div> -->
			<!-- <div class="station_eng_name">Nishi-niippori</div> -->
		<!-- </div> -->
		<!-- <div class="right_contents"> -->
			<!-- <div class="station_name">北千住</div> -->
			<!-- <div class="station_eng_name">Kita-senju</div> -->
		<!-- </div> -->
	<!-- </div> -->


	
	<!-- </div> -->
<script type="text/javascript">
  $(document).ready(new function() {
    var options = {
      autoResize: true, // ブラウザの拡大縮小に合わせて要素を自動でリサイズするかどうか
      container: $('#contents'), // CSSを適用している要素を指定
      offset: 40, // 要素間の隙間を指定
      itemWidth: 210 // 各要素の幅を指定 
    };
 
    var handler = $('#tiles li'); // レンガ状にする要素を指定
       
    handler.wookmark(options); // wookmarkをオプション付きで実行
});
</script>
	</body>
</html>