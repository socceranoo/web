<?PHP
	require_once("access.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<!--<meta http-equiv="refresh" content="60"/>-->
		<title>Welcome!!</title>
		<link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
		<script src="scripts/jquery.js"></script>
		<script> 
			function loadContent() 
			{ 
				$("#includedContent").load("tux.php"); 
			} 
			window.setTimeout("updateTime()", 0);// start immediately
			window.setInterval("updateTime()", 1000);// update every second
			window.setInterval("loadContent()", 60000);// update every second
			function updateTime() 
			{
				document.getElementById("theTimer").firstChild.nodeValue =
				new Date().toTimeString().substring(0, 8);
			}
		</script>

	</head>
	<body>
		<div id='homepage'>
		<div id='fg_membersite_content'>
			<h1><br><br><br>Welcome to Bill _____</h1>
			<div id='operations'>
			<p><a href='add-friend.php'>Add Friend(s)</a></p>
			<p><a href='add-bill.php'>Add Bill</a></p>
			<p><a href='add-friend.php'>View Transaction(s)</a></p>
			<p><a href='add-bill.php'>Edit Transactions</a></p>
			<p><a href='add-friend.php'>View Friend(s)</a></p>
			<p><a href='add-bill.php'>Edit Friends</a></p>
			</div>
			<table border='2'  cellpadding='20' align=center>
			<caption></caption>
			<tr><th>Who ???</th><th>How much ???</th><th>Status</th> </tr>
			<?PHP
				require_once("table-exists.php");
				$result = $fgmembersite->RunQuery("SELECT * FROM $uname");
				// Get all the data from the "example" table
				// keeps getting the next row until there are no more to get
				while($row = mysql_fetch_array( $result )) 
				{
					// Print out the contents of each row into a table
					echo "<tr><td>";
					echo $row['user2'];
					echo "</td><td>";
					echo $row['amount'];
					echo "</td><td>";
					if ($row['amount'] > 0 )
						echo "Owes you";
					else if ($row['amount'] < 0 )
						echo "You owe";
					else
						echo "Even";
					echo "</td> </tr>";
				}
			?>
			</table>
			<div id='tuxcorner'>
				<div bold align=center id="theTimer">00:00:00</div>
				<div id="includedContent"></div>
				<script>loadContent()</script>
				<button onclick="loadContent()">Change my thought</button>
			</div>
		</div>

		</div>
	</body>
</html>
