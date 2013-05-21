var friendarray = new Array();
var paidarray = new Array();
var partarray = new Array();
var payment_payer="";
var payment_payee="";
var add_friend_form_id="add-friend";
var add_bill_form_id="add-bill";
var frlist_id="dummy";
var ab_amount_field_id="ab-amount";
var pubpage;
var oldbill=false;
var edit_bill_id;
$(document).ready(function() {
	$("#li_summary").click(summary_ajax);
	$("#li_view-transaction").click(view_transaction_ajax);
	$("#li_view-del-transaction").click(view_del_transaction_ajax);
	$("#li_add-friend").click(show_af_form);
	$("#li_add-bill").click(show_ab_form);
	$("#li_add-payment").click(show_ap_form);
	$('.close').click(close_payer_payee);
	$(".userclick").click(view_user_transaction_ajax);
	//summary_ajax();
	test_function();
});
var test_function = function() {
	/*
	view_transaction_ajax();	
	*/
	show_ab_form();
	$("#ab-event").attr('value', "test");
	$("#ab-desc").html("test-desc");
	$("#ab-amount").attr('value', 300.00);
	$("#ab-paid").removeAttr("disabled");
	$("#ab-part").removeAttr("disabled");
	//$("#ab-date").attr('value', new Date().toJSON.slice(0,10));
	add_payer("socceranoo", 100);
	add_payer("Ravi", 200);
	add_payee("maniksundar", 200);
	add_payee("socceranoo", 100);
	//add_payee("payee3", 50);
}

var get_ab_amount = function () {
	val = parseFloat($("#ab-amount").attr('value')).toFixed(2);
	return val;
}
var get_ap_amount = function () {
	val = parseFloat($("#ap-amount").attr('value'));
	return val;
}
var set_ab_amount = function (amt) {
	$("#ab-amount").attr('value', amt);
}
var amount_entered = function (event) {
	id=event.target.id;
	value = $("#"+id).attr('value');
	var match = /^\d+(\.[\d]+)?$/i.exec(value); 
	if(match) {
		amt = parseFloat(value).toFixed(2);
		$("#"+id).attr('value', amt);
		if (id == "ap-amount") {
			$("#ap-paid").removeAttr("disabled");
			return;
		}
		$("#ab-paid").removeAttr("disabled");
		$("#ab-part").removeAttr("disabled");
		access_paid_li("equal", amt);
		access_part_li("equal", amt);
	}else {
		$("#dummy_paid").html("");
		$("#dummy_part").html("");
		if (id == "ap-amount") {
			$("#ap-paid").attr("disabled", "disabled");
			$("#ap-part").attr("disabled", "disabled");
			payment_payee="";
			payment_payer="";
			return;
		}
		$("#ab-paid").attr("disabled", "disabled");
		empty_paidarray();
		$('.amount').removeClass("edited");
		$("#"+id).attr('value', "");
		$("#ab-part").attr("disabled", "disabled");
		empty_partarray();
	}
}

var change_ind_amount = function (event) {
	id=event.target.id;
	cur_val = $("#"+id).attr('value');
	var match = /^\d+(\.[\d]+)?$/i.exec(cur_val); 
	if(match) {
		var tempamt = parseFloat(cur_val).toFixed(2);
		$("#"+id).attr('value', tempamt);
		$("#"+id).addClass("edited");
		value = get_ab_amount();
		amt = value;
		if ($("#"+id).hasClass("paidinput")) {
			change_paid_li(amt, id);
			paidarray[id] = cur_val;
		}else if ($("#"+id).hasClass("partinput")) {
			change_part_li(amt, id);
			var m = /^partip_(.*)$/i.exec(id);	
			partarray[m[1]] = cur_val;
		}
	}else {
		$("#"+id).attr('value', "");
		return;
	}	
}
var close_payer_payee = function (event) {
	id = event.target.id;
	var myclass = $("#"+id).attr("class"); 
	var match = /paid/i.exec(myclass); 
	var match_part = /part/i.exec(myclass); 
	if(match) { 
		remove_elem("li_"+id, paidarray);
	}else if (match_part) {
		remove_elem("li_"+id, partarray);
	}
}
var hide_calendar = function () {
	//calendar.hideCalendar();
}
var show_calendar = function () {
	//calendar.showCalendar();
}
var select_payment_payer = function (event) {
	var id = event.target.id;
	var payer = $(this).val();
	if (payer != "default")
		set_payment_payer(payer);
}
var set_payment_payer = function (payer) {
	payment_payer = payer;
	var payer_id = "payer"+payer;
	$("#dummy_paid").html("<li id=li_"+payer_id+">"+payer+"</li>");
	getid("current-content").scrollTop = getid("current-content").scrollHeight;
	set_payment_fields();
}
var select_payment_payee = function (event) {
	var id = event.target.id;
	var payee = $(this).val();
	if (payee != "default")
		set_payment_payee(payee);
}
var set_payment_payee = function (payee) {
	payment_payee = payee;
	var payee_id = "payee"+payee;
	$("#dummy_part").html("<li id=li_"+payee_id+">"+payee+"</li>");
	getid("current-content").scrollTop = getid("current-content").scrollHeight;
	set_payment_fields();
}

var select_payer = function (event) {
	var id = event.target.id;
	var payer = $(this).val();
	if (payer != "default")
		add_payer(payer);
}

var add_payer = function (payer, amount) {
	var paid_id = "paid"+payer;
	var input_id = payer;
	if (!inAssocArray(payer, paidarray)) {
		paidarray[payer]=0;
		$("#dummy_paid").html($("#dummy_paid").html()+"<li id=li_"+paid_id+">"+payer+"<input id="+input_id+" required type=number step=any min=0 class='amount paidinput' value='"+amount+"' /></li>");
		//$("#dummy_paid").html($("#dummy_paid").html()+"<li id=li_"+paid_id+">"+payer+"<input id="+input_id+" type=text class=amount /><a class='close paid' id="+paid_id+" href='JavaScript:(void);'></a></li>");
		if (!amount) {
			var value = get_ab_amount();
			access_paid_li("equal", value);
		}else {
			paidarray[payer]=parseFloat(amount).toFixed(2);
		}
		getid("current-content").scrollTop = getid("current-content").scrollHeight;
		$('.amount').focusout(change_ind_amount);
	}
}
var select_payee = function (event) {
	id = event.target.id;
	payee = $(this).val();
	if (payee != "default")
		add_payee(payee);
}
var add_payee = function (payee, amount) {
	if (!inAssocArray(payee, partarray)) {
		partarray[payee]=0.00;
		var part_id = "part"+payee;
		var input_id = "partip_"+payee;
		$("#dummy_part").html($("#dummy_part").html()+"<li id=li_"+part_id+">"+payee+"<input id="+input_id+" required type=number step=any min=0 class='amount partinput' value='"+amount+"'/></li>");
		//$("#dummy_part").html($("#dummy_part").html()+"<li id=li_"+part_id+">"+payee+"<a class='close part' href='JavaScript:(void);'></a></li>");
		//getid("moneybody").scrollTop = getid("dummy_part").scrollHeight;
		if (!amount) {
			var value = get_ab_amount();
			access_part_li("equal", value);
		}else {
			partarray[payee]=parseFloat(amount).toFixed(2);
			//set_part_input();
		}
		getid("current-content").scrollTop = getid("current-content").scrollHeight;
		$('.amount').focusout(change_ind_amount);
	}
}

var show_af_form = function () {
	var htmlcontent= $("#afhidden").html();
	document.getElementById("current-content").innerHTML = htmlcontent;
	$("#add-friend-submit").click(add_friend_ajax);
	empty_friendarray();
}

var show_ap_form = function () {
	var htmlcontent= $("#aphidden").html();
	document.getElementById("current-content").innerHTML = htmlcontent;
	$("#ap-paid").change(select_payment_payer);
	$("#ap-part").change(select_payment_payee);
	var datestr = new Date().toJSON().slice(0,10);
	$('#ap-date').attr('value', datestr);
	$('#ap-amount').focusout(amount_entered);
	$('#ap-date').focusout(set_payment_fields);
	$('#show-payment-details').click(function () { 
		$("#ap-details").show();
	});
	payment_payer = "";
	payment_payee = "";
	add_payment_ajax();
}
var show_ab_form = function () {
	oldbill=false;
	var htmlcontent= $("#abhidden").html();
	document.getElementById("current-content").innerHTML = htmlcontent;
 	//calendar.set("date");
	$('#ab-amount').focusout(amount_entered);
	$('#paid-reset-fields').click(paid_reset_fields);
	$('#part-reset-fields').click(part_reset_fields);
	$('#ab-date').focusout(hide_calendar);
	$("#ab-paid").change(select_payer);
	$("#ab-part").change(select_payee);
	var datestr = new Date().toJSON().slice(0,10);
	$('#ab-date').attr('value', datestr);
	empty_paidarray();
	empty_partarray();
	add_bill_ajax();
}
var paid_reset_fields = function () {
	$("#dummy_paid").html("");
	$('.amount').removeClass("edited");
	$("#ab-paid").attr("disabled", "disabled");
	empty_paidarray();
	access_paid_li("equal");
}
var part_reset_fields = function () {
	$("#dummy_part").html("");
	$('.amount').removeClass("edited");
	empty_partarray();
	access_part_li("equal");
}
var summary_ajax = function () {
	common_ajax("include/action.php", "summary", "summary");
}
var view_transaction_ajax = function () {
	common_ajax("include/action.php", "view-transaction", "view-transaction", "null");
}
var view_user_transaction_ajax = function (event) {
	id = event.target.id;
	username =  $("#"+id).html();
	common_ajax("include/action.php", "view-transaction", "view-transaction", username);
}
var view_del_transaction_ajax = function () {
	common_ajax("include/action.php", "view-del-transaction", "view-del-transaction", "null");
}
var add_bill_ajax = function () {
	$("#add-bill").submit(function(event) {
		// prevent default posting of form
		event.preventDefault();
		if(0 == Object.size(paidarray) || 0 == Object.size(partarray)) {
			return;
		}
		var $form = $(this), $inputs = $form.find("input,textarea,input,input,select,select, input");
		$inputs.attr("disabled", "disabled", "disabled", "disabled", "disabled", "disabled", "disabled");
		$inputs.removeAttr("disabled");
		var detailarray = {};
		var paidjsonarray = {};
		var partjsonarray = {};
		for (key in paidarray){
			if (paidarray.hasOwnProperty(key))
				paidjsonarray[key]=paidarray[key];
		}
		for (key in partarray){
			if (partarray.hasOwnProperty(key))
				partjsonarray[key]=partarray[key];
		}
		detailarray['flag']="new";
		detailarray['bill_id']=-1;
		if (oldbill) {
			detailarray['flag']="old";
			detailarray['bill_id']=edit_bill_id;
		}
		detailarray['event']=$("#ab-event").attr('value');
		detailarray['desc']=$("#ab-desc").html();
		detailarray['date']=$("#ab-date").attr('value');
		detailarray['amount']=get_ab_amount();
		//alert(detailarray['bill_id']);
		var detailstr = JSON.stringify(detailarray);
		var paidstr = JSON.stringify(paidjsonarray);
		var partstr = JSON.stringify(partjsonarray);
		alert("submitting");
		common_ajax("include/action.php", "add-bill", "add-bill", detailstr, paidstr, partstr);
		oldbill = false;
		edit_bill_id = -1;
	});
}
var add_payment_ajax = function () {
	$("#add-payment").submit(function(event) {
		//alert("submitting payment");
		// prevent default posting of form
		event.preventDefault();
		if(payment_payer == "" || payment_payee == "" || payment_payee == payment_payer) {
			return;
		}
		var $form = $(this), $inputs = $form.find("input,textarea,input,input,select,select, input");
		$inputs.attr("disabled", "disabled", "disabled", "disabled", "disabled", "disabled", "disabled");
		$inputs.removeAttr("disabled");
		var detailarray = {};
		var paidjsonarray = {};
		var partjsonarray = {};
		detailarray['amount']=get_ap_amount();
		paidjsonarray[payment_payer]=detailarray['amount'];
		partjsonarray[payment_payee]=detailarray['amount'];
		detailarray['flag']="new";
		detailarray['bill_id']=-1;
		if (oldbill) {
			detailarray['flag']="old";
			detailarray['bill_id']=edit_bill_id;
		}
		detailarray['event']=$("#ap-event").attr('value');
		detailarray['desc']=$("#ap-desc").html();
		detailarray['date']=$("#ap-date").attr('value');
		var detailstr = JSON.stringify(detailarray);
		var paidstr = JSON.stringify(paidjsonarray);
		var partstr = JSON.stringify(partjsonarray);
		common_ajax("include/action.php", "add-payment", "add-payment", detailstr, paidstr, partstr);
		oldbill = false;
	});
}
var add_friend_ajax = function () {
	if (friendarray.length == 0) {
		return;
	}
	common_ajax("include/action.php", "add-friend", "add-friend", friendarray);
	empty_friendarray();
}
var common_ajax = function(file, actionval, actionval2, argval, argval2, argval3) {
	if (actionval == "edit-bill-info" || actionval == "del-bill-info" || actionval == "rev-bill-info" || actionval == "trash-bill-info") {
	}
	$.post(file, {action:actionval, arg:argval, arg2:argval2, arg3:argval3},function(data){
		var htmlcontent= data.retval;
		document.getElementById("current-content").innerHTML = htmlcontent;
		var match = /transaction/i.exec(actionval);
		if (match){
			//$(".clickbill").live('click', get_bill_info);
			if(htmlcontent == "") {
				htmlcontent="<h3>No Transactions Found</h3>";
				document.getElementById("current-content").innerHTML = htmlcontent;
			}else {
				$(".clickbill").click(get_bill_info);
			}
				
		}
		switch (actionval2) {
			case "summary":
				$(".userclick").click(view_user_transaction_ajax);
				break;
			case "edit-bill-info":
				parse_bill(data.arg);
				break;
			case "del-bill-info":
				var buttonid = "delbutton"+argval;
				var buttonclass ="delbillbutton";
				var buttonvalue ="Confirm Delete";
				var buttonstr = "<h4><input type=button class="+buttonclass+" id="+buttonid+" value='"+buttonvalue+"'/></h4>";
				document.getElementById("current-content").innerHTML += buttonstr;
				$(".delbillbutton").click(delete_bill);
				break;
			case "rev-bill-info":
				var buttonid = "revbutton"+argval;
				var buttonclass ="revbillbutton";
				var buttonvalue ="Confirm Revival";
				var buttonstr = "<h4><input type=button class="+buttonclass+" id="+buttonid+" value='"+buttonvalue+"'/></h4>";
				document.getElementById("current-content").innerHTML += buttonstr;
				$(".revbillbutton").click(revive_bill);
				break;
			case "trash-bill-info":
				var buttonid = "trashbutton"+argval;
				var buttonclass ="trashbillbutton";
				var buttonvalue ="Confirm permanent delete";
				var buttonstr = "<h4><input type=button class="+buttonclass+" id="+buttonid+" value='"+buttonvalue+"'/></h4>";
				document.getElementById("current-content").innerHTML += buttonstr;
				$(".trashbillbutton").click(trash_bill);
				break;
			case "delete-bill":
			case "trash-bill":
			case "revive-bill":
				summary_ajax();
				break;
			default:
				break;
		}
		/*
		if (actionval2 == "summary") {
			$(".userclick").click(view_user_transaction_ajax);
		}else if (actionval2 == "edit-bill-info") {
			parse_bill(data.arg);
		}else if (actionval2 == "del-bill-info") {
			var buttonid = "delbutton"+argval;
			var buttonstr = "<button class=delbillbutton id="+buttonid+">Confirm Delete</button>";
			document.getElementById("current-content").innerHTML += buttonstr;
			$(".delbillbutton").click(delete_bill);
			return;
		}else if (actionval2 == "rev-bill-info") {
			var buttonid = "revbutton"+argval;
			var buttonstr = "<button class=revbillbutton id="+buttonid+">Confirm Revival</button>";
			document.getElementById("current-content").innerHTML += buttonstr;
			$(".revbillbutton").click(revive_bill);
			return;
		}else if (actionval2 == "trash-bill-info") {
			var buttonid = "trashbutton"+argval;
			var buttonstr = "<button class=trashbillbutton id="+buttonid+">Confirm permanent delete</button>";
			document.getElementById("current-content").innerHTML += buttonstr;
			$(".trashbillbutton").click(trash_bill);
			return;
		} else if (actionval2 == "delete-bill" || actionval2 == "revive-bill" || actionval2 == "trash-bill") {
			summary_ajax();
		}
		*/
	}, "json");
}
var delete_bill = function (event) {
	id = event.target.id;
	var match = /(\d+)/i.exec(id);
	bill_id = match[1];
	common_ajax("include/action.php", "delete-bill", "delete-bill", bill_id);
}
var revive_bill = function (id) {
	id = event.target.id;
	var match = /(\d+)/i.exec(id);
	bill_id = parseInt(match[1]);
	common_ajax("include/action.php", "revive-bill", "revive-bill", bill_id);
}
var trash_bill = function (id) {
	id = event.target.id;
	var match = /(\d+)/i.exec(id);
	bill_id = parseInt(match[1]);
	common_ajax("include/action.php", "trash-bill", "trash-bill", bill_id);
}
var parse_bill = function (jsonString) {
	var obj = JSON.parse(jsonString);
	var str="";
	var eventstr = obj['event'];
	var descstr = obj['desc'];
	var match = /Payment:(.*)==>/i.exec(eventstr);
	if (match) {
		edit_old_payment(obj);
	}else {
		edit_old_bill(obj);
	}
	/*
	show_ab_form();
	oldbill = true;
	edit_bill_id = parseInt(obj['id']);
	$("#ab-event").attr('value', obj['event']);
	$("#ab-desc").html(obj['desc']);
	$("#ab-amount").attr('value', obj['amount']);
	$("#ab-paid").removeAttr("disabled");
	$("#ab-date").attr('value', obj['date']);
	var paidarr = JSON.parse(obj['paid']);
	var partarr = JSON.parse(obj['part']);
	for (key in paidarr){
		if (paidarr.hasOwnProperty(key)) {
			add_payer(key, paidarr[key]);
		}
	}
	for (key in partarr){
		if (partarr.hasOwnProperty(key)) {
			add_payee(partarr[key]);
		}
	}
	*/
}
var edit_old_bill = function (obj) {
	show_ab_form();
	oldbill = true;
	edit_bill_id = parseInt(obj['id']);
	$("#ab-event").attr('value', obj['event']);
	$("#ab-desc").html(obj['desc']);
	$("#ab-amount").attr('value', obj['amount']);
	$("#ab-paid").removeAttr("disabled");
	$("#ab-date").attr('value', obj['date']);
	var paidarr = JSON.parse(obj['paid']);
	var partarr = JSON.parse(obj['part']);
	for (key in paidarr){
		if (paidarr.hasOwnProperty(key)) {
			add_payer(key, paidarr[key]);
		}
	}
	for (key in partarr){
		if (partarr.hasOwnProperty(key)) {
			add_payee(key, partarr[key]);
		}
	}
}
var edit_old_payment = function (obj) {
	show_ap_form();
	oldbill = true;
	edit_bill_id = parseInt(obj['id']);
	$("#ap-event").attr('value', obj['event']);
	$("#ap-desc").html(obj['desc']);
	$("#ap-amount").attr('value', obj['amount']);
	$("#ap-paid").removeAttr("disabled");
	$("#ap-date").attr('value', obj['date']);
	var paidarr = JSON.parse(obj['paid']);
	var partarr = JSON.parse(obj['part']);
	for (key in paidarr){
		if (paidarr.hasOwnProperty(key)) {
			set_payment_payer(key);
		}
	}
	for (key in partarr){
		if (partarr.hasOwnProperty(key)) {
			set_payment_payee(key);
		}
	}
}
var get_bill_info = function (event) {
	id = event.target.id;
	var match = /^editbillid_(\d+)$/i.exec(id);
	if (match && match[1]) {
		var bill_id = match[1];
		common_ajax("include/action.php", "bill-info", "edit-bill-info", bill_id, "cur");
		return;
	}
	var match = /^delbillid_(\d+)$/i.exec(id);
	if (match && match[1]) {
		var bill_id = match[1];
		common_ajax("include/action.php", "bill-info", "del-bill-info", bill_id, "cur");
		return;
	}
	var match = /^revbillid_(\d+)$/i.exec(id);
	if (match && match[1]) {
		var bill_id = match[1];
		common_ajax("include/action.php", "bill-info", "rev-bill-info", bill_id, "del");
		return;
	}
	var match = /^trashbillid_(\d+)$/i.exec(id);
	if (match && match[1]) {
		var bill_id = match[1];
		common_ajax("include/action.php", "bill-info", "trash-bill-info", bill_id, "del");
		return;
	}
	var match = /^viewcurbillid_(\d+)$/i.exec(id);
	if (match && match[1]) {
		var bill_id = match[1];
		common_ajax("include/action.php", "bill-info", "bill-info", bill_id, "cur");
		return;
	}
	var match = /^viewdelbillid_(\d+)$/i.exec(id);
	if (match && match[1]) {
		var bill_id = match[1];
		common_ajax("include/action.php", "bill-info", "bill-info", bill_id, "del");
		return;
	}
}
var temp_dummy = function(event) {
	event.preventDefault();
	alert(event.target.id);
}
function add_to_friend_array() {
	var show_id="success-add-friend";
	var friend = "";
	friend = document.getElementById("af-email").value; 
	if (friend != "" && !inArray(friend, friendarray)) {
		friendarray.push(friend);
		$("#"+frlist_id).html($("#"+frlist_id).html()+"<li><h5>"+friend+"</h5></li");
	}
	document.getElementById("af-email").value="";
}

function inAssocArray(needle, haystack) {
	if (haystack[needle]){
		return true;
	}else {
		return false;
	}
}
function inArray(needle, haystack) {
	var length = haystack.length;
	for(var i = 0; i < length; i++) {
		if(haystack[i] == needle) return true;
	}
	return false;
}
function remove_elem(needle, haystack) {
	var length = haystack.length;
	for(var i = 0; i < length; i++) {
		if(haystack[i] == needle) {
			haystack.pop(i);
		}
	}
}
function empty_friendarray() {
	var aLen = friendarray.length - 1;
	for (var x=aLen; friendarray[x];x--) {
			friendarray.pop(x);
	}
}
function empty_partarray() {
	for (key in partarray){
		if (partarray.hasOwnProperty(key))
			delete partarray[key];
	}
}
function empty_paidarray() {
	for (key in paidarray){
		if (paidarray.hasOwnProperty(key))
			delete paidarray[key];
	}
}

function access_paid_li(str, amt) {
	amt = get_ab_amount();
	amt = parseFloat(amt/Object.size(paidarray)).toFixed(2);
	$('#dummy_paid li').each(function(i) {
		input = $(this).children('input').attr('id');
		val = $(this).children('input').attr('value');
		if (str == "equal"){
			paidarray[input] = amt;
		}
		$(this).children('input').attr('value', paidarray[input]);
	});
	$('.paidinput').removeClass("edited");
}
function change_paid_li(amt, id) {
	var total_amount = amt;
	var count = 0;
	$('#dummy_paid li').each(function(i) {
		input = $(this).children('input').attr('id');
		//if (input != id) {
		if ($(this).children('input').hasClass("edited")) {
			value = parseFloat($(this).children('input').attr('value')).toFixed(2);
			amt = parseFloat(amt - value).toFixed(2);
			count++;
		}
	});
	var remcount = Object.size(paidarray) - count ;
	amt = parseFloat(amt/remcount).toFixed(2);
	if (amt < 0) {
		alert("Amount contradiction fields will reset");
		access_paid_li("equal", total_amount);
		return;
	}
	$('#dummy_paid li').each(function(i) {
		input = $(this).children('input').attr('id');
		if (!$(this).children('input').hasClass("edited")) {
			$(this).children('input').attr('value', amt);
			paidarray[input] = amt;
		}
	});

	if (count == Object.size(paidarray)) {
		$('.paidinput').removeClass("edited");
		if (!total_amount_paid_li_satisfied()) {
			alert("Amount contradiction fields will reset");
			access_paid_li("equal", total_amount);
		}
	}
}
function total_amount_paid_li_satisfied() {
	var amt = get_ab_amount();
	var total = 0;
	$('#dummy_paid li').each(function(i) {
		value = parseFloat($(this).children('input').attr('value')).toFixed(2);
		total = parseFloat(total) + parseFloat(value);
		total = parseFloat(total).toFixed(2);
	});
	if (total != amt) {
		return false;
	}
	return true;
}
function set_paid_input () {
	$('#dummy_paid li').each(function(i) {
		var input = $(this).children('input').attr('id');
		$(this).children('input').attr('value', paidarray[input]);
	});
}
function getid(id){ return document.getElementById(id); }

Object.size = function(obj) {
	var size =0, key;
	for (key in obj){
		if (obj.hasOwnProperty(key))
			size++;
	}
	return size;
};

function set_payment_fields () {
	var eventstr ="Payment: "+payment_payer+" ==> "+payment_payee;
	$("#ap-event").attr('value', eventstr);
	var datestr = $("#ap-date").attr('value');
	var descstr = "Payment made by "+payment_payer+" to "+payment_payee+" on "+datestr;
	$("#ap-desc").html(descstr);
}

function access_part_li(str, amt) {
	amt = get_ab_amount();
	amt = parseFloat(amt/Object.size(partarray)).toFixed(2);
	$('#dummy_part li').each(function(i) {
		input = $(this).children('input').attr('id');
		var m = /^partip_(.*)$/i.exec(input);	
		input = m[1];
		val = $(this).children('input').attr('value');
		if (str == "equal"){
			partarray[input] = amt;
		}
		$(this).children('input').attr('value', partarray[input]);
	});
	$('.partinput').removeClass("edited");
}
function change_part_li(amt, id) {
	var total_amount = amt;
	var count = 0;
	$('#dummy_part li').each(function(i) {
		input = $(this).children('input').attr('id');
		//if (input != id) {
		if ($(this).children('input').hasClass("edited")) {
			value = parseFloat($(this).children('input').attr('value')).toFixed(2);
			amt = parseFloat(amt - value).toFixed(2);
			count++;
		}
	});
	var remcount = Object.size(partarray) - count ;
	amt = parseFloat(amt/remcount).toFixed(2);
	if (amt < 0) {
		alert("Amount contradiction fields will reset");
		access_part_li("equal", total_amount);
		return;
	}
	$('#dummy_part li').each(function(i) {
		input = $(this).children('input').attr('id');
		var m = /^partip_(.*)$/i.exec(input);	
		input = m[1];
		if (!$(this).children('input').hasClass("edited")) {
			$(this).children('input').attr('value', amt);
			partarray[input] = amt;
		}
	});

	if (count == Object.size(partarray)) {
		$('.partinput').removeClass("edited");
		if (!total_amount_part_li_satisfied()) {
			alert("Amount contradiction fields will reset");
			access_part_li("equal", total_amount);
		}
	}
}
function total_amount_part_li_satisfied() {
	var amt = get_ab_amount();
	var total = 0;
	$('#dummy_part li').each(function(i) {
		value = parseFloat($(this).children('input').attr('value')).toFixed(2);
		total = parseFloat(total) + parseFloat(value);
		total = parseFloat(total).toFixed(2);
	});
	if (total != amt) {
		return false;
	}
	return true;
}

function set_part_input (id) {
	$('#dummy_part li').each(function(i) {
		var input = $(this).children('input').attr('id');
		var m = /^partip_(.*)$/i.exec(input);	
		input = m[1];
		$(this).children('input').attr('value', partarray[input]);
	});
}
