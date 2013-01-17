<?PHP
	require_once("./include/membersite_config.php");
	function login(){
		global $fgmembersite;
		if($fgmembersite->CheckLogin()) {
			$fgmembersite->Logout();
			$fgmembersite->RedirectToURL("login.php");
			//$login = true;
		}
		if(isset($_POST['loginsubmit'])) {
			if($fgmembersite->Login()) {
				//$login = true;
				$fgmembersite->RedirectToURL("login-home.php");
			}
		}
	}
	function register() {
		global $fgmembersite;
		if(isset($_POST['registersubmit'])) {
			if($fgmembersite->RegisterUser()) {
				$fgmembersite->RedirectToURL("thank-you.html");
			}
		}
	}
	function resetpwd() {
		global $fgmembersite;
		if(isset($_POST['resetreqsubmit'])) {
		   if($fgmembersite->EmailResetPasswordLink()) {
				$fgmembersite->RedirectToURL("reset-pwd-link-sent.html");
				exit;
		   }
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<title>Login</title>
		<?require_once("include/headers.php");?>
	</head>
	<body class='login' id='loginbody' onload='logininit();'>
		<!--
		<img id='title' src="images/login-title-bg.png"/>
		-->
		<div id='iphone'>
			<!--
			-->
			<?require_once("loginform.php");?>
			<?require_once("regform.php");?>
			<?require_once("resetreqform.php");?>
			
			<div id='content'>
				<span id='register-success'>Thank you for registering. Your confirmation email is on its way. Please click the link in the email to complete the registration.Please check your spam folder if you do not see it in your inbox. Sorry for the inconvenience</span>
				<span id='resetreq-success'>An email is sent to your email address that contains the link to reset the password.Please check your spam if you do not find it in inbox</span>
			</div>
			<div id="well">
				<h2><strong id="slider"></strong><span>slide to sign in</span></h2>
			</div>
			<div id="homebutton" onclick="homebutton();"></div>
			<div id="lockbutton" onclick="lockbutton();"></div>
			<div id="blackscreen"></div>
			<div id="timearea">
				<span id='timer'></span><br/>
				<span id='date'></span>
			</div>
			<div id="batterymeter"></div>
		</div>
	</body>
</html>
