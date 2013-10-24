<?PHP 
	system("lessc style/testjunk.less > style/testjunk.css");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>testjunk</title>
	<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/headers.php"); ?>
	<link rel="STYLESHEET" type="text/css" href="style/testjunk.css"/>
	<link rel="icon" type="image/ico" href="images/icon.png"/>
</head>
<body>
	<div class="container">
		<ul id=item-selector class="item-selector carousel-indicators" data-current=0>
			<li data-target=0 class="active"></li>
			<li data-target=1 class=""></li>
			<li data-target=2 class=""></li>
			<li data-target=3 class=""></li>
		</ul>
		<div class="background-sunFlower box"></div>
		<div class="background-alizarin box"></div>
		<div class="background-nephritis box"></div>
		<div class="background-peterRiver box"></div>
	</div>
	<script src="scripts/testjunk.js" type="text/javascript"></script>
	<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/footers.php");?>
</body>
</html>
