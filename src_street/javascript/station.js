/**
 * 現在地の近くに地下鉄の駅があったら通知する
 */
function ToastNearStation() {
    //phpの関数をphp経由で叩く    
    $.ajax({
        type: "POST",
        url: "../php/getNearStation.php",
        cache: false,
        data: { lat: svp.getPosition().lat(),
                lng: svp.getPosition().lng() },
        success: function(html){
            //console.log(html);
            exitArray = ToArray(html);            
            if(exitArray[0] === "true"){
                //通知
                //console.log(exitArray);
                title = '<div class="toast_title">' + exitArray[1] + " 付近です。</div>";
                msg = '<div class="toast_msg">東京メトロに乗車しますか？</div>';
                button = '<div><button type="button" class="toast_btn" onclick=\'RideMetro("' 
                        + exitArray[4] + '")\'>乗車する</button></div>';
                toastr.options = {"timeOut": "7000", "extendedTimeOut": "1500"};
                toastr.info(msg + button, title);
            }
        }
    });
}

/**
 * 東京メトロに乗車するボタン押下時に呼び出される
 * 地上からメトロに乗るまでの橋渡し
 */
function RideMetro(sameAs) {
    alert(sameAs);
    
    //画面ホワイトアウト後ページ遷移
    $('#wrapper').animate({"opacity": 0}, {"duration": 1000, queue: false});
    $('ul#navigation li a').animate({"opacity": 0}, {"duration": 1000, queue: false, 
        complete: function() {
          location.href = "http://google.com";
        }});
}


/**
 * @param {type} phpの実行結果
 * @returns {Array|result|array} 実行結果から出口情報を抜き出して配列化したもの
 */
function ToArray(html){
    result = new Array();    
    
    array = html.split(/\r\n|\r|\n/);
    for (i = 0; i < array.length; i++) {
        //識別子が見つかったら、識別子を除いて配列に格納
        if(array[i].indexOf("***:") !== -1){
            result[0] = array[i].substr(4);
            break;
        }
    }
    
    if(result[0] === "true"){
        result[1] = array[++i]; //出入口名
        result[2] = array[++i]; //緯度
        result[3] = array[++i]; //経度
        result[4] = array[++i]; //駅名
    }
    
    return result;
}
