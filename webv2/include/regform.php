<form id='register' accept-charset='UTF-8'>
<fieldset >
<legend>register</legend>
<input type='hidden' name='registersubmit' id='registersubmit' value='1'/>
<span class='error' id='registererror'></span>
<div class='short_explanation'>* required fields</div>
<input type='text'  class='spmhidip' name='<?php echo $fgmembersite->GetSpamTrapInputName(); ?>' />
	<label>full name*: </label><br/>
	<input type='text' id='rname' required value='<?php echo $fgmembersite->SafeDisplay('name') ?>' maxlength="50" /><br/>
	<label>email*:</label><br/>
	<input type='email' id='remail' required pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" value='<?php echo $fgmembersite->SafeDisplay('email') ?>' maxlength="50" /><br/>
	<label>username*:</label><br/>
	<input type='text' id='rusername' required value='<?php echo $fgmembersite->SafeDisplay('username') ?>' maxlength="50" /><br/>
	<label>password*:</label><br/>
	<input type='password' id='rpassword' maxlength="50"/>
	<label>nickname*:</label><br/>
	<input type='text' id='rnickname' required value='<?php echo $fgmembersite->SafeDisplay('nickname') ?>' maxlength="50" /><br/>
<input type='submit' name='Submit' value='Submit' />
<div class='short_explanation'><a href='javascript:void(0)' onclick="showhideform('login', 'register');">Log in</a></div>
</fieldset>
</form>
