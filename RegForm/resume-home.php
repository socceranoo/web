<?PHP
	$public=false;
	$page = $_REQUEST['page'];
        if ($page == "public")
	{
		$public=true;	
		if (!isset($_REQUEST['uid']))
		{
			header("Location: login.php");
			exit;
		}
		$userid=$_REQUEST['uid'];
		$resumetable="resume";
	}
	else
		require_once("access.php");
	require_once("resumecontent.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<?require_once("includes.php");?>
		<title>My Profile</title>
	</head>
	<body class='home' onload="resumeinit();">
	<div class="centeronly">
		<div class="headingbar">
			<?put_heading_bar($public);?>
		</div>
		<?put_contents($public);?>
	</div>
	<script>resumeajaxinit();</script>
	</body>
</html>
