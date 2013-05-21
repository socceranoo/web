<?PHP
	//require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/membersite_config.php");
	$retval = "";
	$info = "";
	function server_state() {
		return shell_exec("ps -ef 2>/dev/null | grep -v grep | grep testwebsock | awk '{print \$2'}");
	}
	function start_server() {
		return shell_exec("ls");
	}
	function stop_server() {
	}
	function filemain() {
		global $fgmembersite, $info, $retval;
		$info = server_state(); 
		rtrim($info);
		$retval = $info || false;
		return array("retval"=>$retval, "info"=>$info);
	}
$arr = filemain();
echo json_encode($arr);
?>
