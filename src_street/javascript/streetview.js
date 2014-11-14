var map, svp;

function Initialize() {
    $('body').fadeIn(1500);
    
    // 緯度・経度変数 Cookieから取得後削除
    var latlng = new google.maps.LatLng($.cookie("streetLat"), $.cookie("streetLng"));
    if ($.cookie("streetLat") == null){
        latlng = new google.maps.LatLng(35.702942, 139.77175499999998);
    }
    $.removeCookie("streetLat", { path: "/" }); 
    $.removeCookie("streetLng", { path: "/" });

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
            imageDateControl: false,
            panControl: false,
            addressControl: false,
            zoomControlOptions: {
                style: google.maps.ZoomControlStyle.LARGE,
                position: google.maps.ControlPosition.RIGHT_CENTER
            }
        });
    // ストリートビューの設定
    svp.setPov(
        { heading: 0, pitch: 0, zoom: 1 }
        );
    //地図とストリートビューの同期
    map.setStreetView(svp);
    map.bindTo("center", svp, "position");

    //表示している現在位置
    google.maps.event.addListener(svp, "tilesloaded", review);
    google.maps.event.addListener(svp, "position_changed", review);
}

/**
 * 表示座標が変わったときにしたい処理
 */
function review() {
    ToastNearStation();
}


//ページ読み込み時にInitialize()呼び出し
google.maps.event.addDomListener(window, 'load', Initialize);