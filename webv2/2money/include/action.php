<?PHP
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/access.php");
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/db_functions.php");
	require_once("actions-include.php");
	filemain();
	$arr = array("retval"=>$retval, "arg"=>$argstr, "url"=>$billurl, "error"=>$errorstr);
	echo json_encode($arr);
?>
