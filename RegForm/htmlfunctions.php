<?PHP
// Case-insensitive str_replace()
function stri_replace( $find, $replace, $string ) {
		$parts = explode( strtolower($find), strtolower($string) );
		$pos = 0;
		foreach( $parts as $key=>$part ){
			$parts[ $key ] = substr($string, $pos, strlen($part));
			$pos += strlen($part) + strlen($find);
		}
		return( join( $replace, $parts ) );
}

function txt2tag($txt, $tag)
{
	return "<$tag>$txt</$tag>";
}

function txt2html($txt) {
	// Transforms txt in html
	//Kills double spaces and spaces inside tags.
	while( !( strpos($txt,'  ') === FALSE ) )
		$txt = str_replace('  ',' ',$txt);
	$txt = str_replace(' >','>',$txt);
	$txt = str_replace('< ','<',$txt);
	//Transforms accents in html entities.
	$txt = htmlentities($txt);
	//We need some HTML entities back!
	$txt = str_replace('"','"',$txt);
	$txt = str_replace('<','<',$txt);
	$txt = str_replace('>','>',$txt);
	$txt = str_replace('&','&',$txt);
	//Ajdusts links - anything starting with HTTP opens in a new window
	$txt = stri_replace("<a href=\"http://","<a target=\"_blank\" href=\"http://",$txt);
	$txt = stri_replace("<a href=http://","<a target=\"_blank\" href=http://",$txt);
	//Basic formatting
	$eol = ( strpos($txt,"\r") === FALSE ) ? "\n" : "\r\n";
	$html = '<p>'.str_replace("$eol$eol","</p><p>",$txt).'</p>';
	$html = str_replace("$eol"," \n",$html);
	$html = str_replace("</p>","</p>\n\n",$html);
	$html = str_replace("<p></p>","<p></p>",$html);
	//Wipes after block tags (for when the user includes some html in the text).
	$wipebr = Array("table","tr","td","blockquote","ul","ol","li");
	for($x = 0; $x < count($wipebr); $x++) {
		$tag = $wipebr[$x]; 
		$html = stri_replace("<$tag> ","<$tag>",$html);
		$html = stri_replace("</$tag> ","</$tag>",$html);
	}
	return $html;
}

function runQuery($table, $qry)
{

	$result=mysql_query($qry);
	return $result;
}
?>
