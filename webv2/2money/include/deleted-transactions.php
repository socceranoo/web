<?PHP
	require_once("include/actions-include.php");
	$retval = "";
	view_transaction();
	echo "<legend>Deleted Transactions</legend>";
	echo "<div>$retval</div>";
?>
