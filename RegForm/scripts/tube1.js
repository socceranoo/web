var socket, txtareaelem, user;
var defaultsrc="http://www.youtube.com/embed/g3Xvn3AymxA";
var videoArr= new Array("kjO-XSgEwew", "g3Xvn3AymxA");
var player;
var done = false;
///*
function init() 
{
	hideElem("noserver");
	var host = "ws://98.234.216.9:9002/RegForm/tubeserver.php"; // SET THIS TO YOUR SERVER
	try {
		socket = new WebSocket(host);
		txtareaelem = getid("chat");
		user=document.refreshForm.uname.value;
		
		createScript();
		log('Welcome to the SyncTube');
		log('Connecting to the server ...');

		socket.onopen    = function(msg) { 
			log("Connected"); 
			log('You joined the conference room'); 
			var user_msg = "USER:"+user;
			socket.send(user_msg); 
			_run();
			//google.setOnLoadCallback(_run);
		};
		socket.onmessage = function(msg) {
			process(msg.data)
		};
		socket.onclose   = function(msg) { 
			showElem("noserver");
			log("Disconnected"); 
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
		hideElem('jbutton');
		playsound();
		player.cueVideoById(videoArr[0]);
		playVideo();
		return;
	}
	var match = /PLAY:(.*)/i.exec(msg);
	if(match && match[1])
	{
		playVideo();
		return;
	}
	var match = /PAUSE:(.*)/i.exec(msg);
	if(match && match[1])
	{
		pauseVideo();
		return;
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

function setyoutubesrc(id, src)
{
	getid(id).src=src;
}

function sendlink(link)
{
	socket.send("VIDEO:"+defaultsrc);
}
function sendstate()
{
}

function playsound()
{
var song = $(".token").next('audio').get(0);
        song.play();
}
//*/
function updateHTML(elmId, value) {
document.getElementById(elmId).innerHTML = value;
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
	height: '390',
	width: '640',
	/*
	videoId: 'u1zgFlCw8Aw',
	playerVars: {
		'start': 10,
		controls: '0'
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
	player.cueVideoById(videoArr[1]);
	//player.cueVideoById("u1zgFlCw8Aw");
	event.target.playVideo();
        //setInterval(updatePlayerInfo, 250);
        updatePlayerInfo();
}

// 5. The API calls this function when the player's state changes.
//    The function indicates that when playing a video (state=1),
//    the player should play for six seconds and then stop.
function onPlayerStateChange(event) {
	if (event.data == YT.PlayerState.PLAYING && !done) {
		//setTimeout(stopVideo, 6000);
		done = true;
	}
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
	var volume = parseInt(document.getElementById("volumeSetting").value);
	if(isNaN(volume) || volume < 0 || volume > 100) {
		alert("Please enter a valid volume between 0 and 100.");
	}
	else if(player){
		player.setVolume(volume);
	}
}
      
function playVideo() {
	if (player) {
		player.playVideo();
	}
}
      
function pauseVideo() {
	if (player) {
		player.pauseVideo();
	}
}

function muteVideo() {
	if (player) {
		player.mute();
	}
}
function unMuteVideo() {
	if (player) {
		player.unMute();
	}
}

function stopVideo() {
	if (player) {
		player.stopVideo();
	}
}

function smallPlayer() {
	resizePlayer(480, 295);
}

function normalPlayer() {
	resizePlayer(560, 340);
}

function largePlayer() {
	resizePlayer(640, 385);
}
function resizePlayer(width, height) {
	getid("player").height = height;
	getid("player").width = width;
}
