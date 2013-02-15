<form id='resetreq' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>reset</legend>
<input type='hidden' name='resetreqsubmit' id='resetreqsubmit' value='1'/>
<div class='short_explanation'>* required fields</div>
<div><span class='error' id='resetreqerror'></span></div>
<div class='container'>
    <label for='username' >email*:</label><br/>
    <input type='text' name='email' id='email' value='<?php echo $fgmembersite->SafeDisplay('email') ?>' maxlength="50" /><br/>
    <span id='resetreq_email_errorloc' class='error'></span>
</div>
<div class='short_explanation'>a reset password link will be e-mailed to you.</div>
<div class='container'>
    <input type='submit' name='Submit' value='Submit' />
</div>
	<div class='short_explanation'> <a href='javascript:void(0)' onclick="showhideform('login', 'resetreq');">Back to login</a></div>
</fieldset>
</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->
<script type='text/javascript'>
// <![CDATA[
    var frmvalidator2  = new Validator("resetreq");
    frmvalidator2.EnableOnPageErrorDisplay();
    frmvalidator2.EnableMsgsTogether();
    frmvalidator2.addValidation("email","req","Please provide the email address used to sign-up");
    frmvalidator2.addValidation("email","email","Please provide the email address used to sign-up");

// ]]>
</script>
