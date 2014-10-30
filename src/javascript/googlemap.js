

var map;
var panorama;

function initialize() {
  var fenway = new google.maps.LatLng(35.659191,139.700569);

  var mapOptions = {
    center: fenway,
    zoom: 14,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
  };
    map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

    var panoramaOptions = {
        position: fenway,
        pov: {
            heading: 34,
            pitch: 10,
            zoom: 1
        }
    };
    var panorama = new  google.maps.StreetViewPanorama(document.getElementById("pano"), panoramaOptions);
    map.setStreetView(panorama);
   // panorama = map.getStreetView();
  // panorama.setPosition(fenway);
   // panorama.setPov(({
    // heading: 265,
    // pitch: 0
   // }));
    setInterval("setTimer()", 1000);

}

function toggleStreetView() {
    var toggle = panorama.getVisible();
    if (toggle == false) {
        panorama.setVisible(true);
    }
    else {
        panorama.setVisible(false);
    }
}


function setTimer() {
    var dataObj = new Date();
    var h = dataObj.getHours();
    var m = dataObj.getMinutes();
    var s = dataObj.getSeconds();
    document.getElementById("currentTime").innerHTML = "現在の時刻は" + h + "時" + m + "分" + s +"秒";

}

function createMarker(geo_long, geo_lat) {
    var latlng = new google.maps.LatLng(geo_long, geo_lat);
    var marker = new google.maps.Marker({
        position:latlng,
        map:map
    });
}

function panTo(geo_long, geo_lat) {
    map.panTo(new google.maps.LatLng(geo_long, geo_lat));
}

function getLat() {
    var latlng = map.getCenter();
    var lat = latlng.lat();
    var lng = latlng.lng();
    return [lat, lng];
}

google.maps.event.addDomListener(window, "load", initialize);

