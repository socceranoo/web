<?PHP
	require_once("access.php");
	/*
	define ('MAX_FILE_SIZE', 1024 * 50);

	if (array_key_exists('upload', $_POST)) {
		// define constant for upload folder
		define('UPLOAD_DIR', '../images/users/');
		// replace any spaces in original filename with underscores
		//$file = str_replace(' ', '_', $_FILES['image']['name']);
		// create an array of permitted MIME types
		$permitted = array('image/gif', 'image/jpeg', 'image/pjpeg',
		'image/png');
		// upload if file is OK
		if (in_array($_FILES['image']['type'], $permitted) && $_FILES['image']['size'] > 0 && $_FILES['image']['size'] <= MAX_FILE_SIZE) {
			switch($_FILES['image']['error']) {
				case 0:
					// check if a file of the same name has been uploaded
					//if (!file_exists(UPLOAD_DIR . $uname)){
						// move the file to the upload folder and rename it
						$success = move_uploaded_file($_FILES['image']['tmp_name'], UPLOAD_DIR .$uname);
						if ($success) {
							$result = "$file uploaded successfully.";
						} else {
							$result = "Error uploading $file. Please try again.";
						}
					//} else {
					//	$result = 'A file of the same name already exists.';
					//}
					break;
				case 3:
				case 6:
				case 7:
				case 8:
					$result = "error 8: Error uploading $file. Please try again.";
					break;
				case 4:
					$result = "You didn't select a file to be uploaded.";
			}
		} else {
			$result = "$file is either too big or not an image.";
		}
		echo $result;
	}
	*/
	
	function display_user_info()
	{
		global $fgmembersite, $uname;
		$result = $fgmembersite->RunQuery("SELECT name,username,fbusername from regusers where username='$uname'");
		$row = mysql_fetch_array($result);
		foreach ($row as $i => $values) {
			if (!is_numeric($i)) {
				if ($i != "fbusername")
					echo ucwords($i)." : ".$values;	
				else
				{
					echo "Password : *********<a class='small' href='change-pwd.php'>change</a><br/>";
					echo "<br/>";
					echo "<a href='https://www.facebook.com/".$values."'>Facebook profile</a>";
				}
					
				echo "<br/>";
				echo "<br/>";

			}
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<?require_once("includes.php");?>
		<!--<meta http-equiv="refresh" content="60"/>-->
		<title>Welcome!!</title>
		<!--
		<script type="text/javascript" src="scripts/tumblr.js" ></script>
		-->
	</head>
	<body class='home'>
		<h1><br>Account Information</h1>
		<div id="acc-info">		
			<div id="image-set">
				<img class="profile-pic" id="profile-pic" src="../images/users/<?echo $uname?>"/><br/>
				<a href=# onclick="$('#foto-uploader').show();" align="center">edit/add</a>
			</div>
			<div id="foto-uploader">
					<form action="upload-image.php" method="post" enctype="multipart/form-data" name="uploadImage" id="uploadImage">
							<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />
							<label for="image">Upload image:</label>
							<input type="file" name="image" id="image" />
							<input type="submit" name="upload" id="upload" value="Upload" />
							<a href=# id="cancel" onclick="$('#foto-uploader').hide();">Cancel</a>
					</form>
			</div>
			<script>$('#foto-uploader').hide();</script>
			<?display_user_info();?>
		<div>
	</body>
</html>
