<?PHP
require_once("./include/membersite_config.php");
$fgmembersite->LogOut();
$fgmembersite->RedirectToURL("login.php");
?>
<html>
</html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
      <title>Logout</title>
      <link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css" />
      <script type='text/javascript' src='scripts/gen_validatorv31.js'></script>
</head>
	<div class='topright'>
<body>
	<div id='homepage'>
<h2>You have logged out</h2>
<p>
<a href='login.php'>Login Again</a>
</p>
</div>
</body>
</div>
</html>
