<?php
	function populate_pics(){
	$dir="../external/linkhdd/Arthi Backup from HP laptop/Pictures/juboy snow kick";
		if ($handle = opendir($dir)) {
			$count=0;
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != "..") {
					$src=$dir."/".$entry;
					echo "$src\n";
					$count++;
				}
			}
			closedir($handle);
		}
	}
populate_pics();
?>
