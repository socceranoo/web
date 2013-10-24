<?PHP
	function less_to_css() {
		$less_file = $_SERVER['DOCUMENT_ROOT']."webv2/2money/style/money.less";
		$css_file = $_SERVER['DOCUMENT_ROOT']."webv2/2money/style/money2.css";
		system("lessc $less_file > $css_file");
	}
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/headers.php");
	less_to_css();
?>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
<meta http-equiv="content-language" content="en" />
<title>Money Matters</title>
<link rel="icon" type="image/ico" href="images/icon.jpg"/>
<link rel="STYLESHEET" type="text/css" href="style/money2.css" />
<!--
<script src="scripts/time.js" type="text/javascript"></script>
<script src="scripts/money.js" type="text/javascript"></script>
-->
