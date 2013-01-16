var current_id="dummy";
var limiter_id="limiter";
var role_id="tagline";
var formspeed=900;
var textspeed=900;
var active_id="summary";
var form_id="form1";
var form2_id="form2";
var li_def_font_size="";
var li_big_font_size="1.4em";
var li_def_font_color="";
var li_big_font_color="#0A538D";
var state = false;
var uname, fullname, userid;
var temptext, pubpage;

function getUrlVars() {
	var map = {};
	var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
		map[key] = value;
	});
	return map;
}
function resumeinit() {
	var first = getUrlVars()["page"];
	if (first == "public")
		pubpage=true;
	uname=$("#uname").html();
	userid=$("#uid").html();
	fullname=$("#name").html();
	li_def_font_size=getid(active_id).style.fontSize;
	li_def_font_color=getid(active_id).style.color;
	loadCategory("", active_id);
}

function getid(id)
{
	return document.getElementById(id);
}

function hideElem(id)
{
	/*
	getid(id).style.display='none';
	*/
	getid(id).style.visibility='hidden';
	getid(id).style.opacity=0;
}

function showElem(id)
{
	/*
	getid(id).style.display='block';
	*/
	getid(id).style.visibility='visible';
	getid(id).style.opacity=1;
}

function setvaluejq(id, val)
{
	$("#"+id).html(val);
}

function sleep(milliseconds) 
{
	var start = new Date().getTime();
	for (var i = 0; i < 1e7; i++) 
	{
		if ((new Date().getTime() - start) > milliseconds)
		{
			break;
		}
	}
}

function loadCategory(event, direct_id)
{
	if (direct_id)
		id=direct_id;
	else
	{
		id = event.target.id;
		if (active_id == id)
			return;	
	}
	newid = id+"_c";
	if (state==true)
		loadForm();
	$("#"+current_id).slideUp(textspeed, "linear", function(){
		$('#'+current_id).html($("#"+newid).html());
		scrollToEndOfDiv(current_id);
	});
	$("#"+current_id).slideDown(textspeed, function(){});
	increasefont_changecolor(id);	
	active_id=id;
}

function increasefont_changecolor(new_id)
{
	$("#"+active_id).html($("#"+active_id).html().toLowerCase());
	getid(active_id).style.fontSize=li_def_font_size;
	getid(active_id).style.color=li_def_font_color;
	getid(active_id).style.fontWeight="normal";

	$("#"+new_id).html($("#"+new_id).html().toUpperCase());
	getid(new_id).style.fontSize=li_big_font_size;
	getid(new_id).style.color=li_big_font_color;
	getid(new_id).style.fontWeight="bold";
	//alert("Active ID ="+active_id+"New ID="+new_id);
}

function loadForm()
{
	var txtarea_id="txt1";
	if (state == true)
	{
		$("#"+form_id).slideUp(formspeed, "linear", function(){
			getid("txt1").value="";
			scrollToEndOfDiv(form_id);
			$('#'+current_id).html($("#"+active_id+"_c").html());
		});
		state = false;
	}
	else
	{
		var heading=$("#"+current_id).find('h3').html()
		scrollToEndOfDiv(form_id);
		$('#'+current_id).html(txt2tag(heading,"h3"));
			var htmltext=$("#"+active_id+"_c").find('abbr').html();
			htmltext=htmltext.replace(/<li>/g, '<li>•');
			htmltext=htmltext.replace(/<br>/g, "\r\n");
			getid(txtarea_id).value=jQuery(htmltext).text();
			$("#"+form_id).slideDown(formspeed, function(){
				//getid(txtarea_id).value=(htmltext);
			});
		state = true;
	}
}
function loadForm2(option)
{
	var input_id="txt2";
	if (option == true)
	{
		$("#"+role_id).show();
		$("#"+form2_id).fadeOut(formspeed, "linear", function(){
			getid("txt2").value="";
		});
	}
	else
	{
		$("#"+role_id).hide();
		$("#"+form2_id).fadeIn(formspeed, function(){
			var text=$("#"+role_id).html();
			getid(input_id).value=text;
			//getid(input_id).value=jQuery(text).text();
			getid(input_id).select();
		});
	}
}
function txt2tag(txt, tag)
{
	return "<"+tag+">"+txt+"</"+tag+">";
}
/*
Initialize the submit action of the form 
*/
function resumeajaxinit()
{
	$("#"+form_id).submit(function(event) {
		// prevent default posting of form
		event.preventDefault();
		var str = getid("txt1").value+"\n";
		if (str == "")
			return;
		var heading=$("#"+current_id).find('h3').html()
		var $form = $(this), $inputs = $form.find("input,textarea");
		$inputs.attr("disabled", "disabled");
		$.post("resumeform.php",{ uid: userid, txt: str, column:active_id },function(data){
			var val = data.returnValue;
			$("#"+form_id).slideUp(formspeed, "linear", function(){});
			state = false;
			$inputs.removeAttr("disabled");
			//alert(val);
			$('#'+current_id).html(txt2tag(heading,"h3")+val);
			$('#'+active_id+"_c").html(txt2tag(heading,"h3")+val);
			getid("txt1").value="";
			}, "json");
		});
	$("#"+form2_id).submit(function(event) {
		// prevent default posting of form
		event.preventDefault();
		var str = getid("txt2").value+"\n";
		if (str == "")
			return;
		var $form = $(this), $inputs = $form.find("input","input");
		$inputs.attr("disabled", "disabled");
		$.post("resumeform.php",{ uid:userid, txt: str, column:"tagline" },function(data){
			$("#"+role_id).show();	
			var val = data.returnValue;
			$("#"+form2_id).fadeOut(formspeed, "linear", function(){
			});
			$inputs.removeAttr("disabled");
			$('#'+role_id).html(val);
			getid("txt2").value="";
			}, "json");
		});
}

function scrollToEndOfDiv(div)
{
	var vl=$("#"+div).offset().top + $("#"+div).height();
	var vs= $(window).scrollTop();
	if (vl > vs){
		$("body").animate({scrollTop:vl},500);
	}
}
