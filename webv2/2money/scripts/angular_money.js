var afsubmit;
$(document).ready(function() {
	$('#myCarousel').carousel({
		interval:false
	}); 
	$("#add-friend").submit(function(event) {
		afsubmit();
	});
	/*
	$("#temp-click").click(function(event) {
		$('#myCarousel').carousel(2);
	});
	$("#li_summary").click(summary_ajax);
	$("#li_view-transaction").click(view_transaction_ajax);
	$("#li_view-del-transaction").click(view_del_transaction_ajax);
	$("#li_add-friend").click(show_af_form);
	$("#li_add-bill").click(show_ab_form);
	$("#li_add-payment").click(show_ap_form);
	$('.close').click(close_payer_payee);
	$(".userclick").click(view_user_transaction_ajax);
	*/
	//summary_ajax();
	//test_function();
});

function FriendCtrl($scope) {
	$scope.friends = [];
	$scope.safeApply = function( fn ) {
		var phase = this.$root.$$phase;
		if(phase == '$apply' || phase == '$digest') {
			if(fn) {
				fn();
			}
		} else {
			this.$apply(fn);
		}
	};
	$scope.addFriend = function() {
		var value_found = false;
		for (var i = 0, len = $scope.friends.length; i < len; i++) {
			if ($scope.friends[i].email == $scope.friendEmail) {
				value_found = true;	
			}
		}
		if (!value_found && $scope.friendEmail) {
			$scope.friends.push({email:$scope.friendEmail});
		}
		$scope.friendEmail = '';
	};

	$scope.temppush = function() {
		$scope.friends.push({email:"asdasd@asdas.com"});
	};
	$scope.submitFriend = function() {
		//alert(JSON.stringify($scope.friends));
		var friendarray = [];
		if ($scope.friends.length > 0 ){
			for (var i = 0, len = $scope.friends.length; i < len; i++) {
				friendarray.push($scope.friends[i].email);
			}
			$.post("include/action.php", {action:"add-friend", arg:friendarray}, function(data){
				var e = document.getElementById('afdiv');
				var scope = angular.element(e).scope();
				// update the model with a wrap in $apply(fn) which will refresh the view for us
				scope.$apply(function() {
					scope.empty();
				});
				alert(data.retval);
			}, "json");
		} else {
			alert("NO emails added");
		}
		
	};
	$scope.empty = function() {
		$scope.friends = [];
	};

	$("#afdiv").show();
	afsubmit = $scope.submitFriend;
}
function BillCtrl($scope) {
	$scope.event;
	$scope.description;
	$scope.amount = 0.00;
	$scope.billId = $("#bill-flag").attr('value');
	$scope.oldBillDetails = $("#bill-details").html();
	//alert($scope.billId);
	$scope.date = new Date().toJSON().slice(0,10);
	$scope.paid = [];
	$scope.part = [];
	$scope.processOldBill = function() {
		var obj = JSON.parse($scope.oldBillDetails);
		$scope.event = obj.event;
		$scope.description = obj.desc;
		$scope.date = obj.date;
		$scope.amount = parseFloat(obj.amount);
		var match = /^Payment$/i.exec($scope.event);
		if (match) {
			$scope.payment = true;
		}
		var paidarr = JSON.parse(obj.paid);
		var partarr = JSON.parse(obj.part);
		for (var key in paidarr){
			if (paidarr.hasOwnProperty(key)) {
				$scope.paid.push({name:key, amount:paidarr[key], edit:false});
			}
		}
		for (key in partarr){
			if (partarr.hasOwnProperty(key)) {
				$scope.part.push({name:key, amount:partarr[key], edit:false});
			}
		}
	};
	$scope.togglePayment = function() {
		$scope.payment = !$scope.payment;
		$scope.resetFields(3);
		$scope.resetFields(2);
		$scope.billId = -1;
		$scope.initValues();
	};
	$scope.safeApply = function( fn ) {
		var phase = this.$root.$$phase;
		if(phase == '$apply' || phase == '$digest') {
			if(fn) {
				fn();
			}
		} else {
			this.$apply(fn);
		}
	};
	$scope.paidAmountChange = function(elem) {
		elem.edit = true;
		$scope.changeAmounts($scope.paid, 0);
	};
	$scope.partAmountChange = function(elem) {
		elem.edit = true;
		$scope.changeAmounts($scope.part, 1);
	};
	$scope.amountChange = function () {
		if ($scope.payment) {
			if ($scope.paid.length > 0)
				$scope.paid[0].amount = $scope.amount;
			if ($scope.part.length > 0)
				$scope.part[0].amount = $scope.amount;
			return;
		}
		$scope.resetFields(0);
		$scope.resetFields(1);
		/*
		var amt = $scope.amount/$scope.paid.length;
		amt=amt.toFixed(2);
		for (var i = 0; i < $scope.paid.length; i++) {
			$scope.paid[i].amount = amt;
			$scope.paid[i].edit = false;
		}
		amt = $scope.amount/$scope.part.length;
		amt=amt.toFixed(2);
		for (i = 0; i < $scope.part.length; i++) {
			$scope.part[i].amount = amt;
			$scope.part[i].edit = false;
		}
		*/
	};
	$scope.resetEdits = function (elem) {
		for (var i = 0; i < elem.length; i++) {
			elem.edit = false;
		}
		//alert($scope.paid[0].edit);
	};
	$scope.addPayerPayee = function(user, option) {
		if (user == "default") 
			return;
		$scope.Payee = "default";
		$scope.Payer = "default";
		var user_found = false;
		var elem = null;
		if (option === 1) {
			elem = $scope.part;
		} else {
			elem = $scope.paid;
		}
		//alert("payment = "+$scope.payment);
		if ($scope.payment) {
			if (elem.length === 0) {
				elem.push({name:user, amount:$scope.amount, edit:false});
			}else {
				elem[0].name = user;
			}
			return;
		}
		for (var i = 0, len = elem.length; i < len; i++) {
			if (elem[i].name == user) {
				user_found = true;	
			}
		}
		if (!user_found && user) {
			elem.push({name:user, amount:0, edit:false});
			$scope.changeAmounts(elem, option);
		}
	};
	$scope.changeAmounts = function (elem, option) {
		var rest_amount= $scope.amount;
		var rest_count = elem.length;
		var edited_amount= 0;
		if (rest_count === 0) {
			return;
		}
		for (var i = 0; i < elem.length; i++) {
			if (elem[i].edit === true) {
				rest_amount = rest_amount - elem[i].amount;
				rest_count--;
				edited_amount += elem[i].amount;
			}
		}
		if (rest_count === 0) {
			$scope.checkFinalAmount(elem, option);
			return;
		}
		var amt = parseFloat(rest_amount/rest_count).toFixed(2);
		var final_amt = parseFloat(amt * rest_count).toFixed(2);
		var diff = parseFloat(rest_amount - final_amt).toFixed(2);
		final_amt = (parseFloat(amt) + parseFloat(diff)).toFixed(2);
		for (i = 0, j = 0; i < elem.length; i++) {
			if (elem[i].edit === false) {
				if (j == (rest_count - 1)){
					elem[i].amount = final_amt;
				} else {
					elem[i].amount = amt;
				}
				j++;
			}
		}
		$scope.checkFinalAmount(elem, option);
	};
	
	$scope.checkFinalAmount = function(elem, option) {
		var retval = true;
		var final_amount = 0.00;
		for (i = 0; i < elem.length; i++) {
			if (parseFloat(elem[i].amount) > 0 ){
				final_amount = (parseFloat(final_amount) + parseFloat(elem[i].amount)).toFixed(2);
			}
		}
		//alert("FINAL AMOUNT ="+final_amount+" ACtual "+$scope.amount);
		if (final_amount != $scope.amount) {
			retval = false;
			if (option === 0)
				$scope.paidAmountError = true;
			else
				$scope.partAmountError = true;
		}else {
			if (option === 0)
				$scope.paidAmountError = false;
			else
				$scope.partAmountError = false;
		}
		return retval;
	};
	$scope.validations = function () {
		$scope.checkFinalAmount($scope.paid, 0);
		$scope.checkFinalAmount($scope.part, 1);
		$scope.$apply();
		if ($scope.paidAmountError || $scope.partAmountError) {
			return false;
		}
		if ($scope.amount == 0) {
			$("#genError").html("Amount cannot be 0");
			return false;
		}
		if ($scope.paid.length === 0 || $scope.part.length === 0) {
			$("#genError").html("Atleast one payee or participant must be present");
			return false;
		}
		if ($scope.payment){
			if ($scope.paid[0].name == $scope.part[0].name) {
				$("#genError").html("Payment from and to fields are same");
				return false;
			}
		}
		$scope.genError = false;
		$("#genError").html("");
		return true;
	};
	$scope.submitBill = function() {
		var retval = $scope.validations();
		if (!retval) {
			$scope.genError = true;
			$scope.$apply();
			return;
		}
		if ($scope.payment){
			$scope.event = "Payment";
			$scope.description ="From "+$scope.paid[0].name+" to "+$scope.part[0].name+" on "+$scope.date;
		} else {
			if ($scope.event == "Payment") {
				$scope.event = "Payment..." ;
			}
		}
		var detailarray = {};
		var paidjsonarray = {};
		var partjsonarray = {};
		for (var i = 0; i < $scope.paid.length; i++) {
			paidjsonarray[$scope.paid[i].name]= $scope.paid[i].amount;
		}
		for (i = 0; i < $scope.part.length; i++) {
			partjsonarray[$scope.part[i].name]= $scope.part[i].amount;
		}
		detailarray.flag="new";
		detailarray.bill_id=$scope.billId;
		if ($scope.billId != -1) {
			detailarray.flag="old";
		}
		detailarray.event=$scope.event;
		detailarray.desc=$scope.description;
		detailarray.date=$scope.date;
		detailarray.amount=$scope.amount;
		//alert(detailarray['bill_id']);
		var detailstr = JSON.stringify(detailarray);
		var paidstr = JSON.stringify(paidjsonarray);
		var partstr = JSON.stringify(partjsonarray);
		$.post("include/action.php", {action:"add-bill", arg:detailstr, arg2:paidstr, arg3:partstr}, function(data){
			/*
			$scope.resetFields(3);
			$scope.resetFields(2);
			$scope.billId = -1;
			$scope.initValues();
			$scope.$apply();
			*/
			window.location.href = data.url;
		}, "json");
		
	};
	$scope.resetFields = function(option) {
		if (option === 0) {
			for (i = 0; i < $scope.paid.length; i++) {
				$scope.paid[i].edit = false;
			}
			$scope.changeAmounts($scope.paid, option);
		} else if(option === 1) {
			for (i = 0; i < $scope.part.length; i++) {
				$scope.part[i].edit = false;
			}
			$scope.changeAmounts($scope.part, option);
		} else if(option === 2) {
			$scope.paid = [];
			$scope.paidAmountError = false;
		} else {
			$scope.part = [];
			$scope.partAmountError = false;
		}
	};
	$scope.removePayerPayee = function(elem, option) {
		var items = null;
		if (option === 1) {
			items = $scope.part;
		} else {
			items = $scope.paid;
		}
		items.splice(_.indexOf(items, _.find(items, function (item) { return item === elem; })), 1);
		$scope.changeAmounts(items, option);
	};
	$scope.initValues = function () {
		$scope.event = "";
		$scope.description = "";
		$scope.date = new Date().toJSON().slice(0,10);
		$scope.amount = 0;
		$scope.Payer = "default";
		$scope.Payee = "default";
	};
	$scope.init = function () {
		$scope.initValues();
		if (parseInt($scope.billId, 10) > 0) {
			$scope.billId = parseInt($scope.billId, 10);
			if($scope.oldBillDetails != "") {
				$scope.processOldBill();
				//$scope.$apply();
			} else {
				$scope.billId = -1;
			}
		}else {
			$scope.billId = -1;
		}
		$("#add-bill").submit(function(event) {
			$scope.submitBill();
		});
		$("#abdiv").show();
	};
	$scope.init();
}
function BillOpr($scope) {
	$scope.opr = $("#bill-opr").data('opr');
	$scope.billId = $("#bill-opr").data('id');
	$scope.invalidBill = $("#bill-opr").data('auth');
	if ($scope.invalidBill == true) {
		$("#invalid-bill").show();	
		return;
	}
	$("#bill-opr").show();
	if ($scope.opr == "view") {
		return;	
	} else if ($scope.opr == "del") {
		$scope.delete = true;
	} else if ($scope.opr == "rev") {
		$scope.revive = true;
	} else if ($scope.opr == "trash") {
		$scope.trash = true;
	}
	$("#delete-button").click(function(event) {
		$("#bill-opr").hide();
		$.post("include/action.php", {action:"delete-bill", arg:$scope.billId}, function(data){
			$("#bill-info").html(data.retval);
		}, "json");
	});
	$("#revive-button").click(function(event) {
		$("#bill-opr").hide();
		$.post("include/action.php", {action:"revive-bill", arg:$scope.billId}, function(data){
			$("#bill-info").html(data.retval);
		}, "json");
	});
	$("#trash-button").click(function(event) {
		$("#bill-opr").hide();
		$.post("include/action.php", {action:"trash-bill", arg:$scope.billId}, function(data){
			$("#bill-info").html(data.retval);
		}, "json");
	});
	$scope.cancel = true;
}
function Summary($scope) {
	$scope.cur_val = 0;
	$scope.cur_val2 = 0;
	$scope.ouend = parseFloat($("#owesyou").html()).toFixed(2);
	$scope.uoend = parseFloat($("#youowe").html()).toFixed(2);

	$scope.ouinc = 1  + parseInt($scope.ouend/100, 10);
	$scope.uoinc = 1  + parseInt($scope.uoend/100, 10);

	$scope.uotimer = self.setInterval(function () {
		$scope.decrement();
	}, 10);
	$scope.decrement = function() {
		$scope.cur_val2+=$scope.uoinc;
		$("#youowe").html("- $"+$scope.cur_val2);
		if ($scope.cur_val2 > $scope.uoend) {
			window.clearInterval($scope.uotimer);
			$("#youowe").html("- $"+$scope.uoend);
		}
	};
	$scope.outimer = self.setInterval(function () {
		$scope.increment();
	}, 10);
	$scope.increment = function() {
		$scope.cur_val+=$scope.ouinc;
		$("#owesyou").html("+ $"+$scope.cur_val);
		if ($scope.cur_val > $scope.ouend) {
			window.clearInterval($scope.outimer);
			$("#owesyou").html("+ $"+$scope.ouend);
		}
	};
	$scope.plot = function () {
		var data_owesyou = [[]];
		var data_youowe = [[]];
		var i = 0;
		var j = 0;
		$("tr.summary-user").each(function() {
			$this = $(this);
			var firsttd = $this.find('td.user-item');
			var elem_a = firsttd.find("a");
			var username = elem_a.html();
			var nexttd = $this.find('td.user-amount');
			var amt_str = nexttd.html();
			amt_str = amt_str.replace(/\$/, "");
			var amount = parseInt(amt_str, 10);
			if (nexttd.hasClass('owesyou')) {
				data_owesyou[0][i]= [];
				data_owesyou[0][i][0] = username;
				data_owesyou[0][i][1] = amount;
				//alert(username+" owesyou: "+amount);
				i++;
			}else if (nexttd.hasClass('youowe')) {
				data_youowe[0][j]= [];
				data_youowe[0][j][0] = username;
				data_youowe[0][j][1] = amount;
				j++;
				//alert(username+" youowe: "+amount);
			}
		});
		if (data_owesyou[0].length == 0 ) {
			data_owesyou = [[[0]]];
		}
		if (data_youowe[0].length == 0 ) {
			data_youowe = [[[0]]];
		}
		var oweyouplot = new jqPlotChart("pie1", $.jqplot.PieRenderer, data_owesyou);
		var legend = { show:true, placement: 'outside', rendererOptions: { numberRows: 1, animate:{show:true}}, location:'s', marginTop: '7px' };
		oweyouplot.setChartOptions("legend", legend);
		oweyouplot.setChartOptions("title", "Owes you");
		oweyouplot.setChartLevel2Options("grid", "borderWidth", 0);
		oweyouplot.setChartLevel2Options("grid", "shadow", false);
		oweyouplot.setChartLevel2Options("grid", "background", __clouds); 
		oweyouplot.drawChart();
		//var youoweplot = new Chart("pie2", $.jqplot.PieRenderer, [[[0]]]);
		var youoweplot = new jqPlotChart("pie2", $.jqplot.PieRenderer, data_youowe);
		youoweplot.setChartOptions("legend", legend);
		youoweplot.setChartOptions("title", "You Owe");
		youoweplot.setChartLevel2Options("grid", "borderWidth", 0);
		youoweplot.setChartLevel2Options("grid", "shadow", false);
		youoweplot.setChartLevel2Options("grid", "gridLineColor", "#000"); 
		youoweplot.setChartLevel2Options("grid", "background", __clouds); 
		youoweplot.setChartOptions("seriesColors", [__sunFlower, __greenSea, __clouds]);
		youoweplot.drawChart();
	};
	$scope.plot();
	$("#summary").css('visibility', 'visible');
}
