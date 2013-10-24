<?PHP
	function get_session_from_page() {
		if ($_REQUEST['debug']) {
			$debug = $_REQUEST['debug'];
		}else {
			$debug = 0;
		}
		if ($_REQUEST['session']) {
			$session_id = $_REQUEST['session'];
		}else {
			$session_id = 1;
		}
		if ($_REQUEST['user']) {
			$username = $_REQUEST['user'];
		}else {
			$username = "NOUSER";
		}
		echo "<div id=get_session data-debug=$debug data-user=$username data-session=$session_id></div>";
	}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<?require_once("include/tubeheaders.php");?>
	</head>
	<body id='synctube'>
		<?require_once("include/header.php");?>
		<hr class="featurette-divider2" />
		<div class="container">
			<?get_session_from_page()?>
			<div id=main-container class="row background-sunFlower rounded" style="display:none">
				<hr class="featurette-divider3" />
				<!--
				<div class="span8 offset2">
					<form onsubmit="ytEmbed.init({'block':'divsearch','type':'search','q':getid('ytsearch').value,'results': 10,'layout':'thumbnails', 'order':'most_relevance'}); return false;">
						<input id="ytsearch" required placeholder="Search for youtube videos here"/>
						<input id=ytsubmit class="btn btn-danger btn-large" type="submit" value="  Search  "/>
					</form>
				</div>
				-->
				<div id=player-span class="span7">
					<h3 id=now-playing>Coldplay - Paradise</h3>
					<div class="">
						<div id="player">Connect to continue..</div>
					</div>
				</div>
				<div id=search-span class="span5">
					<h3 class=text-center>search results</h3>
					<div id="divsearch"></div>
				</div>
				<div class="span5" id="playlist">
					<h3 class="text-center">Playlist</h3>
					<ul id=playlist-ul class="text-center well unstyled 2background-wetAsphalt">
					</ul>
				</div>
				<div class="span3">
					<h3 class="text-center">User list</h3>
					<ul id=userlist-ul class="well unstyled"></ul>
				</div>
				<div id=chat-span class="span4">
					<h3 class="text-center">Chat</h3>
					<div class="well background-peterriver">
						<textarea class="chat" id="chat" disabled="disabled"></textarea><br/>
						<input class="msg" id="msg" onkeypress="onkey(event, 0)"/>
					</div>
				</div>
				<!--
				<a href="javascript:void(0);" onclick="smallPlayer();">Small Player</a>
				<a href="javascript:void(0);" onclick="normalPlayer();">Normal Player</a>
				<a href="javascript:void(0);" onclick="largePlayer();">Large Player</a>
				-->
				<div class=clearfix></div>
				<hr class="featurette-divider2" />
				<hr class="featurette-divider2" />
				<div id=control-log class="span5" style="display:none">
					<h3 class="text-center">Control log</h3>
					<div class="well background-peterriver">
						<textarea class="chat" id="debug" disabled="disabled"></textarea><br/>
					</div>
				</div>
				<audio src="images/newim.wav" id=audioplayer controls=true style="display:none">
					Your browser does not support the <code>audio</code> element.
				</audio>
				<hr class="featurette-divider2" />
			</div>
			<hr class="featurette-divider2" />

			<div id="join-modal" class="modal hide fade out" style="display:none">
				<div class="modal-header text-center">
					<h2>Enter your name</h2>
					<input id="input-name" type="" required onkeypress="onkey(event, 1)"/>
					<a href="javascript:void(0);" id=joinserver class="btn btn-primary" onclick="joinserver();">submit</a>
				</div>
			</div>

			<?require_once("include/tubefooters.php");?>
		</div>

	</body>
</html>
