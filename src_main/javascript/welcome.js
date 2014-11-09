function setTimer(param) {
	window.setTimeout("href(" + param + ")", 2200);
}

function href(param) {
	railway = param.getAttribute("id");
	alert("#?railway=" + railway);
}