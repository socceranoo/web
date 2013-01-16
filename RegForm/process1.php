<?PHP
	require_once("access.php");
	$emailarray = $_POST['dat'];
	$val="";
	foreach ($emailarray as $k)
	{	
		$qry = "select username from $regusertable where email='$k'";
		$result =$fgmembersite->RunQuery($qry);
		$row = mysql_fetch_array( $result );
		if ($row == "" || $row['username'] == $uname)
		{
			$val = $val."User $k is not registered with weshall.servebeer.com<br/>";
			continue;
		}
		$k = $row['username'];
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
			$val = $val."User $k is already added to your profile<br/>";
		}
		else
		{
			create_entry_in_pair_table($user1, $user2);
			$val = $val."User $k is added to your profile<br/>";
		}
	}
	echo json_encode(array("returnValue"=>"".$val));
?>
