<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<title>Manjunath | Front End Developer</title>
		<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/headers.php");?>
		<?require_once("./include/pfheaders.php");?>
	</head>
	<body>
		<?//require_once("header.php");?>
		<div id="bl-main" class="bl-main">
			<section>
				<div class="bl-box">
					<div class="bl-icon bl-icon-about"><h2>About</h2></div>
				</div>
				<div class="bl-content">
					<h2>About</h2>
					<?require_once("include/about.php");?>
				</div>
				<span class="bl-icon bl-icon-close"></span>
			</section>
			<section>
				<div class="bl-box">
					<div class="bl-icon bl-icon-works"><h2>Works</h2></div>
				</div>
				<div class="bl-content" id='work-content'>
					<h2>My Works</h2>
					<?require_once("include/project.php");?>
				</div>
				<span class="bl-icon bl-icon-close"></span>
			</section>
			<section>
				<div class="bl-box">
					<div class="bl-icon bl-icon-blog"><h2>Blog</h2></div>
				</div>
				<div class="bl-content">
					<h2>My Blog</h2>
					<?//require_once("include/blog.php");?>
				</div>
				<span class="bl-icon bl-icon-close"></span>
			</section>
			<section>
				<div class="bl-box">
					<div class="bl-icon bl-icon-contact"><h2>Contact</h2></div>
				</div>
				<div class="bl-content">
					<h2>Get in touch</h2>
					<?require_once("include/contact.php");?>
					<?require_once("include/footer.php");?>
				</div>
				<span class="bl-icon bl-icon-close"></span>
			</section>
		</div>
		<div class="hidden">
		</div>
	</body>
</html>	
