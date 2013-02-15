<?PHP
	$dir="../external/linkhdd/";
	$string = "coldplay";
	$arr = array();
	function search_by_mp3_file($dir, $string) {
		$string .= "*\.mp3";
		$array = array();
		$variable=exec("find $dir -iname \"*$string\"", $array);
		return $array;
	}
	function search_by_directory($dir, $string) {
		$final = array();
		$dir.= "/";
		$array = array();
		$variable= exec("find $dir -type d -iname \"*$string*\"", $array);
		foreach ($array as $val) {
			$val = str_replace(' ', '\ ', $val);
			$temp=search_by_mp3_file($val, "");
			$final = array_merge($final, $temp);
		}
		return $final;
	}

	function filemain($dir, $string) {
		$final = search_by_directory($dir, $string);
		return $final;
	}
	$final = filemain($dir, $string);
	$arr = array_merge($arr, $final);
	echo json_encode($arr);
?>
