var xpos =0;
var lock = true;
var slider = false;
//var charging = false;
var charging = true;
var weekday=new Array(7);
weekday[0]="Sunday";
weekday[1]="Monday";
weekday[2]="Tuesday";
weekday[3]="Wednesday";
weekday[4]="Thursday";
weekday[5]="Friday";
weekday[6]="Saturday";
var month=new Array();
month[0]="January";
month[1]="February";
month[2]="March";
month[3]="April";
month[4]="May";
month[5]="June";
month[6]="July";
month[7]="August";
month[8]="September";
month[9]="October";
month[10]="November";
month[11]="December";


$(document).ready(function() {
	//TestforChrome 
	var isChrome = testCSS('WebkitTransform');  // Chrome 1+
	if (!isChrome && false)
		setTimeout("window.location='notsupported.php'",1);
});

function testCSS(prop) {
	return prop in document.documentElement.style;
}
function logininit() {
	sliderJqueryinit();
	hideallforms();
	hideslider();
	hideElem("content");
	//window.setInterval("movebackground()", 50);
	window.setInterval("mydate()", 5000);
}
function getid(id){
	return document.getElementById(id);
}
function hideElem(id) {
	$("#"+id).hide();
}
function showElem(id) {
	$("#"+id).show();
}

function showhideform(formname) {
	hideallforms();
	showElem(formname);
	//$("#"+formname).show("slide", {direction:"right"}, 1000);
	lock = false;
}
function hideallforms() {
	hideElem("login");
	hideElem("register");
	hideElem("resetreq");
}
function movebackground() {
	xpos-=1;
	getid("loginbody").style.backgroundPosition =xpos+"px";
}

function homebutton(){
	if (lock == true){
		showslider();
	}
	else {
		showhideform("login");
	}
}
function lockbutton(){
	if (lock == true)
	{
		if (slider) {
			hideslider();
		}else {
			showslider();
		}
	}
	else
		lockphone();
		
}
function lockphone(){
	hideallforms();
	$("#slider").animate({ left: 0 });
	hideslider();
	lock = true;
}

function unlockphone(){
	showhideform("login");
	lock = false;
	hideElem("blackscreen");
}
function showslider(){
	showElem("well");
	slider = true;
	mydate();
	showElem("timearea");
	if (charging) {
		showElem("batterymeter");
		showElem("blackscreen");
	}else {
		hideElem("blackscreen");
	}
}

function hideslider(){
	hideElem("well");
	slider = false;
	hideElem("timearea");
	hideElem("batterymeter");
	showElem("blackscreen");
}

function mydate(){
	var d=new Date();
	var day = weekday[d.getDay()];
	var mon = month[d.getMonth()];
	var date = d.getDate();
	var min = d.getMinutes();
	if (min <10)
		min = "0"+min;
	var hr = d.getHours();
	var sec = d.getSeconds();
	if (sec <10)
		sec = "0"+sec;
	var ret = day+", "+mon+" "+date;
	$("#date").text(ret);
	$("#timer").text(hr+":"+min);
	//$("#timer").text(hr+":"+min+":"+sec);
	return;
}

function sliderJqueryinit() {
	$(function() {
		$("#slider").draggable({
			axis: 'x',
			containment: 'parent',
			drag: function(event, ui) {
				if (ui.position.left > 190) {
					$("#well").fadeOut();
					hideslider();
					unlockphone();
				} else {
					// Apparently Safari isn't allowing partial opacity on text with background clip? Not sure.
					// $("h2 span").css("opacity", 100 - (ui.position.left / 5))
				}
			},
			stop: function(event, ui) {
				if (ui.position.left < 191) {
					$(this).animate({
						left: 0
					})
				}
			}
		});
		
		// The following credit: http://www.evanblack.com/blog/touch-slide-to-unlock/
		
		$('#slider')[0].addEventListener('touchmove', function(event) {
			event.preventDefault();
			var el = event.target;
			var touch = event.touches[0];
			curX = touch.pageX - this.offsetLeft - 30;
			if(curX <= 0)
				return;
			if(curX > 190){
				$('#well').fadeOut();
			}
			el.style.webkitTransform = 'translateX(' + curX + 'px)'; 
		}, false);
		
		$('#slider')[0].addEventListener('touchend', function(event) {	
			this.style.webkitTransition = '-webkit-transform 0.3s ease-in';
			this.addEventListener( 'webkitTransitionEnd', function( event ) { this.style.webkitTransition = 'none'; }, false );
			this.style.webkitTransform = 'translateX(0px)';
		}, false);

	});
}

