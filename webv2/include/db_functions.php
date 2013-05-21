<?PHP
	function add_transaction($event, $desc, $date, $amount, $paid, $part)
	{
		global $fgmembersite, $moneytable;
		// ADD THE TRANSACTION UPDATE THE TRANSACTION TABLES
		$paidarr = objectToArray($paid);
		$partarr = objectToArray($part);
		$paidString = serialize($paidarr);
		$participantString = serialize($partarr);
		$qry = "INSERT INTO $moneytable (event, description, date, paid, participants, amount) ".
		"VALUES('$event','$desc','$date','$paidString', '$participantString', '$amount')";
		$id = $fgmembersite->RunQuery($qry, true);
		// ADD THE NEW TRANSACTION UPDATE THE USER TABLES
		update_on_add_or_del($amount, $paidarr, $partarr, "add");
		return $id;
	}
	function update_transaction($id, $event, $desc, $date, $amount, $paid, $part)
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
		$paidarr = objectToArray($paid);
		$partarr = objectToArray($part);
		$paidString = serialize($paidarr);
		$participantString = serialize($partarr);
		$qry = "UPDATE $moneytable SET event='$event', description='$desc', date='$date', paid='$paidString', participants='$participantString', amount='$amount'".
		"WHERE id=$id";
		$fgmembersite->RunQuery($qry);
		update_on_add_or_del($amount, $paidarr, $partarr, "add");
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
		//$qry = "INSERT INTO $deletedtable SELECT * FROM $moneytable WHERE id=$id";
		$qry = "INSERT INTO $deletedtable (event, description, date, paid, participants, amount) ".
		"SELECT event, description, date, paid, participants, amount FROM $moneytable WHERE id=$id";
		$fgmembersite->RunQuery($qry);
		$qry = "DELETE FROM $moneytable WHERE id=$id";
		$fgmembersite->RunQuery($qry);
	}
	function delete_transaction_forever($id)
	{
		global $fgmembersite, $deletedtable;
		// DELETE THE TRANSACTION FROM DELETED TABLE
		$qry = "DELETE FROM $deletedtable WHERE id=$id";
		$fgmembersite->RunQuery($qry);
	}
	function add_back_transaction($id)
	{
		system_err_message("ID:".$id);
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
		//$qry = "INSERT INTO $moneytable SELECT * FROM $deletedtable WHERE id=$id";
		$qry = "INSERT INTO $moneytable (event, description, date, paid, participants, amount) ".
		"SELECT event, description, date, paid, participants, amount FROM $deletedtable WHERE id=$id";
		$fgmembersite->RunQuery($qry);
		$qry = "DELETE FROM $deletedtable WHERE id=$id";
		$fgmembersite->RunQuery($qry);
	}
	function update_on_add_or_del($amount, $paid, $participant, $opr)
	{
		global $fgmembersite;
		$paid_count = count($paid);	
		$part_count = count($participant);	
		system_err_message("Paid count:$paid_count\nPart count:$part_count\nAmount:$amount\n");
		foreach($paid as $loaner=>$paidvalue)
		{
			foreach ($participant as $loanee=>$partvalue)
			{
				$share_percent = $partvalue/$amount;
				$per_payee_share = $share_percent * $paidvalue;
				system_err_message("Payer: $loaner\nPayee: $loanee\nPaid value:$paidvalue\nPart value:$partvalue\nPart percent: $share_percent\nShare:$per_payee_share\n");
				if ($loanee != $loaner) {
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
		global $fgmembersite, $pairtable;
		if ($loaner < $loanee)
		{
			$qry = "SELECT * FROM $pairtable WHERE user1='$loaner' and user2='$loanee'";
			$result = $fgmembersite->RunQuery($qry);
			if (mysql_num_rows($result) <= 0)
				create_entry_in_pair_table($loaner, $loanee);
			$qry = "UPDATE $pairtable SET amount=amount+'$amount' WHERE user1='$loaner' and user2='$loanee'";
		}
		else
		{
			$qry = "SELECT * FROM $pairtable where user1='$loanee' and user2='$loaner'";
			$result = $fgmembersite->RunQuery($qry);
			if (mysql_num_rows($result) <= 0)
				create_entry_in_pair_table($loanee, $loaner);
			$qry = "UPDATE $pairtable SET amount=amount-'$amount' WHERE user1='$loanee' and user2='$loaner'";
		}
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
			"paid TEXT NOT NULL ,".
			"participants TEXT NOT NULL ,".
			"amount FLOAT(8,2) NOT NULL ,".
			"PRIMARY KEY ( id )".
			")";
			$fgmembersite->RunQuery($qry);
		}
	}
	function check_and_add_user_table($usertable)
	{
		global $fgmembersite;
		if(!$fgmembersite->RunQuery("DESCRIBE `$usertable`"))
		{
			$qry = "Create Table $usertable (".
			"id INT NOT NULL AUTO_INCREMENT ,".
			"user1 VARCHAR( 16 ) NOT NULL ,".
			"user2 VARCHAR( 16 ) NOT NULL ,".
			"amount FLOAT(8,2) NOT NULL ,".
			"PRIMARY KEY ( id )".
			")";
			$fgmembersite->RunQuery($qry);
		}
	}

	function create_entry_in_pair_table($user1, $user2)
	{
		global $fgmembersite, $pairtable;
		$qry = "INSERT INTO $pairtable (user1, user2, amount)".
		"VALUES('$user1','$user2','0')";
		$fgmembersite->RunQuery($qry);
	}
	function paste_select_menu($user, $user_arr, $option) {
		global $values;
		$flag="new";
		$sel="";
		if ($option == 0)
			$array=unserialize($values['paid']);
		else if($option == 1)
			$array=unserialize($values['participants']);

		$sel ="selected=\"selected\"";
		echo "<option $sel value=default>";
		echo "select an option";
		echo "</option>";
		if ($flag=="new" || in_array($user, $array))
			$sel="";
			//$sel ="selected=\"selected\"";
		echo "<option $sel value=$user>";
		echo $user."(You)";
		echo "</option>";
		$sel="";
		foreach ($user_arr as $val)
		{
			if (in_array($val, $array))
				$sel ="selected=\"selected\"";
			echo "<option $sel value=$val>";
			echo $val;
			echo "</option>";
			$sel="";
		}
	}
	function get_field_value($array, $field) {
		return $array["$field"];        
	}
	
	function objectToArray($obj) {
		if (is_object($obj)) {
			$obj = get_object_vars($obj);			
		}
		if (is_array($obj)) {
			return array_map(__FUNCTION__, $obj);
		}else {
			return $obj;
		}
	}
	function system_err_message($qry) {
		global $fgmembersite;
		system("echo \"$qry\" >> /tmp/anoop");
		$errmsg = $fgmembersite->GetErrorMessage();
		system("echo \"$errmsg\" >> /tmp/anoop");
	}
	
	function get_fullname_for_username($username){
		global $fgmembersite;
		$result = $fgmembersite->RunQuery("SELECT name from regusers where username='$username'");
		$row = mysql_fetch_array($result);
		if ($row['name'])
			return $row['name'];
		else 
			return "";
	}
	function get_username_for_fullname($fullname){
		global $fgmembersite;
		$result = $fgmembersite->RunQuery("SELECT username from regusers where name='$fullname'");
		$row = mysql_fetch_array($result);
		if ($row['username'])
			return $row['username'];
		else 
			return "";
	}
	function get_nickname_for_username($username){
		global $fgmembersite;
		$result = $fgmembersite->RunQuery("SELECT nickname from regusers where username='$username'");
		$row = mysql_fetch_array($result);
		if ($row['nickname'])
			return $row['nickname'];
		else 
			return get_firstname_for_username($username);
	}
	function get_firstname_for_username($username) {
		$fullname = get_fullname_for_username($username);
		$pieces = explode(" ", $fullname);
		return $pieces[0];
	}
?>
