<?PHP
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/class.phpmailer.php");
	//require_once("../include/class.phpmailer.php");
	$retval = "true";
	function sendmail( $name, $email, $message) {
		$mailer = new PHPMailer();
		$mailer->CharSet = 'utf-8';
		$mailer->AddAddress("socceranoo@gmail.com" , "Anoop");
		$mailer->Subject = "Some one has sent you a message";
		$mailer->From = $email;
		$mailer->Body = "NAME: $name\n EMAIL: $email\nMessage:$message\n";
		if(!$mailer->Send())
		{  
			$this->HandleError("Failed sending user welcome email.");
			return false;
		}
		return true;
	}
	function filemain() {
			$name =$_POST['name'];
			$email =$_POST['email'];
			$message =$_POST['message'];
			$hidden =$_POST['hidden'];
			if ($hidden == "ONE") {
				$val = sendmail($name, $email, $message);
			}
	}
filemain();
$arr = array("retval"=>$retval);
echo json_encode($arr);
?>
