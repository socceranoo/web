<?PHP
/*
$color_arr = array(
"#FFFFFF", "#FFFFCC", "#FFFF99", "#FFFF66", "#FFFF33", "#FFFF00",
"#FFCCFF", "#FFCCCC", "#FFCC99", "#FFCC66", "#FFCC33", "#FFCC00",
"#FF99FF", "#FF99CC", "#FF9999", "#FF9966", "#FF9933", "#FF9900",
"#FF66FF", "#FF66CC", "#FF6699", "#FF6666", "#FF6633", "#FF6600",
"#FF33FF", "#FF33CC", "#FF3399", "#FF3366", "#FF3333", "#FF3300",
"#FF00FF", "#FF00CC", "#FF0099", "#FF0066", "#FF0033", "#FF0000",
"#CCFFFF", "#CCFFCC", "#CCFF99", "#CCFF66", "#CCFF33", "#CCFF00",
"#CCCCFF", "#CCCCCC", "#CCCC99", "#CCCC66", "#CCCC33", "#CCCC00",
"#CC99FF", "#CC99CC", "#CC9999", "#CC9966", "#CC9933", "#CC9900",
"#CC66FF", "#CC66CC", "#CC6699", "#CC6666", "#CC6633", "#CC6600",
"#CC33FF", "#CC33CC", "#CC3399", "#CC3366", "#CC3333", "#CC3300",
"#CC00FF", "#CC00CC", "#CC0099", "#CC0066", "#CC0033", "#CC0000",
"#99FFFF", "#99FFCC", "#99FF99", "#99FF66", "#99FF33", "#99FF00",
"#99CCFF", "#99CCCC", "#99CC99", "#99CC66", "#99CC33", "#99CC00",
"#9999FF", "#9999CC", "#999999", "#999966", "#999933", "#999900",
"#9966FF", "#9966CC", "#996699", "#996666", "#996633", "#996600",
"#9933FF", "#9933CC", "#993399", "#993366", "#993333", "#993300",
"#9900FF", "#9900CC", "#990099", "#990066", "#990033", "#990000",
"#66FFFF", "#66FFCC", "#66FF99", "#66FF66", "#66FF33", "#66FF00",
"#66CCFF", "#66CCCC", "#66CC99", "#66CC66", "#66CC33", "#66CC00",
"#6699FF", "#6699CC", "#669999", "#669966", "#669933", "#669900",
"#6666FF", "#6666CC", "#666699", "#666666", "#666633", "#666600",
"#6633FF", "#6633CC", "#663399", "#663366", "#663333", "#663300",
"#6600FF", "#6600CC", "#660099", "#660066", "#660033", "#660000",
"#33FFFF", "#33FFCC", "#33FF99", "#33FF66", "#33FF33", "#33FF00",
"#33CCFF", "#33CCCC", "#33CC99", "#33CC66", "#33CC33", "#33CC00",
"#3399FF", "#3399CC", "#339999", "#339966", "#339933", "#339900",
"#3366FF", "#3366CC", "#336699", "#336666", "#336633", "#336600",
"#3333FF", "#3333CC", "#333399", "#333366", "#333333", "#333300",
"#3300FF", "#3300CC", "#330099", "#330066", "#330033", "#330000",
"#00FFFF", "#00FFCC", "#00FF99", "#00FF66", "#00FF33", "#00FF00",
"#00CCFF", "#00CCCC", "#00CC99", "#00CC66", "#00CC33", "#00CC00",
"#0099FF", "#0099CC", "#009999", "#009966", "#009933", "#009900",
"#0066FF", "#0066CC", "#006699", "#006666", "#006633", "#006600",
"#0033FF", "#0033CC", "#003399", "#003366", "#003333", "#003300",
"#0000FF", "#0000CC", "#000099", "#000066", "#000033", "#000000",
);
*/
$color_arr = array();
	//for($i = 0; $i <= 15 ; $i+=3) {
	for($i = 15; $i >= 0 ; $i-=3) {
		//for($j = 0; $j <= 15 ; $j+=3) {
		for($j = 15; $j >= 0 ; $j-=3) {
			//for($k = 0; $k <= 15 ; $k+=3) {
			for($k = 15; $k >= 0 ; $k-=3) {
				$val_r = $i*16 + $i;
				$val_g = $j*16 + $j;
				$val_b = $k*16 + $k;
				$val_i = dechex($i).dechex($i);
				$val_j = dechex($j).dechex($j);
				$val_k = dechex($k).dechex($k);
				$val = "#".$val_i.$val_j.$val_k;
				array_push($color_arr, array("red"=>$val_r, "green"=>$val_g, "blue"=>$val_b, "hex"=>strtoupper($val)));
			}
		}
	}
?>
<?PHP 
	system("lessc style/colors.less > style/colors.css");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Color picker</title>
	<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/headers.php"); ?>
	<link rel="STYLESHEET" type="text/css" href="style/colors.css"/>
	<link rel="icon" type="image/ico" href="images/icon.png"/>
</head>
<body>
	<div class="container">
		<div class="eadingbox">
			<h2 class=text-center>COLOR PICKER</h2>
			<h2 class=text-center id=value>&nbsp;</h2>
			<div id="slider"></div>
		</div>
		<div id=color-picker class="row" data-current=-1>
			<?
				for($i = 0; $i < count($color_arr); $i++) {
					$hex = $color_arr[$i]['hex'];
					$red = $color_arr[$i]['red'];
					$green = $color_arr[$i]['green'];
					$blue = $color_arr[$i]['blue'];
					//echo "<div style='background:$color_arr[$i];' class='span4 hex'></div>";
					echo "<div class='span2 color-holder'>";
					echo "<div style='background:$hex;' data-green=$green data-blue=$blue data-red=$red data-color=$hex class='polygon color-bg'></div>";
					echo "</div>";
					/*
					echo "<svg xmlns='http://www.w3.org/2000/svg' version='1.1'>";
					echo "<polygon points='0,52 30,0 90,0 120,52 90,104 30,104' class=polygon data-color=$color_arr[$i] fill=$color_arr[$i] stroke=#000 stroke-width=0 shape-rendering=crispEdges />";
					echo "</svg>";
					*/
				}
			?>
		</div>
	</div>
	<script src="scripts/colors.js" type="text/javascript"></script>
	<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/footers.php");?>
</body>
</html>
