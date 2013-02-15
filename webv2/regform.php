<form id='register' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>register</legend>
<input type='hidden' name='registersubmit' id='registersubmit' value='1'/>
<div class='short_explanation'>* required fields</div>
<input type='text'  class='spmhidip' name='<?php echo $fgmembersite->GetSpamTrapInputName(); ?>' />
<div><span class='error' id='registererror'></span></div>
<div class='container'>
    <label for='name' >full name*: </label><br/>
    <input type='text' name='rname' id='rname' value='<?php echo $fgmembersite->SafeDisplay('name') ?>' maxlength="50" /><br/>
    <span id='register_rname_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='email' >email*:</label><br/>
    <input type='text' name='remail' id='remail' value='<?php echo $fgmembersite->SafeDisplay('email') ?>' maxlength="50" /><br/>
    <span id='register_remail_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='username' >username*:</label><br/>
    <input type='text' name='rusername' id='rusername' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
    <span id='register_rusername_errorloc' class='error'></span>
</div>
<div class='container' style='height:80px;'>
    <label for='password' >password*:</label><br/>
    <noscript>
    <input type='password' name='rpassword' id='rpassword' maxlength="50"/>
    </noscript>    
    <div class='pwdwidgetdiv' id='thepwddiv' ></div>
</div>
<div id='register_rpassword_errorloc' class='error' style='clear:both'></div>
<div class='container'><input type='submit' name='Submit' value='Submit' /></div>
<div class='short_explanation'><a href='javascript:void(0)' onclick="showhideform('login', 'register');">Log in</a></div>
</fieldset>
</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->
<script type='text/javascript'>
// <![CDATA[
    var pwdwidget = new PasswordWidget('thepwddiv','rpassword');
    pwdwidget.MakePWDWidget();
    
    var frmvalidator1  = new Validator("register");
    frmvalidator1.EnableOnPageErrorDisplay();
    frmvalidator1.EnableMsgsTogether();
    frmvalidator1.addValidation("rname","req","Please provide your name");
    frmvalidator1.addValidation("remail","req","Please provide your email address");
    frmvalidator1.addValidation("remail","email","Please provide a valid email address");
    frmvalidator1.addValidation("rusername","req","Please provide a username");
    frmvalidator1.addValidation("rusername","maxlen","Username can be max 16 chars");
    frmvalidator1.addValidation("rpassword","req","Please provide a password");

// ]]>
</script>
