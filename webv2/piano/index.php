<?PHP
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/headers.php");
	system("lessc style/piano.less > style/piano.css");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<link rel="stylesheet" type="text/css" href="style/piano.css">
</head>
<body>
	<div class="container">
		<div class="featurette-divider"></div>
		<h1 class=text-center>PIANORAZE</h1>
		<div class="featurette-divider"></div>
		<div class="row ">
			<div data-octave=octave2 class="octave">
				<?require("include/octave.php");?>
			</div>
			<div data-octave=octave3 class="octave">
				<?require("include/octave.php");?>
			</div>
			<div data-octave=octave4 class="octave">
				<?require("include/octave.php");?>
			</div>
		</div>
		<audio style="display:none" id ='player' controls="true"></audio>
	</div>
	<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/footers.php");?>
	<script type="text/javascript" src="scripts/piano.js" ></script>
</body>
</html>
