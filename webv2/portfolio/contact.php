<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<?require_once("include/pfheaders.php");?>
	</head>
	<body class=background-white>
		<?require_once("include/header.php");?>
		<div class="container">
			<div class="row">
				<div class="span12 text-center">
					<h3 class="text-center"><span class="uted">Got a website idea or just want to say hi ?</span></h3>
					<div class="span6 well offset3 text-center">
							<ul class="inline">
								<li><a target='_blank' href="https://twitter.com/socceranoo"><img src="images/twitter-black.png" alt="" /></a></li>
								<li><a target='_blank' href="https://www.linkedin.com/pub/manjunath-mageswaran/14/466/372/"><img src="images/linkedin-black.png" alt="" /></a></li>
								<li><a target='_blank' href="https://facebook.com/socceranoo"><img src="images/facebook-black.png" alt="" /></a></li>
								<li><a target='_blank' href="https://plus.google.com/socceranoo/"><img src="images/gplus-black.png" alt="" /></a></li>
								<li><a target='_blank' href="files/resume.pdf"><img src="images/resume-black.png" alt="" /></a></li>
								<li><a href="javascript:void(0);" id=modal-form><img src="images/gmail-black.png" alt="" /></a></li>
							</ul>
						<p class="lead"></p>
					</div>
					<div id='form-div' class="modal hide fade out background-white well1" style="display:none">
						<div class="modal-header">
							<a class="close" data-dismiss="modal">x</a>
							<h2 class="featurette-heading"><span class="muted">Send me an email.</span></h2>
						</div>
						<div class="modal-body">
							<form id="contact-form" class=form-horizontal>
								<div class="control-group">
									<label class="control-label" for="contact-name">Your name*</label>
									<div class="controls"><input type='text' id='contact-name' value="" required ></div>
								</div>
								<div class="control-group">
									<label class="control-label" for="contact-email">Your email*</label>
									<div class="controls"><input type='email' id='contact-email' value="" required></div>
								</div>
								<div class="control-group">
									<label class="control-label" for="contact-message">Your message*</label>
									<div class="controls"><textarea id='contact-message' maxlength="300" rows=3 required></textarea></div>
								</div>
								<div class="control-group">
									<label class="control-label" for="contact-submit"></label>
									<div class="controls">
										<input type='submit' id="contact-submit" class="btn btn-block btn-success" value='send' />
										<input type='hidden' id='contact-hidden' value="ONE"><br/>
									</div>
								</div>
							</form>
						</div>
						<div class="modal-footer">
							<p id=msgsent style="display:none" class="lead text-center">Your message has been sent</p><br/>
						</div>
					</div>
				</div>
			</div>
			<hr class="featurette-divider2" />
			<?require_once("include/footer.php");?>
		</div>
	</body>
	<?require_once("include/pffooters.php");?>
</html>	
