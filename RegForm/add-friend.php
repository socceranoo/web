<?PHP
	require_once("access.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<?require_once("includes.php");?>
		<title>Add friends</title>
	</head>
	<body class='transactions' onload="money_add_friend_init();">
		<div id='other'>
		<div id='fg_membersite_content'>
		<div id='fg_membersite'>
			<h1><br><br><br>Add Friend's</h1>
			<?require_once("rest-elements.php");?>
			<div id='bill'>
			<form id='add-friend' name="add-friend">
				<fieldset>	
				<legend>Add-friends</legend>		
				<div class='short_explanation'>* required fields</div>
				<div class='container'>
					<label for='list'>Enter the email*</label><br/>
					<div id="dummy"></div>
					<input type=text id='email'/>
					<span id='add-friend_email_errorloc' class='error'></span>
					<input type="button" value="Add" onclick="add_to_friend_array();"/>
					<?check_and_add_user_table($pairtable);?>	
				</div>
				<div class='container'>
					<input type="submit"/>
				</div>
				<div id="success-add-friend" onlick="$('#success-add-friend').fadeOut(800,function(){})"></div>
				</fieldset>
			</form>
			</div>
		</div>
		<script type='text/javascript'>
		// <![CDATA[
			/*
			var frmvalidator  = new Validator("add-friend");
			frmvalidator.EnableOnPageErrorDisplay();
			frmvalidator.EnableMsgsTogether();
			frmvalidator.addValidation("list","req","Please select one user to add");
			frmvalidator.addValidation("email","email","Please provide a valid email address");
			*/
		// ]]>
			money_add_friend_ajax_init();
		</script>
		</div>
		</div>
	</body>
</html>

