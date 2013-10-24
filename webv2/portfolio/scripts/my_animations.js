function animations () {
	var asdasd;
	var glow;
	var anim_in_progress = false;
	var prev_section = "";
	(function load_emblem_images() {
		var i=0;
		$('#emblem').css('visibility', 'visible');
		/*
		var url = "url('images/emblem_wo_ball.png')";
		$("#emblem").css("background", url);
		url = "url('images/emblem_wo_html.png')";
		$("#emblem").css("background", url);
		url = "url('images/emblem_wo_gator.png')";
		$("#emblem").css("background", url);
		url = "url('images/emblem_wo_ubuntu.png')";
		$("#emblem").css("background", url);
		url = "url('images/emblemv4.png')";
		$("#emblem").css("background", url);
		*/
		//$('#emblem').fadeIn();
		$("#bl-icon-about").data('dest', "ball-click");
		$("#bl-icon-works").data('dest', "html-click");
		$("#bl-icon-blog").data('dest', "ubuntu-click");
		$("#bl-icon-contact").data('dest', "gator-click");
		$("#ball-click").data('dest', "#section-about");
		$("#html-click").data('dest', "#section-works");
		$("#ubuntu-click").data('dest', "#section-blog");
		$("#gator-click").data('dest', "#section-contact");
		/*
		glow=self.setInterval( function toggle_glow() {
			toggle_glow.toggle = (toggle_glow.toggle) ? false : true;
			url = (toggle_glow.toggle)? "url('images/ballglow.png')" : "url('images/ball.png')";
			$("#ball-click").css("background", url);
		}, 700);
		*/
	})();
	$('.bl-box').children('.bl-icon').click(function (event) {
		var id = event.target.id;
		var dest_id = $("#"+id).data('dest');
		anim_click(dest_id);
	});
	function data_holder (cur_arr, prev_arr, custom_arr) {
		this.anim_id = cur_arr.anim_id;
		this.moving_elem = cur_arr.moving_elem;
		this.base_elem= cur_arr.base_elem;
		this.total_duration = cur_arr.total_duration;
		this.rotate = cur_arr.rotate;
		this.rotate_duration = cur_arr.rotate_duration;
		this.src_left = 0;
		this.src_top = 0;
		this.dest_left = 0;
		this.dest_top= 0;
		this.start_width = 0;
		this.start_height = 0;
		this.stop_width = 0;
		this.stop_height = 0;
		this.onStopFunc = cur_arr.onStop;
		this.onStartFunc = cur_arr.onStart;
		this.dest_icon_id = cur_arr.dest_icon_id;
		this.dest_pos = cur_arr.dest_pos;
		this.section = cur_arr.section;
		this.is_last_animation = cur_arr.is_last_animation;
		this.is_sequential = cur_arr.is_sequential;

		this.default_onStp = function (section) {
			open_section(section);
			$("#moving-div").hide("fast", function () {
				anim_in_progress = false;
			});
		};
		this.default_onStrt = function () {
			return;
		};
		this.calculate_dest_pos = function () {
			if (!prev_arr || !custom_arr.ret_back) {
				var epos = $('#emblem').offset();
				var epos_top = parseInt(epos.top, 10);
				var epos_left = parseInt(epos.left, 10);
				var pos = $(this.dest_icon_id).offset();
				var pos_top = parseInt(pos.top, 10);
				var pos_left = parseInt(pos.left, 10);
				var icon_width = parseInt($(this.dest_icon_id).css('width'), 10);
				var icon_height = parseInt($(this.dest_icon_id).css('height'), 10);
				this.dest_top = (pos_top - epos_top);
				this.dest_left = (pos_left - epos_left);
				if (this.dest_pos == "bottom") {
					this.dest_top = this.dest_top + icon_height;
				}else if (this.dest_pos == "top") {
					this.dest_top = this.dest_top - (icon_height/2);
					this.dest_left = this.dest_left - (icon_width/2);
				}else if (this.dest_pos == "right") {
					this.dest_left = this.dest_left - (icon_width/2);
				}else if (this.dest_pos == "left") {
					this.dest_left = this.dest_left + (icon_width/2);
				}
			}else {
				this.dest_top = prev_arr.src_top;
				this.dest_left = prev_arr.src_left;
			}
		};
		this.calculate_src_pos = function () {
			if (!prev_arr) {
				if (this.moving_elem == this.dest_icon_id) {
					this.src_left = 0;
					this.src_top = 0;
				}else {
					var src_pos = $(this.base_elem).position();
					this.src_top= parseInt(src_pos.top, 10);
					this.src_left= parseInt(src_pos.left, 10);
				}
			}else {
				this.src_top= prev_arr.dest_top;
				this.src_left= prev_arr.dest_left;
			}
		};
		this.calculate_start_size = function () {
			if (!prev_arr) {
				var icon_width = parseInt($(this.dest_icon_id).css('width'), 10);
				var icon_height = parseInt($(this.dest_icon_id).css('height'), 10);
				var $base= $(this.base_elem);
				this.start_width= parseInt($base.css('width'), 10);
				this.start_height= parseInt($base.css('height'), 10);
			}else {
				this.start_width= prev_arr.stop_width;
				this.start_height= prev_arr.stop_height;
			}
			this.stop_width= this.start_width;
			this.stop_height= this.start_height;
		};
		this.calculate_stop_size = function () {
			if (!prev_arr || !custom_arr.ret_back) {
				var icon_width = parseInt($(this.dest_icon_id).css('width'), 10);
				var icon_height = parseInt($(this.dest_icon_id).css('height'), 10);
				this.stop_width= icon_width;
				this.stop_height= icon_height;
			}else {
				this.stop_width= prev_arr.start_width;
				this.stop_height= prev_arr.start_height;
			}
		};
		this.init_events = function () {
			if (custom_arr.dest_pos) {
				this.dest_top= cur_arr.dest_top;
				this.dest_left= cur_arr.dest_left;
			}else {
				this.calculate_dest_pos();
			}
			if (custom_arr.src_pos) {
				this.dest_top= cur_arr.dest_top;
				this.dest_left= cur_arr.dest_left;
			}else {
				this.calculate_src_pos();
			}
			if (custom_arr.start_size) {
				this.start_width= cur_arr.start_width;
				this.start_height= cur_arr.start_height;
			}else {
				this.calculate_start_size();
			}
			if (custom_arr.stop_size) {
				this.stop_width= cur_arr.stop_width;
				this.stop_height= cur_arr.stop_height;
			}else {
				this.calculate_stop_size();
			}
		};
		this.init_events();
	}
	(function set_data () {
		function default_onStop (section) {
			open_section(section);
			$("#moving-div").hide("fast");
			anim_in_progress = false;
		}
		function default_onStart() {
			return;
		}
		function null_function() {
			return;
		}
		function reset_pos_size(arr) {
			arr.start_width = 0;
			arr.start_height = 0;
			arr.stop_height = 0;
			arr.stop_width = 0;
			arr.src_left = 0;
			arr.src_top = 0;
			arr.dest_left = 0;
			arr.dest_top = 0;
		}
		var temp_arr = {
			anim_id:0,
			moving_elem:"#moving-div",
			total_duration:0.75,
			base_elem:"#ball-click",
			rotate:true,
			rotate_duration:80,
			dest_icon_id:"#bl-icon-about",
			section:"#section-about",
			is_last_animation:false,
			is_sequential:true,
			dest_pos:"bottom",
			onStart:default_onStart,
			onStop:default_onStop,
		};
		var custom_arr = {
			dest_pos:false,
			src_pos:false,
			start_size:false,	
			stop_size:false,
			ret_back:true,
		};
		var ballarr1 = new data_holder(temp_arr,  null, custom_arr);
		ballarr1.stop_height = 65;
		ballarr1.stop_width = 65;
		//second ball animation
		temp_arr.total_duration = 0.75;
		temp_arr.dest_icon_id ="#moving-div";
		custom_arr.dest_pos = true;
		temp_arr.dest_left = -1 * (parseInt($("#emblem").offset().left, 10)+150);
		temp_arr.is_sequential = false;
		temp_arr.dest_top = 300;
		var ballarr2 = new data_holder(temp_arr,  ballarr1, custom_arr);
		//about animation
		temp_arr.moving_elem = "#bl-icon-about";
		temp_arr.base_elem ="#bl-icon-about";
		temp_arr.dest_left = 0;
		temp_arr.dest_top = -1 * (parseInt($("#bl-icon-about").offset().top, 10) + 120);
		temp_arr.total_duration= 0.75;
		temp_arr.dest_icon_id ="#bl-icon-about";
		var ballarr3 = new data_holder(temp_arr,  null, custom_arr);
		custom_arr.dest_pos = false;
		ballarr3.is_last_animation = true;

		/* UBUNTU */
		temp_arr.anim_id =2;
		temp_arr.moving_elem ="#moving-div";
		temp_arr.base_elem ="#ubuntu-click";
		temp_arr.total_duration= 1.0;
		temp_arr.dest_icon_id ="#bl-icon-contact";
		temp_arr.dest_icon_id ="#bl-icon-blog";
		temp_arr.dest_pos ="center";
		//temp_arr.dest_pos ="top";
		temp_arr.rotate_duration=30;
		temp_arr.section = "#section-blog";
		temp_arr.is_sequential = true;
		var ubuntuarr1 = new data_holder(temp_arr,  null, custom_arr);
		/*
		custom_arr.stop_size = true;
		temp_arr.stop_width = 124;
		temp_arr.stop_height = 114;
		var ubuntuarr1 = new data_holder(temp_arr,  null, custom_arr);
		temp_arr.dest_icon_id ="#bl-icon-about";
		temp_arr.total_duration= 0.8;
		//temp_arr.dest_pos ="left";
		custom_arr.ret_back = false;
		var ubuntuarr2 = new data_holder(temp_arr,  ubuntuarr1, custom_arr);
		temp_arr.total_duration= 0.7;
		//temp_arr.dest_pos ="right";
		temp_arr.dest_icon_id ="#bl-icon-works";
		var ubuntuarr3 = new data_holder(temp_arr,  ubuntuarr2, custom_arr);
		temp_arr.total_duration= 0.8;
		//temp_arr.dest_pos ="center";
		temp_arr.dest_icon_id ="#bl-icon-blog";
		custom_arr.stop_size = false;
		var ubuntuarr4 = new data_holder(temp_arr,  ubuntuarr3, custom_arr);
		ubuntuarr4.is_last_animation = true;
		*/
		ubuntuarr1.is_last_animation = true;

		/* HTML arr 1*/
		custom_arr.ret_back = true;
		temp_arr.anim_id=1;
		temp_arr.base_elem ="#html-click";
		temp_arr.dest_icon_id ="#bl-icon-works";
		temp_arr.total_duration = 0.7;
		temp_arr.section = "#section-works";
		temp_arr.dest_pos ="top";
		temp_arr.rotate_duration=100;
		var htmlarr0 = new data_holder(temp_arr,  null, custom_arr);
		var temp0 =  htmlarr0.dest_top;
		var temp1 =  htmlarr0.dest_left;
		htmlarr0.dest_top = htmlarr0.dest_top - 208;
		temp_arr.total_duration = 0.4;
		var htmlarr1 = new data_holder(temp_arr,  htmlarr0, custom_arr);
		htmlarr1.dest_top = temp0;
		htmlarr1.dest_left = temp1;
		htmlarr1.stop_width = htmlarr1.start_width;
		htmlarr1.stop_height = htmlarr1.start_height;
		/* HTML arr 2*/
		temp_arr.total_duration = 0.7;
		temp_arr.is_sequential = false;
		temp_arr.rotate=false;
		var htmlarr2 = new data_holder(temp_arr,  htmlarr1, custom_arr);
		htmlarr2.dest_top = htmlarr0.src_top;
		htmlarr2.dest_left = htmlarr0.src_left;
		htmlarr2.stop_width = htmlarr0.start_width;
		htmlarr2.stop_height = htmlarr0.start_height;

		temp_arr.rotate=false;
		temp_arr.moving_elem = "#bl-icon-works";
		temp_arr.base_elem ="#bl-icon-works";
		custom_arr.dest_pos = true;
		temp_arr.dest_left = 0;
		temp_arr.dest_top = 100;
		temp_arr.total_duration= 0.7;
		temp_arr.is_sequential = true;
		var htmlarr3 = new data_holder(temp_arr,  null, custom_arr);
		temp_arr.total_duration= 0.6;
		custom_arr.dest_pos = false;
		var htmlarr4 = new data_holder(temp_arr,  htmlarr3, custom_arr);
		temp_arr.total_duration= 0.5;
		custom_arr.dest_pos = true;
		temp_arr.dest_top = 40;
		var htmlarr5 = new data_holder(temp_arr,  htmlarr4, custom_arr);
		var htmlarr7 = new data_holder(temp_arr,  htmlarr4, custom_arr);
		htmlarr7.dest_top = 20;
		custom_arr.dest_pos = false;
		temp_arr.total_duration= 0.4;
		var htmlarr6 = new data_holder(temp_arr,  htmlarr5, custom_arr);
		var htmlarr8 = new data_holder(temp_arr,  htmlarr7, custom_arr);
		htmlarr8.is_last_animation = true;

		/*Gator 1 animation */
		temp_arr.anim_id=4;
		temp_arr.moving_elem ="#moving-div";
		temp_arr.rotate=false;
		temp_arr.dest_pos ="center";
		temp_arr.total_duration = 1;
		temp_arr.base_elem ="#gator-click";
		temp_arr.dest_icon_id ="#bl-icon-contact";
		temp_arr.section = "#section-contact";
		temp_arr.dest_pos ="top";
		custom_arr.stop_size = true;
		temp_arr.stop_width = 300;
		temp_arr.stop_height = 228;
		var gatorarr1 = new data_holder(temp_arr,  null, custom_arr);
		custom_arr.stop_size = false;
		var gatorarr2 = new data_holder(temp_arr,  gatorarr1, custom_arr);
		gatorarr1.is_last_animation = true;
		$("#moving-div").data('ball', [ballarr1, ballarr3, ballarr2]);
		$("#moving-div").data('html', [htmlarr0, htmlarr1, htmlarr2, htmlarr3, htmlarr4, htmlarr7, htmlarr8]);
		//$("#moving-div").data('html', [htmlarr0, htmlarr1, htmlarr2, htmlarr3, htmlarr4, htmlarr5, htmlarr6, htmlarr7, htmlarr8]);
		$("#moving-div").data('ubuntu', [ubuntuarr1]);
		//$("#moving-div").data('ubuntu', [ubuntuarr1, ubuntuarr2, ubuntuarr3, ubuntuarr4]);
		$("#moving-div").data('gator', [gatorarr1]);
	})();
	start_rotation.angle = 0;	
	function start_rotation(elem) {
		start_rotation.angle += 45;
		start_rotation.angle %= 360;
		$(elem).rotate(start_rotation.angle);
	}
	$('.anim-click').click(function (event) {
		var id = event.target.id;
		anim_click(id);
	});
	function anim_click(id) {
		if ($("#"+id).data('dest') == prev_section) {
			open_section(prev_section);
			return;
		}
		if (!anim_in_progress){
			//$('.anim-click').hide();
			change_emblem(id);
		}
	}
	function open_section (jqid) {
		var $el = $('#bl-main');
		var $section = $(jqid);
		if( !$section.data( 'open' ) ) {
			$section.data( 'open', true ).addClass( 'bl-expand bl-expand-top' );
			$el.addClass( 'bl-expand-item' );	
			var id = $section.attr('id');
			if (id == "section-about") {
				$('.bl-box').children('.bl-icon').css('left', '0px');
				$('.bl-box').children('.bl-icon').css('top', '0px');
				$(".rgraph-content").css('opacity', 1);
			}
			var cur_bg = $section.css('background-color');
			$section.css('background-color', '#000');
			$section.find(".content").css('background-color', cur_bg);
			$("#emblem").fadeOut();
			prev_section = jqid;
		}
	}
	function change_emblem(id) {
		anim_in_progress = true;
		$("#"+id).hide();
		var str = id.match(/^(.*)-click$/);
		var url = "url('images/emblem_wo_"+str[1]+".png')";
		var src = "images/"+str[1]+".png";
		/*
		$("#emblem").css("background", url);
		*/
		$("#moving-div").attr("src", src);
		var val = $("#moving-div").data(str[1]);
		do_tween(val, 0);
	}
	function do_tween (mainarr, index) {
		var arr = mainarr[index];
		var mainelem=arr.moving_elem;
		$(mainelem).tween({
			left:{
				start: arr.src_left,
				stop: arr.dest_left,
				time: 0,
				units: 'px',
				duration: arr.total_duration,
				effect:'easeInOut'
			},
			onStart: function(elem, state ){
				$(mainelem).rotate(0);
				$(mainelem).show();
				if (arr.rotate){
					asdasd=self.setInterval( function()
						{start_rotation(mainelem);}, arr.rotate_duration);
				}
				arr.onStartFunc();
			},
			onStop: function tempstop( elem, state ){
				var next_index = index + 1;
				$(mainelem).clear();
				if (arr.is_last_animation){
					if (arr.rotate){
							window.clearInterval(asdasd);
							$(mainelem).rotate(0);
					}
					arr.onStopFunc(mainarr[index].section);
				}else {
					if (arr.rotate && !mainarr[next_index].rotate){
							window.clearInterval(asdasd);
							$(mainelem).rotate(0);
					}
					if (!mainarr[index].is_sequential){
						return;
					}
					do_tween(mainarr, next_index);
					for (var jj = next_index; jj < (mainarr.length -1) ; jj++) {
						if (mainarr[jj].is_sequential) {
							return;
						}else {
							do_tween(mainarr, (jj+1));
						}
					}
				}
			},
			top:{
				start: arr.src_top,
				stop: arr.dest_top,
				time: 0,
				units: 'px',
				duration: arr.total_duration,
				effect:'easeInOut'
			},
			width:{
				start: arr.start_width,
				stop: arr.stop_width,
				time: 0,
				units: 'px',
				duration: arr.total_duration,
				effect:'easeInOut'
			},
			height:{
				start: arr.start_height,
				stop: arr.stop_height,
				time: 0,
				units: 'px',
				duration: arr.total_duration,
				effect:'easeInOut'
			}
		}).play();
	}

	//open_section("#section-blog");
}
