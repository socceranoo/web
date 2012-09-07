<?PHP
	require_once("access.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<title>Welcome!!</title>
		<link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
	</head>
	<body>
		<div id='fg_membersite_content'>
			<h1 align=center>Welcome to Bill _____</h1>
			<p><a href='add-friend.php'>Add Friend(s)</a></p>
			<p><a href='add-bill.php'>Add Bill</a></p>
			<p>
			<?PHP
				require_once("table-exists.php");
				$result = $fgmembersite->RunQuery("SELECT * FROM $uname");
				// Get all the data from the "example" table
				echo "<table border='5'  cellpadding='30' align=left bgcolor='#F0F0FF' >";
				echo "<tr><th>Name</th><th>Amount</th><th>Status</th> </tr>";
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
				echo "</table>";
			?>
			</p>
		</div>
	</body>
</html>
