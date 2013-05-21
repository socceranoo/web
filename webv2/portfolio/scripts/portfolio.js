var projarr = Array("rz", "gr", "mm");
var curpic = -1;
var no_of_pics = 3;
var curproj = 0;
var screenid = "#screen";
var normalposition = "0px -91px";
var highlposition = "-34px -91px";
$(document).ready(function() {
	if ($("#bl-main").length) {
		Boxlayout();
	}
	/* CONTACT JS */
	if ($("#contact-form").length) {
		$("#msgsent").hide();
		contactajax();
	}
	/* PROJECT JS */
	nextpic();
	setcontent(curproj);
	$(".toc").click(clicktoc);
	$("#smr").click(nextpic);
	$("#sml").click(prevpic);
	$("#leftarrow").click(prevproj);
	$("#rightarrow").click(nextproj);
	$("#logo a").mouseenter(handlerIn).mouseleave(handlerOut);
});

var handlerIn = function (event) {
	//$(".name").fadeIn("slow");
	$(".actual-name").animate({width: 'toggle'});
};

var handlerOut = function (event) {
	$(".actual-name").animate({width: 'toggle'});
	//$(".name").fadeOut("slow");	
};
var clicktoc = function (event) {
	id = event.target.id;
    var str = id.match(/toc(\d+)$/);	
	setpic(str[1], curpic);
};
var nextpic = function () {
	prev = curpic;
	curpic++;
	curpic%=no_of_pics;
	setpic(curpic, prev);
	var mydiv=document.getElementById("work-content");
	mydiv.scrollTop=0;
};
var prevpic = function() {
	prev = curpic;
	curpic+=no_of_pics;
	curpic--;
	curpic%=no_of_pics;
	setpic(curpic, prev);
};
var setpic = function (picno, prev) {
	var url = "url('images/screens/"+projarr[curproj]+picno+".png')";
	$(screenid).css("background-image", url);
	curpic=picno;
	highlighttoc(picno, prev);
};

var highlighttoc = function (num, prev) {
	$("#toc"+prev).css("background-position", normalposition);
	$("#toc"+num).css("background-position", highlposition);
};

var nextproj =function () {
	curpic = -1;
	curproj++;
	curproj%=projarr.length;
	setcontent(curproj);
	$(".toc").css("background-position", normalposition);
	nextpic();
	window.scrollTo(0, 0);
};
var prevproj =function () {
	curpic = -1;
	curproj+=projarr.length;
	curproj--;
	curproj%=projarr.length;
	setcontent(curproj);
	$(".toc").css("background-position", normalposition);
	nextpic();
	window.scrollTo(0, 0);
};

var setcontent = function (num) {
	var text =document.getElementById("proj"+num).innerHTML;
	document.getElementById("main").innerHTML=document.getElementById("proj"+num).innerHTML;
};

function contactajax() {
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
}

function another_message() {
	$("#contact-form").show();	
	$("#msgsent").hide();
}
function reset_form() {
		document.getElementById("contact-name").value = "";
		document.getElementById("contact-email").value = "";
		$("#contact-message").val("");

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
			$icon.click(function() {
				if( !$section.data( 'open' ) ) {
					$section.data( 'open', true ).addClass( 'bl-expand bl-expand-top' );
					$el.addClass( 'bl-expand-item' );	
				}
			});
			$section.find( 'span.bl-icon-close' ).click(function() {
				// close the expanded section and scale up the others
				$section.data( 'open', false ).removeClass( 'bl-expand' ).bind( transEndEventName, function( event ) {
					if(!$(event.target).is('section'))
						return false;
					$(this).unbind( transEndEventName );
					$(this).removeClass( 'bl-expand-top' );
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
