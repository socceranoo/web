$(document).ready(function() {
	Slider();
	$("#search-form").submit(function(event) {
		event.preventDefault();
		var string = document.getElementById("search-query").value;
		var size = "medium";
		$('.size-radio').each(function () {
			if ($(this).is(':checked')){
				size = $(this).attr('value');
			}
		});
		color = "any";
		$('.color-radio').each(function () {
			if ($(this).is(':checked')){
				color = $(this).attr('value');
			}
		});
		execute_search(string, size, color);
	});
});
var seconds=0;
var minutes=0;
var t;
var timer_is_on=0;
function timedCount() {
	seconds=seconds+1;
	if (seconds == 60) {
		seconds = 0;
		minutes++;
	}
	var str = minutes+":"+seconds;
	if (seconds < 10)  
		str = minutes+":0"+seconds;

	t=setTimeout("timedCount()", 1000);
	document.getElementById('clock').innerHTML=str;
}

function doTimer() {
	if (!timer_is_on) {
		timer_is_on=1;
		timedCount();
	}
}

function stopCount() {
	clearTimeout(t);
	timer_is_on=0;
}
function pausePlay() {
	var elem = $("#pause-button");
	if (elem.data('play')) {
		$('.main-box').addClass("paused");
		$("#status").html('PAUSED');
		elem.html("Play");
		elem.data('play', false);
		$('.small-box').hide();
		stopCount();
	}else {
		$('.main-box').removeClass("paused");
		$("#status").html('PLAYING');
		elem.html("Pause");
		elem.data('play', true);
		$('.small-box').show();
		doTimer();
	}
}
function updateClock ( )
{
	var currentTime = new Date ( );
	var currentHours = currentTime.getHours ( );
	var currentMinutes = currentTime.getMinutes ( );
	var currentSeconds = currentTime.getSeconds ( );
	// Pad the minutes and seconds with leading zeros, if required
	currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
	currentSeconds = ( currentSeconds < 10 ? "0" : "" ) + currentSeconds;
	// Choose either "AM" or "PM" as appropriate
	var timeOfDay = ( currentHours < 12 ) ? "AM" : "PM";
	// Convert the hours component to 12-hour format if needed
	currentHours = ( currentHours > 12 ) ? currentHours - 12 : currentHours;
	// Convert an hours component of "0" to "12"
	currentHours = ( currentHours == 0 ) ? 12 : currentHours;

	// Compose the string for display
	var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;

	// Update the time display
	document.getElementById("clock").firstChild.nodeValue = currentTimeString;
}
function submit_form_with_url(url) {
	document.getElementById("link").value = url;
	document.getElementById("searchstr").value = searchString;
	document.getElementById("searchcolor").value = searchColor;
	document.getElementById("searchsize").value = searchSize;
	document.getElementById("input-form").submit();
}
function Slider() {
	var moves = 0;
	assign_values();
	shuffle();
	$('#slider').fadeIn(function() {
		doTimer();
	});
	$('.shuffle').click(function (event) {
		shuffle();
	});
	$('.small-box').click(function (event) {
		var zero_elem = $("#elem16");
		var rows = $(".main-box").data('rows');
		var columns = $(".main-box").data('columns');
		var elem = $(event.target);
		var value = elem.data('value');
		var position = elem.data('position');
		var rem = (position - 1)%columns;
		var zero_position = zero_elem.data('position');
		var debug = "";
		if (value == 16) {
			return;
		}
		if (zero_position - position == 1 && rem !=3) {
			action_right(elem);
		} else if (position - zero_position == 1 && rem) {
			action_left(elem);
		} else if (zero_position - position == 4) {
			action_bottom(elem);
		} else if (position - zero_position == 4) {
			action_top(elem);
		} else {
			return;
		}
		moves++;
		$("#moves").html(moves);
		value = elem.data('value');
		position = elem.data('position');
		if (value == position) {
			elem.removeClass("wrong-border").addClass("right-border");
			check_solution();
		}else {
			elem.removeClass("right-border").addClass("wrong-border");
			zero_elem.removeClass("right-border").addClass("wrong-border");
		}
		/*
		if (zero_elem.data('position') == 15) {
			zero_elem.removeClass("background-alizarin").addClass("background-nephritis");
		} else {
			zero_elem.removeClass("background-nephritis").addClass("background-alizarin");
		}
		*/
		//alert(debug);
		function check_solution() {
			var correct = 0;
			var first_case = false;
			var second_case = false;
			var elem15id;
			var elem14id;
			$('.small-box').each(function () {
				var data = $(this).data('value');
				var position = $(this).data('position');
				if (data == position) {
					correct++;
				}
				if (data == 14 && position == 15) {
					first_case = true;
					elem15id = $(this).attr('id');
				}
				if (data == 15 && position == 14) {
					second_case = true;
					elem14id = $(this).attr('id');
				}
			});
			if (correct == 16) {
				$('.small-box').removeClass("wrong-border").addClass("right-border");
				$("#status").html("SOLVED");
				stopCount();
				return;
			}
			if (correct == 14 && first_case && second_case) {
				swap_values($("#"+elem14id), $("#"+elem15id));
				check_solution();
			}
		}
		function action_left(current) {
			var prev = current.prev('.small-box');
			$(prev).insertAfter(current);
			swap_positions(prev, current);
			debug = debug + "LEFT.";
		}
		function action_right(current) {
			var next = current.next('.small-box');
			$(current).insertAfter(next);
			swap_positions(current, next);
			debug = debug + "RIGHT.";
		}
		function action_top(current) {
			var top = current.prev('.small-box').prev('.small-box').prev('.small-box').prev('.small-box');
			var topPrev = top.prev('.small-box');
			var topNext = top.next('.small-box');
			var curPrev = current.prev('.small-box');
			debug = debug + "TOP.";
			if (position == 5) {
				$(current).insertBefore(topNext);
			} else {
				$(current).insertAfter(topPrev);
			}
			$(top).insertAfter(curPrev);
			swap_positions(current, top);
		}
		function action_bottom(current) {
			var bottom = current.next('.small-box').next('.small-box').next('.small-box').next('.small-box');
			var bottomPrev = bottom.prev('.small-box');
			var curPrev = current.prev('.small-box');
			var curNext = current.next('.small-box');
			if (position == 1) {
				$(bottom).insertBefore(curNext);
			} else {
				$(bottom).insertAfter(curPrev);
			}
			$(current).insertAfter(bottomPrev);
			swap_positions(current, bottom);
			debug = debug + "BOTTOM.";
		}
		function swap_positions(elem1, elem2) {
			var temp = $(elem1).data('position');
			$(elem1).data('position' , $(elem2).data('position'));
			$(elem2).data('position', temp);
		}
	});

	function assign_values() {
		$('.small-box').each(function () {
			//$(this).addClass("right-border");
			var data = $(this).data('value');
			$(this).data('position', data);
			if (data != 16) {
				//$(this).html(data);
				//var url = "url('temp/img"+data+".jpg')";
				//$(this).css('background-image', url);
			}
		});
	}
	function shuffle() {
		/*
		swap_values($("#elem14"), $("#elem15"));
		*/
		var elem = $("#pause-button");
		if (!elem.data('play')) {
			return;
		}
		seconds = 0;
		minutes = 0;
		$("#moves").html(0);
		$("#status").html('PLAYING');
		$('.small-box').removeClass("right-border").addClass("wrong-border");
		$('.small-box').each(function () {
			var position = $(this).data('position');
			var data = $(this).data('value');
			var rand = Math.floor((Math.random()*15)+1);
			if (rand && data!= 16) {
				swap_values($(this), $("#elem"+rand));
				data = $(this).data('value');
				if (data == position) {
					$(this).removeClass("wrong-border").addClass("right-border");
				}else {
					$(this).removeClass("right-border").addClass("wrong-border");
					//zero_elem.removeClass("right-border").addClass("wrong-border");
				}
				//$(this).html($(this).data('value'));
				//$("#elem"+rand).html($("#elem"+rand).data('value'));
			}
		});
	}
	function swap_values(elem1, elem2) {
		var data = $(elem1).data('value');
		var tempurl = "url('temp/img"+data+".jpg')";
		var data2 = $(elem2).data('value');
		var dataurl2 = "url('temp/img"+data2+".jpg')";
		$(elem1).css('background-image' , dataurl2);
		$(elem2).css('background-image', tempurl);
		var temp = $(elem1).data('value');
		$(elem1).data('value' , $(elem2).data('value'));
		$(elem2).data('value', temp);
	}
}
