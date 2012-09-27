<?PHP
	require_once("access.php");
	require_once("operations.php");
	check_and_create_money_table($moneytable);
	$flag = $_POST["flag"];
	if ($flag == "new")
		add_transaction($_POST["event"],$_POST["desc"], $_POST["date"],$_POST["amount"], $_POST["paid"],$_POST["participants"]);
	else if($flag == "old")
		update_transaction($_POST["id"], $_POST["event"],$_POST["desc"], $_POST["date"],$_POST["amount"], $_POST["paid"],$_POST["participants"]);
	$fgmembersite->RedirectToURL("view-transaction.php?page=cur");
	/*foreach (unserialize($_POST['hpaid']) as $k)
		echo $k;
	*/
?>

