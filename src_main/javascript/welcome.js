﻿function setTimer(param) {
	window.setTimeout("href(" + param + ")", 2200);
}

function href(param) {
	railway = param.getAttribute("id");

	alert("#?railway=" + railway);
    
	$('.wrapper').animate(
        { backgroundColor: "#fff" }, {
            "duration": 1000, queue: false
        });
	$('.wrapper').animate(
        { "opacity": 0 }, {
            "duration": 1000, queue: false,
            complete: function () {
                location.href = "http://google.com";
            }
        });
}


$(function(){
    $('#fade1 li').hide();
    $('#fade2').hide();
    $('#fade3').hide();
}); 
        
var i = 0; 
var int=0; 
        
$(window).bind("load", function() { 
    int=setInterval("doFade(i)",700); //読み込む時間を指定
}); 
        
function doFade() { 
    var list = $('#fade1 li').length; 
    if (i >= list) { 
        clearInterval(int);
        nextFade();
    } 
    $('#fade1 li').eq(i).fadeIn(700); //フェードインの時間
    i++; 
}


function nextFade() {
    $('#fade2').fadeIn(1000);
    setTimeout("finalFade()", 1000);    
}


function finalFade() {
    $('#fade3').fadeIn(700);
    setTimeout("flash()", 2500);
}

function flash() {
    $('#ginza a img').animate({ "opacity": -1 }, {
        "duration": 500, queue: false,
        complete: function () {
            $('#ginza a img').animate({ "opacity": 1 }, 500);
        }
    });
    $('#marunouchi a img').animate({ "opacity": -1 }, {
        "duration": 500, queue: false,
        complete: function () {
            $('#marunouchi a img').animate({ "opacity": 1 }, 500);
        }
    });
    $('#hibiya a img').animate({ "opacity": -1 }, {
        "duration": 500, queue: false,
        complete: function () {
            $('#hibiya a img').animate({ "opacity": 1 }, 500);
        }
    });
    $('#tozai a img').animate({ "opacity": -1 }, {
        "duration": 500, queue: false,
        complete: function () {
            $('#tozai a img').animate({ "opacity": 1 }, 500);
        }
    });
    $('#chiyoda a img').animate({ "opacity": -1 }, {
        "duration": 500, queue: false,
        complete: function () {
            $('#chiyoda a img').animate({ "opacity": 1 }, 500);
        }
    });
    $('#yurakucho a img').animate({ "opacity": -1 }, {
        "duration": 500, queue: false,
        complete: function () {
            $('#yurakucho a img').animate({ "opacity": 1 }, 500);
        }
    });
    $('#hanzomon a img').animate({ "opacity": -1 }, {
        "duration": 500, queue: false,
        complete: function () {
            $('#hanzomon a img').animate({ "opacity": 1 }, 500);
        }
    });
    $('#namboku a img').animate({ "opacity": -1 }, {
        "duration": 500, queue: false,
        complete: function () {
            $('#namboku a img').animate({ "opacity": 1 }, 500);
        }
    });
    $('#fukutoshin a img').animate({ "opacity": -1 }, {
        "duration": 500, queue: false,
        complete: function () {
            $('#fukutoshin a img').animate({ "opacity": 1 }, 500);
        }
    });
}