<?PHP
	function add_transaction($event, $desc, $date, $amount, $paid, $participant)
	{
		global $fgmembersite, $moneytable;
		// ADD THE NEW TRANSACTION UPDATE THE USER TABLES
		update_on_add_or_del($amount, $paid, $participant, "add");

		// ADD THE TRANSACTION UPDATE THE TRANSACTION TABLES
		$paidString = serialize($paid);
		$participantString = serialize($participant);
		$qry = "INSERT INTO $moneytable (event, description, date, paid, participants, amount) ".
		"VALUES('$event','$desc','$date','$paidString', '$participantString', '$amount')";
		$fgmembersite->RunQuery($qry);
	}
	function update_transaction($id, $event, $desc, $date, $amount, $paid, $participant)
	{
		global $fgmembersite, $moneytable;
		// DELETE THE OLD TRANSACTION UPDATE THE USER TABLES
		$qry = "SELECT * from $moneytable WHERE id=$id";
		$result = $fgmembersite->RunQuery($qry);
		$row = mysql_fetch_array($result);
		$old_amount = $row['amount'];
		$old_paid = unserialize($row['paid']);
		$old_participant = unserialize($row['participants']);
		update_on_add_or_del($old_amount, $old_paid, $old_participant, "del");

		// ADD THE NEW TRANSACTION UPDATE THE USER TABLES
		$paidString = serialize($paid);
		$participantString = serialize($participant);
		$qry = "UPDATE $moneytable SET event='$event', description='$desc', date='$date', paid='$paidString', participants='$participantString', amount='$amount'".
		"WHERE id=$id";
		$fgmembersite->RunQuery($qry);
		update_on_add_or_del($amount, $paid, $participant, "add");
	}
	function delete_transaction($id)
	{
		global $fgmembersite, $moneytable, $deletedtable;
		// DELETE THE TRANSACTION UPDATE THE USER TABLES
		$qry = "SELECT * from $moneytable WHERE id=$id";
		$result = $fgmembersite->RunQuery($qry);
		$row = mysql_fetch_array($result);
		$amount = $row['amount'];
		$paid = unserialize($row['paid']);
		$participant = unserialize($row['participants']);
		update_on_add_or_del($amount, $paid, $participant, "del");

		// DELETE THE TRANSACTION UPDATE THE TRANSACTION TABLES
		$qry = "INSERT INTO $deletedtable SELECT * FROM $moneytable WHERE id=$id";
		$fgmembersite->RunQuery($qry);
		$qry = "DELETE FROM $moneytable WHERE id=$id";
		$fgmembersite->RunQuery($qry);
	}
	function add_back_transaction($id)
	{
		global $fgmembersite, $moneytable, $deletedtable;
		// REVIVE THE TRANSACTION UPDATE THE USER TABLES
		$qry = "SELECT * from $deletedtable WHERE id=$id";
		$result = $fgmembersite->RunQuery($qry);
		$row = mysql_fetch_array($result);
		$amount = $row['amount'];
		$paid = unserialize($row['paid']);
		$participant = unserialize($row['participants']);
		update_on_add_or_del($amount, $paid, $participant, "add");

		// REVIVE THE TRANSACTION UPDATE THE TRANSACTION TABLES
		$qry = "INSERT INTO $moneytable SELECT * FROM $deletedtable WHERE id=$id";
		$fgmembersite->RunQuery($qry);
		$qry = "DELETE FROM $deletedtable WHERE id=$id";
		$fgmembersite->RunQuery($qry);
	}
	function update_on_add_or_del($amount, $paid, $participant, $opr)
	{
		global $fgmembersite;
		$paid_count = count($paid);	
		$part_count = count($participant);	
		$paid_share = $amount/$paid_count;
		$share = $amount/$part_count;
		$per_payee_share = $share/$paid_count;
		foreach($paid as $loaner)
		{
			foreach ($participant as $loanee)
			{
				if ($loanee != $loaner)
				{
					if ($opr == "add")
						update_user_tables($loaner, $loanee, $per_payee_share);	
					else if($opr == "del")
						update_user_tables($loanee, $loaner, $per_payee_share);	
				}
			}	
		}
	}
	function update_user_tables($loaner, $loanee, $amount)
	{
		global $fgmembersite;
		$qry = "UPDATE $loaner SET amount=amount+'$amount' WHERE user2='$loanee'";
		$fgmembersite->RunQuery($qry);
		$qry = "UPDATE $loanee SET amount=amount-'$amount' WHERE user2='$loaner'";
		$fgmembersite->RunQuery($qry);
	}
	function check_and_create_money_table($table)
	{
		global $fgmembersite;
		if (!$fgmembersite->RunQuery("DESCRIBE `$table`"))
		{
			$qry = "Create Table $table (".
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
	function get_args_from_variable($row)
	{
		$flag ="old";
		$args ="flag=".$flag."&id=".$row['id']."&event=".$row['event']."&desc=".$row['description']."&date=".$row['date']."&paid=".$row['paid']
		."&participants=".$row['participants']."&amount=".$row['amount'];
		return $args;
	}
?>
