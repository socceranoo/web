<?PHP
	require_once("access.php");
	function paste_select_menu($user, $user_arr, $option)
	{
		global $values, $flag;
		$sel="";
		if ($option == 0)
			$array=unserialize($values['paid']);
		else
			$array=unserialize($values['participants']);

		if (($flag=="new" && $option==0) || in_array($user, $array))
			$sel ="selected=\"selected\"";
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
	function get_field_value($array, $field)
	{
		return $array["$field"];		
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<?require_once("includes.php");?>
		<title>Add bill</title>
		<link rel="STYLESHEET" type="text/css" href="style/calendar.css">
		<script type='text/javascript' src='scripts/calendar.js'></script>
	</head>
	<body>
		<div id='other'>
		<div id='fg_membersite_content'>
			<h2><br><br><br>Add bill</h2>
			<?PHP
				require_once("operations.php");
				$flag = $_REQUEST["flag"];
				if ($flag == "old")
				{
					$values = array("id" => $_REQUEST['id'],
							"event" => $_REQUEST['event'],
							"desc" => $_REQUEST['desc'],
							"date" => $_REQUEST['date'],
							"paid" => $_REQUEST['paid'],
							"participants" => $_REQUEST['participants'],
							"amount" => $_REQUEST['amount'],
							);
				}
				$result = $fgmembersite->RunQuery("SELECT * FROM $uname");
				$stack = array();
				while($row = mysql_fetch_array($result)) 
				{
					array_push($stack, $row['user2']);	
				}
			?>
		</div>
			<div id='bill'>
			<div id='fg_membersite'>
			<form id='add-bill' action="process_bill.php?flag=" name='add-bill' method=post align=left>
				<fieldset>
					<legend>Add-bill</legend>
					<input type='hidden' name='submitted' id='submitted' value='1'/>
					<input type='hidden' name='flag' id='flag' value="<?print $flag?>"/>
					<input type='hidden' name='id' id='id' value="<?print $values['id']?>"/>
					<div class='short_explanation'>* required fields</div>
					<div class='container'>
						<label for='event'>Event*: </label><br/>
						<input type='text' id="event" name="event" value="<?print $values['event'];?>"/><br/>
						<span id='add-bill_event_errorloc' class='error'></span>
					</div>
					<div class='container'>
						<label for='desc'>Description: </label><br/>
						<textarea name="desc" id="desc" maxlength="150"><?print $values['desc'];?></textarea><br/>
						<span id='add-bill_desc_errorloc' class='error'></span>
					</div>
					<div class='container'>
						<label for='date'>Date*:</label><br/>
						<input type="text" name="date" id="date"value="<?print $values['date'];?>"/><br/>
						<script type="text/javascript"> calendar.set("date"); </script> 
						<span id='add-bill_date_errorloc' class='error'></span>
					</div>
					<div class='container'>
						<label for='amount'>Amount:* </label><br/>
						<input type="text" name="amount" id="amount" value="<?print $values['amount'];?>"/><br/>
						<span id='add-bill_amount_errorloc' class='error'></span>
					</div>
					<div class='container'>
						<label for='paid'>Who paid?*</label><br/>
						<select name="paid[]"><?paste_select_menu($uname, $stack, 0);?></select><br/>
						<span id='add-bill_paid_errorloc' class='error'></span>
					</div>
					<div class='container'>
						<label for='participants'>Who participated ?</label><br>
						<select name="participants[]" multiple="multiple"><?paste_select_menu($uname, $stack, 1);?>
						</select>
						<span id='add-bill_participants_errorloc' class='error'></span>
					</div>
					<div class='container'>
						<!--<input type="submit" onclick=loadContent('dummy', 'process_bill.php'/>-->
						<input type="submit"/>
					</div>
					<div id='dummy'>
					</div>
				</fieldset>
			</form>
			</div>
			</div>
			<!-- client-side Form Validations:
			Uses the excellent form validation script from JavaScript-coder.com-->

			<script type='text/javascript'>
			// <![CDATA[
				var frmvalidator  = new Validator("add-bill");
				frmvalidator.EnableOnPageErrorDisplay();
				frmvalidator.EnableMsgsTogether();
				frmvalidator.addValidation("event","req","Please provide an event");
				frmvalidator.addValidation("date","req","Please provide the date");
				frmvalidator.addValidation("amount","req","Please provide the amount");
				frmvalidator.addValidation("date", "date","Please enter a valid date");
				frmvalidator.addValidation("amount","numeric","Please enter a valid amount");
				frmvalidator.addValidation("paid","req","Please provide who paid");
				//frmvalidator.addValidation("participants","req","Please provide who participants");
			// ]]>
			</script>
		</div>
	</body>
</html>

