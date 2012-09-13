<?PHP
	require_once("access.php");
	check_and_create_money_table($deletedtable);
	delete_transaction($_REQUEST['id']);
	$fgmembersite->RedirectToURL("view-transaction.php?page=cur");
?>
