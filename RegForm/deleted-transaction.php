<?PHP
	require_once("access.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<?require_once("includes.php");?>
		<!--<meta http-equiv="refresh" content="60"/>-->
		<title>Deleted Transactions</title>
	</head>
	<body>
		<div id='other'>
		<div id='fg_membersite_content'>
			<h1><br><br><br>Deleted Transactions</h1>
			<?require_once("rest-elements.php");?>
			<table class=imagetable align=center>
			<caption></caption>
			<tr><th>Event</th><th>Description</th><th>Date</th><th>Paid</th><th>Participants</th><th>Amount</th></tr>
			<?PHP
				$table = $deletedtable;
				$result = $fgmembersite->RunQuery("SELECT * FROM $table WHERE 
						(paid LIKE '%$uname%' OR participants LIKE '%$uname%')");
				while($row = mysql_fetch_array( $result )) 
				{
					// Print out the contents of each row into a table
					echo "<tr><td>";
					echo $row['event'];
					echo "<br/>";
					$args1 = "id=".$row['id'];
					echo "<div class='short_explanation'><a href='revive-bill.php?$args1'>revive</a></div>";
					echo "</td><td>";
					$str = $row['description'];
					if (strlen($str) > 20)
					{
						$str = substr($str,0,20)."...";
					}
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

