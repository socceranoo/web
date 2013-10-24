<div id=register-div style="display:none" ng-controller="Register">
	<div ng-show=onSuccess class="featurette-divider3"><h2>Welcome {{fullname}}</h2><span>Thank you for registering. Your confirmation email is on its way. Please click the link in the email to complete the registration.Please check your spam folder if you do not see it in your inbox. Sorry for the inconvenience.</span></div>
	<form id='register-form' accept-charset='UTF-8'>
		<legend class=text-center>register</legend>
		<input type='hidden' id='register-submit' value='1'/>
		<div ng-show=onError class="featurette-divider3"><span id=reg-error class='error'></span></div>
		<!--
		<input type='text' class='spmhidip' name='<?php echo $fgmembersite->GetSpamTrapInputName(); ?>' />
		-->
		<div class="featurette-divider3"><span class="input-field">fullname*:</span><input class="pull-right input-field" type="text" maxlength="50" required ng-model="fullname"/></div>
		<div class="featurette-divider3"><span class="input-field">email*:</span><input class="pull-right input-field" type="email" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" maxlength="50" required ng-model="email"/></div>
		<div class="featurette-divider3"><span class="input-field">username*:</span><input class="pull-right input-field" type="text" maxlength="50" required ng-model="username"/></div>
		<div class="featurette-divider3"><span class="input-field">password*:</span><input class="pull-right input-field" type="password" maxlength="50" required ng-model="password"/></div>
		<div class="featurette-divider3"><span class="input-field">nickname*:</span><input class="pull-right input-field" type="text" maxlength="50" required ng-model="nickname"/></div>
		<input type='submit' class="btn btn-primary btn-block" value='Submit'/>
		<div class="featurette-divider3"></div>
		<a class="btn btn-success" href='login.php'>Login</a>
	</form>
</div>
