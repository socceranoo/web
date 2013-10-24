<?PHP
	/*
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
	*/
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
						<!--
						<h1 class="main-heading text-center">SyncTube</h1>
						<a id=init-modal class="pull-right" href="#join-modal" data-toggle=modal >Connect</a>
						<h3 class="muted family-rouge text-center">watch videos together</h3>
						-->
						<a class="brand" href="index.php"><img src="images/synctube-copy.png"/></a>
						<!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
						<div id=init-modal-div class="brand span6">
							<a id=init-modal class="btn btn-block btn-warning" href="#join-modal" data-toggle=modal >&nbsp;<br/>Connect<br/>&nbsp;</a>
						</div>
						<div id=search-form class="brand span6" style="display:none">
							<form onsubmit="ytEmbed.init({'block':'divsearch','type':'search','q':getid('ytsearch').value,'results': 10,'layout':'thumbnails', 'order':'most_relevance'}); return false;">
								<input id="ytsearch" required placeholder="Search for youtube videos here"/>
								<input id=ytsubmit class="btn btn-danger" type="submit" value="  Search  "/>
							</form>
						</div>
						<div id=con-status class="brand span2" style="display:none">
							<a href="javascript:void(0);" class="connection-status btn">Connected</a>
						</div>
						<div class="nav-collapse collapse">
							<ul class="nav">
							</ul>
						</div><!--/.nav-collapse -->
					</div> <!-- /.container -->
				</div><!-- /.navbar-inner -->
			</div><!-- /.navbar -->

		</div><!-- /.navbar-wrapper -->
		<hr class="featurette-divider2" />


		<!--
		<div class="container">
			<div id="biglogo" class="modal hide fade out background-white" style="display: none;">  
				<div class="modal-header text-center">  
					<a class="close" data-dismiss="modal">×</a>  
					<h3>Logo</h3>  
				</div>  
				<div class="modal-body text-center">  
					<img src="images/emblemv4.png" alt="" />	
				</div>  
				<div class="modal-body text-center">  
					<h4 class="btn btn-danger" data-dismiss="modal">Close</h4>
				</div>  
			</div>  
		</div> 
		-->
