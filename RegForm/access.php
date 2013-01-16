<?PHP
	require_once("include/membersite_config.php");
	//require_once($_SERVER['DOCUMENT_ROOT']."RegForm/include/membersite_config.php");
	if(!$fgmembersite->CheckLogin())
	{
	    $fgmembersite->RedirectToURL("login.php");
	    exit;
	}
	//$pairtable = $fgmembersite->UserTable();
	//$moneytable = $fgmembersite->MoneyTable();
	//$deletedtable = $fgmembersite->DeletedTable();
	$moneytable ="money";
	$deletedtable ="deleted";
	$pairtable ="userpair";
	$resumetable ="resume";
	$regusertable = $fgmembersite->RegUserTable();

	$uname = $fgmembersite->UserName();
	$tempresult = $fgmembersite->RunQuery("select id_user,name from $regusertable where username='$uname'");
	$tempresult = mysql_fetch_array($tempresult);
	$userid=$tempresult['id_user'];
	$fullname = $tempresult['name'];
	// Make a MySQL Connection
	//mysql_connect("localhost", "root", "Orange") or die(mysql_error());
	//mysql_select_db("Main") or die(mysql_error());
	//require_once("topright.php");
	$login = true;
	require_once("db_functions.php");
?>
