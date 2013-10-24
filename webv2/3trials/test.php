<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
	<title>Audio</title>
	<?require_once("include/headers.php");?>
	<script type='text/javascript'>
	function init() {
		alert("eady");
		$("#test").submit(function(event) {
			// prevent default posting of form
			event.preventDefault();
			alert("ready");
			var $form = $(this), $inputs = $form.find("input,input, input");
			$inputs.attr("disabled", "disabled", "disabled");
			var name = document.getElementById("asearch").value;
			$.post("posttest.php",{ str: name },function(data){
				$inputs.removeAttr("disabled");
				for(i=0; i<data.length; i++) {
					document.getElementById("temp").innerHTML+=data[i]+"<br/>";
				}
			}, "json");
		});
	}
	</script>
	</head>
	<body onload="init();">
		<form id='test' method='post' accept-charset='UTF-8' align=left>
		<fieldset>
			<input type='submit' name='asubmit' value='search' />
			<input type='text' name='asearch' id='asearch' maxlength="50"/><br/>
		</fieldset>
		</form>
		<div id="temp">
		</div>
	</body>
</html>
