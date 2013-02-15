<?PHP
	require_once("./include/membersite_config.php");
	/*
	if($fgmembersite->CheckLogin()) {
		$fgmembersite->RedirectToURL("login.php");
	}*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<title>Home</title>
		<?require_once("include/headers.php");?>
		<?require_once("include/homeheaders.php");?>
	</head>
	<body class='home' id='homebody'>
	<?require_once("topmenu.php");?>
	<div id='imac2' class="imac">
		<img src="images/imac2.png" alt="">
		<div class='macscreen' id="macscreen1">
			<div class="divholder">
			<?require_once("insertdivs.php");?>
			</div>
		</div>
	</div>
<!-- YOUR CONTENT HERE
<p>
Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
</p>
-->
</div>
</body>
</html>
