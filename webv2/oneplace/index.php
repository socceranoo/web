<?PHP 
	system("lessc style/oneplace.less > style/oneplace.css");
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>TEMPLATE</title>
	<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/headers.php"); ?>
	<link rel="STYLESHEET" type="text/css" href="style/oneplace.css"/>
	<link rel="icon" type="image/ico" href="images/icon.png"/>
</head>
<body>
	<div class="container">
		<div class="row">
			<h2 class=text-center>oNE PLACe</h2>
			<div class="span3">
				<a class="btn btn-inverse" href="#wiki-modal" data-toggle=modal>View details</a>
				<a class="btn btn-custom1 " href="#image-options-modal" data-toggle=modal>options</a>
			</div>
			<div id=image-options-modal class="text-center modal hide fade out background-white well" style="display:none">
				<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/social/google/image_inputs.php");?>
			</div>
			<div class="offset3 span6">
				<form method='post' id=search-form>
					<input id="search-query" type="text" required placeholder="search" data-query='<?echo isset($_REQUEST['q'])?$_REQUEST['q']:"tony hawk video";?>'/>
					<input id=search-submit type=submit class="btn btn-custom5"  value="search"/>
				</form>
			</div>
			<div class="clearfix"></div>
			<div class="span4">
				<h3 class=text-center>Wikipedia</h3>
				<div class=text-right id="wiki-search-branding"><sup>powered by WikiMedia</sup></div>
				<div class="well background-greenSea feed rounded">
					<div id="wiki-search-content" class="content-holder"></div>
				</div>
			</div>
			<div class="span4">
				<h3 class=text-center>Twitter</h3>
				<div class=text-right id="twitter-search-branding"><sup>powered by Twitter</sup></div>
				<div class="well background-pumpkin feed">
					<div id="twitter-search-content" class="content-holder"></div>
				</div>
			</div>
			<div class="span4">
				<h3 class=text-center>Reddit</h3>
				<div class=text-right id="reddit-search-branding"><sup>powered by Reddit</sup></div>
				<div class="well feed">
					<div id="reddit-search-content" class="content-holder"></div>
				</div>
			</div>
			<div class="span4">
				<h3 class=text-center>Youtube</h3>
				<div class=text-right id="youtube-search-branding"><sup>powered by Youtube</sup></div>
				<div class="well feed">
					<div id="youtube-search-content" class="content-holder"></div>
				</div>
			</div>
			<div class="span4">
				<h3 class=text-center>Facebook</h3>
				<div class=text-right id="facebook-search-branding"><sup>powered by Facebook</sup></div>
				<div class="well background-wetAsphalt feed">
					<div id="facebook-search-content" class="content-holder"></div>
				</div>
			</div>
			<div class="span4">
				<h3 class=text-center>Google Images</h3>
				<div class=text-right id="image-search-branding2"><sup>powered by Google</sup></div>
				<!--<div id="image-search-branding"></div>-->
				<div class="well feed">
					<div id="image-search-content" class="content-holder"></div>
				</div>
			</div>
			<div class="span4">
				<h3 class=text-center>Flickr</h3>
				<div class=text-right id="flickr-search-branding"><sup>powered by Flickr</sup></div>
				<div class="well feed">
					<div id="flickr-search-content" class="content-holder"></div>
				</div>
			</div>
		</div>
		<div class=container>
			<iframe id=wiki-modal class="info-modal modal hide fade out background-white well" style="display:none"></iframe>
			<div id=wiki-modal1 class="info-modal text-center modal hide fade out background-white well" style="display:none"></div>
		</div>
	</div>
	<script src="scripts/oneplace.js" type="text/javascript"></script>
	<script src="http://gatoraze.com/social/youtube/lib.js" type="text/javascript"></script>
	<script src="http://gatoraze.com/social/reddit/lib.js" type="text/javascript"></script>
	<script src="http://gatoraze.com/social/flickr/lib.js" type="text/javascript"></script>
	<script src="http://gatoraze.com/social/facebook/lib.js" type="text/javascript"></script>
	<script src="http://gatoraze.com/social/twitter/lib.js" type="text/javascript"></script>
	<script src="http://gatoraze.com/social/google/lib.js" type="text/javascript"></script>
	<script src="http://gatoraze.com/social/wikipedia/lib.js" type="text/javascript"></script>
	<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/footers.php");?>
</body>
</html>
