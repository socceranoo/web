<?PHP
	function less_to_css() {
		$less_file = $_SERVER['DOCUMENT_ROOT']."webv2/synctube/style/synctube.less";
		$css_file = $_SERVER['DOCUMENT_ROOT']."webv2/synctube/style/synctube.css";
		system("lessc $less_file > $css_file");
	}
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/headers.php");
	less_to_css();
?>
<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
<meta http-equiv="content-language" content="en" />
<link rel="STYLESHEET" type="text/css" href="style/synctube.css" />
<title>Synctube- Watch together</title>
<!--
<link rel="STYLESHEET" type="text/css" href="style/portfolio.css" />
<link rel="STYLESHEET" type="text/css" href="style/boxlayout.css" />
<link rel="STYLESHEET" type="text/css" href="style/animation.css" />
<script type='text/javascript' src='scripts/my_animations.js'></script>
<script type='text/javascript' src='scripts/portfolio.js'></script>
<script type='text/javascript' src='scripts/port.js'></script>
<script type="text/javascript" src="scripts/rgraph.js" ></script>
-->
<link rel="icon" type="image/ico" href="images/icon2.png"/>
