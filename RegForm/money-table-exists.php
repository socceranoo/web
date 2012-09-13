<?PHP
$result = $fgmembersite->RunQuery("DESCRIBE `$moneytable`");
if(!$result)
{
	print "There are no transactions under your name";
	print "<br>";
//	exit;
}
?>
