<form id='login' method='post' accept-charset='UTF-8' align=left>
<fieldset >
	<legend>login</legend>
	<input type='hidden' name='loginsubmit' id='loginsubmit' value='1'/>
	<div class='short_explanation'>* required fields</div>
	<div><span class='error' id='loginerror'></span></div>
	<div class='container'>
		<label for='username' >username*:</label><br/>
		<input type='text' name='lusername' id='lusername' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50"/><br/>
		<span id='login_lusername_errorloc' class='error'></span>
	</div>
	<div class='container'>
		<label for='password' >password*:</label><br/>
		<input type='password' name='lpassword' id='lpassword' maxlength="50" /><br/>
		<span id='login_lpassword_errorloc' class='error'></span>
	</div>
	<div class='container'>
		<input type='submit' name='lSubmit' value='Log in' />
		<!--
		<input type="button" value="Reset Form" onclick="newreset('login');" />
		<input type="reset" value="Reset Form">
		<a href="javascript:void();" onclick="submitfunction();">Log in</a>
		-->
	</div>
	<div class='short_explanation'> <a href='javascript:void(0)' onclick="showhideform('resetreq', 'login');">Forgot Password?</a></div>
	<div class='short_explanation'> <a href='javascript:void(0)' onclick="showhideform('register', 'login');">New user?</a></div>
</fieldset>
</form>
<!-- client-side Form Validations:
	<div class='short_explanation'>Confirm Registration</div>
Uses the excellent form validation script from JavaScript-coder.com-->

<script type='text/javascript'>
// <![CDATA[
var frmvalidator  = new Validator("login");
frmvalidator.EnableOnPageErrorDisplay();
frmvalidator.EnableMsgsTogether();
frmvalidator.addValidation("lusername","req","Please provide your username");
frmvalidator.addValidation("lpassword","req","Please provide the password");
// ]]>
</script>
