var playcount = 0;
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
	$(document).keyup(function(event) {
		if (event.keyCode == 32) {
			//playpause();
		}
	});
	var t=setTimeout(function(){
		$("#mainheading").css('visibility', 'hidden');	
	}, 10000);

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
		$(".loading").show();
		document.getElementById("searchresults").innerHTML="";
		var $form = $(this), $inputs = $form.find("input,input, input");
		$inputs.attr("disabled", "disabled", "disabled");
		var name = document.getElementById("asearch").value;
		$.post("include/search.php",{ str: name },function(data){
			document.getElementById("asearch").value = "";
			$inputs.removeAttr("disabled");
			var count = 0;
			for(i=0; i<data.length; i++) {
				count++;
				var str = get_song_details_from_path(data[i]);
				divstr = "<p class='song-holder'>"+str+"<a href='javascript:void(0);' id=spans"+i+" data-val='"+str+"' data-name='"+data[i]+"' class='song-click pull-right icon-glyph icon-plus'></a></p>";
				document.getElementById("searchresults").innerHTML+=divstr;
			}
			$(".loading").hide();
			$(".searchword").html("\""+name+"\"");
			searchcount=count;
			$('.song-click').click(function() { 
				var id= $(this).attr('id');
				add_to_playlist(id);
			});
			$("#manageresults").modal();
			$("#search-modal-link").show();
			if (count) {
			}else {
				document.getElementById("searchresults").innerHTML+="<p>No Results found</p>";
			}
		}, "json");
	});
	$('.playlist-link').on('click', function (event) {
		var name = $(this).data('name');
		openplaylist(name);
	});
	init_jPlayer();
	testsearch();
});
function play_first_file() {
	var name = $("#audiosubmit").attr('value');	
	var id = "p"+playcount;
	var val = "ColdPlay--Hurts like heaven";
	val = "<span>"+val+"</span>";
	add_song_div_to_playlist(id, name, val);
	//myPlaylist.play();
}
function testsearch () {
	play_first_file();
	$.post("include/search.php",{ str: "rainbow" },function(data){
		return;
	}, "json");
};
function playpause() {
	var isPaused = $('#jquery_jplayer_1').data().jPlayer.status.paused;
	if (isPaused) {
		myPlaylist.play();
	}else {
		myPlaylist.pause();
	}
}
/*
var bodyclick = function () {
	alert("click");
}
var rightclick = function () {
	event.preventDefault();
}
*/

function get_song_details_from_path(path) {
	var str = path.match(/.*\/(.*)\/(.*)$/);
	return (str[1]+"--"+str[2]);
}
function add_playlist_to_bar(playlist_name) {
	var divstr = "<li><a href='javascript:void(0);' class='playlist-link btn btn-info' data-name='"+playlist_name+"'>"+playlist_name+"</a></li>";
	document.getElementById("playlistcontent").innerHTML+=divstr;
	$('.playlist-link').on('click', function (event) {
		var name = $(this).data('name');
		openplaylist(name);
	});
}
function add_to_playlist (id) {
	name = $("#"+id).data('name');
	val = $("#"+id).data('val');
	add_song_div_to_playlist("p"+playcount, name, val);
	$("#"+id).data('added', true);
	$("#"+id).parent('.song-holder').hide();
	searchcount--;
	if (searchcount == 0) {
		$("#manageresults").modal('hide');
	}
	if (playcount == 1) {
		myPlaylist.play(0);
	}
}
function add_song_div_to_playlist (id, name, val) {
	songarr.push(id);
	playcount++;
	add_song_to_jPlayer(val, name);
}

var openplaylist = function (name) {
	if (current_playlist== name)
		return;
	$(".loading").show();
	clearlist("playlist");
	$.post("include/getplaylists.php",{reason:"songs", playlist:name ,user: username},function(data){
		for(i=0; i<data.length; i++) {
			id = "p"+playcount;
			val = get_song_details_from_path(data[i]);
			add_song_div_to_playlist(id, data[i], val);
		}
		$(".loading").hide();
		//$("#audiodiv").fadeIn();
		$('#jp_playlist_1').slideDown();
		current_playlist = name;
		myPlaylist.select(0);
		myPlaylist.play();
	}, "json");
}

function add_all_songs_to_playlist() {
	var count = searchcount;
	for(i=0; i<count; i++) {
		id = "spans"+i;
		if (! $("#"+id).data('added')){
			add_to_playlist(id);
		}
	}
	$("#search-modal-link").hide();
	$("#manageresults").modal('hide');
}

function nextsong() {
	myPlaylist.next();
	myPlaylist.play();
}

function prevsong() {
	myPlaylist.previous();
	myPlaylist.play();
}

function get_random_number (limit){
	return Math.floor(Math.random()*limit);
}

function clearlist(id) {
	if (id == "searchresults") {
		searchcount = 0;
		document.getElementById(id).innerHTML="";	
		$("#manageresults").modal('hide');
		$("#search-modal-link").hide();
	} else {
		playcount = 0;
		current = -1;
		current_playlist = "null";
		clear_jPlaylist();
	}

}
var cancelsave = function () {
	$("#saveplaylistmodal").modal('hide');
	savestate = 0;
}
function savelist () {
	document.getElementById("listname").value="";
	$("#modal-playlist-msg").html("");
	$("#saveplaylistmodal").modal();
	var count = 0;
	$('#jp_playlist_1_ul li').each(function(i) {
		count++;
	});
	if (count == 0){
		$("#modal-playlist-msg").html("Playlist is empty");
		return;
	}
	$("#modal-success").show();
}
function submit_playlist() {
	var val =document.getElementById("listname").value;
	if (val == ""){
		$("#modal-success").hide();
		$("#modal-playlist-msg").html("Playlist name is empty");
		return;
	}
	namearr = new Array();
	$('#jp_playlist_1_ul li').each(function(i) {
		var name=$(this).find('.jp-free-media').find('.jp-playlist-item-free').attr('href');
		namearr.push(name);
	});
	listname =val;
	$.post("include/createplaylist.php",{ user: username, playlist:listname, songarr:namearr },function(data){
		$("#modal-success").hide();
		if (data.retval == "true"){
			add_playlist_to_bar(data.listname);	
			current_playlist = data.listname;
			$("#modal-playlist-msg").html("Playlist has been added");
			document.getElementById("listname").value="";
		}else {
			$("#modal-playlist-msg").html(data.info);
		}
		//cancelsave();
	}, "json");
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
		free: true,
	});
}
