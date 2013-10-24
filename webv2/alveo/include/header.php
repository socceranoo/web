<?PHP
	function echoActiveClassIfRequestMatches($requestUri) {
		$active_class_str = "active";
		$current_file_name = basename($_SERVER['REQUEST_URI'], ".php");
		echo "$current_file_name\n";
		echo "$requestUri\n";
		if ($requestUri == "index" && $current_file_name == "2alveo") {
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
						<a class="brand" href="index.php"><img class=brand-image src="images/big-logo1.png"></a>
						<!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
						<div class="nav-collapse collapse">
							<ul class="nav">
								<li <?echoActiveClassIfRequestMatches("index")?>><a href="index.php">Home</a></li>
								<!--
								<li <?//echoActiveClassIfRequestMatches("vision")?> ><a href="vision.php">Vision</a></li>
								<li <?//echoActiveClassIfRequestMatches("contact")?> ><a href="contact.php">Contact</a></li>
								-->
								<li <?echoActiveClassIfRequestMatches("partners")?> ><a href="partners.php">Partners</a></li>
								<li <?echoActiveClassIfRequestMatches("people")?> ><a href="people.php">People</a></li>
								<li <?echoActiveClassIfRequestMatches("careers")?> ><a href="careers.php">Careers</a></li>
							</ul>
						</div><!--/.nav-collapse -->
					</div><!-- /.navbar-inner -->
				</div><!-- /.navbar -->

			</div> <!-- /.container -->
		</div><!-- /.navbar-wrapper -->
		<hr class="featurette-divider" />
		<hr class="featurette-divider2" />
