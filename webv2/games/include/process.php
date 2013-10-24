<?PHP
	$permitted = array('image/jpeg', 'image/pjpeg');
	function add_grids($image_dir, $image_prefix, $rows, $columns, $class_name) {
		for($i = 0; $i < $rows ; $i++) {
			for($j = 0; $j < $columns ; $j++) {
				$back ="background-wetAsphalt";
				$back ="";
				$value = $i*$rows + $j + 1;
				$url = "background-image:url('$image_dir/$image_prefix".$value.".jpg')";
				if ($value == $rows * $columns)
					echo "<div id=elem$value class='$class_name right-border $back' data-value=$value></div>";
				else 
					echo "<div id=elem$value class='$class_name right-border' data-value=$value style=$url></div>";
			}
		}
	}
	function convert_image($image, $image_dir, $image_prefix, $rows, $columns, $width, $height) {
		global $ref_image;
		$dim = $width."x".$height;
		system("convert $image -resize $dim\! $image_dir/output.jpg");
		system("convert $image -resize $dim $ref_image ");
		//system("convert temp/output.jpg -compress JPEG2000 temp/output.jpg");
		$xsize = intval($width/$columns);
		$ysize = intval($height/$rows);
		for($i = 0; $i < $rows ; $i++) {
			$yvalue = $i * $xsize;
			for($j = 0; $j < $columns ; $j++) {
				$value = $i*$rows + $j + 1;
				$xvalue = $j * $ysize;
				$val = $xsize."x".$ysize."+".$xvalue."+".$yvalue;
				system("convert 'temp/output.jpg[$val]' $image_dir/$image_prefix$value.jpg 2>/dev/null");
			}
		}
	}
	function process_image() {
		global $image, $permitted;
		define ('MAX_FILE_SIZE', 1920 * 1280);
		// define constant for upload folder
		define('UPLOAD_DIR', 'temp/');
		// replace any spaces in original filename with underscores
		//$file = str_replace(' ', '_', $_FILES['image']['name']);
		// create an array of permitted MIME types
		//$permitted = array('image/gif', 'image/jpeg', 'image/pjpeg', 'image/png');
		if ($_FILES['image']['size'] == 0 ){
			$result = "Empty file. Please try again.";
			return $result;
		}
		if ($_FILES['image']['size'] > MAX_FILE_SIZE) {
			$result = "File Size too large. Please try again.";
			return $result;
		}
		// upload if file is OK
		if (in_array($_FILES['image']['type'], $permitted)){
				switch($_FILES['image']['error']) {
					case 0:
						$success = move_uploaded_file($_FILES['image']['tmp_name'], UPLOAD_DIR."temp.jpg");
						if ($success) {
							//$result = "$file uploaded successfully.";
							$image = "temp/temp.jpg";
						} else {
							$result = "Error uploading $file. Please try again.";
						}
						break;
				}
		} else {
			$result = "File type not supported at this moment. Please try again.";
		}
		return $result;
	}
	function process_link() {
		global $image, $permitted;
		$array = getimagesize($_POST['link']);
		if ($array) {
			if (in_array($array['mime'], $permitted)){
				$image = $_POST['link'];
			} else {
				$result = "File type not supported at this moment. Please try again.";
			}
		} else {
			$result = "Not a valid Image URL";
		}
		return $result;
	}
?>
