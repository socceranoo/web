var socket, txtareaelem, user;
var defaultsrc="http://www.youtube.com/embed/g3Xvn3AymxA";
var videoArr= new Array("kjO-XSgEwew", "7HKoqNJtMTQ", "AlBQFpSVU_s", "PQWwO0vGu44", "g3Xvn3AymxA", "vmPYsBbjl88");
var videoArr1= new Array();
var player;
var done = false;
var connection = false;
var xlarge= new Array('1280', '800');
var large= new Array('640', '385');
var normal= new Array('560', '340');
var small= new Array('480', '285');
var state="pause";
var next = false, prev= false;
///*
function init() 
{
	hideElem("noserver");
	hideElem("default");
	var host = "ws://gatoraze.tk:9002/RegForm/tubeserver.php"; // SET THIS TO YOUR SERVER
	try {
		txtareaelem = getid("chat");
		user=document.refreshForm.uname.value;
		
		log('Welcome to the SyncTube');
		log('Connecting to the server ...');
		socket = new WebSocket(host);

		socket.onopen    = function(msg) { 
			createScript();
			log("Connected"); 
			connection = true;
			//var user_msg = "USER:"+user;
			//socket.send(user_msg); 
		};
		socket.onmessage = function(msg) {
			process(msg.data)
		};
		socket.onclose   = function(msg) { 
			connection = false;
			showElem("noserver");
			log("Disconnected"); 
			if (!player) {
				//createScript();
				hideDiv("total");
			}
		};

	}
	catch(ex){ 
		log(ex); 
	}
	getid("msg").focus();
}

function process(msg)
{
	var match = /VIDEO:(.*)/i.exec(msg);
	if(match && match[1])
	{
		if (player) {
			if (match[1] == "START")
			{
				player.cuePlaylist(videoArr1);
				player.setLoop(true);
				videoPlay(2);
			}
			else if (match[1] == "NEXT")
				videoNext();
			else if (match[1] == "PREV")
				videoPrev();
		}
		return;
	}
	match = /PLAY:(.*)/i.exec(msg);
	if(match && match[1])
	{
		log(msg);
		videoPlay();
		return;
	}
	match = /SYNC:(.*)/i.exec(msg);
	if(match && match[1])
	{
		seek();
		return;
	}
	match = /LIST:(.*)/i.exec(msg);
	if(match && match[1])
	{
		str = match[1].trim();
		videoArr1 = str.split(" ");
		player.cuePlaylist(videoArr1);
		//player.setLoop(true);
		return;
	}
	match = /ADD:(.*)/i.exec(msg);
	if(match && match[1])
	{
		stopVideo();
		videoArr1.unshift(match[1]);
		player.cuePlaylist(videoArr1);
		return;
	}
	match = /PAUSE:(.*)/i.exec(msg);
	if(match && match[1])
	{
		log(msg);
		videoPause();
		return;
	}
	match = /VIDEOAT:(.*)/i.exec(msg);
	if(match && match[1])
	{
		index = parseInt(match[1]);
		videoPlay(index);
		//return;
	}
	match = /SEEK:(.*)/i.exec(msg);
	if(match && match[1])
	{
		time = parseInt(match[1]);
		player.seekTo(time)
		//return;
	}
	log(msg);
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
	txtareaelem.value += msg;
	txtareaelem.value += "\n";
	txtareaelem.scrollTop = txtareaelem.scrollHeight;
// JQUERY EQUIVALENT FOR Text area append;
// getid("log").innerHTML+="<br>"+msg; 
}
function onkey(event)
{
	if(event.keyCode==13)
	{ 
		send(); 
	}
}

function hideElem(id)
{
	getid(id).style.visibility='hidden';
	getid(id).style.opacity=0;
}

function showElem(id)
{
	getid(id).style.visibility='visible';
	getid(id).style.opacity=1;
}

function disableonclick(id)
{
	getid(id).onclick="";
}

function enableonclick(id)
{
	//getid(id).onclick=function(){cardclick(event);};
}

function setimgsrc(id, src)
{
	getid(id).src=src;	
}

function playsound()
{
	var song = $(".token").next('audio').get(0);
        song.play();
}
//*/
function updateHTML(elmId, value) {
	getid(elmId).innerHTML = value;
}
      
function onPlayerError(errorCode) {
	alert("An error occured of type:" + errorCode);
}
function createScript()
{
	var tag = document.createElement('script');
	tag.src = "//www.youtube.com/iframe_api";
	var firstScriptTag = document.getElementsByTagName('script')[0];
	firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
}
// 3. This function creates an <iframe> (and YouTube player)
//    after the API code downloads.
function onYouTubeIframeAPIReady() {
	player = new YT.Player('player', {
		height: large[1],
		width: large[0],
		/*
		videoId: 'u1zgFlCw8Aw',
		*/
		playerVars: {
			//'start': 10,
			//controls: '0'
			controls: '1'
		},
		/*
			videoArr[1],
			videoArr[2]
		},
		*/
		events: {
			'onReady': onPlayerReady,
			'onStateChange': onPlayerStateChange,
			'onError': onPlayerError
		}
	});
}

// 4. The API will call this function when the video player is ready.
function onPlayerReady(event) {
        //setInterval(updatePlayerInfo, 250);
	if (connection) {
		var user_msg = "USER:"+user;
		socket.send(user_msg); 
	}
	else {
		//player.cuePlaylist(videoArr);
		//player.setLoop(true);
		//player.setShuffle(true);
		//videoPlay(2);
		showElem("default");
	}
        //updatePlayerInfo();
}

// 5. The API calls this function when the player's state changes.
//    The function indicates that when playing a video (state=1),
//    the player should play for six seconds and then stop.
function onPlayerStateChange(event) {
	if (event.data == 1 && state == "pause")
	{
		socket.send("PLAY:DONE");
		//sendPlaylistIndex();
	}
	else if (event.data == 2 && state == "play") 
	{
		socket.send("PAUSE:DONE");
	}
	if (next == true)
		next == false;
	if (prev == true)
		prev == false;
}

function updatePlayerInfo() {
	
	if(player && player.getDuration) {
		updateHTML("videoDuration", player.getDuration());
		updateHTML("videoCurrentTime", player.getCurrentTime());
		updateHTML("bytesTotal", player.getVideoBytesTotal());
		updateHTML("startBytes", player.getVideoStartBytes());
		updateHTML("bytesLoaded", player.getVideoBytesLoaded());
		updateHTML("volume", player.getVolume());
	}

}
// Allow the user to set the volume from 0-100
function setVideoVolume() {
	var volume = parseInt(getid("volumeSetting").value);
	if(isNaN(volume) || volume < 0 || volume > 100) {
		alert("Please enter a valid volume between 0 and 100.");
		getid("volumeSetting").value="";
		
	}
	else if(player){
		player.setVolume(volume);
		updateHTML("volume", "Volume:"+player.getVolume());
	}
}

function seek()
{
	if (connection) {
		time = player.getCurrentTime();
		//state = player.getPlayerState();
		//socket.send("SEEK:"+time+" "+state);
		socket.send("SEEK:"+time);
	}
}

function addVideo()
{
	val = getid("inputlink").value;
	if (val == "")
		return;
	getid("inputlink").value="";
	if (connection) {
		socket.send("ADD:"+val);
	}
	else {
		videoid = youtubeIdFromUrl(val);
		videoArr1.push(videoid);
		player.cuePlaylist(videoArr1);
		player.setLoop(true);
	}
}
      
function sendState() {
	if (connection && player.getPlayerState() != 1)
	{
		socket.send("PLAY:DONE");
		//sendPlaylistIndex();
	}
	else if (connection && player.getPlayerState() != 2)
		socket.send("PAUSE:DONE");
	else if (!connection && player.getPlayerState() != 1)
		videoPlay();
	else if (!connection && player.getPlayerState() != 2)
		videoPause();
}
function nextPrevVideo(option) {
	if (connection && option == 1)
	{
		socket.send("VIDEO:NEXT");
	}
	else if (connection && option == 2)
	{
		socket.send("VIDEO:PREV");
	}
	else if (!connection && option == 1)
		videoNext();
	else if (!connection && option == 2)
		videoPrev();
}
function muteVideo() {
	if (player && getid('mute').innerHTML == "Mute") {
		player.mute();
		updateHTML('mute', "Unmute");
	}
	else if (player && getid('mute').innerHTML == "Unmute") {
		player.unMute();
		updateHTML('mute', "Mute");
	}
}

function stopVideo() {
	if (player) {
		player.stopVideo();
	}
}

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
	//getid("player").height = height;
	//getid("player").width = width;
	player.setSize(parseInt(width), parseInt(height));
}

function videoPlay(pos)
{
	state = "play";
	if (pos && pos<videoArr.length)
	{
		player.playVideoAt(pos);	
	}
	else
	{
		player.playVideo();
	}
	updateHTML('play', "Pause");
}
function videoPause()
{
	state = "pause";
	updateHTML('play', "Play");
	player.pauseVideo();
}
function videoPrev()
{
	updateHTML('play', "Pause");
	player.previousVideo();
	prev =true;
}
function videoNext()
{
	updateHTML('play', "Pause");
	player.nextVideo();
	next =true;
}

function sendPlaylistIndex()
{
	index = player.getPlaylistIndex();
	socket.send("INDEX:"+index);
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

function hideDiv(div)
{
	div1 = "#"+div;
	$(div1).hide();
}
/*
function Start () {
	try {
		// Create an instance of StreamReader to read from a file.
		sr = new StreamReader("TestFile.txt");
		// Read and display lines from the file until the end of the file is reached.
		line = sr.ReadLine();
		while (line != null) {
			print(line);
			line = sr.ReadLine();
		}
		sr.Close();
	}
	catch (e) {
		// Let the user know what went wrong.
		print("The file could not be read:");
		print(e.Message);
	}
}
*/
