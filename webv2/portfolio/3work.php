<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<?require_once("include/pfheaders.php");?>
	</head>
	<body class=background-white>
		<?require_once("include/header.php");?>
		<div class="container">
			<div id=myCarousel class="well background-clouds row text-center carousel slide">
				<ul class="inline carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1" class=""></li>
					<li data-target="#myCarousel" data-slide-to="2" class=""></li>
					<!--
					-->
				</ul>
				<br/><br/>
				<div class="carousel-inner">
					<div class="item active">
						<div class="span4 offset1 background-sunFlower">
							<h2 class="text-center">Alveo Energy</h2>
							<img class="img-circle " src="images/alveo3.jpg" alt="" />
							<p>A simple flat and responsive website for the company Alveo Energy © - an early-stage startup based in the SF bay area that is developing a new high power, long cycle life, low-cost battery technology for stationary and select transit applications.</p>
							<a class="btn btn-inverse" href="#alveo-modal" data-toggle=modal >View details</a>
							<p></p>
						</div>
						<div class="span4 offset2 background-emerald">
							<h2 class="text-center">Money Matters</h2>
							<img class="img-circle " src="images/money3.jpg" alt="" />
							<p>A simple online solution for money management, expense reporting tool where friends and roommates can track where their money is and how much to pay each other or how much to be paid back. All registered users have access to the tool and can add other registered users as their friends.</p>
							<a class="btn btn-inverse" href="#money-modal" data-toggle=modal >View details</a>
							<p></p>
						</div>
					</div>
					<div class="item">
						<div class="span4 offset1 background-peterRiver">
							<h2 class="text-center">mp3raZe</h2>
							<img class="img-circle " src="images/razer2.jpg" alt="" />
							<p>A free, online music streaming website which was inspired from grooveshark. This site lets you search for songs, create, playlists and listen to them anywhere. All registered users have access to the tool and can add other registered users as their friends.</p>
							<a class="btn btn-inverse" href="#razer-modal" data-toggle=modal >View details</a>
							<p></p>
						</div>
						<div class="span4 offset2 background-carrot">
							<h2 class="text-center">Trump</h2>
							<img class="img-circle " src="images/trump.jpg" alt="" />
							<p>This is an online multiplayer site for playing indian trick-taking card game. The game is a variant of spades where the order of the ranks are changed significantly (J, 9, A, 10, K, Q, 8, 7). Jack ranks the highest with 3 points and nine comes second with 2 and so on. The total points in the game is 28 and hence the name.</p>
							<a class="btn btn-inverse" href="#trump-modal" data-toggle=modal >View details</a>
							<p></p>
						</div>
					</div>
					<div class="item">
						<div class="span4 offset1 background-peterRiver">
							<h2 class="text-center">SyncTube</h2>
							<img class="img-circle " src="images/razer2.jpg" alt="" />
							<p>A free, online streaming website for watching youtube videos with your friends at the same time from anywhere.</p>
							<a class="btn btn-inverse" href="#razer-modal" data-toggle=modal >View details</a>
							<p></p>
						</div>
						<!--
						<div class="span4 offset2 background-carrot">
							<h2 class="text-center">Trump</h2>
							<img class="img-circle " src="images/trump.jpg" alt="" />
							<p>This is an online multiplayer site for playing indian trick-taking card game. The game is a variant of spades where the order of the ranks are changed significantly (J, 9, A, 10, K, Q, 8, 7). Jack ranks the highest with 3 points and nine comes second with 2 and so on. The total points in the game is 28 and hence the name.</p>
							<a class="btn btn-inverse" href="#trump-modal" data-toggle=modal >View details</a>
							<p></p>
						</div>
						-->
					</div>
				</div>
				<a class="left carousel-control" href="#myCarousel" data-slide="prev">&lsaquo;</a>
				<a class="right carousel-control" href="#myCarousel" data-slide="next">&rsaquo;</a>
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
