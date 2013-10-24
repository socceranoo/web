<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<?require_once("include/pfheaders.php");?>
	</head>
	<body class=background-white>
		<?require_once("include/header.php");?>
		<div class="container">
			<div class=row>
				<div id=loading-bar class="span4 offset4 text-center" style="min-height:500px;position:relative;top:40%;">
					<h2>loading&nbsp;&nbsp;<span class=muted>...</span></h2>
					<img src="images/loading5.gif" class="img-circle" alt="" style="height:150px;width:150px"/>
				</div>
			</div>
			<div class="row" id=snowkick-holder style="display:none">
				<div class="span4 offset4 text-center">
					<h3 id=heading-start class=text-center><a id=snowkick-start href="javascript:void(0);" data-fast=100 data-slow=300 data-med=150 ><span class="icon-glyph icon-play" style="font-size:50px;"></span></a></h3>
				</div>
				<div class="span8 well offset2 text-center" >
					<div id="snowkick-img" class="span8">
						<img src="images/snowkick/001.jpg" style="visibility:hidden" id=dummy-img />
					</div>
				</div>
				<?require_once("include/pictures.php");?>
			</div>
		</div>
		<?require_once("include/footer.php");?>
	</body>
	<?require_once("include/pffooters.php");?>
</html>	
