<?PHP
	require_once("./include/membersite_config.php");
	if(!$fgmembersite->CheckLogin()) {
		$fgmembersite->RedirectToURL("login.php");
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
		-->
		<div id='iphone'>
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
