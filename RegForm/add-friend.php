<?PHP
	require_once("access.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<title>An Access Controlled Page</title>
		<link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
	</head>
	<body>
		<div id='other'>
		<div id='fg_membersite_content'>
			<h2><br><br><br>Add User's Page</h2>
			<p>Add User(s) from the drop down menu below.</p>
			<?PHP
				$result = $fgmembersite->RunQuery("SELECT * FROM regusers");
			?>
			<form action=process.php name=form1 method=post>
				<select name="jumpmenu[]" multiple="multiple">
				<? 
					while($row = mysql_fetch_array( $result )) 
					{
						$name = $row['name'];
						$user = $row['username'];
						if (strcmp($user, $fgmembersite->UserName()) != 0) 
						{
							echo "<option value=$user>";
							echo $name;
							echo "</option>";
						}
					}
				?>	
				</select>
				<input type="submit" />
			</form>
			<p><a href='access-controlled.php'>Back</a></p>
		</div>
		</div>
	</body>
</html>

