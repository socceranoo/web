<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<?require_once("include/pfheaders.php");?>
	</head>
	<body class=background-white>
		<?require_once("include/header.php");?>
		<div class="container">
			<div id=myCarousel class="row carousel slide">
				<ul class="inline carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1" class=""></li>
					<li data-target="#myCarousel" data-slide-to="2" class=""></li>
					<li data-target="#myCarousel" data-slide-to="3" class=""></li>
					<li data-target="#myCarousel" data-slide-to="4" class=""></li>
					<!--
					-->
				</ul>
				<br/><br/>
				<div class="carousel-inner">
					<div class="item active">
						<div class="featurette clearfix">
							<img class=" pull-right featurette-image" src="../images/energy-icon.png" alt="" />
							<h2 class="featurette-heading">Alveo Energy</h2>
							<p class=lead1>A simple flat and responsive website for the company Alveo Energy © - an early-stage startup based in the SF bay area that is developing a new high power, long cycle life, low-cost battery technology for stationary and select transit applications.</p>
							<a class="btn details-button btn-success btn-large" href="#alveo-modal" data-toggle=modal >View details</a>
							<p></p>
						</div>
						<a class="left pull-left arousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
						<a class="right pull-right arousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
						<hr class=featurette-divider />
					</div>
					<div class="item">
						<div class="featurette clearfix">
							<img class="pull-left featurette-image" src="../images/synctube-icon2.png" alt="" />
							<h2 class="featurette-heading">SyncTube</h2>
							<p class=lead1>A free, online streaming website for watching youtube videos with your friends at the same time from anywhere.</p>
							<a class="btn details-button btn-success btn-large" href="#razer-modal" data-toggle=modal >View details</a>
							<p></p>
						</div>
						<a class="left pull-left arousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
						<a class="right pull-right arousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
						<hr class=featurette-divider />
					</div>
					<div class="item">
						<div class="featurette clearfix">
							<img class=" pull-right featurette-image" src="../images/money-icon2.png" alt="" />
							<h2 class="featurette-heading">Money Matters</h2>
							<p class=lead1>A simple online solution for money management, expense reporting tool where friends and roommates can track where their money is and how much to pay each other or how much to be paid back. All registered users have access to the tool and can add other registered users as their friends.</p>
							<a class="btn details-button btn-success btn-large" href="#money-modal" data-toggle=modal >View details</a>
							<p></p>
						</div>
						<a class="left pull-left arousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
						<a class="right pull-right arousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
						<hr class=featurette-divider />
					</div>
					<div class="item">
						<div class="featurette clearfix">
							<img class=" pull-left featurette-image " src="../images/music-icon2.png" alt="" />
							<h2 class="featurette-heading">mp3raZe</h2>
							<p class=lead1>A free, online music streaming website which was inspired from grooveshark. This site lets you search for songs, create, playlists and listen to them anywhere. All registered users have access to the tool and can add other registered users as their friends.</p>
							<a class="btn details-button btn-success btn-large" href="#razer-modal" data-toggle=modal >View details</a>
							<p></p>
						</div>
						<a class="left pull-left arousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
						<a class="right pull-right arousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
						<hr class=featurette-divider />
					</div>
					<div class="item">
						<div class="featurette clearfix">
							<img class="pull-right featurette-image" src="../images/trump-icon3.png" alt="" />
							<h2 class="featurette-heading">Trump</h2>
							<p class=lead1>This is an online multiplayer site for playing indian trick-taking card game. The game is a variant of spades where the order of the ranks are changed significantly (J, 9, A, 10, K, Q, 8, 7). Jack ranks the highest with 3 points and nine comes second with 2 and so on. The total points in the game is 28 and hence the name.</p>
							<a class="btn details-button btn-success btn-large" href="#trump-modal" data-toggle=modal >View details</a>
							<p></p>
						</div>
						<a class="left pull-left arousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
						<a class="right pull-right arousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
						<hr class=featurette-divider />
						<!--
						<div class="featurette clearfix">
							<img class=" " src="images/trump.jpg" alt="" />
							<h2 class="featurette-heading"></h2>
							<p class=lead1></p>
							<a class="btn details-button btn-danger btn-large" href="#trump-modal" data-toggle=modal ></a>
							<p></p>
						</div>
						-->
					</div>
				</div>
				<!--
				<a class="left pull-left arousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
				<a class="right pull-right arousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
				-->
			</div>
			<?require("content/trump.php");?>
			<?require("content/alveo.php");?>
			<?require("content/money.php");?>
			<?require("content/razer.php");?>
		</div>
		<?require_once("include/footer.php");?>
	</body>
	<?require_once("include/pffooters.php");?>
</html>	
