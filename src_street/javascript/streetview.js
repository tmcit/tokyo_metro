var map, svp;

function Initialize() {
    // 緯度・経度変数
    var latlng = new google.maps.LatLng(35.698683, 139.774219);

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
    IsNearStation();
}

/**
 * 現在地の近くに地下鉄の駅があるかどうか
 */
function IsNearStation() {
    //phpの関数をphp経由で叩く    
    $.ajax({
        type: "POST",
        url: "../php/getNearStation.php",
        cache: false,
        data: { lat: svp.getPosition().lat(),
                lng: svp.getPosition().lng() },
        success: function(isNear){
            //上手く行けば結果がisNearにtrue/falseで格納されるはず
            console.log(isNear);
        }
    });
}

//ページ読み込み時にInitialize()呼び出し
google.maps.event.addDomListener(window, 'load', Initialize);