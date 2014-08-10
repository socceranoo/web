<?PHP
	system("lessc style/home.less > style/home.css");
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/access.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html class=full xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US" ng-app>
	<head>
		<?require_once("include/headers.php");?>
		<?require_once("include/loginheaders.php");?>
		<title>Welcome to gatoraze.com</title>
		<link href="http://gatoraze.com/style/home.css" rel="stylesheet">
	</head>
	<body class="full background-cloud login">
		<div class="full container" ng-controller="Home">
			<div class="topfixed">
				<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/topright.php");?>
				<h3 class="website-heading">gatoraze.com</h3>
			</div>
			<ul id=item-selector class="item-selector carousel-indicators" data-current=0>
				<li data-target=0 class="active"></li>
				<li data-target=1 class=""></li>
				<li data-target=2 class=""></li>
				<li data-target=3 class=""></li>
				<!--
				  <li data-target=4 class=""></li>
				  <li data-target=5 class=""></li>
				-->
			</ul>
			<!--
			  <div class="full span12 box clearfix">
			  	<div class="featurette-divider5"></div>
			  	<div class=span6>
			  		<img class="site-icons" src="images/design-tools.png">
			  	</div>
			  	<div class="span5">
			  		<h3 class="featurette-heading">Where<span class="muted"> ...</span></h3>
			  		<div class="well">
			  			<p class="lead"> - designs meet brilliance.</p>
			  			<p class=lead> - services attain excellence.</p>
			  			<p class=lead> - features acquire consistence.</p>
			  			<p class=lead> - codes obtain conformance.</p>
			  		</div>
			  	</div>
			  </div>
			-->
			<div class="full span12 box clearfix ">
				<div class="featurette-divider5"></div>
				<div class="span6">
					<img class="site-icons pull-left" src="images/synctube-icon3.png">
			</div>
				<div class="span5">
					<h3 class="featurette-heading">SyncTube<span class="muted"> - watch videos together</span></h3>
					<div class="well">
						<p class="lead">Our specialty is helping you integrate 3D printing to your business at an appropriate level of cost and commitment, applying this technology to create new products, broaden your offering, or simplify your supply chain. We do this by offering a range of services from custom parts to in-house 3d printing systems and software.</p>
						<a href='synctube/' class="btn btn-block btn-primary">Go to site</a>
					</div>
				</div>
			</div>
			<div class="full span12 box clearfix ">
				<div class="featurette-divider5"></div>
				<div class="span6">
					<img class="site-icons pull-right" src="images/trump-icon3.png">
				</div>
				<div class="span5">
					<h3 class="featurette-heading">Trump<span class="muted"> - multiplayer card game</span></h3>
					<div class="well"><p class="lead">Our goal is to make the process of 3d Printing, from content to fabrication, as simple and intuitive as possible. We are here to walk you through every step of the process and make sure you are getting the exact pieces you want.</p>
					<p class=lead></p>
					<a href='trump/' class="btn btn-block btn-custom4">Go to site</a></div>
				</div>
			</div>
			<div class="full span12 box clearfix ">
				<div class="featurette-divider5"></div>
				<div class="span6">
					<img class="site-icons pull-left" src="images/money-icon2.png">
				</div>
				<div class="span5">
					<h3 class="featurette-heading">Money Matters<span class="muted"> - manage your expenses</span></h3>
					<div class="well"><p class="lead">Our goal is to make the process of 3d Printing, from content to fabrication, as simple and intuitive as possible. We are here to walk you through every step of the process and make sure you are getting the exact pieces you want.</p>
					<p class=lead></p>
					<a href='money/summary.php' class="btn btn-block btn-custom5">Go to site</a></div>
				</div>
			</div>
			<div class="full span12 box clearfix ">
				<div class="featurette-divider5"></div>
				<div class="span6">
					<img class="site-icons pull-right" src="images/music-icon2.png">
				</div>
				<div class="span5">
					<h3 class="featurette-heading">MP3raze<span class="muted"> - listen to your favorite music</span></h3>
					<div class="well"><p class="lead">Our goal is to make the process of 3d Printing, from content to fabrication, as simple and intuitive as possible. We are here to walk you through every step of the process and make sure you are getting the exact pieces you want.</p>
					<p class=lead></p>
					<a href='audio/' class="btn btn-block btn-custom3">Go to site</a></div>
				</div>
			</div>

			<!--
			  <div class="full span12 box clearfix ">
			  	<div class="featurette-divider5"></div>
			  	<div class="span6">
			  		<img class="site-icons pull-left" src="images/warning.png">
			  	</div>
			  	<div class="span5">
			  		<h3 class="featurette-heading">And lastly, this one. <span class="muted">Get in touch.</span></h3>
			  		<div class="well"><p class="lead">Like us or tweet about us.</p></div>
			  	</div>
			  </div>
			-->

		</div><!-- /.container -->
		<?require_once("include/footers.php");?>
	</body>
</html>

