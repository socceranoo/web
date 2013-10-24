<?PHP 
	$blog_table = "blog";
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/membersite_config.php");
	function get_entries ($tag) {
		global $fgmembersite, $blog_table;
		if (!$tag) {
			$result = $fgmembersite->RunQuery("SELECT * FROM $blog_table");
		}else {
			$result = $fgmembersite->RunQuery("SELECT * FROM $blog_table WHERE tags LIKE '%$tag%'");
		}
		if (mysql_num_rows($result) > 0) {
			while($row = mysql_fetch_array($result)) {
				$title= $row['title'];
				$desc= $row['description'];
				$link= $row['link'];
				$author= $row['author'];
				$tags= $row['tags'];
				$id= $row['blog_id'];
				echo "<div id=entry$id class='blog-entry fullcontent' name=$tags>";
				echo "<img class='tag-image' src='images/blog/$tags.jpg' alt=''/>";
				echo "<a href=$link target='_blank'>";
				echo "<h2>$title</h2>";
				echo "</a>";
				echo "<p>$desc</p>";
				echo "<p class=author>by $author</p>";
				echo "</div>";
			}
		}
	}
	function get_tags () {
		global $fgmembersite, $blog_table;
		$result = $fgmembersite->RunQuery("SELECT DISTINCT(tags) as tags FROM $blog_table ORDER BY tags");
		$id = 0;
		if (mysql_num_rows($result) > 0) {
			while($row = mysql_fetch_array($result)) {
				$tags= $row['tags'];
				$id++;
				echo "<span id=tag$id class=tag-entry name=$tags>$tags</span>";
			}
		}
	}
	function insert_entry ($title, $desc, $author, $link, $tags) {
		global $fgmembersite, $blog_table;
		$result = $fgmembersite->RunQuery("INSERT INTO $blog_table (title, description, author, link, tags)
		VALUES ($title, $desc, $author, $link, $tags)");
	}
?>

<div class="content">
	<span class="bl-icon bl-icon-close"></span>
	<h2>Tech from the web</h2>
	<div class="cleardiv"></div>
	<div class="tag-table">
	<h2 id=reset-tags>Tags</h2>
	<?get_tags();?>
	<div class="cleardiv-1px"></div>
	</div>
	<div class="cleardiv"></div>
	<div id="blog-content" class="blog-content">
		<?get_entries();?>
	</div>
	<div class="cleardiv"></div>
</div>
