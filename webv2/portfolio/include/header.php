<?PHP
	function echoActiveClassIfRequestMatches($requestUri) {
		$active_class_str = "active";
		$current_file_name = basename($_SERVER['REQUEST_URI'], ".php");
		echo "$current_file_name\n";
		echo "$requestUri\n";
		if ($requestUri == "index" && $current_file_name == "portfolio") {
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
						<a class="brand" href="#biglogo"><img src="images/emblemv5.png" alt="" onclick="triggermodal('#biglogo');"/></a>
						<a class="brand" href="index.php"><i>Manjunath</i></a>
						<!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
							<ul class="nav logo-holder">
								<li><a target='_blank' href="https://twitter.com/socceranoo"><img src="images/twitterlogo2.png" alt="" /></a></li>
								<li><a target='_blank' href="https://facebook.com/socceranoo"><img src="images/fblogo.png" alt="" /></a></li>
								<li><a target='_blank' href="https://www.linkedin.com/pub/manjunath-mageswaran/14/466/372/"><img src="images/linkedinlogo.png" alt="" /></a></li>
								<li><a target='_blank' href="https://plus.google.com/socceranoo/"><img src="images/gpluslogo.png" alt="" /></a></li>
							</ul>
						<div class="nav-collapse collapse">
							<ul class="nav">
								<li <?echoActiveClassIfRequestMatches("about")?> ><a href="about.php">about</a></li>
								<li <?echoActiveClassIfRequestMatches("work")?> ><a href="work.php">work</a></li>
								<li <?echoActiveClassIfRequestMatches("tech")?> ><a href="tech.php">tech</a></li>
								<!--
								<li <?//echoActiveClassIfRequestMatches("gallery")?> ><a href="gallery.php">gallery</a></li>
								<li <?//echoActiveClassIfRequestMatches("index")?>><a href="index.php">home</a></li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><big><em><b class="caret"></b></em></big></a>
									<ul class="dropdown-menu">
									<li <?//echoActiveClassIfRequestMatches("gallery")?> ><a href="gallery.php">gallery</a></li>
								-->
										<li <?echoActiveClassIfRequestMatches("contact")?> ><a href="contact.php">contact</a></li>
								<!--
									</ul>
								</li>
								-->
								<!--
								<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">...<b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="#">Something else here</a></li>
										<li class="divider"></li>
										<li class="nav-header">Nav header</li>
										<li><a href="#">Separated link</a></li>
									</ul>
								</li>
								-->
							</ul>
						</div><!--/.nav-collapse -->
					</div> <!-- /.container -->
				</div><!-- /.navbar-inner -->
			</div><!-- /.navbar -->

		</div><!-- /.navbar-wrapper -->
		<hr class="featurette-divider" />


		<div class="container">
			<div id="biglogo" class="modal hide fade out background-white" style="display: none;">  
				<div class="modal-header text-center">  
					<a class="close" data-dismiss="modal">×</a>  
					<h3 class="family-rouge">Manjunath</h3>
				</div>  
				<div class="modal-body text-center">  
					<img style="height:400px;width:400px;" src="images/emblemv5.png" alt="" />	
				</div>  
				<div class="modal-body text-center">  
					<h4 class="btn btn-danger" data-dismiss="modal">Close</h4>
				</div>  
			</div>  
		</div> 
