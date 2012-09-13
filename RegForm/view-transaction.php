<?PHP
	require_once("access.php");
	function get_args_from_variable($row)
	{
		$flag ="old";
		$args ="flag=".$flag."&id=".$row['id']."&event=".$row['event']."&desc=".$row['description']."&date=".$row['date']."&paid=".$row['paid']
			."&participants=".$row['participants']."&amount=".$row['amount'];
		return $args;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<?require_once("includes.php");?>
		<!--<meta http-equiv="refresh" content="60"/>-->
		<title>Transactions!!</title>
	</head>
	<body>
		<div id='other'>
		<div id='fg_membersite_content'>
			<h1><br><br><br>Transactions</h1>
			<?require_once("operations.php");?>
			<table class=imagetable align=center>
			<caption></caption>
			<tr><th>Event</th><th>Desc</th><th>Date</th><th>Paid</th><th>Participants</th><th>Amount</th></tr>
			<?PHP
				//require_once("money-table-exists.php");
				$result = $fgmembersite->RunQuery("SELECT * FROM $moneytable WHERE 
						(paid LIKE '%$uname%' OR participants LIKE '%$uname%')");
				// Get all the data from the "example" table
				// keeps getting the next row until there are no more to get
				while($row = mysql_fetch_array( $result )) 
				{
					// Print out the contents of each row into a table
					$args = get_args_from_variable($row);
					echo "<tr><td>";
					echo $row['event'];
					echo "<br/>";
					echo "<div class='short_explanation'><a href='add-bill.php?$args'>Edit</a></div>";
					echo "</td><td>";
					$str = $row['description'];
					if (strlen($str) > 20)
					{
						$str = substr($str,0,20)."...";
					}
					//echo $row['description'];
					echo $str;
					echo "</td><td>";
					echo $row['date'];
					echo "</td><td>";
					$paidarray = unserialize($row['paid']);
					foreach ($paidarray as $k)
					{
					      echo $k;       
					      echo "<br>";       
					}
					echo "</td><td>";
					$partarray = unserialize($row['participants']);
					foreach ($partarray as $k)
					{
					      echo $k;       
					      echo "<br>";       
					}
					echo "</td><td>";
					echo $row['amount'];
					echo "</td> </tr>";
				}
			?>
			</table>
		</div>
		</div>
	</body>
</html>

