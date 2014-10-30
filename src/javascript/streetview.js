var map, svp;

function Initialize() {
    // 緯度・経度変数
    var latlng = new google.maps.LatLng(35.674144, 139.77675999999997);

    //地図の設定
    var mapOption = {
        heading: 0,
        zoom: 18,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        scrollwheel: false,
        draggable: false
    };
    //地図オブジェクト生成
    map = new google.maps.Map(document.getElementById("map"), mapOption);

    //ストリートビューパノラマ生成
    svp = new google.maps.StreetViewPanorama(        
        document.getElementById("svp"), {
            position: map.getCenter(),
            imageDateControl: false
        });
    // ストリートビューの設定
    svp.setPov(
        { heading: 0, pitch: 0, zoom: 0 }
        );
    //地図とストリートビューの同期
    map.setStreetView(svp);
    map.bindTo("center", svp, "position");

    //表示している現在位置
    google.maps.event.addListener(svp, "tilesloaded", review);
    google.maps.event.addListener(svp, "position_changed", review);
}

function review() {
    //document.getElementById("res").innerHTML = svp.getPosition();
}

//ページ読み込み時にInitialize()呼び出し
google.maps.event.addDomListener(window, 'load', Initialize);