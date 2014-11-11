var HTML_HEIGHT = "802";
$(function() {
    $(window).resize(function(){ setZoom(); });
    setZoom();
});

function setZoom(){
    var scale = $(window).height() / HTML_HEIGHT * 100;
    $('.contents_left').css({'zoom' : scale + "%" });

    //ドアの下に駅名が回り込まないように、widthを動的に設定
    var width = $('.contents_left').width() * scale / 100 + 500;
    if (($('body').width() > width) === true){
        $('.wrapper').css({'width' : "auto" });
    }
    else {
        $('.wrapper').css({'width' : width + "px" });
    }
    
    //駅名の間隔の分散
    var max_height = $('body').height() / $('li').length;
    $('.station li div').css({'margin' : max_height/2 - 40 + "px 0"});
    $('.station li .name').css({'margin' : max_height/2 - 40 + "px 10px"});
}