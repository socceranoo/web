var socket, txtareaelem, user;
var defaultsrc="http://www.youtube.com/embed/g3Xvn3AymxA";
var videoArr= new Array("kjO-XSgEwew", "g3Xvn3AymxA");

function init() 
{
	hideElem("noserver");
	var host = "ws://98.234.216.9:9002/RegForm/tubeserver.php"; // SET THIS TO YOUR SERVER
	try {
		socket = new WebSocket(host);
		txtareaelem = getid("chat");
		user=document.refreshForm.uname.value;

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
		ytplayer.cueVideoById(videoArr[0]);
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

function stopvideo()
{
	$('#iframe').get(0).stopVideo();	
}
function playsound()
{
var song = $(".token").next('audio').get(0);
        song.play();
}
function playvideo()
{
var vid = $(".token").next('iframe').get(0);
        vid.play();
}
      
// Update a particular HTML element with a new value
function updateHTML(elmId, value) {
document.getElementById(elmId).innerHTML = value;
}
      
// This function is called when an error is thrown by the player
function onPlayerError(errorCode) {
  alert("An error occured of type:" + errorCode);
}
      
// This function is called when the player changes state
function onPlayerStateChange(newState) {
  updateHTML("playerState", newState);
  if (newState ==2)
	  socket.send("PAUSE:DONE");
  else if (newState==1)
	  socket.send("PLAY:DONE");
}
      
// Display information about the current state of the player
function updatePlayerInfo() {
  // Also check that at least one function exists since when IE unloads the
        // page, it will destroy the SWF before clearing the interval.
  if(ytplayer && ytplayer.getDuration) {
          updateHTML("videoDuration", ytplayer.getDuration());
          updateHTML("videoCurrentTime", ytplayer.getCurrentTime());
          updateHTML("bytesTotal", ytplayer.getVideoBytesTotal());
          updateHTML("startBytes", ytplayer.getVideoStartBytes());
          updateHTML("bytesLoaded", ytplayer.getVideoBytesLoaded());
          updateHTML("volume", ytplayer.getVolume());
        }
      }
      
      // Allow the user to set the volume from 0-100
function setVideoVolume() {
        var volume = parseInt(document.getElementById("volumeSetting").value);
        if(isNaN(volume) || volume < 0 || volume > 100) {
          alert("Please enter a valid volume between 0 and 100.");
        }
        else if(ytplayer){
          ytplayer.setVolume(volume);
        }
      }
      
function playVideo() {
        if (ytplayer) {
          ytplayer.playVideo();
        }
      }
      
function pauseVideo() {
        if (ytplayer) {
          ytplayer.pauseVideo();
        }
      }
      
function muteVideo() {
        if(ytplayer) {
          ytplayer.mute();
        }
      }
      
function unMuteVideo() {
        if(ytplayer) {
          ytplayer.unMute();
        }
      }
      
      
// This function is automatically called by the player once it loads
function onYouTubePlayerReady(playerId) {
        ytplayer = document.getElementById("ytPlayer");
        // This causes the updatePlayerInfo function to be called every 250ms to
        // get fresh data from the player
        setInterval(updatePlayerInfo, 250);
        updatePlayerInfo();
        ytplayer.addEventListener("onStateChange", "onPlayerStateChange");
        ytplayer.addEventListener("onError", "onPlayerError");
        //Load an initial video into the player
        //ytplayer.cueVideoById("g3Xvn3AymxA");
        //ytplayer.cueVideoById("ylLzyHk54Z0");
      }
      
      // The "main method" of this sample. Called when someone clicks "Run".
      function loadPlayer() {
	var videoID = "ylLzyHk54Z0";
        // Lets Flash from another domain call JavaScript
	var params = {};
 	params.allowfullscreen = "true";
	/*
 	params.menu = "false";
 	params.quality = "best";
 	params.scale = "noscale";
 	params.bgcolor = "#FFFFFF";
	*/
 	params.allowScriptAccess = "always";
        //var params = { allowScriptAccess: "always"};
        // The element id of the Flash embed
        var atts = { id: "ytPlayer" };
        // All of the magic handled by SWFObject (http://code.google.com/p/swfobject/)
	swfobject.embedSWF("http://www.youtube.com/v/" + videoID + 
                     "?version=3&enablejsapi=1&playerapiid=player1", 
                     "videoDiv", "480", "295", "9", null, null, params, atts);
/*	
      swfobject.embedSWF("http://www.youtube.com/apiplayer?" +
                        "version=3&enablejsapi=1&playerapiid=player1", 
                       "videoDiv", "480", "295", "9", null, null, params, atts);
*/
      }
      function _run() {
        loadPlayer();
      }
//google.setOnLoadCallback(_run);
