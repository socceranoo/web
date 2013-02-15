<?PHP
	require_once("./include/membersite_config.php");
	if(!$fgmembersite->CheckLogin()) {
		$fgmembersite->RedirectToURL("login.php");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<title>Home</title>
		<?require_once("include/headers.php");?>
		<?require_once("include/homeheaders.php");?>
	</head>
	<body class='home' id='homebody' onload="homeinit();">
	<div class='curtain_wrapper'>
	<div class='desc' id='open'>OPEN</div>
	<?require_once("topmenu.php");?>
	<img class='curtain curtainLeft' src='images/curtainLeft3.jpg' />
    <img class='curtain curtainRight' src='images/curtainRight3.jpg' />
	<!--
	-->
	<div id='imac1' class="imac">
		<img src="images/imac2.png" alt="">
		<div class='macscreen'>
		<img class='imgholder'>
		<?require_once("pictures.php");?>
		</div>
	</div>
<!-- YOUR CONTENT HERE
		<img id='rarrow' class="arrow arrowright" src="images/righthand.png">
		<img id='larrow' class="arrow arrowleft" src="images/lefthand.png">
<p>
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
</p>
-->
</div>
</body>
</html>
