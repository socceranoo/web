<?PHP
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/membersite_config.php");
	checklogin();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US" ng-app>
	<head>
		<?require_once("include/moneyheaders.php");?>
	</head>
	<body class='money background-white'>
		<div class="container">
			<!--
			<h1 class=text-center>Money Matters</h1>
			-->
			<hr class="featurette-divider3" />
			<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/topright.php");?>
			<?require_once("include/hiddenforms.php");?>
			<div class="row">
				<div class="span3">
					<?require_once("include/actionsbox.php");?>
					<?require_once("include/friendbox.php");?>
				</div>
				<div id=myCarousel class="span8 well carousel slide">
					<ul class="inline carousel-indicators">
						<li data-target="#myCarousel" data-slide-to="0" class=""></li>
						<li data-target="#myCarousel" data-slide-to="1" class=""></li>
						<li data-target="#myCarousel" data-slide-to="2" class="active"></li>
						<li data-target="#myCarousel" data-slide-to="3" class=""></li>
						<li data-target="#myCarousel" data-slide-to="4" class=""></li>
						<!--
						-->
					</ul>
					<div class="text-center span6 carousel-inner">
						<div class="item">
							<?require_once("include/summary.php");?>
						</div>
						<div class="item">
							<?require_once("include/friend-form.php");?>
						</div>
						<div class="item active">
							<?require_once("include/bill-form.php");?>
						</div>
						<div class="item">
							<?require_once("include/transactions.php");?>
						</div>
						<div class="item">
							<?require_once("include/deleted-transactions.php");?>
						</div>
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
