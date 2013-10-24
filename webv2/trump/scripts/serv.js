$(document).ready(function() {
	$("#scorecard").fadeIn("slow", function(){
		$("#servbutton").click(startserver);
		$("#servstopbutton").click(stopserver);
	});
});
function stopserver() {
	$("#servstopbutton").attr("disabled");
	$.post("include/servfunc.php", { str: "stop"}, function(data){
		alert(data.retval+""+data.info);
		$("#servstopbutton").removeAttr("disabled");
		$("#servstate").html("Stopped");
	}, "json");
};
function startserver() {
	$("#servbutton").attr("disabled");
	$.post("include/servfunc.php", { str: "start"}, function(data){
		alert(data.retval+""+data.info);
		$("#servbutton").removeAttr("disabled");
		$("#servstate").html("Running");
	}, "json");
};
