<?
echo "<div id=".$_REQUEST['id']."></div>";
$array = unserialize($_REQUEST['arg']);
foreach ($array as $k)
{
	echo $k."<br>";
}
?>
