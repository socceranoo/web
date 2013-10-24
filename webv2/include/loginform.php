<div id=login-div style="display:none" ng-controller="Login">
	<form id='login-form' accept-charset='UTF-8'>
	<legend class=text-center>login</legend>
	<input type='hidden' id='login-submit' value='1'/>
	<div ng-show=onError class="featurette-divider3"><span class='error'>The username or password you provided does not match our records.</span></div>
	<div class="featurette-divider3"><span class="input-field">username*:</span><input class=pull-right type="text" maxlength="50" required ng-model="username"/></div>
	<div class="featurette-divider3"><span class="input-field">password*:</span><input class=pull-right type="password" maxlength="50" required ng-model="password"/></div>
	<input type='submit' class="btn btn-primary btn-block" value='Log in'/>
	<div class="featurette-divider3"></div>
	<a class="btn btn-danger" href='forgot-password.php'>Forgot Password?</a>
	<a class="btn btn-inverse" href='register.php'>New user?</a>
	</form>
</div>
