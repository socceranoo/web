<?PHP
	system("lessc style/home.less > style/home.css");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US" ng-app>
	<head>
		<?require_once("include/headers.php");?>
		<?require_once("include/loginheaders.php");?>
		<title>Error</title>
		<link href="http://gatoraze.com/style/home.css" rel="stylesheet">
	</head>
	<body class="background-cloud login">
		<div class="container background-eterRiver" ng-controller="Home">
			<h2 class=text-center>ERROR PAGE</h2>
		</div><!-- /.container -->
		<?require_once("include/footers.php");?>
	</body>
</html>

