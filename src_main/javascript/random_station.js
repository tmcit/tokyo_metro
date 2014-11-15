$(document).ready(function() {
    $('.wrapper').fadeIn(800);
});

//情報読み取り
var railway, station_jp, color, station_html;

$(function () {
    railway = $("div.info #railway").text();
    color = $("div.info #color").text();
    station_jp = $("div.info #station_jp").text();
    station_eng = $("div.info #station_eng").text();

    station_html = '<div class="station">'
                        + '<span id="jp">' + station_jp + '</span></br>'
                        + '<span id="eng">' + station_eng + '</span>'
                    + '</div>';
});

setTimeout("flip()", 1800);
function flip(){
    $("#flipbox").flip({
        direction:'tb',
        color: color,
        speed: 500,
        content: station_html
    });
}

function ride() {
    $('.wrapper').animate(
    { backgroundColor: "#fff" }, {
        "duration": 700, queue: false
    });
    $('.wrapper').animate(
    { "opacity": 0 }, {
        "duration": 700, queue: false,
        complete: function () {
            location.href = "../../src/php/railway_select.php?railway=" + railway + "&station=" + station_jp;
        }
    });
}