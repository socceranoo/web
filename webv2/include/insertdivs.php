<?php
$count = 8;
$arr = array("Webmaster's Portfolio", "Resume Builder", "Money Matters", "Game Room", "My Music", "SyncTube" , "My Recipes", "My Money 2");
$linkarr = array("portfolio", "../RegForm/resume-home.php", "../RegForm/money-matters.php", "trump/", "audio.php", "../RegForm/synctube-home.php" , "../RegForm/recipes.php", "money");
$imgarr = array("portfolio.jpg", "ResumeBuildTN1.jpg", "money.jpg", "gameroom1TN.jpg", "ftpTN.jpg", "synctubeTN.jpg" , "kitchenTN.jpg", "money.jpg");
for ($i=0; $i < $count; $i++) { 
	$target="";
	if ($i == 0){
		$target="target=\"_blank\"";
	}
	$link = $linkarr[$i];
	$content = $arr[$i];
	$imgsrc = "images/".$imgarr[$i];
	echo "<div id='float$i' class='floating'>
	<a href='$link' $target><div class='glossy'>
	</div><img src='$imgsrc'><p>$content</p></a></div>";
}
?>
