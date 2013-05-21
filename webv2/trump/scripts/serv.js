$(document).ready(function() {
	$("#scorecard").fadeIn("slow", function(){
		$("#servbutton").click(getstate);
	});
});

function getstate() {
	$("#servbutton").attr("disabled");
	$.post("include/servfunc.php", { str: "asdsa"}, function(data){
		alert(data.retval+""+data.info);
		$("#servbutton").removeAttr("disabled");
	}, "json");
};
