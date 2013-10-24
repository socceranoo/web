<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<?require_once("include/tubeheaders.php");?>
	</head>
	<body id='synctube'>
		<?require_once("include/header.php");?>
		<div class="container">
			<hr class="featurette-divider2" />
			<!--
			<h1 class="main-heading text-center">SyncTube<br/><a id=init-modal href="#join-modal" data-toggle=modal >Connect</a></h1>
			<h4 class="muted text-center">watch youtube videos together</h5>
			-->
			<div class="row background-sunFlower rounded">
				<hr class="featurette-divider3" />
				<div class="span8 offset2">
					<form onsubmit="ytEmbed.init({'block':'divsearch','type':'search','q':getid('ytsearch').value,'results': 10,'layout':'thumbnails', 'order':'most_relevance'}); return false;">
						<input id="ytsearch" required placeholder="Search for youtube videos here"/>
						<input id=ytsubmit class="btn btn-danger btn-large" type="submit" value="  Search  "/>
					</form>
				</div>
				<div id=player-span class="span7">
					<h3 id=now-playing>The YouTube API: Upload, Player APIs and more!</h3>
					<div class="">
						<div id="player">Connect to continue..</div>
					</div>
					<!--
					<p></p>
					<div class="offset2 span2" ><a href="javascript:void(0);" class="btn btn-primary btn-block" onclick="seek();">Seek</a></div>
					-->
				</div>
				<div id=search-span class="span5">
					<h3 class=text-center>search results</h3>
					<div id="divsearch"></div>
				</div>
				<div class="span7" id="playlist">
					<h3 class="text-center">current playlist</h3>
					<ul id=playlist-ul class="text-center well inline unstyled background-wetAsphalt">
					</ul>
				</div>
				<!--
				<div class="span4 well">
					<ul id=userlist class="unstyled"></ul>
				</div>
				-->
				<div id=chat-span class="span5">
					<h3 class="text-center">chat area</h3>
					<div class="well">
						<textarea class="chat background-peterRiver" id="chat" disabled="disabled"></textarea><br/>
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
