<?PHP
	require_once("access.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<?require_once("includes.php");?>
		<title>Add friends</title>
		<script type="text/javascript">var friendarray = new Array();</script>
	</head>
	<body class='transactions'>
		<div id='other'>
		<div id='fg_membersite_content'>
		<div id='fg_membersite'>
			<h1><br><br><br>Add Friend's</h1>
			<?require_once("operations.php");?>
			<div id='bill'>
			<form action=process.php name=form1 method=post>
				<fieldset>	
				<legend>Add-friends</legend>		
				<div class='short_explanation'>* required fields</div>
				<div class='container'>
					<label for='list'>Enter the email*</label><br/>
					<!--
					<label for='list'>Add from the list?*</label><br/>
					-->
					<div id="dummy"></div>
					<input type=text id='email'/>
					<input type="button" value="Add" onclick="addToArray(friendarray, 'dummy', 'email', 'frlist', 'load.php')"/>
					<input type="hidden" name="frlist" id="frlist" value=""/>
					<? 
						check_and_add_user_table($pairtable);
						/*
						echo "<select name='jumpmenu[]' multiple='multiple'>";
						$result = $fgmembersite->RunQuery("SELECT * FROM $pairtable WHERE user1='$uname' or user2='$uname'");
						$stack = array();
						while($row = mysql_fetch_array($result))
						{
							if ($row['user1'] == $uname)
								array_push($stack, $row['user2']);
							else if($row['user2'] == $uname)
								array_push($stack, $row['user1']);
						}
						$result = $fgmembersite->RunQuery("SELECT * FROM $regusertable WHERE username!='$uname'");
						while($row = mysql_fetch_array( $result )) 
						{
							$name = $row['name'];
							$user = $row['username'];
							if (!in_array($user, $stack)) 
							{
								echo "<option value=$user>";
								echo $name;
								echo "</option>";
							}
						}
						echo "</select>";
						*/
					?>	
					<span id='form_jumpmenu_errorloc' class='error'></span>
				</div>
				<div class='container'>
					<input type="submit" />
				</div>
				</fieldset>
			</form>
			</div>
		</div>
		<script type='text/javascript'>
		// <![CDATA[
			var frmvalidator  = new Validator("form1");
			frmvalidator.EnableOnPageErrorDisplay();
			frmvalidator.EnableMsgsTogether();
			frmvalidator.addValidation("list","req","Please select one user to add");
			//frmvalidator.addValidation("participants","req","Please provide who participants");
			// ]]>
		</script>
		</div>
		</div>
	</body>
</html>

