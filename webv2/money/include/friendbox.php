<?PHP
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/membersite_config.php");
	function print_friends($user) {
		global $fgmembersite, $pairtable;
		$result = $fgmembersite->RunQuery("SELECT * FROM $pairtable WHERE (user1='$user' or user2='$user') ORDER BY user1");
		$i=0;
		if (mysql_num_rows($result) > 0){
			echo "<h3>Friends list\t</h3>";
		}
		while($row = mysql_fetch_array( $result )) {
			if ($row['user1'] == $user)
				$user2=$row['user2'];
			else if($row['user2'] == $user)
				$user2=$row['user1'];
			$result2 = $fgmembersite->RunQuery("SELECT name from regusers where username='$user2'");
			$row2 = mysql_fetch_array( $result2);
			$user2 = $row2['name'];
			echo "<li><a id=sfrend$i class=userclick href='JavaScript:(void);'>$user2</a></li>";
			$i++;
		}
	}
?>
	<ul class='box operations' id=friendbox>
	<?print_friends($uname);?>
	</ul>
