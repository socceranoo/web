<?PHP
    require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/membersite_config.php");
    require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/global_values.php");
	$start_song="images/hlh-cp.mp3";
	//$start_song="../../external/linkhdd/Audio/English/Poets of the Fall/Carnival of Rust.mp3";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/headers.php");?>
		<?require_once("include/audioheaders2.php");?>
	</head>
	<body class='' id='audiobody'>
		<?require_once("include/header.php");?>
		<div id='container' class="container">
			<h5 id="search-modal-link" style="display:none" class=text-center><a data-toggle="modal" href="#manageresults">Search results for <span class="searchword" class=muted></span></a></h5>
			<h5 id="mainheading" class="well text-center" >Works best on webkit browsers and Mozilla firefox due to jPlayer compatability</h5>
				<div id='manageresults' class="modal hide fade out background-white well1" style="display:none">
					<div class="modal-header">
						<a class="close" data-dismiss="modal">x</a>
						<h3 class=''>Search results for <span class="searchword"></span></h3>
					</div>

					<div class="modal-body" id='searchresults'></div>

					<div class="modal-footer text-center">
						<a class="btn btn-small btn-danger" onclick="clearlist('searchresults');">clear results</a>
						<a class="btn btn-small btn-primary" data-dismiss="modal">hide results</a>
						<a class="btn btn-small btn-success" onclick="add_all_songs_to_playlist();">add all</a>
					</div>
				</div>
			<div class="row-fluid">
				<div class="span3 offset9 text-center well sidebar-nav" id='playlistbar'>
					<img id='centerloading' src="images/loading2.gif" class="loading" style="display:none"/>
					<?require_once("include/playlists.php");?>
				</div>
			</div>
			<?require_once("include/jplayer.php");?>
			<!--
			<div id=mb-container style="display:none">
				<div id='mainbuttons'>
					<p style='font-size:10px; text-align:center;'>Enter playlist name</p>
					<input type='text' name='listname' id='listname' maxlength="20" required placeholder="enter playlist name"/>
					<button class=save id='saveplaylist' onclick="savelist();">submit</button>
				</div>
			</div>
			-->
		</div>
		<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/footers.php");?>
		<?require_once("include/audiofooters.php");?>
	</body>
</html>
