var formarr =new Array();
formarr[0]="login";
formarr[1]="register";
formarr[2]="resetreq";
function ajaxinit()
{
	$("#"+formarr[0]).submit(function(event) {
		// prevent default posting of form
		event.preventDefault();
		var heading=$("#"+current_id).find('h3').html()
		var $form = $(this), $inputs = $form.find("input,textarea");
		$inputs.attr("disabled", "disabled");
		$.post("resumeform.php",{ uid: userid, txt: str, column:active_id },function(data){
			var val = data.returnValue;
			//alert(val);
			}, "json");
	});
	$("#"+formarr[1]).submit(function(event) {
		// prevent default posting of form
		event.preventDefault();
		var $form = $(this), $inputs = $form.find("input","input");
		$inputs.attr("disabled", "disabled");
		$.post("resumeform.php",{ uid:userid, txt: str, column:"tagline" },function(data){
			var val = data.returnValue;
			$inputs.removeAttr("disabled");
			}, "json");
	});
	$("#"+formarr[2]).submit(function(event) {
		// prevent default posting of form
		event.preventDefault();
		var $form = $(this), $inputs = $form.find("input,textarea");
		$inputs.attr("disabled", "disabled");
		$.post("resumeform.php",{ uid: userid, txt: str, column:active_id },function(data){
			var val = data.returnValue;
			$inputs.removeAttr("disabled");
			//alert(val);
		}, "json");
	});
}
