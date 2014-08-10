$(document).ready(function() {

	//$('#myCarousel').carousel('slide', {interval:7000});
	blog();
	contact();
	/*
	$('#stick').waypoint('sticky');
	*/
	if ($("#snowkick-holder").length !== 0) {
		snowkick();
	}
	$('#myCarousel').carousel({
		interval:false
	});
	if ($("#about-container").length !== 0) {
		about_graph1();
		//waypoint_do_something("#back-end-skills", about_graph1, "70%");
		waypoint_do_something("#general-skills", about_graph2, "70%");
		waypoint_do_something("#ui-skills", about_graph3, "70%");
	}
	waypoint_appear(".waypoint-column", null, "100%");
	//waypoint_appear("#fifapic-holder", null, "75%");
	waypoint_appear("#profilepic-holder", null, "75%");
	//waypoint_multiple_appear(".bar-graph", ".bar", bar_count, "70%");
	waypoint_multiple_appear(".randomfacts1", ".facts-li1", null, "75%");
	//waypoint_multiple_appear(".randomfacts2", ".facts-li2", null, "75%");
	function bar_count() {
		$('.bar-value-elem').each( function() {
			var id = "#"+$(this).attr('id');
			var start = $(this).data('min');
			var end = $(this).data('max');
			var timerId = self.setInterval(function () {
				increment();
				}, 10);
			var cur_val = 0;

			function increment() {
				cur_val++;	
				$(id).html(cur_val+"%");
				if (cur_val == end) {
					window.clearInterval(timerId);
				}
			}
		});
	}
	$("#totop").click(function(){
		$('html, body').animate({scrollTop:0}, 600 , "swing");
	});
});

function waypoint_do_something(element, fn, offset1) {
	$(element).waypoint(function(event, direction) {
		fn();
	}, { offset: offset1 , triggerOnce : true }
	);
}
function waypoint_appear(mainclass, second_function, offset1) {
	$(mainclass).waypoint(function(event, direction) {
		var delay = 0;
		var delay_interval = $(this).data('waypoint').delay_interval;
		var total_time = $(this).data('waypoint').total_time;
		var attr = $(this).data('waypoint').attr;
		var width_animate = false;
		if($.inArray("width", attr) != -1){
			var width = $(this).css('width');
			$(this).css('width', 0);
			$(this).css({'visibility':'visible'}).stop().delay(delay).animate({'opacity':1, 'width':width}, total_time);
		}else {
			$(this).css({'visibility':'visible'}).stop().delay(delay).animate({'opacity':1}, total_time);
		}
		if (second_function !== null) {
			second_function();
		}
	}, { offset: offset1 , triggerOnce : true }
	);
}
function waypoint_multiple_appear(mainclass, subclass, second_function, offset1) {
	$(mainclass).waypoint(function(event, direction) {
		var delay = 0;
		var delay_interval = $(this).data('waypoint').delay_interval;
		var total_time = $(this).data('waypoint').total_time;
		var attr = $(this).data('waypoint').attr;
		var width_animate = false;
		if($.inArray("width", attr)){
			width_animate = true;
		}
		$(subclass).each( function() {
			if(!width_animate){
				var width = $(this).css('width');
				$(this).css('width', 0);
				$(this).css({'visibility':'visible'}).stop().delay(delay).animate({'opacity':1, 'width':width}, total_time);
			}else {
				$(this).css({'visibility':'visible'}).stop().delay(delay).animate({'opacity':1}, total_time);
			}
			delay = delay + delay_interval;
		});
		if (second_function !== null) {
			second_function();
		}
	}, { offset: offset1 , triggerOnce : true }
	);
}
function triggermodal(elem) {
	$(elem).modal();
}
function blog() {
	function init_events() {
		$('.tag-entry').click(function (event) {
			var name = $(this).attr('name');
			$('#reset-tags').removeClass('active');
			$('.tag-entry').removeClass('active');
			$(this).addClass('active');
			$('.blog-entry').show();
			//$('.blog-entry').fadeIn("800");
			get_tag_posts(name);
		});
		$('#reset-tags').click(function () {
			$('.blog-entry').show();
			$('.tag-entry').removeClass('active');
			$('#reset-tags').addClass('active');
		});
	}
	function get_tag_posts(tag) {
		$('.blog-entry').each( function() {
			var name=$(this).attr('name');
			if (name != tag) {
				//$(this).fadeOut("800");
				$(this).hide();
			}
		});
	}
	return init_events();
}

function snowkick() {
	var div_id = "#snowkick-holder";
	var img_id = "#snowkick-img";
	var start_id = "#snowkick-start";
	var heading_id = "#heading-start";
	var img_thumb_class= ".img-thumbnail";
	var loading_id = "#loading-bar";
	var load_count = 0;
	var end=20;
	var cur_val = 0;
	var timerId = 0;
	$(start_id).on('click', function () {
		play_video();
	});
	$(loading_id).show();
	$(img_thumb_class).on('click', function (event) {
		var id = event.target.id;
		var match = id.match(/img-tn(\d+)$/);
		var val = parseInt(match[1], 10);
		set_bgpos(val);
	});
	function load_i () {
		img = new Image();
		img.onload = load_e;
		img.src = "images/snowkick/snowkick.jpg";
	}
	function load_e() {
		after_loading();
	}
	function after_loading() {
		$(loading_id).delay(100).fadeOut("slow", function () { 
			$(div_id).fadeIn("slow");
			$(heading_id).show();	
		});
	}
	load_i();
	function play_video() {
		$(start_id).off('click');
		cur_val = 0;
		var delay = $(start_id).data('med');
		timerId = self.setInterval(function () {
			increment();
		}, delay);
	}
	function increment() {
		cur_val++;
		set_bgpos(cur_val);
		if (cur_val == end) {
			window.clearInterval(timerId);
			$(start_id).on('click', function () {
				play_video();
			});
		}
	}
	function set_bgpos(val) {
		var img_width = 720;
		var img_height = 540;
		var xpos = val * img_width;
		xpos = xpos * (-1);
		var bgpos = xpos+"px 0px";
		$(img_id).css('background-position', bgpos);
	}
	/*
	function increment() {
		cur_val++;
		var url, src;
		if (cur_val < 10) {
			url = "url('images/snowkick/00"+cur_val+".jpg')";
			src = "images/snowkick/00"+cur_val+".jpg";
		}
		else  {
			url = "url('images/snowkick/0"+cur_val+".jpg')";
			src = "images/snowkick/0"+cur_val+".jpg";
		}

		//$(div_id).css('background-image', url);
		$(img_id).attr('src', src);
		if (cur_val == end) {
				window.clearInterval(timerId);
				$(start_id).on('click', function () {
					play_video();
				});
		}
	}
	*/
}

function contact() {
	$("#contact-form").submit(function(event) {
		// prevent default posting of form
		event.preventDefault();
		var $form = $(this), $inputs = $form.find("input, input,input,textarea");
		$inputs.attr("disabled", "disabled", "disabled");
		var name = document.getElementById("contact-name").value;
		var email = document.getElementById("contact-email").value;
		var hidden = document.getElementById("contact-hidden").value;
		var message = $("#contact-message").val();
		$.post("include/sendmail.php",{ formname: "contact-form", name:name, email:email, message:message, hidden:hidden},function(data){
			$inputs.removeAttr("disabled");
			reset_form();
			$("#msgsent").show();
		}, "json");
	});
	
	$("#modal-form").click(function() {
		$("#form-div").modal();
		$("#msgsent").hide();
	});
	
	function reset_form() {
		document.getElementById("contact-name").value = "";
		document.getElementById("contact-email").value = "";
		$("#contact-message").val("");
	}
}

function about_graph1() {
	$.jqplot.config.enablePlugins = true;
	var s1 = [30, 30, 20, 10, 5, 5];
	var spie = [[['C/C++', 30], ['PHP', 30], ['PYTHON', 10], ['PERL', 20], ['MYSQL', 5], ['SHELL', 5]]];
	var ticks = ['C/C++', 'PHP', 'PERL', 'PYTHON', 'MYSQL', 'SHELL'];
	var backEnd = new jqPlotChart("back-end-skills", $.jqplot.PieRenderer, spie); 
	//var backEnd = new jqPlotChart("back-end-skills", $.jqplot.BarRenderer, [s1]); 
	var legend = { show:true, rendererOptions: { animate:{show:true}}, location:'ne', marginTop: '57px' }; 
	backEnd.setChartOptions("title", "Back End Skills"); 
	backEnd.setChartOptions("legend", legend); 
	//backEnd.setChartOptions("axes", {xaxis: {renderer: $.jqplot.CategoryAxisRenderer, ticks: ticks}}); 
	backEnd.setChartOptions("highlighter", { show: false }); 
	backEnd.setChartOptions("animate", !$.jqplot.use_excanvas); 
	//backEnd.setChartOptions("seriesColors", [__peterRiver]); 
	backEnd.setChartOptions("seriesColors", [__orange, __amethyst, __wetAsphalt, __pomegranate, __asbestos, __peterRiver]); 
	backEnd.setChartLevel3Options("seriesDefaults", "rendererOptions", "barMargin", 20); 
	backEnd.setChartLevel2Options("grid", "borderWidth", 0); 
	backEnd.setChartLevel2Options("grid", "shadow", false); 
	//backEnd.setChartLevel2Options("grid", "gridLineColor", "#fff"); 
	backEnd.drawChart();
}
function about_graph2() {
	$.jqplot.config.enablePlugins = true;
	var s2 = [8, 9.5, 8.5, 8, 7, 9];
	var ticks2 = ['Algorithms', 'OS', 'Debugging', 'Networking', 'Security', 'Scripting'];
	var general = new jqPlotChart("general-skills", $.jqplot.BarRenderer, [s2]); 
	//var legend = { show:true, placement: 'outside', rendererOptions: { numberRows: 1, animate:{show:true}}, location:'s', marginTop: '7px' }; 
	general.setChartOptions("title", "General Skills"); 
	general.setChartOptions("axes", {xaxis: {renderer: $.jqplot.CategoryAxisRenderer, ticks: ticks2}}); 
	general.setChartLevel2Options("axes", "yaxis", {min:5, max:10}); 
	//general.setChartLevel2Options("axes", "yaxis", {renderer: $.jqplot.CategoryAxisRenderer, min:0, max:10, ticks: [[5, 'low'], [6, 'low-med'], [7, 'med'], [8, 'med-high'], [9, 'high']]}); 
	general.setChartOptions("axesDefaults", { min: 0,  tickInterval: 1, tickOptions: { formatString: '%.1f' }}); 
	general.setChartOptions("animate", !$.jqplot.use_excanvas); 
	general.setChartOptions("seriesColors", [__greenSea, __alizarin, __sunFlower, __concrete, __peterRiver, __emerald]); 
	general.setChartLevel3Options("seriesDefaults", "rendererOptions", "barMargin", 20); 
	//general.setChartLevel3Options("seriesDefaults", "rendererOptions", "barDirection", "horizontal"); 
	general.setChartLevel3Options("seriesDefaults", "rendererOptions", "varyBarColor", true); 
	general.setChartLevel2Options("grid", "borderWidth", 1.0); 
	//general.setChartLevel2Options("grid", "gridLineColor", "#fff"); 
	general.drawChart();
}
function about_graph3() {
	$.jqplot.config.enablePlugins = true;
	var s2 = [70, 75, 95, 90, 85];
	var ticks2 = ['Photoshop', 'jQuery', 'HTML5', 'CSS3', 'JavaScript'];
	var uiskills = new jqPlotChart("ui-skills", $.jqplot.BarRenderer, [s2]); 
	//var legend = { show:true, placement: 'outside', rendererOptions: { numberRows: 1, animate:{show:true}}, location:'s', marginTop: '7px' }; 
	uiskills.setChartOptions("title", "UI Skills"); 
	uiskills.setChartOptions("axes", {yaxis: {renderer: $.jqplot.CategoryAxisRenderer, ticks: ticks2}}); 
	uiskills.setChartLevel2Options("axes", "xaxis", {min:40, max:100}); 
	//uiskills.setChartLevel2Options("axes", "xaxis", {renderer: $.jqplot.CategoryAxisRenderer, min:0, max:100, ticks: [[50, 'Amateur'], [60, 'Semi-pro'], [70, 'Pro'], [80, 'World-class'], [90, 'Legendary']]}); 
	uiskills.setChartOptions("axesDefaults", { tickInterval:20, tickOptions: { formatString: '%d' }}); 
	uiskills.setChartOptions("animate", !$.jqplot.use_excanvas); 
	uiskills.setChartOptions("seriesColors", [__greenSea, __alizarin, __sunFlower, __concrete, __peterRiver, __emerald]); 
	uiskills.setChartLevel3Options("seriesDefaults", "rendererOptions", "barMargin", 15); 
	uiskills.setChartLevel3Options("seriesDefaults", "rendererOptions", "barDirection", "horizontal"); 
	uiskills.setChartLevel3Options("seriesDefaults", "rendererOptions", "varyBarColor", true); 
	uiskills.setChartLevel2Options("grid", "borderWidth", 1.0); 
	//uiskills.setChartLevel2Options("grid", "gridLineColor", "#fff"); 
	uiskills.drawChart();
}
