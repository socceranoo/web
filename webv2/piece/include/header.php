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
			<div class="container">
				<div class="navbar">
					<div class="navbar-inner">
					<!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
						<a type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</a>
						<a class="brand" href="index.php"><img class=brand-image src="images/brand.jpg">PieceMaker Technologies</a>
						<!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
						<div class="nav-collapse collapse">
							<ul class="nav">
								<li <?echoActiveClassIfRequestMatches("index")?>><a href="index.php">Home</a></li>
								<li <?echoActiveClassIfRequestMatches("services")?> ><a href="services.php">Services</a></li>
								<li <?echoActiveClassIfRequestMatches("3d-printer")?> ><a href="3d-printer.php">3D-Printing</a></li>
								<li <?echoActiveClassIfRequestMatches("piece-it")?> ><a href="piece-it.php">Piece-it! Software</a></li>
								<li <?echoActiveClassIfRequestMatches("support")?> ><a href="support.php">Support</a></li>
								<!--
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"><big><em><b class="caret"></b></em></big></a>
									<ul class="dropdown-menu">
								-->
										<li <?echoActiveClassIfRequestMatches("about")?> ><a href="about.php">About</a></li>
										<li <?echoActiveClassIfRequestMatches("contact")?> ><a href="contact.php">Contact</a></li>
								<!--
									</ul>
								</li>
								-->
								<!-- Read about Bootstrap dropdowns at http://twitter.github.com/bootstrap/javascript.html#dropdowns -->
								<!--
								<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">...<b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="#">Action</a></li>
										<li><a href="#">Another action</a></li>
										<li><a href="#">Something else here</a></li>
										<li class="divider"></li>
										<li class="nav-header">Nav header</li>
										<li><a href="#">Separated link</a></li>
										<li><a href="#">One more separated link</a></li>
									</ul>
								</li>
								-->
							</ul>
						</div><!--/.nav-collapse -->
					</div><!-- /.navbar-inner -->
				</div><!-- /.navbar -->

			</div> <!-- /.container -->
		</div><!-- /.navbar-wrapper -->

