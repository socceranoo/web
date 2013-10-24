<?PHP
	require_once("include/actions-include.php");
	$retval = "";
	if ($_REQUEST['user'])
		view_transaction("cur", $_REQUEST['user']);
	else 
		view_transaction("cur");
	echo "<legend>Transactions</legend>";
	echo "<div>$retval</div>";
?>
