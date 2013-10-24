<?
	$blog_table = "blog";
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/membersite_config.php");
	function insert_entry ($title, $desc, $author, $link, $tags) {
		global $fgmembersite, $blog_table;
		$result = $fgmembersite->RunQuery("INSERT INTO $blog_table (title, description, author, link, tags) VALUES ('$title', '$desc', '$author', '$link', '$tags')");
		echo $fgmembersite->GetErrorMessage();
		echo "<h2>Entry Successful</h2>";
		echo "<a href=add-blog.php>Return to add blog</a>";
	}
	/*
	foreach $_POST ($k => $value) {
		echo "Key:$k";
		echo "Value:$value";
	}
	*/
	$title = $_POST["title"];
	$desc = $_POST["desc"];
	$author = $_POST["author"];
	$link =$_POST["link"];
	$tags = $_POST["tags"];
	insert_entry($_POST["title"],$_POST["desc"],$_POST["author"],$_POST["link"],$_POST["tags"]);
?>
