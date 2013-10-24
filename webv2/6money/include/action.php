<?PHP
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/membersite_config.php");
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/db_functions.php");
	$retval = "";
	$argstr = "";
	function summary() {
		global $fgmembersite, $uname, $pairtable;
		$owesyou=0;
		$youowe=0;
		$i=0;
		$result = $fgmembersite->RunQuery("SELECT * FROM $pairtable WHERE (user1='$uname' or user2='$uname') and amount!=0 ORDER BY abs(amount) DESC");
		if (mysql_num_rows($result) > 0) {
			append("<table id='gradient-style' align=center>");
			append("<tr><th>Who</th><th align=center>How much</th></tr>");
			//append("<tr><th>Who</th><th>How much</th><th>Status</th></tr>");
			while($row = mysql_fetch_array( $result )) {
				append("<tr><td>");
				if ($row['user1'] == $uname)
					$user2=$row['user2'];
				else if($row['user2'] == $uname)
					$user2=$row['user1'];
				$user2 = get_firstname_for_username($user2);
				append("<a id=selem$i class=userclick href='JavaScript:(void);'>");
				append($user2);
				append("</a>");
				$amountstr="$".number_format(abs($row['amount']), 2, '.', '');
				$owestr="";
				$classstr="";
				if ($uname < $user2)	{
					if ($row['amount'] > 0 ) {
						$owesyou+=$row['amount'];
						$classstr ="class='disp_amount owesyou'";
						$owestr="Owes you";
						//append("Owes you");
					} else if ($row['amount'] < 0 ) {
						$youowe+=abs($row['amount']);
						$classstr ="class='disp_amount youowe'";
						$owestr="You owe";
						//append("You owe");
					} else {
						$amountstr="--";
						$classstr ="class='disp_amount even'";
						$owestr="Even";
						//append("Even");
					}
				} else {
					if ($row['amount'] > 0 ) {
						$youowe+=$row['amount'];
						$classstr ="class='disp_amount youowe'";
						$owestr="You owe";
						//append("You owe");
					} else if ($row['amount'] < 0 ) {
						$owesyou+=abs($row['amount']);
						$classstr ="class='disp_amount owesyou'";
						$owestr="Owes you";
						//append("Owes you");
					} else {
						$amountstr="--";
						$classstr ="class='disp_amount even'";
						$owestr="Even";
						//append("Even");
					}
				}
				append("</td><td align=center $classstr>");
				append($amountstr);
				//append("</td><td>");
				//append($owestr);
				append("</td> </tr>");
				$i++;
			}
			append("</table>");
		}
		$owesyou=number_format($owesyou, 2, '.', '');
		$youowe=number_format($youowe, 2, '.', '');
		prepend("<h3>SUMMARY</h3>\n<h4 align='center' class=owesyou >OTHERS OWE: \$$owesyou</h4><h4 class=youowe>YOU OWE: \$$youowe</h4>");
	}

	function add_friend($emailarray) {
		global $fgmembersite, $regusertable, $uname, $pairtable;
		append("<ul>");
		foreach ($emailarray as $k) {
			$qry = "select username from $regusertable where email='$k'";
			$result =$fgmembersite->RunQuery($qry);
			$row = mysql_fetch_array( $result );
			if ($row == "" || $row['username'] == $uname) {
				append("<li><h5>User $k is not registered with gatoraze.tk</h5></li>");
				continue;
			}
			$k = $row['username'];
			if ($uname < $k) {
				$user1=$uname;
				$user2=$k;
			} else {
				$user2=$uname;
				$user1=$k;
			}
			$qry = "select id from $pairtable where user1='$user1' and user2='$user2'";
			$result =$fgmembersite->RunQuery($qry);
			$row = mysql_fetch_array( $result );
			if ($row['id'] > 0) {
				append("<li><h5>User $k is already added to your profile</h5></li>");
			} else {
				create_entry_in_pair_table($user1, $user2);
				append("<li><h5>User $k is added to your profile</h5></li>");
			}
		}
		append("</ul>");
	}

	function add_edit_bill($detailarray, $paidarray, $partarray) {
		global $fgmembersite, $uname, $moneytable, $deletedtable;
		foreach ($detailarray as $k=>$value) {
			if ($k == "flag") {
				$flag = $value;
			}else if($k == "bill_id") {
				$bill_id=$value;
			}else if($k == "event") {
				$event=$value;
			}else if($k == "desc") {
				$desc=$value;
			}else if($k == "date") {
				$date=$value;
			}else if($k == "amount") {
				$amount=$value;
			}
		}
		check_and_create_money_table($moneytable);
		if ($flag == "new") {
			$bill_id = add_transaction($event,$desc, $date,$amount, $paidarray,$partarray);
		}
		else if($flag == "old"){
			update_transaction($bill_id, $event,$desc, $date,$amount, $paidarray,$partarray);
		}
		get_bill_info($bill_id, "cur");
	}

	function view_transaction($page, $user) {
		global $fgmembersite, $uname, $moneytable, $deletedtable;
		$deltitlestr="This operation will put the bill in the recycle bin. You can revive or delete permanently later";
		$revtitlestr="This operation will revive the bill and apply the bill";
		$edittitlestr="This operation will allow you to change the bill paramters";
		$trashtitlestr="This operation will delete the bill permanently";
		if ($page == "cur")
			$table = $moneytable;
		else
			$table = $deletedtable;

		if ($user != "null") {
			$user = get_username_for_fullname($user);
			$qry ="SELECT * FROM $table WHERE (paid LIKE '%$uname%' AND participants LIKE '%$user%')"
				."OR (paid LIKE '%$user%' AND participants LIKE '%$uname%') ORDER BY date DESC";
				$result = $fgmembersite->RunQuery($qry);
		} else {
			$result = $fgmembersite->RunQuery("SELECT * FROM $table WHERE 
				(paid LIKE '%$uname%' OR participants LIKE '%$uname%') ORDER BY date DESC");
		}
		if (mysql_num_rows($result) > 0) {
			append("<table id='gradient-style' align=center>");
			append("<tr><th>Event</th><th>Description</th><th>Date</th><th>Paid</th><th>Participants</th><th>Amount</th></tr>");
			while($row = mysql_fetch_array( $result )) {
				// Print out the contents of each row into a table
				append("<tr><td class=disp_event>");
				$id="view".$page."billid_".$row['id'];
				append("<a class=clickbill id=$id href='JavaScript:(void);'>".$row['event']."</a>");
				append("<br/>");
				if ($page == "cur") {
					append("<div class='short_explanation'><a title='$edittitlestr' class=clickbill id=editbillid_".$row['id']." href='JavaScript:(void);'>edit</a></div>");
					append("<div class='short_explanation'><a title='$deltitlestr' class=clickbill id=delbillid_".$row['id']." href='JavaScript:(void);'>delete</a></div>");
				}
				else {
					append("<div class='short_explanation'><a title='$revtitlestr' class=clickbill id=revbillid_".$row['id']." href='JavaScript:(void);'>revive</a></div>");
					append("<div class='short_explanation'><a title='$trashtitlestr' class=clickbill id=trashbillid_".$row['id']." href='JavaScript:(void);'>shift-delete</a></div>");
				}
				$longstr = $row['description'];
				$str = $longstr;
				if (strlen($longstr) > 20) {
					$str = substr($longstr,0,20)."...";
				}
				append("</td><td class=disp_desc title='$longstr'>");
				append($str);
				append("</td><td class=disp_date>");
				append($row['date']);
				append("</td><td class=disp_paid>");
				$paidarray = unserialize($row['paid']);
				foreach ($paidarray as $k=>$value) {
					$name = get_firstname_for_username($k);
					$name = get_nickname_for_username($k);
				    append("$name : $value");
				    append("<br>");
				}
				append("</td><td class=disp_part>");
				$partarray = unserialize($row['participants']);
				foreach ($partarray as $k=> $value) {
					$name = get_nickname_for_username($k);
					append("$name : $value");
					append("<br>");       
				}
				append("</td><td class=disp_amount>");
				append($row['amount']);
				append("</td> </tr>");
			}
			append("</table>");
		}
	}
	function get_bill_info($id, $page) {
		global $fgmembersite, $uname, $moneytable, $deletedtable;
		global $argstr;
		if ($page == "cur")
			$table = $moneytable;
		else
			$table = $deletedtable;
		$argarray = array();
		$result = $fgmembersite->RunQuery("SELECT * FROM $table WHERE id=$id");
		if (mysql_num_rows($result) > 0 && $row = mysql_fetch_array($result)) {
			// Print out the contents of each row into a table
			$argarray['id']=$row['id'];
			$argarray['event']=$row['event'];
			$argarray['desc']=$row['description'];
			$argarray['date']=$row['date'];
			$argarray['amount']=$row['amount'];
			$argarray['paid']=json_encode(unserialize($row['paid']));
			$argarray['part']=json_encode(unserialize($row['participants']));
		}
		$paidarray = unserialize($row['paid']);
		$partarray = unserialize($row['participants']);
		append("<table id='gradient-style' align=center>");
		append("<tr><th>#</th><th>Value</th></tr>");

		append("<tr><td class=disp_event>");
		append("Bill ID");
		append("</td><td class=disp_event>");
		append($argarray['id']);
		append("</td></tr>");

		append("<tr><td class=disp_event>");
		append("Event");
		append("</td><td class=disp_event>");
		append($argarray['event']);
		append("</td></tr>");

		append("<tr><td class=disp_event>");
		append("Description");
		append("</td><td class=disp_event>");
		append($argarray['desc']);
		append("</td></tr>");

		append("<tr><td class=disp_event>");
		append("Date");
		append("</td><td class=disp_event>");
		append($argarray['date']);
		append("</td></tr>");

		append("<tr><td class=disp_event>");
		append("Amount");
		append("</td><td class=disp_event>");
		append($argarray['amount']);
		append("</td></tr>");

		append("<tr><td class=disp_event>");
		append("Who Paid");
		append("</td><td class=disp_amount>");
		foreach ($paidarray as $k=>$value) {
			$name = get_firstname_for_username($k);
			append("$name:$value");
			append("<br>");       
		}
		append("</td></tr>");

		append("<tr><td class=disp_event>");
		append("Who Participated");
		append("</td><td class=disp_amount>");
		foreach ($partarray as $k=>$value) {
			$name = get_firstname_for_username($k);
			$name = get_nickname_for_username($k);
			append("$name:$value");
			append("<br>");       
		}
		append("</td></tr>");

		append("<tr><td class=disp_event>");
		append("Summary");
		append("</td><td class=disp_amount>");
		$amount = $argarray['amount'];
		append("Who owes whom<br/>");
		foreach($paidarray as $loaner=>$paidvalue){
			foreach($partarray as $loanee=>$partvalue) {
				$share_percent = $partvalue/$amount;
				$per_payee_share = $share_percent * $paidvalue;
				if ($loaner != $loanee){
					$lhsname = get_firstname_for_username($loanee);
					$lhsname = get_nickname_for_username($loanee);
					$rhsname = get_firstname_for_username($loaner);
					$rhsname = get_nickname_for_username($loaner);
					$tempamt=number_format($per_payee_share, 2, '.', '');
					append("$lhsname====>$rhsname: $tempamt");
					append("<br/>");
				}
			}
		}
		append("</td></tr>");
		append("</table>");
		$argstr = json_encode($argarray);
	}
	function delete_bill ($bill_id) {
		global $fgmembersite, $uname, $moneytable, $deletedtable;
		//check_and_create_money_table($deletedtable);
		delete_transaction($bill_id);
		append("<h3>Bill ".$bill_id." has been successfully deleted </h3>");
	}
	function revive_bill ($bill_id) {
		global $fgmembersite, $uname, $moneytable, $deletedtable;
		add_back_transaction($bill_id);
		append("<h3>Bill ".$bill_id." has been successfully revived </h3>");
	}
	function trash_bill ($bill_id) {
		global $fgmembersite, $uname, $moneytable, $deletedtable;
		delete_transaction_forever($bill_id);
		append("<h3>Bill ".$bill_id." has been deleted permanently</h3>");
	}
	function filemain() {
		if ($_POST['action'] == "summary")
			summary();
		else if ($_POST['action'] == "add-friend")
			add_friend($_POST['arg']);
		else if ($_POST['action'] == "add-bill" || $_POST['action'] == "add-payment") {
			$detailarr = json_decode($_POST['arg']);
			$paidarr = json_decode($_POST['arg2']);
			$partarr = json_decode($_POST['arg3']);
			add_edit_bill($detailarr, $paidarr, $partarr);
		} else if ($_POST['action'] == "view-transaction")
			view_transaction("cur", $_POST['arg']);
		else if ($_POST['action'] == "view-del-transaction")
			view_transaction("del");
		else if ($_POST['action'] == "bill-info"){
			get_bill_info($_POST['arg'], $_POST['arg2']);
		}
		else if ($_POST['action'] == "delete-bill")
			delete_bill($_POST['arg']);
		else if ($_POST['action'] == "revive-bill")
			revive_bill($_POST['arg']);
		else if ($_POST['action'] == "trash-bill")
			trash_bill($_POST['arg']);
	}

	function append($str) {
		global $retval;
		$retval .= $str;
	}
	function prepend($str) {
		global $retval;
		$retval = $str.$retval;
	}
	filemain();
	$arr = array("retval"=>$retval, "arg"=>$argstr);
	echo json_encode($arr);
?>
