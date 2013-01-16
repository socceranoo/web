<?PHP
	require_once("./include/membersite_config.php");
	function login(){
		global $fgmembersite;
		if($fgmembersite->CheckLogin()) {
			$fgmembersite->Logout();
			$fgmembersite->RedirectToURL("login.php");
			//$login = true;
		}
		if(isset($_POST['submitted'])) {
			if($fgmembersite->Login()) {
				//$login = true;
				$fgmembersite->RedirectToURL("login-home.php");
			}
		}
	}
	function register() {
		global $fgmembersite;
		if(isset($_POST['submitted'])) {
			if($fgmembersite->RegisterUser()) {
				$fgmembersite->RedirectToURL("thank-you.html");
			}
		}
	}
	function resetpwd() {
		global $fgmembersite;
		if(isset($_POST['submitted'])) {
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
	<script>
	var isChrome = testCSS('WebkitTransform');  // Chrome 1+
	function testCSS(prop) {
	    return prop in document.documentElement.style;
	}
	if (!isChrome && false)
		//setTimeout("window.location='notsupported.php'",1);
	</script>
	</head>
	<body class='login' onload='logininit();'>
		<!--
		<img id='title' src="images/login-title-bg.png"/>
		-->
		<div id='webv2'>
		<?require_once("loginform.php");?>
		<?require_once("regform.php");?>
		<?require_once("forgotpwdform.php");?>
		</div>
		<div id="well">
			<h2><strong id="slider"></strong><span>slide to unlock</span></h2>
		</div>
	</body>
</html>
