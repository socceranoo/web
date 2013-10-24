<?PHP
	require_once("include/actions-include.php");
	if ($_REQUEST['edit']) {
		if (intval($_REQUEST['edit']) > 0) {
			$retval = "";
			$argstr = "";
			get_bill_info($_REQUEST['edit'], "cur");
		}
	}
	function paste_select($user, $user_arr, $option) {
		echo "<option selected='selected' value=default>select an option</option>";
		echo "<option value=$user>$user (you)</option>";
		foreach ($user_arr as $val) {  
			if ($val != "maniksundar" || $val != "socceranoo") {
				echo "<option value=$val>";
				echo $val;
				echo "</option>";
			}
		}
	}
?>
<div class=ngdiv id="abdiv" ng-controller="BillCtrl">
	<form id='add-bill'>
		<div id=bill-details class=hidden><?echo $argstr?></div>
		<input id='bill-flag' type=hidden ng-model=billId value='<?$tmp_id =($_REQUEST['edit'])?$_REQUEST['edit']:"";echo $tmp_id;?>'/>
		<!--
		-->
		<legend ng-hide="payment">Add-bill</legend>
		<legend ng-show="payment">Report Payment</legend>
		<sup><span ng-hide="payment" style="cursor:pointer" ng-click="togglePayment();"><a>Report Payment</a></span>
		<span ng-show="payment" style="cursor:pointer" ng-click="togglePayment();"><a>Add bill</a></span></sup>
		<div class=clearfix></div>
		<div class=featurette-divider3 style="color:red" id=genError ng-show=genError></div>
		<div ng-hide="payment">
			<div class="featurette-divider3">Event*:<input class=pull-right type='text' ng-model="event" required/></div>
			<div class="featurette-divider3">Description*:<textarea class=pull-right maxlength="150" ng-model="description" required></textarea></div>
		</div>
		<div class="featurette-divider3">Date*:<input class=pull-right type="date" required ng-model="date"/></div>
		<div class="featurette-divider3">Amount*: <input class=pull-right type=number step=any required ng-model="amount" ng-change="amountChange();"/></div>
		<div class="featurette-divider3" ng-show="payment">Payment From*<select class="pull-right" ng-model="Payer" ng-change="addPayerPayee(Payer, 0);"><?paste_select($uname, $stack, 0);?></select></div>
		<div class="featurette-divider3" ng-hide="payment">Who paid?*<select class="pull-right" ng-model="Payer" ng-change="addPayerPayee(Payer, 0);"><?paste_select($uname, $stack, 0);?></select></div>
		<div class="featurette-divider3">
			<sub ng-hide="payment" class="text-center" style="cursor:pointer" ng-click="resetFields(2);"><a>reset fields</a></sub>
			<sub ng-hide="payment" class="pull-right" style="cursor:pointer" ng-click="resetFields(0);"><a>equalize amounts</a></sub>
		</div>
		<div class=featurette-divider3 style="color:red" ng-show="paidAmountError">Please check the paid amounts*</div>
		<ul class="unstyled">
			<li class="clearfix featurette-divider4" ng-repeat="payer in paid">
				<span>{{payer.name}}</span>
				<span style="cursor:pointer;color:red" class="pull-right" ng-click="removePayerPayee(payer, 0);">X</span>
				<div class=pull-right ng-hide="payment">
					<!--
					<input class="pull-right" disabled type=checkbox ng-model=payer.edit />
					-->
					<input class="pull-right ind-amount" ng-change="paidAmountChange(payer);" ng-model=payer.amount />
				</div>
			</li>
		</ul>
		<div class="featurette-divider3" ng-show="payment">Payment to *<select class=pull-right ng-model="Payee" ng-change="addPayerPayee(Payee, 1);"><?paste_select($uname, $stack, 1);?></select></div>
		<div class="featurette-divider3" ng-hide="payment">Who participated?*<select class=pull-right ng-model="Payee" ng-change="addPayerPayee(Payee, 1);"><?paste_select($uname, $stack, 1);?></select></div>
		<div class="featurette-divider3">
			<sub ng-hide="payment" class="text-center" style="cursor:pointer" ng-click="resetFields(3);"><a>reset fields</a></sub>
			<sub ng-hide="payment" class="pull-right" style="cursor:pointer" ng-click="resetFields(1);"><a>equalize amounts</a></sub>
		</div>
		<div class=featurette-divider3 style="color:red" ng-show="partAmountError">Please check the part amounts*</div>
		<ul class="unstyled">
			<li class="clearfix featurette-divider4" ng-repeat="payee in part">
				<span>{{payee.name}}</span>
				<span style="cursor:pointer;color:red" class="pull-right" ng-click="removePayerPayee(payee, 1);">X</span>
				<div class=pull-right ng-hide="payment">
					<!--
					<input class="pull-right" disabled type=checkbox ng-model=payee.edit />
					-->
					<input class="pull-right" ng-change="partAmountChange(payee);" ng-model=payee.amount />
				</div>
			</li>
		</ul>
		<input class="btn btn-block btn-primary" type="submit"/>
	</form>
</div>
<!--
-->
