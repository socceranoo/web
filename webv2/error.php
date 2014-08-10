<?PHP
	system("lessc style/home.less > style/home.css");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US" ng-app>
	<head>
		<?require_once("include/headers.php");?>
		<?require_once("include/loginheaders.php");?>
		<title>Error 404 Not Found</title>
		<link href="http://gatoraze.com/style/home.css" rel="stylesheet">
	</head>
	<body class="background-peterRiver">
		<div class="container background-eterRiver" ng-controller="Home">
			<div class="row">
				<h2 class="text-center"><a href="http://gatoraze.com">gatoraze.com</a></h2>
				<div class="span6 offset3"><img src="images/404-not-found.png" alt=""></div>
			</div>
		</div><!-- /.container -->
		<?require_once("include/footers.php");?>
	</body>
</html>

