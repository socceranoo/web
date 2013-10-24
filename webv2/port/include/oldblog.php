<?
	function print_line_of_code($line, $tabcount) {
		$tab ="&nbsp;&nbsp;&nbsp;&nbsp;";
		for ($i = 0; $i <$tabcount; $i++){
			echo $tab;
		}
		echo "$line<br/>";
	}
	function echo_one_entry($article) {
		$title=$article->title;
		$desc=$article->desc;
		$code=$article->code;
		$date=$article['dateposted'];
		echo "<h3 class=title>$title</h3><h4>$date</h4>";
		foreach ($desc->para as $para) {
			echo "<p class=para>$para;</p>";
		}
		if (count($code->line))
			echo "<div class=code><code data-language=javascript >";
		$tabcount = 0;
		foreach ($code->line as $line) {
			if (preg_match('/^\/\//', $line, $matches)){
				$line = preg_replace('/^\/\//', '/* ', $line);	
				$line = preg_replace('/$/', ' */', $line);	
			}
			if (preg_match('/{$/', $line, $matches)){
				print_line_of_code($line, $tabcount);
				$tabcount++;
			}else if (preg_match('/}$/', $line, $matches)){
				$tabcount--;
				print_line_of_code($line, $tabcount);
			}else { 
				print_line_of_code($line, $tabcount);
			}
		}
		if (count($code->line))
			echo "</code></div>";
	}
	function one_half_content($article, $classstr) {
		//echo "<div class='thirdcontent $classstr'>";
		echo "<div class='fullcontent'>";
		//echo "<div class='halfcontent $classstr'>";
		echo_one_entry($article);
		echo "</div>";
	}
	function filemain() {
		$flarr = array("left", "right");
		$dir="blog";
		$i = 0;
		if ($handle = opendir($dir)) {
			while (false !== ($entry = readdir($handle))) {
				if ($entry != "." && $entry != "..") {
					$src=$dir."/".$entry;
					$myfile = simplexml_load_file($src);
					foreach ($myfile as $article):
						$i = 1 - $i;
						one_half_content($article, $flarr[$i]);
						//$i = 1 - $i;
						//one_half_content($article, $flarr[$i]);
					endforeach;
				}
			}
			closedir($handle);
		}
	}
?>
<div class=content >
	<span class="bl-icon bl-icon-close"></span>
	<h2>Coming soon ... </h2>
	<div class="cleardiv"></div>
	<div class="cleardiv"></div>
	<?//filemain();?>
</div>
