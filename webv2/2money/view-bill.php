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
			<hr class="featurette-divider3" />
			-->
			<div class="featurette-divider3"></div>
			<div class="row">
				<div class="span3">
					<?require_once("include/actionsbox2.php");?>
					<?require_once("include/friendbox2.php");?>
				</div>
				<div class="span9">
					<div class="text-center well" ng-controller="BillOpr">
						<?require_once("include/view-bill.php");?>
						<div id='bill-opr' style="display:none;" data-auth='<?echo $empty_bill;?>' data-id='<?echo $_REQUEST['id'];?>' data-opr='<?echo $_REQUEST['opr'];?>'>
							<legend>Bill details</legend>
							<div><?echo $retval;?></div>
							<a ng-show='delete' id='delete-button' href='javascript:void(0);' class='btn btn-large btn-warning'>delete</a>
							<a ng-show='revive' id='revive-button' href='javascript:void(0);' class='btn btn-large btn-success'>revive</a>
							<a ng-show='trash' id='trash-button' href='javascript:void(0);' class='btn btn-large btn-danger'>shift-delete</a>
							<a ng-show='cancel' href='summary.php' class='btn btn-large btn-info'>cancel</a>
						</div>
						<h3 style="display:none;" id=invalid-bill ng-show='invalidBill'>Invalid Bill Id</h3>
						<div id=bill-info ></div>
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
