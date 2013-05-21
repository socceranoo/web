<?PHP
	$dir="../../../external/linkhdd/Audio";
	$string = $_POST['str'];
	function dir_name_processing ($val) {
		$val = str_replace(' ', '\ ', $val);
		$val = str_replace('\'', '\\\'', $val);
		$val = str_replace('(', '\(', $val);
		$val = str_replace(')', '\)', $val);
		$val = str_replace('[', '\[', $val);
		$val = str_replace(']', '\]', $val);
		return $val;
	}
	function search_by_mp3_file($dir, $string) {
		$dir.= "/";
		$string .= "*\.mp3";
		$array = array();
		$variable=exec("find $dir -iname \"*$string\"", $array);
		return $array;
	}
	function search_by_directory($dir, $string) {
		$final= array();
		$dir.= "/";
		$array = array();
		$variable= exec("find $dir -type d -iname \"*$string*\"", $array);
		foreach ($array as $val) {
			$val = dir_name_processing($val);
			$temp =search_by_mp3_file($val, "");
			$final = array_merge($final, $temp);
		}
		return $final;
	}

	function filemain($dir, $string) {
		$dir_array = search_by_directory($dir, $string);
		$song_array = search_by_mp3_file($dir, $string);
		return array_merge($dir_array, $song_array); 
	}
	$string = str_replace(' ', '*', $string);
	$final = filemain($dir, $string);
	echo json_encode($final);
?>
