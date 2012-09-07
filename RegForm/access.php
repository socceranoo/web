<?PHP
	require_once($_SERVER['DOCUMENT_ROOT']."RegForm/include/membersite_config.php");
	if(!$fgmembersite->CheckLogin())
	{
	    $fgmembersite->RedirectToURL("login.php");
	    exit;
	}
	$uname = $fgmembersite->UserName();
	// Make a MySQL Connection
	//mysql_connect("localhost", "root", "Orange") or die(mysql_error());
	//mysql_select_db("Main") or die(mysql_error());
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<style type="text/css">
			/*this is what we want the div to look like*/
			div.topright
			{
				display:block;
				/*set the div in the top right corner*/
				position:absolute;
				top:0;
				right:0;
				width:400px;
				/*give it some background and border*/
				/*background:#eee;
				border:1px solid #eee;
				*/
			}
		</style>
	</head>
	<body>
		<div class="topright">
			<p>
				logged in(<?= $fgmembersite->UserName() ?>)
				&nbsp;
				<a href='login-home.php'>home</a>
				&nbsp;
				<a href='logout.php'>logout</a>
				&nbsp;
				<a href='change-pwd.php'>change password</a>
			</p>
		</div>
	</body>
</html>
