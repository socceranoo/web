$(document).ready(function() {
	//TestforChrome 
	/*
	var isChrome = testCSS('WebkitTransform');  // Chrome 1+
	if (!isChrome && false)
		setTimeout("window.location='notsupported.php'",1);
	$('input[type=password]').passStrengthify();
	*/
});

function Home($scope) {
	$('#myCarousel').carousel({
		interval:false
	});
}
function testCSS(prop) {
	return prop in document.documentElement.style;
}

function Login($scope) {
	$("#login-div").show();
	$scope.username = "guest1";
	$scope.password = "guest1";
	$scope.submit = function () {
		$scope.onError = false;
		$scope.$apply();
		var $form = $("#login-form"); 
		var $inputs = $form.find("input,input,input,input");
		$inputs.attr("disabled", "disabled", "disabled", "disabled");
		var uname = $scope.username;
		var pwd = $scope.password;
		var hidden = $("#login-submit").attr('value');
		var pgreq= $("#page-req").html();
		$.post("include/processform.php",{ formname: "login", loginsubmit:hidden, username:uname, password:pwd, page:pgreq},function(data){
			if (data.retval == "true") {
				window.location.href=data.url;
			} else {
				$scope.onError = true;
				$scope.password= "";
				$scope.$apply();
			}
			$inputs.removeAttr("disabled");
		}, "json");
	};
	$("#login-form").submit(function(event) {
		$scope.submit();	
	});
}
function Register($scope) {
	$("#register-div").show();
	$scope.fullname= "guest4 guest4";
	$scope.nickname= "guest4";
	$scope.email= "gatoraze@gmail.com";
	$scope.username = "guest4";
	$scope.password = "guest4";
	$scope.submit = function () {
		$scope.onError = false;
		$scope.$apply();
		var $form = $("#register-form"); 
		$inputs = $form.find("input","input","input","input","input","input", "input","input");
		$inputs.attr("disabled", "disabled", "disabled", "disabled", "disabled", "disabled", "disabled", "disabled");
		var uname = $scope.username;
		var pwd = $scope.password;
		var hidden = $("#register-submit").attr('value');
		var mail = $scope.email;
		var fname = $scope.fullname;
		var fnickname = $scope.nickname;
		$.post("include/processform.php",{ formname:"register", registersubmit:hidden, name:fname, username:uname, email:mail, password:pwd , nickname:fnickname},function(data){
			if (data.retval == "true") {
				$scope.onSuccess = true;
				$scope.$apply();
				$("#register-form").hide();
			} else {
				$("#reg-error").html(data.errormsg);
				$scope.onError = true;
				$scope.$apply();
				/*
				$scope.password= "";
				$scope.email= "";
				$scope.fullname= "";
				*/
			}
			$inputs.removeAttr("disabled");
		}, "json");
	};
	$("#register-form").submit(function(event) {
		$scope.submit();	
	});
}

function ResetPassword($scope) {
	$("#reset-div").show();
	$scope.email= "rasnud5@gmail.com";
	$scope.submit = function () {
		$scope.onError = false;
		$scope.$apply();
		var $form = $("#reset-form"); 
		var $inputs = $form.find("input","input","input");
		$inputs.attr("disabled", "disabled", "disabled");
		var mail = $scope.email;
		var hidden = $("#reset-submit").attr('value');
		$.post("include/processform.php",{ formname:"resetreq", resetreqsubmit: hidden, email:mail },function(data){
			if (data.retval == "true") {
				$scope.onSuccess = true;
				$scope.$apply();
				$("#reset-form").hide();
			} else {
				$("#reset-error").html(data.errormsg);
				$scope.onError = true;
				$scope.$apply();
			}
			$inputs.removeAttr("disabled");
		}, "json");
	};
	$("#reset-form").submit(function(event) {
		$scope.submit();	
	});
}
function ChangePassword($scope) {
	$("#changepwd-div").show();
	$scope.oldPassword= "guest1";
	$scope.newPassword= "guest1";
	$scope.confirmPassword= "guest2";
	$scope.submit = function () {
		$scope.onError = false;
		$scope.$apply();
		var $form = $("#changepwd-form"); 
		var $inputs = $form.find("input","input","input", "input");
		$inputs.attr("disabled", "disabled", "disabled", "disabled");
		var hidden = $("#changepwd-submit").attr('value');
		if ($scope.oldPassword == $scope.newPassword) {
			$("#changepwd-error").html("current and the new passwords are the same.");
			$scope.onError = true;
			$scope.$apply();
			$inputs.removeAttr("disabled");
			return;
		}
		if ($scope.confirmPassword !== $scope.newPassword) {
			$("#changepwd-error").html("Please confirm the correct password");
			$scope.onError = true;
			$scope.$apply();
			$inputs.removeAttr("disabled");
			return;
		}
		$.post("include/processform.php",{ formname:"changepwd", changepwdsubmit: hidden, oldpwd:$scope.oldPassword, newpwd:$scope.newPassword },function(data){
			if (data.retval == "true") {
				$scope.onSuccess = true;
				$scope.$apply();
				$("#changepwd-form").hide();
			} else {
				$("#changepwd-error").html(data.errormsg);
				$scope.onError = true;
				$scope.$apply();
			}
			$inputs.removeAttr("disabled");
		}, "json");
	};
	$("#changepwd-form").submit(function(event) {
		$scope.submit();	
	});
}

function process_ajax(formname, data){
	var retval= data.retval;
	var info= data.info;
	var url= data.url;
	var errormsg= data.errormsg;
	if (retval == "true") {
		if (formname == "login"){
			setTimeout("window.location='"+url+"'",0);
			return;
		}
		$("#success").html(info+url);
	} else {
		$("#"+formname+"error").html(errormsg);
	}
}

