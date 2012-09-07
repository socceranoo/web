<html>
<body>
<p>
<?php 
	print $_POST["date"];	
	print $_POST["amount"];	
	print $_POST["paid"];	
	foreach ($_POST["participants"] as $k)
	{
		print $k;	
	}
?>
</p>
</body>
</html>
