<?PHP 
	$blog_table = "blog";
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/membersite_config.php");
	function get_entries ($tag) {
		$backgrounds=["background-clouds"];
		//$backgrounds=["background-sunFlower", "background-emerald", "background-clouds", "background-carrot", "background-peterRiver", "background-amethyst"];
		global $fgmembersite, $blog_table;
		if (!$tag) {
			$result = $fgmembersite->RunQuery("SELECT * FROM $blog_table");
		}else {
			$result = $fgmembersite->RunQuery("SELECT * FROM $blog_table WHERE tags LIKE '%$tag%'");
		}
		if (mysql_num_rows($result) > 0) {
			$i = 0;
			while($row = mysql_fetch_array($result)) {
				
				$title= $row['title'];
				$desc= $row['description'];
				$link= $row['link'];
				$author= $row['author'];
				$tags= $row['tags'];
				$id= $row['blog_id'];
				$bg_str =$backgrounds[$i];
				$title=ucwords(strtolower($title));
				echo "<div id=entry$id class='blog-entry span12 text-center well $bg_str' name=$tags>";
					echo "<img class='pull-left img-rounded img-polaroid' src='images/blog/$tags.jpg' alt=''/>";
					echo "<h3>";
					echo "<a href=$link target='_blank'>$title</a>";
					echo "</h3>";
					echo "<p>$desc</p>";
					echo "<p class=pull-right>by $author</p>";
					echo "<div class=clearfix></div>";
				echo "</div>";
				$i++;
				$i%=count($backgrounds);
			}
		}
	}
	function get_tags () {
		global $fgmembersite, $blog_table;
		$result = $fgmembersite->RunQuery("SELECT DISTINCT(tags) as tags FROM $blog_table ORDER BY tags");
		$id = 0;
		if (mysql_num_rows($result) > 0) {
			echo "<ul class=inline>";
			echo "<li class=active id=reset-tags><a href='javascript:void(0);'><h4>all</h4></a></li>";
			while($row = mysql_fetch_array($result)) {
				$tags= $row['tags'];
				$id++;
				echo "<li id=tag$id class=tag-entry name=$tags><a href='javascript:void(0);' name=$tags><h4>$tags</h4></a></li>";
			}
			echo "</ul>";
		}
	}
	function insert_entry ($title, $desc, $author, $link, $tags) {
		global $fgmembersite, $blog_table;
		$result = $fgmembersite->RunQuery("INSERT INTO $blog_table (title, description, author, link, tags)
		VALUES ($title, $desc, $author, $link, $tags)");
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<?require_once("include/pfheaders.php");?>
	</head>
	<body class=background-white>
		<?require_once("include/header.php");?>
		<div class="container">
			<div class="row">
				<div class="span12 text-center well background-clouds pagination">
					<h2>Tech from the web</h2>
					<?get_tags();?>
				</div>
			</div>
			<hr class="featurette-divider2" />
			<div class="row">
				<?get_entries();?>
			</div>
			<hr class="featurette-divider2" />
		</div>
		<?require_once("include/footer.php");?>
	</body>
	<?require_once("include/pffooters.php");?>
</html>	
