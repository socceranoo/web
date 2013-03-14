var playcount = 0;
var playlistcount = 0;
var current = -1;
var current_playlist= "null";
var searchcount = 0;
var shuffle =false;
var repeat = 0;
var songarr = Array();
var username ="guest1";
var savestate = 0;
var wallpapercount = 14;
$(document).ready(function() {
	$("#sidebuttons").hide();
	$("#mainbuttons").hide();
	$("#listname").hide();
	$("#cancelsave").hide();
	$(".loading").hide();
	$(document).keyup(function(event) {
		if (event.keyCode == 32) {
			//playpause();
		}
	});
	$(document).keydown(function(event) {
		if (event.keyCode == 32) {
			playpause();
		}else if (event.keyCode == 37 || event.keyCode == 38) {
			prevsong();	
		}else if (event.keyCode == 39 || event.keyCode == 40) {
			nextsong();	
		}
	});
	$(window).unload(function () { 
		alert("Leave Really?");
	});
	$("#audio").submit(function(event) {
		// prevent default posting of form
		event.preventDefault();
		val = document.getElementById("audio").onreset();
		if (!val)
			return;
		$("#sideloading").show();
		document.getElementById("searchresults").innerHTML="";
		var $form = $(this), $inputs = $form.find("input,input, input");
		$inputs.attr("disabled", "disabled", "disabled");
		var name = document.getElementById("asearch").value;
		$.post("search.php",{ str: name },function(data){
			$("#sidebuttons").hide();
			document.getElementById("asearch").value = "";
			$inputs.removeAttr("disabled");
			for(i=0; i<data.length; i++) {
				var str = get_song_details_from_path(data[i]);
				//divstr = "<div class='clickable' id ='"+data[i]+"' onclick=\"add_to_playlist(event);\">"+str[1]+"-"+str[2]+"</div>";
				//divstr = "<div class='clickable' id ='s"+i+"' name ='"+data[i]+"'>"+str[1]+"-"+str[2]+"</div>";
				divstr = "<div class='clickable' id ='s"+i+"' name ='"+data[i]+"'><span>"+str+"</span></div>";
				document.getElementById("searchresults").innerHTML+=divstr;
				$("#searchresults").children('.clickable').click(original);
			}
			searchcount=data.length;
			$("#sidebuttons").show();
			$("#sideloading").hide();
			//$("#player").attr("src", data);
		}, "json");
	});
	getplaylists();
	register_player_events();
	song_search_field();
	playlist_field();
	$(".sidebar").child(".clickable").child('span').bind('click', span_click);
	//mouseover_clickable();
	//window.setInterval("changewallpaper()", 10000);
	//play_first_file();
});

var playpause = function () {
	var myaudio = document.getElementById("player");
		if (myaudio.paused) {
			myaudio.play();
			return;
		}else if(!myaudio.paused && myaudio.duration > 0){
			myaudio.pause();
			return;
		}
}
var span_click = function() {
	id = event.target.id;
	pid = $("#"+id).parent().attr('id');
	alert(pid);
}
function mouseover_clickable() {
	$(".sidebar").child('.clickable').mouseover(function () {
		id=event.target.id;
		alert(id);
		$("#"+id).css("opacity", 1);
	});
}
function song_search_field(){
	var text = "search your favorite songs ...";
	$("#asearch").attr('value', text);
		$("#asearch").focus(function () {
			if ($(this).attr("value") == text){
				$("#asearch").attr('value', "");
			}
		});
		$("#asearch").blur(function () {
			$(this).attr("value", text);
		});
}
function playlist_field(){
	var text = "enter playlist name...";
	$("#listname").attr('value', text);
	$("#listname").focus(function () {
		if ($(this).attr("value") == text){
			$("#listname").attr('value', "");
		}
	});
}
function changewallpaper () {
	val = get_random_number(wallpapercount)+1;
	url = "url('images/Music/"+val+".jpg')";
	$('#audiobody').fadeTo('slow', 0.4, function()
	{
		$("#audiobody").css("background-image", url); 
	}).fadeTo('slow', 1);
}
var bodyclick = function () {
	alert("click");
}
var rightclick = function () {
	event.preventDefault();
	alert("asdasd");
}
function register_player_events ()
{
	$("#player").bind('ended', autonextsong);
	$("#player").bind('error', errorsong);
	//$("#audiodiv").bind('contextmenu', rightclick);
	//$("#player").bind('invalid', errorsong);
}

var errorsong = function () {
	nextsong();
}

function  get_song_details_from_path(path) {
	var str = path.match(/.*\/(.*)\/(.*)$/);
	return (str[1]+"--"+str[2]);
}

var original = function () {
	id = event.target.id;
	add_to_playlist(id);
}

function add_to_playlist (id) {
	name = $("#"+id).attr('name');
	val=document.getElementById(id).innerHTML;
	add_song_div_to_playlist("p"+playcount, name, val);
	if (playcount == 1) {
		nextsong();
	}
}
function add_song_div_to_playlist (id, name, val) {
	divstr = "<div class='clickable' id ='"+id+"' name ='"+name+"' onclick=\"newfunc();\">"+val+"</div>";
	document.getElementById("playlist").innerHTML+=divstr;
	//$("#mainbuttons").show();
	songarr.push(id);
	playcount++;
	$("#mainbuttons").show();
}

var openplaylist = function () {
	id = event.target.id;
	name = $("#"+id).attr('name');
	if (current_playlist== name)
		return;
	$("#centerloading").show();
	$("#audiodiv").fadeOut('slow', function() {
		clearlist("playlist");
		$.post("getplaylists.php",{reason:"songs", playlist:name ,user: username},function(data){
			for(i=0; i<data.length; i++) {
				id = "p"+playcount;
				val = get_song_details_from_path(data[i]);
				val = "<span>"+val+"</span>";
				add_song_div_to_playlist(id, data[i], val);
			}
			$("#centerloading").hide();
			$("#audiodiv").fadeIn();
			current_playlist = name;
			nextsong();
		}, "json");
	});
}
var newfunc = function () {
	id = event.target.id;
	var str = id.match(/p(\d+)$/);
	playfile(id, parseInt(str[1]));
}

function playfile(id, val, first) {
	name = $("#"+id).attr('name');
	if (name == $("#player").attr("src") && id == "p"+current)
		return;
	$("#player").attr("src", name);
	document.getElementById("player").play();
	//$("#playlist").child('.clickable').css("opacity", 0.6);
	$("#p"+current).css("opacity", 0.6);
	current = val;
	$("#"+id).css("opacity", 1);
}

function add_all_songs_to_playlist() {
	for(i=0; i<searchcount; i++) {
		id = "s"+i;
		add_to_playlist(id);
	}
	//document.getElementById("playlist").innerHTML+=document.getElementById("searchresults").innerHTML;
	//$("#playlist").children('.clickable').unbind('click', original).click(newfunc);
}

function autonextsong() {
	if (repeat == 1) {
		audioElement = document.getElementById("player");
		audioElement.currentTime=0;
		audioElement.play();
		return;
	}
	nextsong();
}
var nextsong = function() {
	next = getnextsong("NEXT");
	id = "p"+next;
	playfile(id, next);
}

var prevsong = function() {
	prev = getnextsong("PREV");
	id = "p"+prev;
	playfile(id, prev);
}


function getnextsong(option) {
	if (shuffle) {
		next = get_random_number(playcount);
		if (next == current){
			next = current+1;
			next %=playcount;
		}
	}else {
		if (option == "NEXT") {
			next = current+1;
			next %=playcount;
		}else if (option == "PREV") {
			next = current + playcount - 1;
			next %=playcount;
		}
	}
	return next;
}

function get_random_number (limit){
	return Math.floor(Math.random()*limit);
}
function changeshuffle() {
	shuffle = (!shuffle);
	state = (shuffle)?"ON":"OFF";
	state = "shuffle "+state;
	document.getElementById("shuffle").innerHTML=state;
}
function changerepeat() {
	repeat = (repeat+1)%3;
	switch(repeat)
	{
		case 0:
			state="OFF";
			break;
		case 1:
			state="ONE";
		break;
		case 2:
			state="ALL";
		break;
		default:
			state="OFF";
	}
	state = "repeat "+state;
	document.getElementById("repeat").innerHTML=state;
}
function play_first_file() {
	name = $("#audiosubmit").attr('value');	
	id = "p"+playcount;
	val = get_song_details_from_path(name);
	val = "<span>"+val+"</span>";
	add_song_div_to_playlist(id, name, val);
	playfile(id, 0);
}

function clearlist(id) {
	/*
	$("#"+id).fadeOut('slow', function() {
		document.getElementById(id).innerHTML="";	
	});
	*/
	document.getElementById(id).innerHTML="";	
	if (id == "searchresults") {
		$("#sidebuttons").hide();
		searchcount = 0;
	} else {
		playcount = 0;
		current = -1;
		current_playlist = "null";
		$("#mainbuttons").hide();
	}
}
function cancelsave() {
	$("#listname").fadeOut('slow', function () {
		document.getElementById("saveplaylist").innerHTML="save playlist";
		document.getElementById("listname").value="enter playlist name...";
	});
	$("#cancelsave").fadeOut();
	savestate = 0;
}
function savelist () {
	if (savestate == 0) {
		$("#listname").fadeIn();
		$("#cancelsave").fadeIn();
		savestate = 1;
		document.getElementById("saveplaylist").innerHTML="submit";
	} else if (savestate == 1) {
		val =document.getElementById("listname").value;
		if (val == ""){
			return;
		}
		namearr = new Array();
		for(i=0; i<playcount; i++) {
			id = "p"+i;
			name = $("#"+id).attr('name');
			namearr.push(name);
		}
		listname =val;
		$.post("createplaylist.php",{ user: username, playlist:listname, songarr:namearr },function(data){
			cancelsave();
			if (data.retval == "true"){
				add_playlist_to_bar(data.listname);	
				current_playlist = data.listname;
			}else {
				alert(data.info);
			}
		}, "json");
	}
}

function getplaylists() {
	$.post("getplaylists.php",{reason:"playlist", playlist:"dummy",user: username},function(data){
		for(i=0; i<data.length; i++) {
			add_playlist_to_bar(data[i]);	
		}
	}, "json");
}


function add_playlist_to_bar(name) {
	divstr = "<div class='clickable' id ='pl"+playlistcount+"' name ='"+name+"' onclick=\"openplaylist();\"><span>"+name+"</span></div>";
	document.getElementById("playlistcontent").innerHTML+=divstr;
	playlistcount++;
}
