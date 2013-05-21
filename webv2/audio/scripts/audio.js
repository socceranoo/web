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
var wallpapercount = 5;
var myPlaylist;
$(document).ready(function() {
	$("#sidebuttons").hide();
	$("#mb-container").hide();
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
		$("#sidebuttons").hide();
		$("#sideloading").show();
		document.getElementById("searchresults").innerHTML="";
		var $form = $(this), $inputs = $form.find("input,input, input");
		$inputs.attr("disabled", "disabled", "disabled");
		var name = document.getElementById("asearch").value;
		$.post("include/search.php",{ str: name },function(data){
			$("#sidebuttons").hide();
			document.getElementById("asearch").value = "";
			$inputs.removeAttr("disabled");
			var count = 0;
			for(i=0; i<data.length; i++) {
				count++;
				var str = get_song_details_from_path(data[i]);
				divstr = "<div class='clickable' id ='s"+i+"' name ='"+data[i]+"'><span id=spans"+i+" name='"+data[i]+"'>"+str+"</span></div>";
				document.getElementById("searchresults").innerHTML+=divstr;
			}
			$("#searchresults").children('.clickable').find('span').click(original);
			searchcount=data.length;
			if (count)
				$("#sidebuttons").show();
			$("#sideloading").hide();
		}, "json");
	});
	getplaylists();
	song_search_field();
	init_jPlayer();
	$("#mb-container").click(cancelsave);
	$("#mainbuttons").click( function (event) { 
		return false;
	});
	testsearch();
});

var testsearch = function() {
	$.post("include/search.php",{ str: "rainbow" },function(data){
		return;
	}, "json");
}
var playpause = function () {
	var isPaused = $('#jquery_jplayer_1').data().jPlayer.status.paused;
	if (isPaused) {
		myPlaylist.play();
	}else {
		myPlaylist.pause();
	}
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
function changewallpaper () {
	return;
	/*
	val = get_random_number(wallpapercount)+1;
	url = "url('images/Music/"+val+".jpg')";
	$('#audiobody').fadeTo('slow', 0.4, function()
	{
		$("#audiobody").css("background-image", url); 
	}).fadeTo('slow', 1);
	*/
}
var bodyclick = function () {
	alert("click");
}
var rightclick = function () {
	event.preventDefault();
	alert("asdasd");
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
		myPlaylist.play(0);
	}
}
function add_song_div_to_playlist (id, name, val) {
	val = "<span id ='span"+id+"' name ='"+name+"'\">"+val+"</span>";
	divstr = "<div class='clickable' id ='"+id+"' name ='"+name+"'>"+val+"</div>";
	document.getElementById("playlist").innerHTML+=divstr;
	songarr.push(id);
	playcount++;
	add_song_to_jPlayer(val, name);
}

var openplaylist = function () {
	id = event.target.id;
	name = $("#"+id).attr('name');
	if (current_playlist== name)
		return;
	$("#centerloading").show();
	clearlist("playlist");
	$.post("include/getplaylists.php",{reason:"songs", playlist:name ,user: username},function(data){
		for(i=0; i<data.length; i++) {
			id = "p"+playcount;
			val = get_song_details_from_path(data[i]);
			add_song_div_to_playlist(id, data[i], val);
		}
		$("#centerloading").hide();
		//$("#audiodiv").fadeIn();
		$('#jp_playlist_1').slideDown();
		current_playlist = name;
		myPlaylist.select(0);
		myPlaylist.play();
	}, "json");
}

function add_all_songs_to_playlist() {
	for(i=0; i<searchcount; i++) {
		id = "spans"+i;
		add_to_playlist(id);
	}
}

function autonextsong() {
	/*
	*/
	nextsong();
}
var nextsong = function() {
	myPlaylist.next();
	myPlaylist.play();
}

var prevsong = function() {
	myPlaylist.previous();
	myPlaylist.play();
}


function get_random_number (limit){
	return Math.floor(Math.random()*limit);
}
function changerepeat() {
	/*
	*/
}
function play_first_file() {
	name = $("#audiosubmit").attr('value');	
	id = "p"+playcount;
	val = get_song_details_from_path(name);
	val = "<span>"+val+"</span>";
	add_song_div_to_playlist(id, name, val);
}

function clearlist(id) {
	document.getElementById(id).innerHTML="";	
	if (id == "searchresults") {
		$("#sidebuttons").hide();
		searchcount = 0;
	} else {
		playcount = 0;
		current = -1;
		current_playlist = "null";
		//$("#mainbuttons").hide();
		clear_jPlaylist();
	}

}
var cancelsave = function () {
	$("#mb-container").fadeOut('slow', function () {
		$("#container").css('opacity', 1);
	});
	savestate = 0;
}
function savelist () {
	var count = 0;
	$('#jp_playlist_1_ul li').each(function(i) {
		count++;
	});
	if (count == 0){
		alert("playlist name or playlist empty");
		return;
	}
	if (savestate == 0) {
		$("#container").css('opacity', 0.1);
		$("#mb-container").fadeIn('slow', function () {
		});
		savestate = 1;
	} else if (savestate == 1) {
		val =document.getElementById("listname").value;
		if (val == ""){
			alert("playlist name or playlist empty");
			return;
		}
		namearr = new Array();
		$('#jp_playlist_1_ul li').each(function(i) {
			var name=$(this).find('.jp-playlist-item').find('span').attr('name');
			namearr.push(name);
		});
		listname =val;
		$.post("include/createplaylist.php",{ user: username, playlist:listname, songarr:namearr },function(data){
			if (data.retval == "true"){
				add_playlist_to_bar(data.listname);	
				current_playlist = data.listname;
			}else {
				alert(data.info);
			}
			cancelsave();
		}, "json");
	}
}

function getplaylists() {
	$.post("include/getplaylists.php",{reason:"playlist", playlist:"dummy",user: username},function(data){
		for(i=0; i<data.length; i++) {
			add_playlist_to_bar(data[i]);	
		}
	}, "json");
}


function add_playlist_to_bar(name) {
	divstr = "<div class='clickable' id ='pl"+playlistcount+"' name ='"+name+"'><span id=spanpl"+playlistcount+" name ='"+name+"' onclick=\"openplaylist();\">"+name+"</span></div>";
	document.getElementById("playlistcontent").innerHTML+=divstr;
	playlistcount++;
}

function init_jPlayer () {
	myPlaylist = new jPlayerPlaylist({
		jPlayer: "#jquery_jplayer_1",
		cssSelectorAncestor: "#jp_container_1"
		}, [], {
			playlistOptions: {
				autoPlay: false,
				loopOnPrevious: false,
				shuffleOnLoop: true,
				enableRemoveControls: true,
				displayTime: 'slow',
				addTime: 'fast',
				removeTime: 'fast',
				shuffleTime: 'slow'
			},
		swfPath: "swf",
		supplied: "mp3",
		smoothPlayBar: true,
		keyEnabled: true,
		audioFullScreen: false // Allows the audio poster to go full screen via keyboard
	});
	$('.jp-full-screen').click( function () {
		var ht = $("#jp_playlist_1").children("ul").css('height');	
		var height = parseInt(ht.match(/(\d+)/));
		if (height > 0) {
			$('#jp_playlist_1').slideUp();
			return;
		}
		$('#jp_playlist_1').slideDown();
	});
	$('.jp-save-playlist').click( function () {
		savelist();	
	});
	$('.jp-clear-playlist').click( function () {
		clearlist("playlist");
	});
}

function clear_jPlaylist(){
	myPlaylist.setPlaylist([]);
	//$('.jp-save-playlist').unbind('click');
}

function add_song_to_jPlayer(val, name) {
	var match = val.match(/(.*)--(.*)/);
	myPlaylist.add({
		title:match[2]+ " from "+ match[1],
		//artist:match[1],
		mp3:name,
	});
}
