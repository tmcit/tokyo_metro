

var map, svp;

function initialize() {

	// 緯度・軽度変数
	var latlng = new google.maps.LatLng(35.674144,139.77675999999997);
	// 地図のオプション設定
	var options = {
		// カメラの向き
		heading: -20,
		// 初期のズームレベル
		zoom: 16,
		// 地図の中心点
		center: latlng,
		// 地図タイプ
		mapTypeId: google.maps.MapTypeId.ROADMAP
	};
	//地図オブジェクト生成
	map = new google.maps.Map(document.getElementById('map'), options);
 
	//	ストリートビューオブジェクト生成
	svp = new google.maps.StreetViewPanorama(
	document.getElementById('svp'),{
		position : map.getCenter()
	});
  	
  	// ストリートビューオブジェクト詳細設定
  	svp.setPov({heading: -20, pitch: 0, zoom: 0});
 	
 	// マップとストリートビューの一致させる為の記述
	map.setStreetView(svp);
  	
  	// 緯度・経度確認
  	google.maps.event.addListener(svp, 'tilesloaded', review);
  	google.maps.event.addListener(svp, 'position_changed', review);  	
}

function selectRailway() {
	var select_html = "";

	select_html += "<form>";
	select_html += "<select id='railway' onChange='disRailway()'>";


	$(function() {
		$.getJSON("../json/tokyo_metro_json/metro_railwayDict.json", function(data) {
			var
				tag = $("#railway");
				len = data.length;
			for (var i = 0; i < len; i++){

			} 
		});
	});
}

// ロード
google.maps.event.addDomListener(window, 'load', initialize);