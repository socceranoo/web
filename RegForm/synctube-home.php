<?PHP
	require_once("access.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<title>Synctube</title>
		<?require_once("tubeincludes.php");?>
	</head>
	<body class='gameroom' onload="init()">
		<h3>Synctube v1.0</h3>
		<h3 id='noserver' style='visibility:hidden;'>SERVER NOT FOUND</h3>
		<h3 id='dup' style='visibility:hidden;'>DUPLICATE LOGIN FOUND YOU WILL BE REDIRECTED IN 5 Seconds...</h3>
		<form name="refreshForm">
		<input type="hidden" name="visited" value="" />
		<input type="hidden" id='uname' name="uname" value=<?echo $uname;?>>
		</form>
		
		<button id='jbutton' onclick="sendlink('dummy');">CLICK ME</button>
		<div class="token"></div>
		<audio class="audiotemp" id="aud-token">
		<source src="sounds/yourturn.oga" type="audio/ogg" />
			Your browser does not support HTML5 audio.
		</audio>
			<div id="player">Loading...</div>
			<div id="videoInfo">
				<a href="javascript:void(0);" onclick="smallPlayer();">Small Player</a>
				<a href="javascript:void(0);" onclick="normalPlayer();">Normal Player</a>
				<a href="javascript:void(0);" onclick="largePlayer();">Large Player</a>
				<p>Player state: <span id="playerState">--</span></p><br/>
				<p>Current Time: <span id="videoCurrentTime">--:--</span> | Duration: <span id="videoDuration">--:--</span></p><br/>
				<p>Bytes Total: <span id="bytesTotal">--</span> | Start Bytes: <span id="startBytes">--</span> | Bytes Loaded: <span id="bytesLoaded">--</span></p><br/>
				<p>Controls: <a href="javascript:void(0);" onclick="playVideo();">Play</a> | <a href="javascript:void(0);" onclick="pauseVideo();">Pause</a> | <a href="javascript:void(0);" onclick="muteVideo();">Mute</a> | <a href="javascript:void(0);" onclick="unMuteVideo();">Unmute</a></p><br/>
				<p><input id="volumeSetting" type="text" size="3" />&nbsp;<a href="javascript:void(0)" onclick="setVideoVolume();">&lt;- Set Volume</a> | Volume: <span id="volume">--</span></p><br/>
			</div>
		<div id="chatboxtest" class="chatroom">
			<div class="chatbox">
				<textarea class="chat" id="chat" disabled="disabled"></textarea>
				<input class="msg" id="msg" onkeypress="onkey(event)"/>
			</div>
		</div>
	</body>
</html>
