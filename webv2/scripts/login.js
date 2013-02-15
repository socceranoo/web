var xpos =0;
var lock = true;
var slider = false;
var curform = "login";
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

var formarr =new Array();
formarr[0]="login";
formarr[1]="register";
formarr[2]="resetreq";

$(document).ready(function() {
	//TestforChrome 
	var isChrome = testCSS('WebkitTransform');  // Chrome 1+
	if (!isChrome && false)
		setTimeout("window.location='notsupported.php'",1);
	logininit();
});

function testCSS(prop) {
	return prop in document.documentElement.style;
}
function logininit() {
	sliderJqueryinit();
	hideallforms();
	hideslider();
	hideElem("content");
	ajaxinit();
	//window.setInterval("movebackground()", 50);
	window.setInterval("mydate()", 1000);
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

function showhideform(formname, fromform) {
	if (formname === curform)
		return;
	$("#"+curform).hide(200, function() {
		$("#"+formname).fadeIn(200);
		curform = formname;
	});
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
			showElem("blackscreen");
		}else {
			showslider();
		}
	}
	else
		lockphone();
		
}
function lockphone(){
	hideallforms();
	hideslider();
	showElem("blackscreen");
	$("#slider").animate({ left: 0 });
	lock = true;
}

function unlockphone(){
	hideslider();
	hideElem("blackscreen");
	lock = false;
	showElem("login");
}
function showslider(){
	showElem("well");
	mydate();
	showElem("timearea");
	if (charging) {
		showElem("batterymeter");
		showElem("blackscreen");
	}else {
		hideElem("blackscreen");
	}
	slider = true;
}

function hideslider(){
	hideElem("well");
	hideElem("timearea");
	hideElem("batterymeter");
	slider = false;
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
				unlockphone();
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

function ajaxinit()
{
	$("#"+formarr[0]).submit(function(event) {
		// prevent default posting of form
		event.preventDefault();
		val = document.getElementById(formarr[0]).onreset();
		if (!val)
			return;
		var $form = $(this), $inputs = $form.find("input,input,input,input");
		$inputs.attr("disabled", "disabled", "disabled", "disabled");
		var uname = getid("lusername").value;
		var pwd = getid("lpassword").value;
		var hidden = getid("loginsubmit").value;
		$.post("processform.php",{ formname: formarr[0], loginsubmit:hidden, username:uname, password:pwd},function(data){
			process_ajax(formarr[0], data);
			$inputs.removeAttr("disabled");
			}, "json");
	});
	$("#"+formarr[1]).submit(function(event) {
		// prevent default posting of form
		event.preventDefault();
		val = document.getElementById(formarr[1]).onreset();
		if (!val) {
			return;
		}
		var $form = $(this), $inputs = $form.find("input","input","input","input","input","input","input");
		$inputs.attr("disabled", "disabled", "disabled", "disabled", "disabled", "disabled", "disabled");
		var uname = getid("rusername").value;
		var fname = getid("rname").value;
		var pwd = getid("rpassword_id").value;
		var mail = getid("remail").value;
		var hidden = getid("registersubmit").value;
		$.post("processform.php",{ formname:formarr[1], registersubmit:hidden, name:fname, username:uname, email:mail, password:pwd },function(data){
			process_ajax(formarr[1], data);
			$inputs.removeAttr("disabled");
			}, "json");
	});
	$("#"+formarr[2]).submit(function(event) {
		// prevent default posting of form
		event.preventDefault();
		val = document.getElementById(formarr[2]).onreset();
		if (!val) {
			return;
		}
		var $form = $(this), $inputs = $form.find("input","input","input");
		$inputs.attr("disabled", "disabled", "disabled");
		var mail = getid("email").value;
		var hidden = getid("resetreqsubmit").value;
		$.post("processform.php",{ formname:formarr[2], resetreqsubmit: hidden, email:mail },function(data){
			process_ajax(formarr[2], data);
			$inputs.removeAttr("disabled");
		}, "json");
	});
	$('#'+formarr[0]).find('input').click(function(event) {
		var elem = event.target.id;
		getid(elem).value = "";
	});
	$('#'+formarr[0]).find('input').keydown(function(event) {
		var elem = event.target.id;
	});
}

function process_ajax(formname, data){
	var retval= data.retval;
	var info= data.info;
	var url= data.url;
	var errormsg= data.errormsg;
	if (retval == "true") {
		hideElem(formname);
		$("#success").html(info+url);
		if (formname == "login")	
			setTimeout("window.location='"+url+"'",1);
	} else {
		$("#"+formname+"error").html(errormsg);
	}
}
