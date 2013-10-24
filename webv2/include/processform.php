<?PHP
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/membersite_config.php");
	$retval = "true";
	$errormsg="";
	$url = "";
	$info = "";
	function login($page){
		global $fgmembersite;
		global $retval, $errormsg, $url, $info;
		if(isset($_POST['loginsubmit'])) {
			if($fgmembersite->Login()) {
				if ($page != "")
					$url = $page;
				else 
					$url = "home.php";
				$info = "You have successfully logged in";
				//$fgmembersite->RedirectToURL("login-home.php");
			}
			else {
				$errormsg = $fgmembersite->GetErrorMessage();
				$retval = "false";
			}
		}
	}
	function register() {
		system("echo registerreached >> /tmp/free");
		global $fgmembersite;
		global $retval, $errormsg, $url, $info;
		if(isset($_POST['registersubmit'])) {
			if($fgmembersite->RegisterUser()) {
				$url = "thank-you.html";
				$info = "Thank you for registering. Your confirmation email is on its way. Please click the link in the email to complete the registration.Please check your spam folder if you do not see it in your inbox. Sorry for the inconvenience.";
			}
			else {
				$errormsg = $fgmembersite->GetErrorMessage();
				$retval = "false";
			}
		}
	}
	function resetpwd() {
		global $fgmembersite;
		global $retval, $errormsg, $url, $info;
		if(isset($_POST['resetreqsubmit'])) {
			if($fgmembersite->EmailResetPasswordLink()) {
				$url = "reset-pwd-link-sent.html";
				$info = "An email is sent to your email address that contains the link to reset the password.Please check your spam if you do not find it in inbox";
			}
			else {
				$errormsg = $fgmembersite->GetErrorMessage();
				$retval = "false";
			}
		}
	}
	function changepwd() {
		global $fgmembersite;
		global $retval, $errormsg, $url, $info;
		if(isset($_POST['changepwdsubmit'])) {
			if($fgmembersite->ChangePassword()) {
				$url = "l";
				$info = "Your Password has been changed successfully.";
			}
			else {
				$errormsg = $fgmembersite->GetErrorMessage();
				$retval = "false";
			}
		}
	}
	function filemain() {
		if ($_POST['formname'] == "login")
			login($_POST['page']);
		else if ($_POST['formname'] == "register")
			register();
		else if ($_POST['formname'] == "resetreq")
			resetpwd();
		else if ($_POST['formname'] == "changepwd")
			changepwd();
	
	}
filemain();
$arr = array("retval"=>$retval, "errormsg"=>$errormsg, "url"=>$url, "info"=>$info);
//echo json_encode(array("retval"=>"".$retval, "errormsg"=>"".$errormsg, "url"=>"".$url, "info"=>"".$info));
echo json_encode($arr);
//Because we want to use json, we have to place things in an array and encode it for json.
//This will give us a nice javascript object on the front side.
?>
