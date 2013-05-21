<?PHP
	$highl ="class=\"highlight\"";
	$li2=$highl;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<title>Manjunath | Front End Developer</title>
		<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/headers.php");?>
		<?require_once("./include/pfheaders.php");?>
	</head>
	<body class='portfolio' id='pfbody'>
		<?require_once("header.php");?>
		<div id="wrapper">			
			<div id="content">
				<div class="arrow" id="leftarrow"></div>
				<div class="arrow" id="rightarrow"></div>
				<div id="pic-nav">
					<div class="smallcircle smallleftarrow" id="sml"></div>
					<div class="toc smallcircle" id="toc0"></div>
					<div class="toc smallcircle" id="toc1"></div>
					<div class="toc smallcircle" id="toc2"></div>
					<div class="smallcircle smallrightarrow" id="smr"></div>
				</div>
				<div id="imac">
					<div id="screen">
					</div>
				</div>
				<div class="halfcontent" id="main">
				</div>
				<div class="hidden" id="proj0">
					<h3 id="proj-heading">raZershark</h3>
					<?require("content/rshark.txt");?>
				</div>
				<div class="hidden" id="proj1">
					<h3 id="proj-heading">gameroom</h3>
					<?require("content/mmatters.txt");?>
				</div>
				<div class="hidden" id="proj2">
					<h3 id="proj-heading">moneymatters</h3>
					<?require("content/mmatters.txt");?>
				</div>
				<div class="hidden" id="proj3">
					<h3 id="proj-heading">resumebuilder</h3>
					<?require("content/rbuilder.txt");?>
				</div>
			</div>
		</div>
		<?require_once("footer.php");?>
	</body>
</html>	
