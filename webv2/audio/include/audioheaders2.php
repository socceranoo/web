<?PHP
	function less_to_css() {
		$less_file = $_SERVER['DOCUMENT_ROOT']."webv2/audio/style/audio.less";
		$css_file = $_SERVER['DOCUMENT_ROOT']."webv2/audio/style/audio2.css";
		system("lessc $less_file > $css_file");
	}
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/headers.php");
	less_to_css();
?>
<!-- LOGIN-->
<link rel="stylesheet" href="style/jplayer.blue.monday.css" type="text/css" media='all'/>
<link rel="icon" type="image/ico" href="images/music-icon.png"/>
<!--
<link rel="stylesheet" href="style/jplayer.blue.monday.css" type="text/css" media='screen and (max-width: 700px)'/>
<link rel="stylesheet" href="style/jplayer.blue.monday.css" type="text/css" media='screen and (min-width: 980px)'/>
<link rel="icon" type="image/ico" href="images/music-icon.png"/>
<link rel="stylesheet" media='screen and (max-width: 979px)' href="style/premium-pixels.css" type="text/css" />
<link rel="stylesheet" href="style/jplayer.blue.monday.css" type="text/css" media="all" />
<link rel="stylesheet" href="style/main.css" type="text/css" media="all" />
<link rel="stylesheet" type="text/css" href="style/audio.css" />
-->
<link rel="stylesheet" type="text/css" href="style/audio2.css" />
