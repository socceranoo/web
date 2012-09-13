<?PHP
	require_once("access.php");
	add_back_transaction($_REQUEST['id']);
	$fgmembersite->RedirectToURL("view-transaction.php?page=del");
?>
