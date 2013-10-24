<?PHP
	$uname = $fgmembersite->UserName();
	///*
	$moneytable ="money";
	$deletedtable ="deleted";
	$pairtable ="userpair";
	//*/
	/*
	$moneytable ="money2";
	$deletedtable ="deleted2";
	$pairtable ="userpair2";
	*/

	$resumetable ="resume";
	$songtable = "song";
	$tagtable = "songtag";
	$maptable = "songtagmap";
	$regusertable = $fgmembersite->RegUserTable();
	$tempresult = $fgmembersite->RunQuery("select id_user,name from $regusertable where username='$uname'");
	$tempresult = mysql_fetch_array($tempresult);
	$userid=$tempresult['id_user'];
	$fullname = $tempresult['name'];
?>
