<?PHP
	system("lessc style/home.less > style/home.css");
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/membersite_config.php");
	$fgmembersite->LogOut();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US" ng-app>
	<head>
		<?require_once("include/headers.php");?>
		<?require_once("include/loginheaders.php");?>
	</head>
	<body class='background-clouds'>
		<div class=container>
			<div class="featurette-divider4"></div>
			<h3 class=website-heading>gatoraze.com</h3>
			<hr class="featurette-divider4">
			<div class=row>
				<div class=span4>
					<h4>You have logged out successfully</h4>
					<a class="btn btn-custom4 btn-success" href='login.php'>Login</a>
				</div>
			</div>
		</div>
	</body>
</html>
