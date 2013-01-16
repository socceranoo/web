<form id='login' action='<?php echo $fgmembersite->GetSelfScript(); login();?>' method='post' accept-charset='UTF-8' align=left>
<fieldset >
	<legend>login</legend>
	<input type='hidden' name='submitted' id='submitted' value='1'/>
	<div class='short_explanation'>* required fields</div>
	<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
	<div class='container'>
		<label for='username' >username*:</label><br/>
		<input type='text' name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50"/><br/>
		<span id='login_username_errorloc' class='error'></span>
	</div>
	<div class='container'>
		<label for='password' >password*:</label><br/>
		<input type='password' name='password' id='password' maxlength="50" /><br/>
		<span id='login_password_errorloc' class='error'></span>
	</div>
	<div class='container'><input type='submit' name='Submit' value='Log in' /></div>
	<div class='short_explanation'> <a href='javascript:void(0)' onclick="showhideform('resetreq');">Forgot Password?</a></div>
	<div class='short_explanation'> <a href='javascript:void(0)' onclick="showhideform('register');">New user?</a></div>
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
frmvalidator.addValidation("username","req","Please provide your username");
frmvalidator.addValidation("password","req","Please provide the password");
// ]]>
</script>
