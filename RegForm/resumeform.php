<?PHP
	require_once("access.php");
	require_once("htmlfunctions.php");
	$table="resume";
	$link = mysql_connect("localhost", "root", "Orange") or die(mysql_error());
	mysql_select_db("Main", $link) or die(mysql_error());
	$column=$_POST['column'];
	$val=$_POST['txt'];
	$userid = $_POST['uid'];
	//system("echo \"POST: $_POST['txt1']\" > /tmp/reached");
	$val =mb_convert_encoding($val, 'HTML-ENTITIES', 'UTF-8');
	$val=str_replace("&bull;","<li>", $val, $count);
	$val=str_replace("&ndash;","-", $val);
	$val=str_replace("&rsquo;","'", $val);
	$val=preg_replace("/<li>/","<ul><li>", $val, 1);
	$val=preg_replace("/<li>(.*)[\n\.]/","<li>$1</li><br/>", $val);
	//$val=str_replace("\n","<br/>", $val);
	$val=preg_replace('~</li>(?!.*</li>)~', '</li></ul>', $val);
	$val=preg_replace("/\s\s\s+/","<br/>", $val);
	$val=str_replace("\"","", $val);
	if ($count > 0)
	{

	}
	$val = mysql_escape_string($val);
	$qry="update $table set $column='$val' where fkey_regusers='$userid'";
	if (!mysql_query($qry, $link))
		$val=mysql_error($link);
	else
	{
		$qry="select $column from $table where fkey_regusers='$userid'";
		if (!$result=mysql_query($qry, $link))
			$val=mysql_error($link);
		else
		{
			$result=mysql_fetch_array($result);
			$val=$result[0];
			$val = html_entity_decode($val);
			//$val=txt2html($val);
			if ($column != "tagline")
			{
				$val=txt2tag($val, "p");
				$val=txt2tag($val, "abbr");
			}
		}
	}
//Because we want to use json, we have to place things in an array and encode it for json.
//This will give us a nice javascript object on the front side.
echo json_encode(array("returnValue"=>"".$val));  

?>
