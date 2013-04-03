<?PHP
	$highl ="class=\"highlight\"";
	$li3=$highl;
	/*
	$name="asdasdas";
	$email="socceranoo@123.com";
	$message ="Hi how are you";
	*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<title>Manjunath | Front End Developer</title>
		<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/headers.php");?>
		<?require_once("./include/pfheaders.php");?>
	</head>
	<body class='portfolio' id='pfbody'>
		<?require_once("header.php");?>
		<div id="wrapper">			
			<div id="content">
			<div class="fullcontent"><img src="images/bwfifa13-1.png"/></div>
			<form id="contact-form">
				<legend>Send me an email</legend><br/>
				<fieldset >
				<div class="halfcontent" id="div-form">
						<label for='name' >Your name*:</label><br/>
						<input type='text' id='name' maxlength="50" value="<?echo $name ;?>" required placeholder="<enter your name>"><br/>
						<label for='email' >Your email*:</label><br/>
						<input type='email' id='email' value="<?echo $email;?>" required placeholder="<enter your email address>"><br/>
						<input type='hidden' id='hidden' value="ONE"><br/>
				</div>
				<div class="halfcontent" id="div-form2">
					<label for='message' >Your message*:</label><br/>
					<textarea id='message' maxlength="500" required placeholder="<enter your message>"><? echo $message;?></textarea><br/>
					<input type='submit' id="submit" value='send' />
				</div>
				</fieldset>
			</form>
			<div class="pagediv" id="msgsent"><p>Your message has been sent<br/><p style="cursor:pointer;" onclick="another_message();">Send another message</p></p></div>
			<div class="pagediv"><p></p></div>
			</div>
		</div>
		<?require_once("footer.php");?>
	</body>
</html>	
