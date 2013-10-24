<?PHP
	function echoActiveClassIfRequestMatches($requestUri) {
		$active_class_str = "active";
		$current_file_name = basename($_SERVER['REQUEST_URI'], ".php");
		echo "$current_file_name\n";
		echo "$requestUri\n";
		if ($requestUri == "index" && $current_file_name == "piece") {
			echo "class=$active_class_str";
			return;
		}
		if ($current_file_name == $requestUri)
			echo "class=$active_class_str";
	}
?>
		<!-- NAVBAR
		================================================== -->
		<div class="navbar-wrapper">
			<!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
			<div class="navbar navbar-fixed-top navbar-inverse" >
				<div class="navbar-inner">
					<div class="container">
					<!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
						<a type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</a>
						<a class="brand" data-toggle="modal" href="#manageresults"><img src="images/music-icon.png" alt=""/></a>
						<a class="brand" href="index2.php"><i>mp3raze</i></a>
						<!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
						<form class="navbar-form pull-left" id='audio' method='post' accept-charset='UTF-8'>
							<input type='hidden' name='audiosubmit' id='audiosubmit' value='<?echo $start_song;?>'/>
							<input type='text' class="search-query" name='asearch' id='asearch' maxlength="50" required placeholder="Search"/><br/>
							<input type='submit' name='asubmit' value='search' style="display:none"/>
						</form>
						<div class="nav-collapse collapse">
						</div><!--/.nav-collapse -->
					</div> <!-- /.container -->
				</div><!-- /.navbar-inner -->
			</div><!-- /.navbar -->

		</div><!-- /.navbar-wrapper -->
		<hr class="featurette-divider" />


		<div class="container">
			<div id="saveplaylistmodal" class="modal hide fade out background-white" style="display: none;">  
				<div class="modal-header text-center">  
					<a class="close" data-dismiss="modal">x</a>  
					<h3 class=lead>Save Playlist</h3>  
				</div>  
				<div id=modal-success class="modal-body text-center" style="display:none">  
					<input type='text' name='listname' id='listname' maxlength="20" required placeholder="enter playlist name"/>
					<button class='save btn btn-success' id='saveplaylist' onclick="submit_playlist();">submit</button>
					<button class='save btn btn-danger' id='cancelplaylist1' onclick="cancelsave();">cancel</button>
				</div>  
				<p id=modal-playlist-msg class=text-center></p>
				</div>  
			</div>  
		</div> 
