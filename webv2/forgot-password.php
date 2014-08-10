<?PHP
	system("lessc style/home.less > style/home.css");
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/membersite_config.php");
	if ($fgmembersite->CheckLogin()){
		$fgmembersite->RedirectToURL("home.php");
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US" ng-app>
	<head>
		<?require_once("include/headers.php");?>
		<?require_once("include/loginheaders.php");?>
	</head>
	<body class='background-clouds'>
		<div class=container>
			<div class="featurette-divider4"></div>
			<h3 class="website-heading">gatoraze.com</h3>
			<hr class="featurette-divider4">
			<div class=row>
				<div class=span4>
					<?require_once("include/resetform.php");?>
				</div>
				<div class=span6>
				</div>
				<div class=span2>
					<OBJECT CLASSID="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" CODEBASE="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,0,0" WIDTH=200 HEIGHT=200">
						<PARAM NAME="movie" VALUE="images/clock.swf">
						<PARAM NAME="quality" VALUE="high">
						<PARAM NAME="bgcolor" VALUE="#FFFFFF">
						<PARAM NAME="wmode" VALUE="transparent">
						<PARAM NAME="menu" VALUE="false">
						<EMBED SRC="images/clock.swf" WIDTH=200 HEIGHT=200 QUALITY="high" WMODE="transparent" MENU="false"></EMBED>
					</OBJECT>
				</div>
			</div>
		</div>
		<?require_once("include/footers.php");?>
	</body>
</html>
