<div id=reset-div style="display:none" ng-controller="ResetPassword">
	<div ng-show=onSuccess class="featurette-divider3"><span class='1error'>An email is sent to your email address that contains the link to reset the password.Please check your spam if you do not find it in inbox.</span></div>
	<form id='reset-form' accept-charset='UTF-8'>
		<legend class=text-center>reset password</legend>
		<div ng-show=onError class="featurette-divider3"><span id=reset-error class='error'></span></div>
		<input type='hidden' id='reset-submit' value='1'/>
		<div class="featurette-divider3"><span class="input-field">email*:</span><input class="pull-right input-field" type="email" pattern="^[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})$" maxlength="50" required ng-model="email"/></div>
		<div class="featurette-divider3"><span>a reset password link will be e-mailed to you.</span></div>
		<input type='submit' class="btn btn-primary btn-block" value='Submit'/>
		<div class="featurette-divider3"></div>
		<a class="btn btn-success" href='login.php'>Login</a>
	</form>
</div>
