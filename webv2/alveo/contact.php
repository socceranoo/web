<!DOCTYPE html>
<html lang="en">
	<meta charset="UTF-8">
	<head>
	<?require_once("include/alveoheaders.php");?>
	</head>
	<body class=alveo>
		<?require_once("include/header.php");?>
		<div class="container alveo-container">
			<div class="row">
				<hr class="featurette-divider2" />
				<h2 class="text-center lead">Contact Us</h2>
				<div class="offset1 text-justify span6 well background-clouds1 test2 height-300">
					<p>We are located at 180 Elm Ct #506, Sunnyvale, California.</p>
					<p>Alveo may hire a limited number of technical interns to work during summer, 2013. These short-term positions will involve hands-on lab work building and testing batteries. Talented interns may be offered long-term positions. If you are interested in a summer internship at Alveo, please contact us as <a href="mailto:jobs@alveoenergy.com">jobs@alveoenergy.com</a>.
					<!--<a id="contact" href="mailto:info@alveoenergy.com">Contact Us</a>-->
				</div>
				<div class="span4 well background-clouds1 height-300">
					<?require("include/map.php");?>
				</div>
			</div>
			<hr class="featurette-divider2" />
			<div class="row">
				<form id="contact-form" class=form-horizontal>
					<div class="span6 offset1 well" id="div-form">
						<div class="control-group">
							<label class=control-label>Your name*:</label>
							<div class="controls"><input type='text' id='contact-name' value="" required placeholder="<enter your name>"></div>
						</div>
						<div class="control-group">
							<label class=control-label>Your email*:</label>
							<div class="controls"><input type='email' id='contact-email' value="" required placeholder="<enter your email address>"></div>
							<input type='hidden' id='contact-hidden' value="ONE">
						</div>
						<div class="control-group">
							<label class=control-label>Your message*:</label>
							<div class="controls">
								<textarea id='contact-message' required placeholder="<enter your message>"></textarea><p></p>
								<input type='submit' class="btn btn-primary" id="contact-submit" value='submit' />
							</div>
						</div>
					</div>
				</form>
			</div>
			<hr class="featurette-divider2" />
		</div>
		<?require_once("include/footer.php");?>
	</body>
</html>
