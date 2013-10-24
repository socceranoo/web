<? 
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
				echo "<div class='blog-entry fullcontent'>"
				echo "<h2>$row['title']</h2>";
				echo "<p>$row['desc']</p>";
				echo "</div>";
			}
		}
	}
	function insert_entry ($title, $desc, $author, $link, $tags) {
		global $fgmembersite, $blog_table;
		$result = $fgmembersite->RunQuery("INSERT INTO $blog_table (title, description, author, link, tags)
		VALUES ($title, $desc, $author, $link, $tags)");
	}
?>
