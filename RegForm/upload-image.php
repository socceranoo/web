<?PHP
	require_once("access.php");
	// define a constant for the maximum upload size
	function resizeimage($filename)
	{
		$image = new Imagick( $filename );
		$imageprops = $image->getImageGeometry();
		if ($imageprops['width'] <= 320 && $imageprops['height'] <= 240) {
		// don't upscale
		}
		else {
			$image->resizeImage(320,240, imagick::FILTER_LANCZOS, 0.9, true);
		}
	}
	define ('MAX_FILE_SIZE', 1920 * 1280);

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
							resizeimage(UPLOAD_DIR .$uname);	
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
	if ($success)
		$fgmembersite->RedirectToURL("account-info.php?page=success");
	else
		$fgmembersite->RedirectToURL("account-info.php?page=failed");
		
	/*foreach (unserialize($_POST['hpaid']) as $k)
		echo $k;
	*/
?>

