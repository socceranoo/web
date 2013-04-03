<?PHP
	function print_spaces($count)
	{
		for($i=0;$i<$count;$i++)
			print "&nbsp";
	}
	function listfiles($directory)
	{
		//print $directory;
		//print "<br/>";
		$fileArr = scandir($directory);
		foreach($fileArr as $file) {
			$extension = pathinfo($directory.$file);	
			$ext = $extension['extension'];
			if ($ext == "exe" ||$ext == "rar" || $ext == "zip" || $ext == "zip") {
				//print_spaces(10);
				print "<a href='".$directory.$file."'>";
				print $file;
				print "</a>";
				//print_spaces(5);
				/*
				if (is_dir($directory.$file))
				{
					print "<br/>";
					print_spaces(10);
					listfiles($directory.$file."/");
					print "<br/>";
				}
				*/
				print "<br/>";
			}
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body onload="init();">
	<div id="files">
	<?listfiles("../ftp/AOE-2/");?>
	</div>
</body>
</html>
