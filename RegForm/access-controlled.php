<?PHP
	require_once("access.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<?require_once("includes.php");?>
		<!--<meta http-equiv="refresh" content="60"/>-->
		<title>Welcome!!</title>
		<script>
			window.setTimeout("updateTime()", 0);// start immediately
			window.setInterval("updateTime()", 1000);// update every second
			window.setInterval("loadContent('#includedContent', 'tux.php')", 30000);// update every second
					
		</script>
		<!--<script type="text/javascript" src="scripts/tumblr.js" ></script>-->
	</head>
	<body>
		<div id='homepage'>
		<div id='fg_membersite_content'>
			<h1><br><br><br>money Matters</h1>
			<?require_once("operations.php");?>
			<table class="imagetable" align=center>
			<caption></caption>
			<?PHP
				$result = $fgmembersite->RunQuery("SELECT * FROM $pairtable WHERE user1='$uname' or user2='$uname'");
				if (mysql_num_rows($result) > 0)
					echo "<tr><th>Who ???</th><th>How much ???</th><th>Status</th></tr>";
				while($row = mysql_fetch_array( $result )) 
				{
					echo "<tr><td>";
					if ($row['user1'] == $uname)
						$user2=$row['user2'];
					else if($row['user2'] == $uname)
						$user2=$row['user1'];
					echo $user2;
					echo "</td><td>";
					echo abs($row['amount']);
					echo "</td><td>";
					if ($uname < $user2)	
					{
						if ($row['amount'] > 0 )
							echo "Owes you";
						else if ($row['amount'] < 0 )
							echo "You owe";
						else
							echo "Even";
					}
					else
					{
						if ($row['amount'] > 0 )
							echo "You owe";
						else if ($row['amount'] < 0 )
							echo "Owes you";
						else
							echo "Even";
					}	
					echo "</td> </tr>";
				}
			?>
			</table>
			<div id='tuxcorner'>
				<div bold align=center id="theTimer">00:00:00</div>
				<div id="includedContent"></div>
				<script>loadContent('#includedContent', 'tux.php')</script>
				<button onclick="loadContent('#includedContent', 'tux.php')">change</button>
			</div>
		</div>

		</div>
	</body>
</html>
