<?PHP
	require_once("access.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<title>Done</title>
		<link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
	</head>
	<body>
		<div id='fg_membersite_content'>
			<h2>Done!</h2>
			<?php 
				if(!mysql_query("DESCRIBE `$uname`")) 
				{
					$qry = "Create Table $uname (".
					"id INT NOT NULL AUTO_INCREMENT ,".
					"user1 VARCHAR( 16 ) NOT NULL ,".
					"user2 VARCHAR( 16 ) NOT NULL ,".
					"amount INT NOT NULL ,".
					"flag VARCHAR(10) NOT NULL ,".
					"PRIMARY KEY ( id )".
					")";
					mysql_query($qry) or die(mysql_error());
				}
				foreach ($_POST["jumpmenu"] as $k)
				{	
					$qry = "select id from $uname where user2='$k'";
					$result = mysql_query($qry);
					$row = mysql_fetch_array( $result );
					if ($row['id'] > 0)
					{
						print "User $k is already added to your profile\n";
					}
					else
					{
						$qry = "INSERT INTO $uname (user1, user2, amount, flag) ".
						"VALUES('$uname','$k','0','y')"; 
						mysql_query($qry) or die(mysql_error());
						print "User $k is added to your profile\n";
					}
					print "<br>";
				}
			?>
		</div>
	</body>
</html>
