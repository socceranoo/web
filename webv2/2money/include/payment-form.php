<form id='add-payment'>
	<legend>Add-Payment</legend>
	<div class=hidden id=ap-details>
		<label>Event*:</label><br/>
		<input type='text' id="ap-event" required value="<?print $values['event'];?>"/><br/>
		<label>Description*:</label><br/>
		<textarea id="ap-desc" maxlength="150" required><?print $values['desc'];?></textarea><br/>
	</div>
	<a id=show-payment-details href='JavaScript:(void);'>show details</a></br/>
	<label>Date of Payment*:</label><br/>
	<input type="date" id="ap-date" required value="<?print $values['date'];?>"/><br/>
	<label>Amount:* </label><br/>
	<input type="text" required id="ap-amount" value="<?print $values['amount'];?>"/>
	<label>Select payer?*</label>
	<select id="ap-paid" >
		<?paste_select_menu($uname, $stack, 0);?>
	</select><br/>
	<ul id="dummy_paid" class=dummy></ul>
	<label>Select who was paid?*</label>
	<select id="ap-part">
		<?paste_select_menu($uname, $stack, 1);?>
	</select><br/>
	<ul id="dummy_part" class=dummy>
	</ul>
	<input type="submit"/>
</form>
