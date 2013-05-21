<form id='login' accept-charset='UTF-8' align=left>
<fieldset >
<legend>login</legend>
<input type='hidden' id='loginsubmit' value='1'/>
<div class='short_explanation'>* required fields</div>
<span class='error' id='loginerror'></span>
<label>username*:</label><br/>
<input type='text' id='lusername' required value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50"/><br/>
<label>password*:</label><br/>
<input type='password' required id='lpassword' maxlength="50" /><br/>
<input type='submit' name='lSubmit' value='Log in' />
<div class='short_explanation'> <a href='javascript:void(0)' onclick="showhideform('resetreq', 'login');">Forgot Password?</a></div>
<div class='short_explanation'> <a href='javascript:void(0)' onclick="showhideform('register', 'login');">New user?</a></div>
</fieldset>
</form>
