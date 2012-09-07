<?PHP
$result = $fgmembersite->RunQuery("DESCRIBE `$uname`");
if(!$result)
{
	print "No friends in your list.Please add friends by clicking Add Friends";
	print "<br>";
	exit;
}
?>
