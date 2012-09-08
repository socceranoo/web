<?PHP
	require_once("access.php");
	function paste_select_menu($user, $user_arr)
	{
		echo "<option value=$user>";
		echo $user."(You)";
		echo "</option>";
		foreach ($user_arr as $val)
		{
			echo "<option value=$val>";
			echo $val;
			echo "</option>";
		}
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
				$result = $fgmembersite->RunQuery("SELECT * FROM $uname");
				$stack = array();
				while($row = mysql_fetch_array($result)) 
				{
					array_push($stack, $row['user2']);	
				}
			?>
			<div id='bill' >
			<div id='fg_membersite'>
			<form id='add-bill' action=process_bill.php name='add-bill' method=post align=left>
					<input type='hidden' name='submitted' id='submitted' value='1'/>
					<div class='short_explanation'>* required fields</div>
					<div class='container'>
						<label for='event'>Event*: </label><br/>
						<input type='text' id="event" name="event"/><br/>
						<span id='add-bill_event_errorloc' class='error'></span>
					</div>
					<div class='container'>
						<label for='desc'>Description: </label><br/>
						<textarea name="desc" id="desc"></textarea><br/>
						<span id='add-bill_desc_errorloc' class='error'></span>
					</div>
					<div class='container'>
						<label for='date'>Date*:</label><br/>
						<input type="text" name="date" id="date"/><br/>
						<script type="text/javascript"> calendar.set("date"); </script> 
						<span id='add-bill_date_errorloc' class='error'></span>
					</div>
					<div class='container'>
						<label for='amount'>Amount:* </label><br/>
						<input type="text" name="amount" id="amount"/><br/>
						<span id='add-bill_amount_errorloc' class='error'></span>
					</div>
					<div class='container'>
						<label for='paid'>Who paid?*</label><br/>
						<select name="paid"><? paste_select_menu($uname, $stack);?></select><br/>
						<span id='add-bill_paid_errorloc' class='error'></span>
					</div>
					<div class='container'>
						<label for='participants'>Who participated ?</label><br>
						<select name="participants[]" multiple="multiple"><?paste_select_menu($uname, $stack);?>
						</select>
						<span id='add-bill_participants_errorloc' class='error'></span>
					</div>
					<div class='container'>
						<input type="submit" />
					</div>
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
		</div>
	</body>
</html>

