<?PHP
	$start_song="../../external/linkhdd/Audio/English/Poets of the Fall/Carnival of Rust.mp3";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<title>raZershark!</title>
		<?require_once("./include/headers.php");?>
		<?require_once("./include/audioheaders.php");?>
	</head>
	<body class='login' id='audiobody'>
	<h2 id="mainheading" onclick="changewallpaper();">raZershark!</h2>
	<img id='centerloading' src="images/loading.gif" class="loading"/>
	<div id='audiodiv'>
		<div id='mainbuttons'>
			<input type='text' name='listname' id='listname' maxlength="20"/>
			<button id='clearplaylist' onclick="clearlist('playlist');">clear playlist</button>
			<button id='saveplaylist' onclick="savelist();">save playlist</button>
			<button id='cancelsave' onclick="cancelsave();">cancel</button>
		</div>
		<div id='playlist'></div>
	</div>
	<div class='sidebar' id='manageresults'>
		<form id='audio' method='post' accept-charset='UTF-8' align=left>
		<fieldset>
			<input type='hidden' name='audiosubmit' id='audiosubmit' value='<?echo $start_song;?>'/>
			<div class='container'>
				<input type='submit' name='asubmit' value='search' />
			</div>
			<div class='container'>
				<input type='text' name='asearch' id='asearch' maxlength="50"/><br/>
				<span id='asearch_errorloc' class='error'></span>
			</div>
		</fieldset>
		</form>
		<script type='text/javascript'>
		// <![CDATA[
		var frmvalidator  = new Validator("audio");
		frmvalidator.EnableOnPageErrorDisplay();
		frmvalidator.EnableMsgsTogether();
		frmvalidator.addValidation("asearch","req","Please enter string to search");
		// ]]>
		</script>
		<div id='sidebuttons'>
			<button id='clearsearchlist' onclick="clearlist('searchresults');">clear results</button>
			<button id="addall" onclick="add_all_songs_to_playlist();">add all</button>
		</div>
		<div id='searchresults'></div>
		<img id='sideloading' src="images/loading.gif" class="loading"/>
	</div>
	<div class='sidebar' id='playlistbar'>
		<h2>your playlists</h2>
		<div id='playlistcontent'></div>
	</div>

	<div id='mainplayer'>
		<div id='playerbuttons'>
			<button id='repeat' onclick="changerepeat();">repeat OFF</button>
			<button id='shuffle' onclick="changeshuffle();">shuffle OFF</button>
			<button id='prev' onclick="prevsong();">pre</button>
			<button id='next' onclick="nextsong();">nxt</button>
		</div>
		<audio id ='player' controls="true"></audio>	
	</div>
	</body>
</html>
