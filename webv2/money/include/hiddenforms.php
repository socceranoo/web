<div id=afhidden class=hidden>
	<h3>Add-friends</h3>
	<h4>Enter the email</h4>
	<ul id="dummy" class=dummy></ul>
	<input type=email id='af-email'/>
	<input type="button" value="Add" onclick="add_to_friend_array();"/>
	<input type="button" value="Submit" id="add-friend-submit" onclick="//add_friend_submit();"/>
</div>
<div id=abhidden class=hidden>
<?PHP 
	$result = $fgmembersite->RunQuery("SELECT * FROM $pairtable WHERE user1='$uname' or user2='$uname'");
	$stack = array();
	while($row = mysql_fetch_array($result)) {  
		if ($row['user1'] == $uname)
		array_push($stack, $row['user2']);
		else if($row['user2'] == $uname)
		array_push($stack, $row['user1']);
	}
	sort($stack);
?>
	<form id='add-bill'>
		<fieldset>
			<legend>Add-bill</legend>

			<label>Event*: </label><br/>
			<input type='text' id="ab-event" required value="<?print $values['event'];?>"/><br/>

			<label>Description*: </label><br/>
			<textarea id="ab-desc" maxlength="150" required><?print $values['desc'];?></textarea><br/>

			<label>Date*:</label><br/>
			<input type="date" id="ab-date" required value="<?print $values['date'];?>"/><br/>
			<script type="text/javascript"> //calendar.set("date"); </script> 

			<label>Amount:* </label><br/>
			<input type="text" required id="ab-amount" value="<?print $values['amount'];?>"/>
			<label>Who paid?*</label>
			<select id="ab-paid" disabled><?paste_select_menu($uname, $stack, 0);?></select><br/>
			<a id=paid-reset-fields href='JavaScript:(void);'>reset fields</a>
			<ul id="dummy_paid" class=dummy></ul>
			<label>Who participated?*</label>
			<select id="ab-part" disabled><?paste_select_menu($uname, $stack, 1);?></select><br/>
			<a id=part-reset-fields href='JavaScript:(void);'>reset fields</a>
			<ul id="dummy_part" class=dummy></ul>
			<input type="submit"/>
		</fieldset>
	</form>
</div>
<div id=aphidden class=hidden>
	<form id='add-payment'>
		<fieldset>
			<legend>Add-Payment</legend>
			<div class=hidden id=ap-details>
			<label>Event*:</label><br/>
			<input type='text' id="ap-event" required value="<?print $values['event'];?>"/><br/>

			<label>Description*:</label><br/>
			<textarea id="ap-desc" maxlength="150" required><?print $values['desc'];?></textarea><br/>
			</div>
			<a id=show-payment-details href='JavaScript:(void);'>show details</a>
			</br/>
			<label>Date of Payment*:</label><br/>
			<input type="date" id="ap-date" required value="<?print $values['date'];?>"/><br/>

			<label>Amount:* </label><br/>
			<input type="text" required id="ap-amount" value="<?print $values['amount'];?>"/>
			<label>Select payer?*</label>
			<select id="ap-paid" disabled><?paste_select_menu($uname, $stack, 0);?></select><br/>
			<ul id="dummy_paid" class=dummy></ul>
			<label>Select who was paid?*</label>
			<select id="ap-part"><?paste_select_menu($uname, $stack, 1);?></select><br/>
			<ul id="dummy_part" class=dummy></ul>
			<input type="submit"/>
		</fieldset>
	</form>
</div>
