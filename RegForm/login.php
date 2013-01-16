<?PHP
	$login = false;
	require_once("./include/membersite_config.php");
	if($fgmembersite->CheckLogin())
	{
		$fgmembersite->RedirectToURL("login-home.php");
		$login = true;
	}
	if(isset($_POST['submitted']))
	{
		if($fgmembersite->Login())
		{
			$login = true;
			$fgmembersite->RedirectToURL("login-home.php");
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<title>Login</title>
		<?require_once("includes.php");?>
		<?//require_once("topbar.php");?>
	<script>
	var isChrome = testCSS('WebkitTransform');  // Chrome 1+
	function testCSS(prop) {
	    return prop in document.documentElement.style;
	}
	if (!isChrome && false)
		setTimeout("window.location='notsupported.php'",1);
	</script>
	</head>
	<body class='login'>
		<?//require_once("bee.php");?>
		<div id='posRight'>
		<!-- Form Code Start >-->
		<div id='fg_membersite'>
			<form id='login' action='<?php echo $fgmembersite->GetSelfScript(); ?>' method='post' accept-charset='UTF-8' align=left>
				<fieldset >
					<legend>Login</legend>
					<input type='hidden' name='submitted' id='submitted' value='1'/>
					<div class='short_explanation'>* required fields</div>
					<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
					<div class='container'>
						<label for='username' >UserName*:</label><br/>
						<input type='text' name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
						<span id='login_username_errorloc' class='error'></span>
					</div>
					<div class='container'>
						<label for='password' >Password*:</label><br/>
						<input type='password' name='password' id='password' maxlength="50" /><br/>
						<span id='login_password_errorloc' class='error'></span>
					</div>
					<div class='container'>
						<input type='submit' name='Submit' value='Login' />
					</div>
					<div class='short_explanation'><a href='reset-pwd-req.php'>Forgot Password?</a></div>
					<div class='short_explanation'><a href='register.php'>New User?</a></div>
					<div class='short_explanation'><a href='confirmreg.php'>Confirm Registration</a></div>
					<div class='short_explanation'><a href='../home2.html'>About the Webmaster</a></div>
				</fieldset>
			</form>
			<!-- client-side Form Validations:
			Uses the excellent form validation script from JavaScript-coder.com-->

			<script type='text/javascript'>
				// <![CDATA[
				var frmvalidator  = new Validator("login");
				frmvalidator.EnableOnPageErrorDisplay();
				frmvalidator.EnableMsgsTogether();
				frmvalidator.addValidation("username","req","Please provide your username");
				frmvalidator.addValidation("password","req","Please provide the password");
				// ]]>
			</script>
		</div>
		</div>
	<div class='footer'>Copyright (c) 2012</div>
	</body>
</html>
