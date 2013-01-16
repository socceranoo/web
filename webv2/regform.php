<form id='register' action='<?php echo $fgmembersite->GetSelfScript(); register();?>' method='post' accept-charset='UTF-8'>
<fieldset >
<legend>register</legend>
<input type='hidden' name='submitted' id='submitted' value='1'/>
<div class='short_explanation'>* required fields</div>
<input type='text'  class='spmhidip' name='<?php echo $fgmembersite->GetSpamTrapInputName(); ?>' />
<div><span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span></div>
<div class='container'>
    <label for='name' >full name*: </label><br/>
    <input type='text' name='name' id='name' value='<?php echo $fgmembersite->SafeDisplay('name') ?>' maxlength="50" /><br/>
    <span id='register_name_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='email' >email*:</label><br/>
    <input type='text' name='email' id='email' value='<?php echo $fgmembersite->SafeDisplay('email') ?>' maxlength="50" /><br/>
    <span id='register_email_errorloc' class='error'></span>
</div>
<div class='container'>
    <label for='username' >username*:</label><br/>
    <input type='text' name='username' id='username' value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
    <span id='register_username_errorloc' class='error'></span>
</div>
<div class='container' style='height:80px;'>
    <label for='password' >password*:</label><br/>
    <noscript>
    <input type='password' name='password' id='password' maxlength="50"/>
    </noscript>    
    <div class='pwdwidgetdiv' id='thepwddiv' ></div>
</div>
<div id='register_password_errorloc' class='error' style='clear:both'></div>
<div class='container'><input type='submit' name='Submit' value='Submit' /></div>
<div class='short_explanation'><a href='javascript:void(0)' onclick="showhideform('login');">Log in</a></div>
</fieldset>
</form>
<!-- client-side Form Validations:
Uses the excellent form validation script from JavaScript-coder.com-->
<script type='text/javascript'>
// <![CDATA[
    var pwdwidget = new PasswordWidget('thepwddiv','password');
    pwdwidget.MakePWDWidget();
    
    var frmvalidator  = new Validator("register");
    frmvalidator.EnableOnPageErrorDisplay();
    frmvalidator.EnableMsgsTogether();
    frmvalidator.addValidation("name","req","Please provide your name");
    frmvalidator.addValidation("email","req","Please provide your email address");
    frmvalidator.addValidation("email","email","Please provide a valid email address");
    frmvalidator.addValidation("username","req","Please provide a username");
    frmvalidator.addValidation("username","maxlen","Username can be max 16 chars");
    frmvalidator.addValidation("password","req","Please provide a password");

// ]]>
</script>
