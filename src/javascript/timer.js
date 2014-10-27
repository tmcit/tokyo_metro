function clock() {
	setInterval(setTimer(), 1000);
}

function setTimer() {
	var dataObj = new Date();
	var h = dataObj.getHours();
	var m = dataObj.getMinutes();
	var s = dataObj.getSeconds();
	document.getElementById("currentTime").innerHTML = h + "時" + m + "分" + s "秒";

}

