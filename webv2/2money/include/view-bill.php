<?PHP
	require_once("include/actions-include.php");
	$retval = "";
	$empty_bill ="false";
	if ($_REQUEST['id']){
		if ($_REQUEST['page'])
			get_bill_info($_REQUEST['id'], $_REQUEST['page']);
		else
			get_bill_info($_REQUEST['id']);
	}
	if ($retval == "") {
		$empty_bill ="true";
	}
?>
