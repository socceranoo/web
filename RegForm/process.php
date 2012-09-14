<?PHP
	require_once("access.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<?require_once("includes.php");?>
		<title>Done</title>
	</head>
	<body>
		<div id='other'>
		<div id='fg_membersite_content'>
			<br><br><br>
			<h3>Done!</h3>
			<?php 
				foreach ($_POST["jumpmenu"] as $k)
				{	
					if ($uname < $k)
					{
						$user1=$uname;
						$user2=$k;
					}
					else
					{
						$user2=$uname;
						$user1=$k;
					}
					$qry = "select id from $pairtable where user1='$user1' and user2='$user2'";
					$result =$fgmembersite->RunQuery($qry);
					$row = mysql_fetch_array( $result );
					if ($row['id'] > 0)
					{
						print "User $k is already added to your profile\n";
					}
					else
					{
						create_entry_in_pair_table($user1, $user2);
						print "User $k is added to your profile\n";
					}
					print "<br>";
				}
				$fgmembersite->RedirectToURL("login-home.php");
			?>
		</div>
		</div>
	</body>
</html>
