<?PHP
	system("lessc style/home.less > style/home.css");
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/access.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US" ng-app>
	<head>
		<?require_once("include/headers.php");?>
		<?require_once("include/loginheaders.php");?>
		<title>Welcome to gatoraze.com</title>
		<link href="http://gatoraze.com/style/home.css" rel="stylesheet">
	</head>
	<body class="background-cloud login">
		<div class="container background-eterRiver" ng-controller="Home">
			<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/topright.php");?>
			<div class="featurette-divider4"></div>
			<h3 class="text-right website-heading" style="font-size:50px;">GATORAZE.COM</h3>
			<hr class="featurette-divider4">

			<div id=myCarousel class="carousel slide">
				<ul class="inline carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1" class=""></li>
					<li data-target="#myCarousel" data-slide-to="2" class=""></li>
					<li data-target="#myCarousel" data-slide-to="3" class=""></li>
					<li data-target="#myCarousel" data-slide-to="4" class=""></li>
					<li data-target="#myCarousel" data-slide-to="5" class=""></li>
				</ul>
				<div class="carousel-inner">
					<!-- START THE FEATURETTES -->
					<div class="featurette clearfix item active">
						<img class="featurette-image site-icons pull-right" src="images/design-tools.png">
						<h2 class="featurette-heading">Where<span class="muted"> ...</span></h2>
						<p class="lead"> - designs meet brilliance.</p>
						<p class=lead> - services attain excellence.</p>
						<p class=lead> - features acquire consistence.</p>
						<p class=lead> - codes obtain conformance.</p>
					</div>
					<div class="featurette clearfix item ">
						<img class="featurette-image site-icons pull-left" src="images/synctube-icon3.png">
						<h2 class="featurette-heading">SYNCTUBE<span class="muted"> - watch videos together</span></h2>
						<p class="lead">Our specialty is helping you integrate 3D printing to your business at an appropriate level of cost and commitment, applying this technology to create new products, broaden your offering, or simplify your supply chain. We do this by offering a range of services from custom parts to in-house 3d printing systems and software.</p>
						<a href='synctube/' class="btn btn-info">Go to site</a>
					</div>

					<div class="featurette clearfix item">
						<img class="featurette-image site-icons pull-right" src="images/trump-icon3.png">
						<h2 class="featurette-heading">TRUMP<span class="muted"> - multiplayer card game</span></h2>
						<p class="lead">Our goal is to make the process of 3d Printing, from content to fabrication, as simple and intuitive as possible. We are here to walk you through every step of the process and make sure you are getting the exact pieces you want.</p>
						<p class=lead></p>
						<a href='trump/' class="btn btn-info">Go to site</a>
					</div>

					<div class="featurette clearfix item">
						<img class="featurette-image site-icons pull-left" src="images/money-icon2.png">
						<h2 class="featurette-heading">MONEY MATTERS<span class="muted"> - manage your expenses</span></h2>
						<p class="lead">Our goal is to make the process of 3d Printing, from content to fabrication, as simple and intuitive as possible. We are here to walk you through every step of the process and make sure you are getting the exact pieces you want.</p>
						<p class=lead></p>
						<a href='2money/summary.php' class="btn btn-info">Go to site</a>
					</div>

					<div class="featurette clearfix item">
						<img class="featurette-image site-icons pull-right" src="images/music-icon2.png">
						<h2 class="featurette-heading">MP3RAZE<span class="muted"> - listen to your favorite music</span></h2>
						<p class="lead">Our goal is to make the process of 3d Printing, from content to fabrication, as simple and intuitive as possible. We are here to walk you through every step of the process and make sure you are getting the exact pieces you want.</p>
						<p class=lead></p>
						<a href='audio/' class="btn btn-info">Go to site</a>
					</div>

					<div class="featurette clearfix item">
						<img class="featurette-image site-icons pull-left" src="images/warning.png">
						<h2 class="featurette-heading">And lastly, this one. <span class="muted">Get in touch.</span></h2>
						<p class="lead">Like us or tweet about us.</p>
					</div>
					<!-- /END THE FEATURETTES -->

				</div> <!-- Carousel inner-->
			</div> <!-- Carousel-->
		</div><!-- /.container -->
		<?require_once("include/footers.php");?>
	</body>
</html>

