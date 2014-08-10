$(document).ready(function() {
	$(".polygon").click(function() {
		var prev = $("#color-picker").data("current");
		$("#value").html($(this).data('color'));	
		$(".polygon:eq("+prev+")").removeClass("outline");
		$(this).addClass("outline");
		var val = $(".polygon").index(this);
		$("#color-picker").data("current", val);
	});
	var cw = $('.color-bg').width();
	$('.color-bg').css({'height':cw+'px'});
});
