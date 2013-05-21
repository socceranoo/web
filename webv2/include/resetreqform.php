<form id='resetreq' accept-charset='UTF-8'>
<fieldset >
<legend>reset</legend>
<input type='hidden' id='resetreqsubmit' value='1'/>
<span class='error' id='resetreqerror'></span>
<div class='short_explanation'>* required fields</div>
<label>email*:</label><br/>
<input type='email' id='email' required pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" value='<?php echo $fgmembersite->SafeDisplay('email') ?>' maxlength="50" /><br/>
<div class='short_explanation'>a reset password link will be e-mailed to you.</div>
<input type='submit' name='Submit' value='Submit' />
<div class='short_explanation'> <a href='javascript:void(0)' onclick="showhideform('login', 'resetreq');">Back to login</a></div>
</fieldset>
</form>
