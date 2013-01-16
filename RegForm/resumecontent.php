<?PHP
require_once("htmlfunctions.php");
$contents=array();
$form_class="genform";
$table=$resumetable;
$link = mysql_connect("localhost", "root", "Orange") or die(mysql_error());
mysql_select_db("Main") or die(mysql_error());
if ($public)
{
	$maintable="regusers";
	$qry="select username,name from $maintable where id_user='$userid'";
	$result=runQuery($maintable, $qry);
	$inforow=mysql_fetch_array($result);
	$uname=$inforow['username'];
	$fullname=$inforow['name'];
}
$qry="select * from $resumetable where fkey_regusers='$userid'";
$result=runQuery($resumetable, $qry);
$row=mysql_fetch_array($result);

function put_heading_bar($public)
{
	global $row, $uname, $fullname, $form_class, $userid;


	echo "<div id='profilepic' style=\"background-image:url('../images/users/$uname');\"></div>";
	echo "<h1 class='name' id='name'>$fullname</h1>";
	$role="put your role here";
	$form2_id="form2";
	$role_id="tagline";
	$input_id="txt2";
	$maxlength_input=200;
	if ($row['tagline'] != "")
		$role=$row['tagline'];
	if (!$public)
	{
		echo "<span id='$role_id' onclick=\"loadForm2();\">$role\n</span>";
		echo "<form class='$form_class' id='$form2_id'><input class='textinput' type='text' id='$input_id' maxlength=$maxlength_input/><input type='submit' value='save'/><input type=button value='cancel' onclick=\"loadForm2(true); return false;\"/></form>";
		echo "<a target=\"_blank\" href='resume-home.php?page=public&uid=$userid' id='publink'>Public View</a>";
	}
	else
	{
		echo "<span id='$role_id'>$role\n</span>";
		//echo "<a href='resume-home.php' id='prilink'>Edit</a>";
	}
}

function put_form()
{
	global $form_class;
	$form_id="form1";
	$txtarea_id="txt1";
	//$extension=".txt";
	echo "<form class=\"$form_class\" id=\"$form_id\">";
	echo "<textarea id='$txtarea_id' maxlength=\"65535\"></textarea><br/>";
	echo "<input type=\"submit\" id=\"submit\" value='Submit'/>";
	echo "<input type=\"button\" id=\"cancel1\" value='Cancel' onclick=\"loadForm();\"/>";
	echo "</form>";
}
function put_contents($public)
{
	global $row, $resumetable, $contents, $userid;
	$div_class="content";
	$hid_div_class="hdiv";
	$div_listbox_class="listbox";
	$content_id="dummy";
	$qry="select column_name from INFORMATION_SCHEMA.COLUMNS where TABLE_NAME='$resumetable'";
	$result=runQuery($table, $qry);
	while($row1=mysql_fetch_array($result))
	{
		$val = $row1[0];
		if ($val == "id" || $val == "fkey_regusers" || $val == "name" || $val =="tagline")
			continue;
		array_push($contents, $val);
	}
	//$contents=array("aboutme", "summary", "skills", "education", "experience", "projects", "awards", "activities");
	echo "<div class='$div_listbox_class'>";
	echo "<ul>";

	foreach ($contents as $val)
	{
		//$tempval = ucwords($val);
		$tempval =($val);
		$val_c=$val."_c";
		echo "<li id='$val' onclick=\"loadCategory(event);\">$tempval</li><br/>";
	}
	echo "</ul>";
	echo "</div>";
	
	echo "<div class=\"$div_class\" id=\"$content_id\"></div>";
	if (!$public)
		put_form();
	
	foreach ($contents as $val)
	{
		$tempval = strtoupper($val);
		if (!$public)
			$tempval=$tempval."<sup id='supid' onclick=\"event.preventDefault();loadForm();\">Edit</sup>";
		
		$tempval=txt2tag($tempval,"h3");
		$value = html_entity_decode($row["$val"]);
		$htmltext=$value;
		//$htmltext=txt2html($value);
		$htmltext = txt2tag($htmltext,"p");
		$abbrval = txt2tag($htmltext,"abbr");
		$tempval=$tempval.$abbrval;
		/*if ($row["$val"] != "");
		{
		}
		*/
		$val_c=$val."_c";
		echo "<div class=\"$hid_div_class\" id=\"$val_c\">$tempval</div>";
	}
	echo "<div class=\"$hid_div_class\" id=\"footer\"></div>";
}
?>

