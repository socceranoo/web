<?PHP
	require_once("include/actions-include.php");
	$retval = "";
	summary();
	echo "<legend>Summary</legend>";
	echo "<div class='span6 offset1'>";
	echo "<div class='pull-left' style='margin-top: 20px; margin-left: 20px; width: 200px; height: 200px; position: relative;' id=pie1></div>";
	echo "<div class='pull-right' style='margin-top: 20px; margin-left: 20px; width: 200px; height: 200px; position: relative;' id=pie2></div>";
	echo "</div>";
	echo "<div class=featurette-divider2></div>";
	echo "<div class='span4 offset2 text-center'>$retval</div>";
?>
