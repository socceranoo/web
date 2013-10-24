<?PHP
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/membersite_config.php");

	//simulate login
	/*
	$uname ="guest1";
	$password ="guest1";
	if($fgmembersite->Login2($uname, $password)) {  
		$login = true;
	}
	global $fgmembersite, $login, $uname;
	*/
	$request_url = $_SERVER['REQUEST_URI'];
	if(!$fgmembersite->CheckLogin()) {
		$fgmembersite->RedirectToURL("http://gatoraze.com/login.php?req=$request_url");
	}
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/global_values.php");
?>
