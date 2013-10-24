$(document).ready(function() {
	var inprogress = false;
	 $(".box").waypoint(function(direction) {
		if (direction === 'down' && inprogress === false) {
			var index = $(".box").index(this);
			move(index);
		}
	 }, { offset: '95%' , triggerOnce : false }
	 );
	 $(".box").waypoint(function(direction) {
		if (direction === 'up' && inprogress === false) {
			var index = $(".box").index(this);
			move(index);
		}
	 }, { offset: '-95%' , triggerOnce : false }
	 );
	/*
	 alert($(".box:eq(1)").attr('class'));
	*/
	$("#item-selector li").click(function () {
		var val = $(this).data('target');
		move(val);
	});
	function move(val) {
		var prev = $("#item-selector").data("current");
		if (prev === val) {
			return;
		}
		var diff = Math.abs(val - prev);
		var delay = diff * 500;
		delay = (delay < 1000)?1000:delay;
		inprogress = true;
		/*
		$(".box:eq("+val+")").slideUp(delay, callback);
		*/
		$('html, body').animate({
			scrollTop: $(".box:eq("+val+")").offset().top
		}, delay , callback);
		function callback() {
			inprogress = false;
			$("#item-selector li:eq("+prev+")").removeClass("active");
			$("#item-selector li:eq("+val+")").addClass("active");
			$("#item-selector").data("current", val);
			// Animation complete.
		}
	}
});
