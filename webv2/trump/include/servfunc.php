<?PHP
	//require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/membersite_config.php");
	$retval = "";
	$info = "";
	function server_state() {
		return shell_exec("ps -ef 2>/dev/null | grep -v grep | grep testwebsock | awk '{print \$2'}");
	}
	function start_server() {
		return shell_exec("php -f ./testwebsock.php &");
	}
	function stop_server() {
		return shell_exec("ps -ef 2>/dev/null | grep -v grep | grep testwebsock | awk '{print \$2'} | xargs kill -9");
	}
	function filemain($option) {
		global $info, $retval;
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
		}
		return array("retval"=>$retval, "info"=>$info);
	}
$option = $_POST['str'];
$arr = filemain($option);
echo json_encode($arr);
?>
