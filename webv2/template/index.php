<?PHP 
	system("lessc style/template.less > style/template.css");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TEMPLATE</title>
	<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/headers.php"); ?>
	<link rel="STYLESHEET" type="text/css" href="style/template.css"/>
	<link rel="icon" type="image/ico" href="images/icon.png"/>
</head>
<body>
	<div class="container">
	</div>
	<script src="scripts/template.js" type="text/javascript"></script>
	<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/footers.php");?>
</body>
</html>
