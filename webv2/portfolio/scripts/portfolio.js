var projarr = Array("rz", "mm", "rb");
var curpic = -1;
var no_of_pics = 3;
var curproj = 0;
var screenid = "#screen";
var normalposition = "0px -91px";
var highlposition = "-34px -91px";
$(document).ready(function() {
	/* CONTACT JS */
	if ($("#contact-form").length) {
		contactajax();
		return;
	}
	/* PROJECT JS */
	nextpic();
	setcontent(curproj);
	$(".toc").click(clicktoc);
	$("#smr").click(nextpic);
	$("#sml").click(prevpic);
	$("#leftarrow").click(prevproj);
	$("#rightarrow").click(nextproj);
});

var clicktoc = function (event) {
	id = event.target.id;
    var str = id.match(/toc(\d+)$/);	
	setpic(str[1], curpic);
}
var nextpic = function () {
	prev = curpic;
	curpic++;
	curpic%=no_of_pics;
	setpic(curpic, prev);
}
var prevpic = function() {
	prev = curpic;
	curpic+=no_of_pics;
	curpic--;
	curpic%=no_of_pics;
	setpic(curpic, prev);
}
var setpic = function (picno, prev) {
	var url = "url('images/screens/"+projarr[curproj]+picno+".png')";
	$(screenid).css("background-image", url);
	curpic=picno;
	highlighttoc(picno, prev);
}

var highlighttoc = function (num, prev) {
	$("#toc"+prev).css("background-position", normalposition);
	$("#toc"+num).css("background-position", highlposition);
}

var nextproj =function () {
	curpic = -1;
	curproj++;
	curproj%=projarr.length;
	setcontent(curproj);
	$(".toc").css("background-position", normalposition);
	nextpic();
}
var prevproj =function () {
	curpic = -1;
	curproj+=projarr.length;
	curproj--;
	curproj%=projarr.length;
	setcontent(curproj);
	$(".toc").css("background-position", normalposition);
	nextpic();
}

var setcontent = function (num) {
	var text =document.getElementById("proj"+num).innerHTML;
	document.getElementById("main").innerHTML=document.getElementById("proj"+num).innerHTML;
}

function contactajax() {
	$("#contact-form").submit(function(event) {
		alert("e");
		// prevent default posting of form
		event.preventDefault();
		val = document.getElementById("contact-form").onreset();
		alert("e");
		if (!val) {
			alert("here");
			return;
		}
		alert("1");
		var $form = $(this), $inputs = $form.find("input,input,input");
		$inputs.attr("disabled", "disabled", "disabled");
		var name = getid("name").value;
		var email = getid("email").value;
		var message = getid("message").value;
		alert("2");
		$.post("sendmail.php",{ formname: "contact-form", name:name, email:email, message:message},function(data){
			$inputs.removeAttr("disabled");
			alert("3");
			}, "json");
	});
}
