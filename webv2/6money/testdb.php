<?PHP
	$moneytable ="money";
	$deletedtable ="deleted";
	$pairtable ="userpair2";
	$resumetable ="resume";
	$regusertable ="regusers";
	
	$table = $moneytable;
	//$table = $deletedtable;
	// Make a MySQL Connection
	mysql_connect("localhost", "root", "Orange") or die(mysql_error());
	mysql_select_db("Main") or die(mysql_error());
	$tempresult = mysql_query("select * from $table");
	while($row = mysql_fetch_array($tempresult)) {
		$id = $row['id'];
		$newpartarr = array();
		$amount = $row['amount'];
		echo $row['participants']."\n";
		$partarr=unserialize($row['participants']);
		$newpartstr="";
		$partcount = count($partarr);
		foreach ($partarr as $k=>$value) {
			$partamt = $amount/$partcount;
			$newpartarr[$value] = number_format($partamt, 2, '.','');
		}
		print_r($newpartarr);
		$newpartstr = serialize($newpartarr);
		echo "$newpartstr\n";
		$qry = "UPDATE $table SET participants='$newpartstr' WHERE id=$id";
		mysql_query($qry);
	}
?>
