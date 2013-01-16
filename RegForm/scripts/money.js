var friendarray = new Array();
var add_friend_form_id="add-friend";
var frlist_id="dummy";
var pubpage;
function money_add_friend_init() {
	/*
	alert("init");
	var first = getUrlVars()["page"];
	if (first == "public")
		pubpage=true;
	uname=$("#uname").html();
	userid=$("#uid").html();
	fullname=$("#name").html();
	*/
}

/*
Initialize the submit action of the form 
*/
function money_add_friend_ajax_init()
{
	$("#"+add_friend_form_id).submit(function(event) {
		var show_id="success-add-friend";
		// prevent default posting of form
		event.preventDefault();
		if (friendarray.length == 0)
			return;
		var $form = $(this), $inputs = $form.find("input,input,input");
		$inputs.attr("disabled", "disabled");
		$.post("process1.php", {dat : friendarray} ,function(data){
				
				var aLen = ( friendarray.length - 1 );
				for ( var x = aLen; friendarray[ x ]; x-- ) 
				{
					friendarray.pop( x );
				}
				$("#"+frlist_id).html("");
				var val = data.returnValue;
				$('#'+show_id).html(val);
				$("#"+show_id).fadeIn(2000, "linear", function(){
					$inputs.removeAttr("disabled");
					$("#"+show_id).fadeOut(10000, "linear", function(){});
				});
		}, "json");
	});
}
function add_to_friend_array()
{
	var frmvalidator  = new Validator("add-friend");
	frmvalidator.EnableOnPageErrorDisplay();
	frmvalidator.EnableMsgsTogether();
	frmvalidator.addValidation("email","email","Please provide a valid email address");
	var show_id="success-add-friend";
	//$("#"+show_id).fadeOut(800, "linear", function(){});
	var friend = "";
	friend = getid("email").value; 
	if (friend != "" && !inArray(friend, friendarray))
	{
		friendarray.push(friend);
		$("#"+frlist_id).html($("#"+frlist_id).html()+friend+"<br/>");
	}
	getid("email").value="";
}
