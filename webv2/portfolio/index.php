<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<title>Manjunath | Front End Developer</title>
		<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/headers.php");?>
		<?require_once("./include/pfheaders.php");?>
		<?require_once("./include/rgraph_headers.php");?>
	</head>
	<body>
		<?//require_once("header.php");?>
		<div id=emblem >
			<div class=anim-click id=gator-click></div>
			<div class=anim-click id=ubuntu-click></div>
			<div class=anim-click id=html-click></div>
			<div class=anim-click id=ball-click></div>
			<img id=moving-div />
		</div>
		<div id="bl-main" class="bl-main">
			<section id=section-about>
				<div class="bl-box">
					<div id=bl-icon-about class="bl-icon bl-icon-about"><h2>Mein</h2></div>
				</div>
				<div id=about-bl-content class="bl-content">
					<h2>&nbsp;</h2>
					<?require_once("include/about.php");?>
				</div>
			</section>
			<section id=section-works>
				<div class="bl-box">
					<div id=bl-icon-works class="bl-icon bl-icon-works"><h2>Work</h2></div>
				</div>
				<div class="bl-content" id='work-content'>
					<h2>&nbsp;</h2>
					<?require_once("include/project.php");?>
				</div>
			</section>
			<section id=section-blog>
				<div class="bl-box">
					<div id=bl-icon-blog class="bl-icon bl-icon-blog"><h2>Blog</h2></div>
				</div>
				<div class="bl-content">
					<h2>&nbsp;</h2>
					<?require_once("include/blog.php");?>
				</div>
			</section>
			<section id=section-contact>
				<div class="bl-box">
					<div id=bl-icon-contact class="bl-icon bl-icon-contact"><h2>Ping</h2></div>
				</div>
				<div class="bl-content">
					<h2>&nbsp;</h2>
					<?require_once("include/contact.php");?>
					<?require_once("include/footer.php");?>
				</div>
			</section>
		</div>
	</body>
</html>	
				<!--
				-->
