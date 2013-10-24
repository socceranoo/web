<?PHP
	function less_to_css() {
		$less_file = $_SERVER['DOCUMENT_ROOT']."/webv2/2alveo/style/alveo.less";
		$css_file = $_SERVER['DOCUMENT_ROOT']."/webv2/2alveo/style/alveo2.css";
		system("lessc $less_file > $css_file");
	}
	less_to_css();
?>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
<meta http-equiv="content-language" content="en" />
<title>Alveo Energy</title>
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<link rel="icon" type="image/ico" href="images/icon.png"/>
<link href='http://fonts.googleapis.com/css?family=Archivo+Narrow' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Elsie+Swash+Caps' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Titillium+Web' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Paprika' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro' rel='stylesheet' type='text/css'>
<!--BOOTSTRAP ITEMS -->
<link href="bootstrap/bootstrap.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link href="bootstrap/bootstrap-responsive.css" rel="stylesheet">
<link rel="STYLESHEET" type="text/css" href="style/alveo.css" />
<link rel="STYLESHEET" type="text/css" href="style/alveo2.css" />
