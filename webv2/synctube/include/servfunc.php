<?PHP
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/membersite_config.php");
	$retval = "";
	$info = "";
	function server_state() {
		return shell_exec("ps -ef 2>/dev/null | grep -v grep | grep tubeserver | awk '{print \$2'}");
	}
	function start_server() {
		return shell_exec("echo Orange | sudo php -f ./tubeserver.php &");
	}
	function stop_server() {
		return shell_exec("ps -ef 2>/dev/null | grep -v grep | grep tubeserver | awk '{print \$2'} | xargs kill -9");
	}
	function filemain($option, $session) {
		global $info, $retval;
		global $fgmembersite;
		$info = server_state(); 
		rtrim($info);
		$retval = $info || false;
		if (!$retval && $option == "start") {
			start_server();
			$info = server_state(); 
			rtrim($info);
			$retval = $info || false;
		}else if ($retval && $option == "stop") {
			stop_server();
			$info = server_state(); 
			rtrim($info);
			$retval = $info || false;
		}else if ($retval && $option == "info") {
			$qry = "SELECT * from sync_sessions where id = $session";
			$result = $fgmembersite->RunQuery($qry);
			$row = mysql_fetch_array($result);
			$info = json_encode($row);
		}
		return array("retval"=>$retval, "info"=>$info);
	}
$option = $_POST['str'];
$session = $_POST['session'];
$arr = filemain($option, $session);
echo json_encode($arr);
?>
