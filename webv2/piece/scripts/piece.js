$(document).ready(function() {

	$('#myCarousel').carousel();
	/*
	if ($("#index-exists").length != 0) {
		$("#index-link").addClass("1highlight-link");
		index_init();
	}else {
		var loc = window.location.toString();
		var str = loc.match(/((\/.*)*)?\/(.*)\.php?$/);
		if (str[3]) {
			$("#"+str[3]+"-link").addClass("highlight-link");
		}

	}
	if ($("#people-exists").length != 0) {
		people_init();
	}
	*/
});

	function triggermodal(elem) {
		$(elem).modal();
	}
