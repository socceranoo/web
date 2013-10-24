$(document).ready(function() {
	Boxlayout();
	contact();
	blog();
	reset_project = project_set();
	animations();
	$("#about-bl-content").scroll(scroll_content);
	//$("#about-bl-content").click(test);
	//test();
	/* PROJECT JS */
	//projset = new project_set();
	//projset.initEvents();
});

function project_set () {
	var proj_obj_arr = [];
	var cur_proj_id = -1;
	var cur_proj_name;
	var cur_proj = null;
	var add_project = function(sname, fname, numpics) {
		var id = proj_obj_arr.length;
		var temp = new project(id, sname, fname, numpics);
		proj_obj_arr.push(temp);
		if (id === 0) {
			//cur_proj_name = temp.setcontent1();
		}
	};
	var clicktoc = function (event) {
		cur_proj.clicktoc1(event); 
		//proj_obj_arr[cur_proj_id].clicktoc1(event); 
	};
	var changepic = function (option) {
		if (option == 1) {
			//proj_obj_arr[cur_proj_id].nextpic1(); 
			cur_proj.nextpic1(); 
		} else {
			cur_proj.prevpic1(); 
			//proj_obj_arr[cur_proj_id].prevpic1(); 
		}
	};

	var setcurprojtonull = function () {
		cur_proj.slideUpContainer();
		cur_proj.cur_pic = -1; 
		cur_proj = null;
	};
	var setproj = function(event) {
		var id = event.target.id;
		var match = id.match(/project(\d+)$/);
		var selected_id = parseInt(match[1], 10);
		var name = $("#"+id).attr('name');
		var thumbid = "#"+id;
		if (cur_proj != null) {
			if (cur_proj != proj_obj_arr[selected_id]) {
				cur_proj.removeFocus();
				cur_proj = proj_obj_arr[selected_id];
				cur_proj.changeContent();
				cur_proj.setFocus();
			}else {
				cur_proj.removeFocus();
				cur_proj.slideUpContainer();
				cur_proj = null;
			}
		}else {
			cur_proj = proj_obj_arr[selected_id];
			cur_proj.changeContent();
			cur_proj.slideDownContainer();
			cur_proj.setFocus();
		}

		/*
		for (var ii = 0; ii < proj_obj_arr.length ; ii++){
			var proj_name = proj_obj_arr[ii].project_name;
			if (name == proj_name) {
				$(".proj-thumb").addClass("opacity1");
				$(thumbid).removeClass("opacity1").addClass("transform200");
				$("#proj-thumb-nav").slideDown();
				//$("#proj-main").addClass('grad-bg');
				if (cur_proj_id != -1) 
					proj_obj_arr[cur_proj_id].cur_pic = 3; 
				cur_proj_id = ii;
				cur_proj_name = proj_obj_arr[cur_proj_id].setcontent1(); 
				//$("#project-icon-"+proj_name).parent('.thirdcontent').fadeIn("slow");	
			}else {
				//$("#project-icon-"+proj_name).parent('.thirdcontent').hide();
			}
		}
		*/
	};
	var initEvents = function() {
		$(".toc").click(function (event) {
			clicktoc(event);
		});
		$("#smr").click(function () {
			changepic(1);
		});
		$("#screen").click(function () {
			changepic(1);
		});
		$("#sml").click(function () {
			changepic(2);
		});
		$(".project-icon").click(function (event) {
			setproj(event);
		});
		$(".proj-thumb").click(function (event) {
			setproj(event);
		});
		add_project("mm", "Money Matters", 3);
		add_project("rz", "mp3raze", 3);
		add_project("gr", "Trump", 3);
		add_project("ae", "Alveo Energy", 3);
	};
	function project(id, sname, fname, numpics) {
		
		this.proj_id = id;
		this.project_fullname = fname;
		this.project_name = sname;
		this.cur_pic = -1;
		this.screenid = "#screen";
		this.no_of_pics = numpics;
		this.normalposition = "0px -91px";
		this.highlposition = "-34px -91px";
		this.circleid = "#project"+id;
		this.nextpic1  = function () {
			var prev = this.cur_pic;
			this.cur_pic++;
			this.cur_pic%=this.no_of_pics;
			this.setpic1(this.cur_pic, prev);
		};
		this.prevpic1 = function () {
			var prev = this.cur_pic;
			this.cur_pic+=this.no_of_pics;
			this.cur_pic--;
			this.cur_pic%=this.no_of_pics;
			this.setpic1(this.cur_pic, prev);
		};
		
		this.setpic1 = function (picno, prev) {
			this.cur_pic=picno;
			var url = "url('images/screens/"+this.project_name+picno+".jpg')";
			this.highlighttoc1(picno, prev);
			$(this.screenid).css("background-image", url);
			/*
			$(this.screenid).hide("slow", function () {
				alert(url);
				$(this.screenid).css("background-image", url);
				$(this.screenid).fadeIn("slow");
				alert($(this.screenid).css("background-image"));
			});
			*/
			/*
			$(this.screenid).css("background-image", url);
			$(this.screenid).fadeIn("slow");
			*/
		};
		
		this.highlighttoc1 = function (num, prev) {
			$("#toc"+prev).css("background-position", this.normalposition);
			$("#toc"+num).css("background-position", this.highlposition);
		};

		this.clicktoc1 = function (event) {
			var id = event.target.id;
			var str = id.match(/toc(\d+)$/);	
			this.setpic1(parseInt(str[1]), this.cur_pic);
		};
		
		this.setcontent1 = function () {
			document.getElementById("main").innerHTML=document.getElementById("proj-"+this.project_name).innerHTML;
			$(".toc").css("background-position", this.normalposition);
			this.nextpic1();
			return this.project_name;
		};
		
		this.changeContent = function () {
			this.setcontent1();
		};
		this.removeFocus = function () {
			$('.inactive').removeClass('opacity1');
			$(this.circleid).removeClass('transform200').addClass('inactive');
			this.cur_pic = -1;
		};
		this.setFocus = function () {
			$(this.circleid).removeClass('inactive').addClass('transform200');
			$('.inactive').addClass('opacity1');
		};
		
		this.slideUpContainer = function () {
			$("#proj-content").slideUp(1200);
		};
		this.slideDownContainer = function () {
			$("#proj-content").slideDown(1200);
		};
	}

	initEvents();
	return setcurprojtonull;
}
/*
function test () {
	var winheight = $(window).height();
	//var height = parseInt($('#about-content').offset().top);
	var height1 = parseInt($("#uiskills").offset().top);
	//var height1 = parseInt($("#uiskills").offset().top);
	//var height2 = parseInt($("#about-content").offset().top);
	//var height1 = parseInt($("#uiskills").outerHeight(true));
	var height2 = parseInt($("#languages").offset().top);
	var height3 = parseInt($("#strengths").offset().top);
	//alert(height+" "+height1+" "+height2);
	//alert(winheight+" "+height1+" "+height2+" "+height3);
}
*/

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
			$("#contact-form").hide();	
			$("#msgsent").show();
		}, "json");
	});

	function another_message() {
		$("#contact-form").show();	
		$("#msgsent").hide();
	}
	function reset_form() {
		document.getElementById("contact-name").value = "";
		document.getElementById("contact-email").value = "";
		$("#contact-message").val("");
	}
	var handlerIn = function (event) {
		//$(".name").fadeIn("slow");
		$(".actual-name").animate({width: 'toggle'});
	};

	var handlerOut = function (event) {
		$(".actual-name").animate({width: 'toggle'});
		//$(".name").fadeOut("slow");	
	};
	$("#msgsent").hide();
	$("#another-message").click(another_message);
	$("#logo a").mouseenter(handlerIn).mouseleave(handlerOut);
}
function blog() {
	function init_events() {
		$('.tag-entry').click(function (event) {
			var id = event.target.id;
			var name = $("#"+id).attr('name');
			$('.blog-entry').removeClass('display-none');
			//$('.blog-entry').fadeIn("800");
			get_tag_posts(name);
		});
		$('#reset-tags').click(function () {
			$('.blog-entry').removeClass('display-none');
		});
	}
	function get_tag_posts(tag) {
		$('.blog-entry').each( function() {
			var name=$(this).attr('name');
			if (name != tag) {
				//$(this).fadeOut("800");
				$(this).addClass('display-none');
			}
		});
	}
	return init_events();
}
var Boxlayout = function() {
	var $el = $( '#bl-main' );
	$sections = $el.children( 'section' );
	transEndEventNames = {
			'WebkitTransition' : 'webkitTransitionEnd',
			'MozTransition' : 'transitionend',
			'OTransition' : 'oTransitionEnd',
			'msTransition' : 'MSTransitionEnd',
			'transition' : 'transitionend'
	};
	// transition end event name
	transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ];
	// support css transitions
	supportTransitions = Modernizr.csstransitions;
	function init() {
		initEvents();
	}

	function initEvents() {
		$('#bl-main').children('section').each( function() {
			var $section = $(this);
			// expand the clicked section and scale down the others
			var $icon = $(this).children('.bl-box').children('.bl-icon');
				/*
			$icon.click(function() {
				if( !$section.data( 'open' ) ) {
					$section.data( 'open', true ).addClass( 'bl-expand bl-expand-top' );
					$el.addClass( 'bl-expand-item' );	
					var id = $section.attr('id');
					if (id == "section-about") {
						$(".rgraph-content").css('opacity', 1);
					}
					$("#emblem").fadeOut();
				}
			});
			*/
			$section.find( 'span.bl-icon-close' ).click(function() {
				var bg_color = $section.find(".content").css('background-color');
				$section.css('background-color', bg_color);
				// close the expanded section and scale up the others
				$section.data( 'open', false ).removeClass( 'bl-expand' ).bind( transEndEventName, function( event ) {
					if(!$(event.target).is('section'))
						return false;
					$(this).unbind( transEndEventName );
					$(this).removeClass( 'bl-expand-top' );
					var id = $(this).attr('id');
					if (id == "section-about") {
						$(".rgraph-content").css('opacity', 0);
					}
					$('.blog-entry').removeClass('display-none');
					$(".anim-click").show();
					$("#emblem").fadeIn();
					reset_project();
					//$("#proj-content").slideUp(800);
					$(".proj-thumb").removeClass("transform200 opacity1");
				} );
				if( !supportTransitions ) {
					$section.removeClass( 'bl-expand-top' );
				}
				$el.removeClass( 'bl-expand-item' );
				return false;

			} );
		} );
	}
	init();
};
function scroll_content(option) {
	if (typeof scroll_content.counter == "undefined") {
		scroll_content.counter = 0;
		scroll_content.sth= false;
		scroll_content.lang = false;
		scroll_content.ui = false;
		return;
	}
	var height = 0;
	var winheight = $(window).height();
	var canvasheight = parseInt($("#uiskills").outerHeight(true));
	var threshold = winheight - canvasheight;
	//canvasheight -= parseInt($("#uiskills").css('margin-bottom'));
	if (scroll_content.ui === false) {
		height = parseInt($("#uiskills").offset().top);
		if (height > 0 && height < threshold) {
			load_graphs(1);
			scroll_content.counter++;
			scroll_content.ui = true;
		}
	}
	if (scroll_content.lang === false) {
		height = parseInt($("#languages").offset().top);
		if (height > 0 && height < threshold) {
			load_graphs(2);
			scroll_content.counter++;
			scroll_content.lang = true;
		}
	}
	if (scroll_content.sth === false) {
		height = parseInt($("#strengths").offset().top);
		if (height > 0 && height < threshold) {
			load_graphs(3);
			scroll_content.counter++;
			scroll_content.sth = true;
		}
	}
	if (scroll_content.counter == 3) {
		//alert("LENGTH"+$("#about-bl-content").data('events').scroll.length)
		$("#about-bl-content").unbind('scroll');
	}
}
