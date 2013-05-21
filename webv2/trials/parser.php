<?PHP
// Include the library
include('simple_html_dom.php');
$base_link = 'http://espnfc.com/tables/_/league/';
$start_str = "POSTEAMPWDLFAWDLFAWDLFAGDPts";
$end_str = "Champions League";

$leaguearr = array(
	"eng" => "barclays-premier-league",
	"esp" => "spanish-la-liga",
	"ita" => "italian-serie-a",
	"ger" => "german-bundesliga",
);

function get_link_for_league($league, $year){
	global $base_link, $leaguearr;
	$season_str="season/$year/";
	if ($year == "current")
		$season_str="";
	$league_str=$league.".1/".$leaguearr[$league]."?cc=5901";
	$link = $base_link.$season_str.$league_str;
	return $link;
}
$headings=array("position", "name", "P", "W", "D", "L", "GF", "GA", "HW", "HD", "HL", "HGF", "HGA", "AW", "AD", "AL", "AGF", "AGA", "GD", "points");
/*
$link1 ='http://espnfc.com/tables/_/league/eng.1/barclays-premier-league?cc=5901';
$link2 ='http://espnfc.com/tables/_/league/esp.1/spanish-la-liga?cc=5901';
$link3 ='http://espnfc.com/tables/_/league/ita.1/italian-serie-a?cc=5901';
$link4 ='http://espnfc.com/tables/_/league/ger.1/german-bundesliga?cc=5901';

$linkarr = array($link1, $link2, $link3, $link4);
*/
// Retrieve the DOM from a given URL
function get_string_between($string, $start, $end){
    $string = " ".$string;
    $ini = strpos($string,$start);
    if ($ini == 0) return "";
    $ini += strlen($start);
    $len = strpos($string,$end,$ini) - $ini;
    return substr($string,$ini,$len);
}
function extract_details_from_string($subject) {
	$pattern = '/\d+\s+(\D+(\d+)?<\/td>)(\s+)((-?\d+(\s+)?){18})/';
	preg_match_all($pattern, $subject, $matches);
	foreach ($matches[0] as $string) {
		$string = preg_replace('/\s+/', ' ', $string);
		$string = preg_replace('/<\/td>/', '', $string);
		//print $string."\n<br/>";
	}
	foreach ($matches[5] as $string) {
		print $string."\n<br/>";
	}
	foreach ($matches[1] as $string) {
		print $string."\n<br/>";
	}
}
foreach($leaguearr as $key => $value) {
	$link = get_link_for_league($key, "current");
	$plaintext = file_get_html($link)->plaintext;
	$parsed = get_string_between($plaintext, $start_str, $end_str);
	extract_details_from_string($parsed);
	echo "<br/><br/>END of TABLE<br/><br/>";
}

/*
// Find all "A" tags and print their HREFs
foreach($html->find('a') as $e) 
    echo $e->href . '<br>';

// Retrieve all images and print their SRCs
foreach($html->find('img') as $e)
    echo $e->src . '<br>';

// Find all images, print their text with the "<>" included
foreach($html->find('img') as $e)
    echo $e->outertext . '<br>';

// Find the DIV tag with an id of "myId"
foreach($html->find('div#myId') as $e)
    echo $e->innertext . '<br>';

// Find all SPAN tags that have a class of "myClass"
foreach($html->find('span.myClass') as $e)
    echo $e->outertext . '<br>';

// Find all TD tags with "align=center"
foreach($html->find('td[align=center]') as $e)
    echo $e->innertext . '<br>';
    
// Extract all text from a given cell
echo $html->find('td[align="center"]', 1)->plaintext.'<br><hr>';
*/
?>
