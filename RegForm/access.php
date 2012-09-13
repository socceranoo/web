<?PHP
	require_once($_SERVER['DOCUMENT_ROOT']."RegForm/include/membersite_config.php");
	if(!$fgmembersite->CheckLogin())
	{
	    $fgmembersite->RedirectToURL("login.php");
	    exit;
	}
	$uname = $fgmembersite->UserName();
	$moneytable = $fgmembersite->MoneyTable();
	// Make a MySQL Connection
	//mysql_connect("localhost", "root", "Orange") or die(mysql_error());
	//mysql_select_db("Main") or die(mysql_error());
	require_once("topright.php");
?>

