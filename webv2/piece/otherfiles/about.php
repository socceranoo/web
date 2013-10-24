<?PHP
	system("lessc style/piece.less > style/piece2.css");
?>
<html>
	<head>
		<?require_once("include/pieceheaders.php");?>
	</head>
	<body class=piece>
		<?require_once("include/header.php");?>
		<?require_once("include/footer.php");?>
	</body>
</html>

