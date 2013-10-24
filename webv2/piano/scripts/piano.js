$(document).ready(function() {
	/*
	$(".octave").children(".key-combo").children("a").click(function (event) {
		alert(event.target.data('key'));
	});
	*/
	$(".key-combo").children("a").click(function(event) {
		var elem = $(event.target);
		keypress(elem);
	});
	$(".key-combo").children("a").children('span').click(function(event) {
		var elem = $(event.target);
		var parent_elem = $(elem).parent();
		keypress(parent_elem);
		event.stopPropagation();
	});

	function keypress(elem) {
		var parent_elem = $(elem).parent().parent();
		var key = elem.data('key');
		var octave = parent_elem.data('octave');
		var src = "images/"+octave+"/"+key+".wav";
		document.getElementById('player').src = src;
		document.getElementById('player').play();
	}
});

