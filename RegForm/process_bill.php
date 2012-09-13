<?PHP
	require_once("access.php");
	function add_transaction($event, $desc, $date, $amount, $paid, $participant)
	{
		global $fgmembersite, $moneytable;
		$paidString = serialize($paid);
		$participantString = serialize($participant);
		$qry = "INSERT INTO $moneytable (event, description, date, paid, participants, amount) ".
		"VALUES('$event','$desc','$date','$paidString', '$participantString', '$amount')";
		$fgmembersite->RunQuery($qry);
		print "Transaction added\n";
	}
	function update_transaction($id, $event, $desc, $date, $amount, $paid, $participant)
	{
		global $fgmembersite, $moneytable;
		$paidString = serialize($paid);
		$participantString = serialize($participant);
		$qry = "UPDATE $moneytable SET event='$event', description='$desc', date='$date', paid='$paidString', participants='$participantString', amount='$amount'".
		"WHERE id=$id";
		$fgmembersite->RunQuery($qry);
		print "Transaction updated\n";
	}
	function check_and_create_money_table()
	{
		global $fgmembersite, $moneytable;
		if (!$fgmembersite->RunQuery("DESCRIBE `$moneytable`"))
		{
			$qry = "Create Table $moneytable (".
			"id INT NOT NULL AUTO_INCREMENT ,".
			"event VARCHAR( 40 ) NOT NULL ,".
			"description VARCHAR( 250 ) NOT NULL ,".
			"date VARCHAR( 16 ) NOT NULL ,".
			"paid VARCHAR( 500 ) NOT NULL ,".
			"participants VARCHAR( 1000 ) NOT NULL ,".
			"amount INT NOT NULL ,".
			"PRIMARY KEY ( id )".
			")";
			$fgmembersite->RunQuery($qry);
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<?require_once("includes.php");?>
		<title>Done</title>
	</head>
	<body>
		<div id='other'>
		<div id='fg_membersite_content'>
			<br><br><br>
			<h3>Done!</h3>
			<?php 
				require_once("operations.php");
				check_and_create_money_table();
				$flag = $_POST["flag"];
				if ($flag == "new")
					add_transaction($_POST["event"],$_POST["desc"], $_POST["date"],$_POST["amount"], $_POST["paid"],$_POST["participants"]);
				else if($flag == "old")
					update_transaction($_POST["id"], $_POST["event"],$_POST["desc"], $_POST["date"],$_POST["amount"], $_POST["paid"],$_POST["participants"]);
				//print "OLD transaction cannot be editted now";
			?>
		</div>
		</div>
	</body>
</html>

