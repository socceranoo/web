<?PHP
	require_once("access.php");
	function paste_select_menu($user, $user_arr)
	{
		echo "<option value=$user>";
		echo $user."(You)";
		echo "</option>";
		foreach ($user_arr as $val)
		{
			echo "<option value=$val>";
			echo $val;
			echo "</option>";
		}
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<title>An Access Controlled Page</title>
		<link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
		<link rel="STYLESHEET" type="text/css" href="style/calendar.css">
		<script type='text/javascript' src='scripts/myscripts.js'> </script>
	</head>
	<body>
		<div id='other'>
		<div id='fg_membersite_content'>
			<h2><br><br><br>Add bill</h2>
			<?PHP
				$result = $fgmembersite->RunQuery("SELECT * FROM $uname");
				$stack = array();
				while($row = mysql_fetch_array($result)) 
				{
					array_push($stack, $row['user2']);	
				}
			?>
			<form action=process_bill.php name=bill_form method=post align=left>
				<p>Select Date: <input type="text" name="date" id="date" />
				<script type="text/javascript"> calendar.set("date"); </script></p> 
				<p>Amount: <input type="text" name="amount" id="amount"/></p>
				<p>Who paid ? <br/></p>
					<select name="paid">
						<? paste_select_menu($uname, $stack); ?>	
					</select>
				<p>Who participated ? <br> </p>
					<select name="participants[]" multiple="multiple">
						<?paste_select_menu($uname, $stack); ?>	
					</select>
				<input type="submit" />
			</form>
		</div>
		</div>
	</body>
</html>

