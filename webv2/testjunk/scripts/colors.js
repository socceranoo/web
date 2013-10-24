$(document).ready(function() {
	$(".polygon").click(function() {
		var prev = $("#color-picker").data("current");
		$("#value").html($(this).data('color'));	
		$(".polygon:eq("+prev+")").removeClass("outline");
		$(this).addClass("outline");
		var val = $(".polygon").index(this);
		$("#color-picker").data("current", val);
		$("#slider").slider({
			value:100,
			min: 0,
			max: 500,
			step: 50,
			slide: function(event, ui) {
				$("#amount").val("$" + ui.value);

			}
		});
	});
	var cw = $('.color-bg').width();
	$('.color-bg').css({'height':cw+'px'});
});
