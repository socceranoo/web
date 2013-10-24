<?PHP
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/access.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US" ng-app>
	<head>
		<?require_once("include/moneyheaders.php");?>
	</head>
	<body class='money background-white'>
		<?require_once("include/headers.php");?>
		<div class="container">
			<!--
			<h1 class=text-center>Money Matters</h1>
			-->
			<div class="featurette-divider3"></div>
			<div class="row">
				<div class="span3">
					<?require_once("include/actionsbox2.php");?>
					<?require_once("include/friendbox2.php");?>
				</div>
				<div class="span8 well background-clouds">
					<div class="text-center" ng-controller="Summary">
						<?require_once("include/summary.php");?>
					</div>
				</div>
				<!--
				<div class="moneycontent span9 text-center" id=moneycontent>
					<div class="current-content well" id=current-content>
						<?//require_once("include/summary.php");?>
					</div>
				</div>
				<hr class="featurette-divider" />
				-->
			</div>
		</div>
		<?require_once("include/moneyfooters.php");?>
	</body>
</html>
