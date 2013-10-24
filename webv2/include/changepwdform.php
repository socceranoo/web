<div id=changepwd-div style="display:none" class="span4" ng-controller="ChangePassword">
	<div ng-show=onSuccess class="featurette-divider3"><span class='1error'>Your Password has been changed successfully.</span></div>
	<form id='changepwd-form' accept-charset='UTF-8'>
		<legend>Change Password</legend>
		<input type='hidden' id='changepwd-submit' value='1'/>
		<div ng-show=onError class="featurette-divider3"><span id=changepwd-error class='error'></span></div>
		<div class="featurette-divider3"><span class="input-field2">Current pwd*:</span><input class="pull-right input-field" type="password" maxlength="50" required ng-model="oldPassword"/></div>
		<div class="featurette-divider3"><span class="input-field2">New pwd*:</span><input class="pull-right input-field" type="password" maxlength="50" required ng-model="newPassword"/></div>
		<div class="featurette-divider3"><span class="input-field2">Confirm pwd*:</span><input class="pull-right input-field" type="password" maxlength="50" required ng-model="confirmPassword"/></div>
		<input type='submit' class="btn btn-primary btn-block" value='Submit'/>
		<div class="featurette-divider3"></div>
	</form>
	<a class="btn btn-success" href='home.php'>Back to home</a>
</div>
