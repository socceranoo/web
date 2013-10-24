<?PHP
	$dir="../../external/linkhdd";
    $string = $argv[1];
    function search_by_mp3_file($dir, $string) {
        $dir.= "/";
        $string .= "*\.mp3";
        $array = array();
        $variable=exec("find $dir -iname \"*$string\"", $array);
		print_r($array);
        $final = implode("\n", $array);
        return $final;
    }
    function search_by_directory($dir, $string) {
        $final="";
        $dir.= "/";
        $array = array();
        $variable= exec("find $dir -type d -iname \"*$string*\"", $array);
        foreach ($array as $val) {
            $val = str_replace(' ', '\ ', $val);
			$val = str_replace('(', '\(', $val);
            $val = str_replace(')', '\)', $val);
            $final.=search_by_mp3_file($val, "");
        }
        return $final;
    }

    function filemain($dir, $string) {
        $final = search_by_directory($dir, $string);
        $final .= search_by_mp3_file($dir, $string);
        return $final;
    }
    //$string = str_replace(' ', '*', $string);
    $final = filemain($dir, $string);
	print $final;
?>
