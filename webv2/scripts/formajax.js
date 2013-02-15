function ajaxinit()
{
	alert("val");
	$("#"+formarr[0]).submit(function(event) {
		// prevent default posting of form
		event.preventDefault();
		var $form = $(this), $inputs = $form.find("input,input,input,input");
		$inputs.attr("disabled", "disabled", "disabled", "disabled");
		$.post("processform.php",{ formname: formarr[0], loginsubmit: ,username: , password: },function(data){
			var retval= data.retval;
			var info= data.info;
			var url= data.url;
			var errormsg= data.errormsg;
			alert(val+url+errormsg+info+"");
			}, "json");
	});
	$("#"+formarr[1]).submit(function(event) {
		// prevent default posting of form
		event.preventDefault();
		var $form = $(this), $inputs = $form.find("input","input","input","input","input","input","input");
		$inputs.attr("disabled", "disabled", "disabled", "disabled", "disabled", "disabled", "disabled");
		$.post("processform.php",{ formname:formarr[1], registersubmit:, name: , spe8306af0d23b01a2bf7c1734aacf25fe: ,username:, email: , password: },function(data){
			var val = data.returnValue;
			$inputs.removeAttr("disabled");
			}, "json");
	});
	$("#"+formarr[2]).submit(function(event) {
		// prevent default posting of form
		event.preventDefault();
		var $form = $(this), $inputs = $form.find("input","input","input");
		$inputs.attr("disabled", "disabled", "disabled");
		$.post("processform.php",{ formname:formarr[2], resetreqsubmit: , email: },function(data){
			var val = data.returnValue;
			$inputs.removeAttr("disabled");
			//alert(val);
		}, "json");
	});
}
