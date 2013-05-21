<div class="content">
	<div class="fullcontent"><img src="images/bwfifa13-1.png"/></div>
	<form id="contact-form">
		<legend>Send me an email</legend><br/>
		<fieldset >
			<div class="halfcontent left" id="div-form">
				<label>Your name*:</label><br/>
				<input type='text' id='contact-name' maxlength="50" value="" required placeholder="<enter your name>"><br/>
				<label>Your email*:</label><br/>
				<input type='email' id='contact-email' value="" required placeholder="<enter your email address>"><br/>
				<input type='hidden' id='contact-hidden' value="ONE"><br/>
			</div>
			<div class="halfcontent right" id="div-form2">
				<label>Your message*:</label><br/>
				<textarea id='contact-message' maxlength="500" required placeholder="<enter your message>"></textarea><br/>
				<input type='submit' id="contact-submit" value='send' />
			</div>
		</fieldset>
	</form>
	<div class="pagediv" id="msgsent"><p>Your message has been sent<br/><p style="cursor:pointer;" onclick="another_message();">Send another message</p></p></div>
</div>
