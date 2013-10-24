var socket, user;
var mainplayer;
var connection = false;
var large= new Array('640', '385');
var state ="pause";
var seeker =false;
var userid;
var userclick = false;
var	new_video = false;
var pause = false;
var	load_in_progress = false;
var	initiator = false;
var	first_add = true;
/*
var defaultsrc="http://www.youtube.com/embed/g3Xvn3AymxA";
var videoArr= new Array("kjO-XSgEwew", "7HKoqNJtMTQ", "AlBQFpSVU_s", "PQWwO0vGu44", "g3Xvn3AymxA", "vmPYsBbjl88");
var videoArr1= new Array();
var xlarge= new Array('1280', '800');
var normal= new Array('560', '340');
var small= new Array('480', '285');
var state="pause";
var next = false, prev= false;
*/
$(document).ready(function() {
	log('Welcome to the SyncTube');
	getid("msg").focus();
	//$("#join-modal").modal();
	test_start();
});

function test_start() {
	user="Anoop";
	createScript();
	test();
	$("#init-modal").data('toggle', "");
	var js_url = "javascript:void(0);";
	$("#init-modal").attr('href', js_url);
	$("#init-modal").html("");
	$("#join-modal").modal('hide');
}

function joinserver() {
	var msg = getid("input-name").value;
	if (msg == "")
		return;
	user=msg;
	createScript();
	test();
	$("#init-modal").data('toggle', "");
	$("#init-modal").attr('href', "javascript:void(0);");
	$("#init-modal").html("");
	$("#join-modal").modal('hide');
}
function sockinit (user) {
	var host = "ws://gatoraze.com:443/synctube/include/tubeserver.php"; // SET THIS TO YOUR SERVER
	try {
		log('Connecting to the server ...');
		socket = new WebSocket(host);
		socket.onopen    = function(msg) {
			log("Connected"); 
			user_msg = "USER:"+user;
			socket.send(user_msg); 
			connection = true;
		};
		socket.onmessage = function(msg) {
			process(msg.data);
		};
		socket.onclose   = function(msg) {
			connection = false;
			log("Disconnected"); 
			if (!mainplayer) {
				createScript();
			}
		};
	} catch(ex){ 
		log(ex); 
	}
}
function test() {
	var search_query = "mylo xyloto";
	ytEmbed.init({'block':'divsearch','type':'search','q':search_query,'results': 10,'layout':'thumbnails', 'order':'most_relevance'});
	return false;
}
function process(msg) {
	match = /USER:(.*)/i.exec(msg);
	if(match && match[1]) {
		add_to_userlist(usr_id, match[1]);
		log(msg);
		seeker = true;
		return;
	}
	match = /PLAY:(.*)/i.exec(msg);
	if(match && match[1]) {
		log(msg);
		videoPlay();
		return;
	}
	match = /SYNC:(.*)/i.exec(msg);
	if(match && match[1]) {
		log(msg);
		seek();
		return;
	}
	match = /ADD:(.*);SRC:(.*);TITLE:(.*)$/i.exec(msg);
	if(match && match[1] && match[2] && match[3]) {
		if (initiator === false) {
			load_in_progress = true;
			addVideo(match[1], match[3]);
		}
		log(msg);
		initiator = false;
		if (first_add){
			load_in_progress = true;
			first_add = false;
		}
		return;
	}
	match = /ADD_TO_PLAYLIST:(.*);SRC:(.*);TITLE:(.*)$/i.exec(msg);
	if(match && match[1] && match[2] && match[3]) {
		add_to_playlist(match[1], match[2], match[3]);
		log(msg);
		return;
	}
	match = /PAUSE:(.*)/i.exec(msg);
	if(match && match[1]) {
		log(msg);
		videoPause();
		return;
	}
	match = /USERLIST:(.*)/i.exec(msg);
	if(match && match[1]) {
		var obj = JSON.parse(match[1]);
		for (var i = 0; i < obj.length ; i++) {
			var usr_id = obj[i]['userid'];
			var username = obj[i]['username'];
			add_to_userlist(usr_id, username);
		}
		log(msg);
		return;
	}
	match = /USERID:(.*)/i.exec(msg);
	if(match && match[1]) {
		log(msg);
		userid=match[1];
		return;
	}
	match = /LIST:(.*)$/i.exec(msg);
	if(match && match[1]) {
		var obj = JSON.parse(match[1]);
		for (var i = 0; i < obj.length ; i++) {
			var videoid = obj[i]['videoId'];
			var imgsrc = obj[i]['imgsrc'];
			var title = obj[i]['title'];
			add_to_playlist(videoid, imgsrc, title);
		}
		log(msg);
		return;
	}
	match = /SEEK:(.*)/i.exec(msg);
	if(match && match[1]) {
		log(msg);
		if (!seeker) {
			pause = false;
			time = parseInt(match[1], 10);
			mainplayer.seekTo(time);
		}
		seeker = false;
		return;
	}
	log(msg);
}

function add_to_userlist(usr_id, username) {
	var userlist_ul = document.getElementById("userlist");
	var ul_li = document.createElement('li');
	if (usr_id != userid) {
		ul_li.innerHTML=username+"&nbsp;"+usr_id;	
	}else {
		ul_li.innerHTML=username+"(you)&nbsp;"+usr_id;	
	}
	userlist_ul.appendChild(ul_li);
}
function add_to_playlist(vidid, imgsrc, title) {
	var playlist_ul = document.getElementById("playlist-ul");
	var pl_li = document.createElement('li');			
	pl_li.className = 'playlist-link';
	pl_li.setAttribute('data-id', vidid);
	pl_li.setAttribute('data-title', title);
	pl_li.setAttribute('title', title);
	var img2 = document.createElement('img');
	img2.className = 'img-polaroid video-thumbnail2';
	img2.setAttribute('src', imgsrc);
	img2.setAttribute('title', title);
	pl_li.appendChild(img2);
	playlist_ul.appendChild(pl_li);
	pl_li.addEventListener('click', function(event) { 
		userclick = true;
		setVideo(vidid, imgsrc, title);
	},false);
}
function send_add_playlist(vidid, imgsrc, title) {
	if (connection) {
		var msg="ADD_TO_PLAYLIST:"+vidid+";SRC:"+imgsrc+";TITLE:"+title;
		socket.send(msg);
	}
	else {
		add_to_playlist(vidid, imgsrc, title);
	}
}
function send(){
	var txt,msg;
	txt = getid("msg");
	msg = txt.value;
	if(!msg) { 
		//alert("Message can not be empty"); 
		return; 
	}
	txt.value="";
	txt.focus();
	try { 
		socket.send(msg); 
		log('You : '+msg); 
	} catch(ex) { 
		log(ex); 
	}
}

// Utilities
function getid(id){ return document.getElementById(id); }
function log(msg)
{
	var txtareaelem = getid("chat");
	txtareaelem.value += msg;
	txtareaelem.value += "\n";
	txtareaelem.scrollTop = txtareaelem.scrollHeight;
}
function onkey(event, option) {
	if(event.keyCode==13) {
		if (option === 0)
			send();
		else
			joinserver();
	}
}

function onPlayerError(errorCode) {
	alert("An error occured of type:" + errorCode);
}
function createScript() {
	var tag = document.createElement('script');
	tag.src = "//www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
}
// 3. This function creates an <iframe> (and YouTube player)
//    after the API code downloads.
function onYouTubeIframeAPIReady() {
	mainplayer = new YT.Player('player', {
		height: '450',
		width: '640',
		videoId: 'u1zgFlCw8Aw',
		playerVars: {
			controls: '0'
		},
		events: {
			'onReady': onPlayerReady,
			'onStateChange': onPlayerStateChange,
			'onError': onPlayerError
		}
	});
}

// 4. The API will call this function when the video player is ready.
function onPlayerReady(event) {
	sockinit(user);
}

// 5. The API calls this function when the player's state changes.
//    The function indicates that when playing a video (state=1),
//    the player should play for six seconds and then stop.
function onPlayerStateChange(event) {
	log("DATA"+event.data);
	if (new_video && (event.data == 1 || event.data== 5)) {
		if (!userclick && load_in_progress === false) {
			initiator = true;
			var vid_id = youtubeIdFromUrl(mainplayer.getVideoUrl())
			var url = "https://gdata.youtube.com/feeds/api/videos/"+vid_id+"?v=2";
			var doc = httpGet(url);
			var title = $(doc).find("title").text();
			var imgsrc = "http://img.youtube.com/vi/"+vid_id+"/0.jpg";
			if (connection)
				setVideo(vid_id, imgsrc, title);
			$("#now-playing").html(title);
		}
		new_video = false;
		userclick = false;
		load_in_progress = false;
	}
	if (event.data== -1) {
		new_video = true;
	}
	if (event.data == 2 && pause) {
		if (connection)
			seek();
		pause = false;
		return;
	}
	if (event.data == 2) {
		pause = true;
	}
	if (event.data != 2) {
		pause = false;
	}
	if (connection) {
		if (event.data == 1 && state == "pause") {
			socket.send("PLAY:DONE");
		} else if (event.data== 2 && state == "play") {
			socket.send("PAUSE:DONE");
		}
	}
	/*	
	else if (event.data== 5) 
		//alert("CUE");
	else if (event.data== 0) 
		//alert("started");
	else if (event.data== 4) 
		//alert("stoped");
	*/
}

function httpGet(theUrl)
{
	var xmlHttp = null;
	xmlHttp = new XMLHttpRequest();
	xmlHttp.open( "GET", theUrl, false );
	xmlHttp.send( null );
	return xmlHttp.responseText;
}
function seek()
{
	if (connection) {
		log("SEEKER IN PROGRESS");
		seeker = true;
		time = mainplayer.getCurrentTime();
		socket.send("SEEK:"+time);
	}
}

function setVideo(vidid, src, title) {
	if (connection) {
		var msg="ADD:"+vidid+";SRC:"+src+";TITLE:"+title;
		socket.send(msg);
	}
	else {
		addVideo(vidid, title);
	}
}
function stopVideo() {
	if (mainplayer) {
		mainplayer.stopVideo();
	}
}

function addVideo(vidid, title) {
	mainplayer.cueVideoById(vidid);
	mainplayer.playVideo();
	$("#now-playing").html(title);
}
function videoPlay(pos) {
	mainplayer.playVideo();
	state="play";
}
function videoPause() {
	mainplayer.pauseVideo();
	state="pause";
}
function youtubeIdFromUrl(url)
{
	var video_id = url.split('v=');
	var ampersandPosition = video_id[1].indexOf('&');
	val = video_id[1];
	if(ampersandPosition != -1) {
		video_id = video_id[1].split('&');
		val = video_id[0];
	}
	return val;
}
/*
function smallPlayer() {
	resizePlayer(small[0], small[1]);
	getid('main').style.width=small[0];
}

function normalPlayer() {
	resizePlayer(normal[0], normal[1]);
	getid('main').style.width=normal[0];
}

function largePlayer() {
	resizePlayer(large[0], large[1]);
	getid('main').style.width=large[0];
}
function resizePlayer(width, height) {
	mainplayer.setSize(parseInt(width), parseInt(height));
}
function updatePlayerInfo() {
	if(mainplayer && mainplayer.getDuration) {
		updateHTML("videoDuration", mainplayer.getDuration());
		updateHTML("videoCurrentTime", mainplayer.getCurrentTime());
		updateHTML("bytesTotal", mainplayer.getVideoBytesTotal());
		updateHTML("startBytes", mainplayer.getVideoStartBytes());
		updateHTML("bytesLoaded", mainplayer.getVideoBytesLoaded());
		updateHTML("volume", mainplayer.getVolume());
	}
}
*/
