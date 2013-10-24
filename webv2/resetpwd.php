<?PHP
	system("lessc style/home.less > style/home.css");
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/membersite_config.php");
	$success = false;
	if($fgmembersite->ResetPassword()) {
		$success=true;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US" ng-app>
	<head>
		<?require_once("include/headers.php");?>
		<?require_once("include/loginheaders.php");?>
	</head>
	<body class='background-cloud login'>
		<div class=container>
			<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/topright.php");?>
			<div class="featurette-divider4"></div>
			<h3 class="text-right website-heading" style="font-size:50px;">GATORAZE.COM</h3>
			<hr class="featurette-divider4">
			<div class=row>
				<div class=span4>
					<?php
					if($success){
					?>
						<h2>Password is Reset Successfully</h2>
						Your new password is sent to your email address.
					<?php
					}else{
					?>
						<h2>Error</h2>
						<span class='error'><?php echo $fgmembersite->GetErrorMessage(); ?></span>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</body>
</html>
