<?PHP
    require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/membersite_config.php");
    //require_once($_SERVER['DOCUMENT_ROOT']."webv2/topright.php");
    checklogin();
	$start_song="../../external/linkhdd/Audio/English/Poets of the Fall/Carnival of Rust.mp3";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<title>mp3raze</title>
		<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/headers.php");?>
		<?require_once("./include/audioheaders.php");?>
	</head>
	<body class='login' id='audiobody'>
	<div id='container'>
	<h2 id="mainheading" onclick="changewallpaper();">mp3raze</h2>
	<img id='centerloading' src="images/loading.gif" class="loading"/>
	<div class='sidebar' id='manageresults'>
		<form id='audio' method='post' accept-charset='UTF-8' align=left>
		<fieldset>
			<input type='hidden' name='audiosubmit' id='audiosubmit' value='<?echo $start_song;?>'/>
			<input type='submit' name='asubmit' value='search' />
			<input type='text' name='asearch' id='asearch' maxlength="50" required/><br/>
		</fieldset>
		</form>
		<div id='sidebuttons'>
			<button id='clearsearchlist' onclick="clearlist('searchresults');">clear results</button>
			<button id="addall" onclick="add_all_songs_to_playlist();">add all</button>
		</div>
		<div id='searchresults'></div>
		<img id='sideloading' src="images/loading.gif" class="loading"/>
	</div>
	<div class='sidebar' id='playlistbar'>
		<h2>Playlists</h2>
		<div id='playlistcontent'></div>
	</div>

	<div class="jp-audio">
		<div id=jp_container_1 class="jp-type-playlist">
			<div id="jp_playlist_1" class="jp-playlist">
				<ul id=jp_playlist_1_ul></ul>
			</div>
			<div id="jquery_jplayer_1" class="jp-jplayer"></div>
			<div id="jp_interface_1" class="jp-interface">
				<ul class="jp-controls">
					<li><a href="javascript:;" class="jp-previous" tabindex="1">previous</a></li>
					<li><a href="javascript:;" class="jp-play" tabindex="1">play</a></li>
					<li><a href="javascript:;" class="jp-pause" tabindex="1">pause</a></li>
					<li><a href="javascript:;" class="jp-next" tabindex="1">next</a></li>
					<li><a href="javascript:;" class="jp-stop" tabindex="1">stop</a></li>
					<li><a href="javascript:;" class="jp-mute" tabindex="1" title="mute">mute</a></li>
					<li><a href="javascript:;" class="jp-unmute" tabindex="1" title="unmute">unmute</a></li>
					<li><a href="javascript:;" class="jp-volume-max" tabindex="1" title="max volume">max volume</a></li>
				</ul>
				<div class="jp-progress">
					<div class="jp-seek-bar">
						<div class="jp-play-bar"></div>
					</div>
				</div>
				<div class="jp-volume-bar">
					<div class="jp-volume-bar-value"></div>
				</div>
				<ul class="jp-toggles">
					<li><a href="javascript:;" class="jp-clear-playlist jp-small" tabindex="1" title="clear playlist" >clear playlist</a></li>
					<li><a href="javascript:;" class="jp-shuffle" tabindex="1" title="shuffle" style="display: none;">shuffle</a></li>
					<li><a href="javascript:;" class="jp-shuffle-off" tabindex="1" title="shuffle off" style="display: block;">shuffle off</a></li>
					<li><a href="javascript:;" class="jp-full-screen" tabindex="1" title="hide/show playlist" >hide/show playlist</a></li>
					<li><a href="javascript:;" class="jp-repeat" tabindex="1" title="repeat" style="display: block;">repeat</a></li>
					<li><a href="javascript:;" class="jp-repeat-off" tabindex="1" title="repeat off" style="display: none;">repeat off</a></li>
					<li><a href="javascript:;" class="jp-save-playlist jp-small" tabindex="1" title="save playlist" >save playlist</a></li>
				</ul>
				<div class="jp-current-time"></div>
				<div class="jp-duration"></div>
			</div>
		</div>
	</div>
	<div id='audiodiv'>
		<div id='playlist'></div>
	</div>
	<!--
	<button id='clearplaylist' onclick="clearlist('playlist');">clear playlist</button>
	<div id='mainplayer'>
		<div id='playerbuttons'>
			<button id='repeat' onclick="changerepeat();">repeat OFF</button>
			<button id='shuffle' onclick="changeshuffle();">shuffle OFF</button>
			<button id='prev' onclick="prevsong();">pre</button>
			<button id='next' onclick="nextsong();">nxt</button>
		</div>
		<audio id ='player' controls="true"></audio>	
	</div>
	-->
	</div>
	<div id=mb-container>
		<div id='mainbuttons'>
			<p style='font-size:10px; text-align:center;'>Enter playlist name</p>
			<input type='text' name='listname' id='listname' maxlength="20" required placeholder="enter playlist name"/>
			<button class=save id='saveplaylist' onclick="savelist();">submit</button>
		</div>
	</div>
	</body>
</html>
