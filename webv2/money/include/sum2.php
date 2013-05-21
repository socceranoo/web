<?PHP
$owesyou=0;
$youowe=0;
$result = $fgmembersite->RunQuery("SELECT * FROM $pairtable WHERE user1='$uname' or user2='$uname' ORDER BY user1");
if (mysql_num_rows($result) > 0) {
	echo "<table id='gradient-style' align=center>";
	echo "<tr><th>Who</th><th>How much</th><th>Status</th></tr>";
	while($row = mysql_fetch_array( $result )) 
	{
		echo "<tr><td>";
		if ($row['user1'] == $uname)
			$user2=$row['user2'];
		else if($row['user2'] == $uname)
			$user2=$row['user1'];
		echo "<a href=view-transaction.php?page=cur&user=$user2>";
		echo $user2;
		echo "</a>";
		echo "</td><td>";
		echo "$".abs($row['amount']);
		echo "</td><td>";
		if ($uname < $user2)	
		{
			if ($row['amount'] > 0 )
			{
				$owesyou+=$row['amount'];
				echo "Owes you";
			}
			else if ($row['amount'] < 0 )
			{
				$youowe+=abs($row['amount']);
				echo "You owe";
			}
			else
				echo "Even";
		}
		else {
			if ($row['amount'] > 0 )
			{
				$youowe+=$row['amount'];
				echo "You owe";
			}
			else if ($row['amount'] < 0 )
			{
				$owesyou+=abs($row['amount']);
				echo "Owes you";
			}
			else
				echo "Even";
		}	
		echo "</td> </tr>";
	}
	echo "</table>";
}
?>
<p align='center'>TOTAL<br/>
OTHERS OWE: $<?echo $owesyou?><br/>
YOU OWE: $<?echo $youowe?></p>
