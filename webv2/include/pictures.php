<?php
	function populate_pics(){
	$dir="external/linkhdd/Arthi Backup from HP laptop/Pictures/juboy snow kick";
	//$dir="../external/linkhdd/Arthi Backup from HP laptop/Pictures/Gainesville/At homestead";
		if ($handle = opendir($dir)) {
			$count=0;
			while (false !== ($entry = readdir($handle))) {
				$id = "thumb".$count;
				if ($entry != "." && $entry != "..") {
					$src=$dir."/".$entry;
					$file_parts = pathinfo($src);
					if ($file_parts['extension'] == "JPG" || $file_parts['extension'] == "jpg") {
						echo "<li><img id='$id' src='$src' class='thumbnail'></li>";
						$count++;
					}
				}
			}
			closedir($handle);
		}
	}
?>
<div class='thumbnail-wrap'>
<div class="ice-previous"></div>
<ul class="navigator">
<?populate_pics();?>
</ul>
<div class="ice-next"></div>
</div>
