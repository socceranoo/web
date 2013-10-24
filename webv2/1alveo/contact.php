<!DOCTYPE html>
<html lang="en">
	<meta charset="UTF-8">
	<title></title>
	<head>
	<title>Alveo Energy</title>
	<!--#include virtual="include/alveoheaders.php" -->
	<?require_once("include/alveoheaders.php");?>
	</head>
	<body class=alveo>
		<div class="main-container">
			<?require_once("include/header.php");?>
			<div class="maincontent">
				<div class="pagecontent">
					<h2>Contact Us</h2>
					<div class="twothird test height-300 fl-left">
						<p>We are located at 180 Elm Ct #506, Sunnyvale, California.</p>
						<p>Alveo may hire a limited number of technical interns to work during summer, 2013. These short-term positions will involve hands-on lab work building and testing batteries. Talented interns may be offered long-term positions. If you are interested in a summer internship at Alveo, please contact us as <a href="mailto:jobs@alveoenergy.com">jobs@alveoenergy.com</a>.
						<!--<a id="contact" href="mailto:info@alveoenergy.com">Contact Us</a>-->
					</div>
					<div class="onethird test height-300 fl-right">
						<?require("include/map.php");?>
					</div>
					<div class=cleardiv></div>
					<form id="contact-form">
					<fieldset >
					<!--
					<legend>Contact Us</legend><br/>
					-->
						<div class="onehalf test fl-left" id="div-form">
							<br/><label>Your name*:</label><br/>
							<input type='text' id='contact-name' maxlength="50" value="" required placeholder="<enter your name>"><br/>
							<br/><label>Your email*:</label><br/>
							<input type='email' id='contact-email' value="" required placeholder="<enter your email address>"><br/>
							<input type='hidden' id='contact-hidden' value="ONE"><br/>
						</div>
						<div class="onehalf test fl-right" id="div-form2">
							<br/><label>Your message*:</label><br/>
							<textarea id='contact-message' maxlength="500" required placeholder="<enter your message>"></textarea><br/>
							<input type='submit' id="contact-submit" value='send' />
						</div>
					</fieldset>
					</form>
					<div class=cleardiv></div>
				</div>
			</div>
		</div>
		<?require_once("include/footer2.php");?>
	</body>
</html>
