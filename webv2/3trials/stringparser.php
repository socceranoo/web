<?PHP
function extract_details_from_string($subject) {
	print $subject."\n";
	$pattern = '/\d+(\s)(\D+)(\s)(-?\d+\s?){18}/';
	if (preg_match_all($pattern, $subject, $matches)){
	//if (preg_match($pattern, $subject, $matches, PREG_OFFSET_CAPTURE)){
		//print $matches[0][0]."\n";
		print_r($matches);
	}
}
$headings=array("position", "name", "P", "W", "D", "L", "GF", "GA", "HW", "HD", "HL", "HGF", "HGA", "AW", "AD", "AL", "AGF", "AGA", "GD", "points");
$string = "1 Manchester United 35 27 4 4 79 36 15 0 2 43 17 12 4 2 36 19 43 -85 2 Manchester City 35 21 9 5 61 31 13 3 1 38 12 8 6 4 23 19 -30 72 ";
extract_details_from_string($string);
?>
