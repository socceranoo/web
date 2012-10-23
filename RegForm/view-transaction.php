<?PHP
	require_once("access.php");
	$page = $_REQUEST['page'];
	if ($page == "cur")
		$table = $moneytable;
	else
		$table = $deletedtable;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<?require_once("includes.php");?>
		<!--<meta http-equiv="refresh" content="60"/>-->
		<title>Transactions!!</title>
	</head>
	<body class='transactions'>
		<div id='other'>
		<div id='fg_membersite_content'>
			<h1><br><br><br><?if ($page == "cur")print "Transactions";else print "Deleted Transactions";?></h1>
			<?require_once("rest-elements.php");?>
			<table class=imagetable align=center>
			<table id="gradient-style" align=center>
			<caption></caption>
			<?PHP
				if (isset($_REQUEST['user']))
				{
					$user = $_REQUEST['user'];
					$qry ="SELECT * FROM $table WHERE (paid LIKE '%$uname%' AND participants LIKE '%$user%')"
					."OR (paid LIKE '%$user%' AND participants LIKE '%$uname%') ORDER BY date DESC";
					$result = $fgmembersite->RunQuery($qry);
				}
				else
				{
					$result = $fgmembersite->RunQuery("SELECT * FROM $table WHERE 
						(paid LIKE '%$uname%' OR participants LIKE '%$uname%') ORDER BY date DESC");
				}
				if (mysql_num_rows($result) > 0)
					echo "<tr><th>Event</th><th>Description</th><th>Date</th><th>Paid</th><th>Participants</th><th>Amount</th></tr>";
				while($row = mysql_fetch_array( $result )) 
				{
					// Print out the contents of each row into a table
					echo "<tr><td>";
					echo $row['event'];
					echo "<br/>";
					if ($page == "cur")
					{
						$args = get_args_from_variable($row);
						echo "<div class='short_explanation'><a href='add-bill.php?$args'>edit</a></div>";
						$args1 = "id=".$row['id'];
						echo "<div class='short_explanation'><a href='delete-bill.php?$args1'>delete</a></div>";
					}
					else
					{
						$args1 = "id=".$row['id'];
						echo "<div class='short_explanation'><a href='revive-bill.php?$args1'>revive</a></div>";
					}
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

