var HTML_HEIGHT = "802";
$(function() {
    $(window).resize(function(){ setZoom(); });
    setZoom();
});

function setZoom(){
    var scale = $(window).height() / HTML_HEIGHT * 100;
    $('.contents_left').css({'zoom' : scale + "%" });

    var width = $('.contents_left').width() * scale / 100 + 500;
    if (($('body').width() > width) === true){
        $('.wrapper').css({'width' : "auto" });
    }
    else {
        $('.wrapper').css({'width' : width + "px" });
    }
}