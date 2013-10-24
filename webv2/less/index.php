<?
	system("lessc style/sample.less > style/less.css");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Less to CSS converter</title>
	<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/headers.php");?>
	<?require_once("./include/lessheaders.php");?>
</head>
<body class=bg-silver>
	<div class="maincontent no-bg">
		<div class="pagecontent">
			<div class="full height-600 bg-clouds">
				<h2>LESS to CSS converter</h2>
				<form action="upload-image.php" method="post" enctype="multipart/form-data" name="uploadImage" id="uploadImage">
					<label for="image">Upload image:</label>
					<input type="file" name="image" id="image" required/>
					<input type="submit" name="upload" id="upload" value="Upload" />
					<br/>
					<h2>OR Enter LESS text here</h2>
					<textarea id="less-text" name="" cols="30" rows="10"></textarea>	
				</form>
			</div>
			<div class="cleardiv"></div>
			<div class="full height-600 bg-peter-river"></div>
		</div>
	</div>
</body>
</html>
