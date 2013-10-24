<?PHP
	ini_set('error_reporting', E_ALL);
	$image = "images/depp.jpg";
	$ref_image = "temp/ref_image.jpg";
	$image_dir = "temp/";
	$image_prefix = "img";
	$class_name = "small-box";
	$count = 4;
	$rows = 4;
	$columns = 4;
	$height = 400;
	$width = 400;
	$searchstr = "";
	$searchsize = "";
	$searchcolor = "";
	require_once("include/process.php");
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/membersite_config.php");
	if(isset($_POST['submitted'])) {
		if ($_POST['link']) {
			$error_msg= process_link();	
		} else if ($_POST['upload'] && $_FILES['image']) {
			$error_msg= process_image();
		} else {
			$error_msg = "Please upload or provide URL";
		}
		$searchstr = $_POST['searchstr'];
		$searchcolor = $_POST['searchcolor'];
		$searchsize = $_POST['searchsize'];
	}

	system("lessc style/slider.less > style/slider.css");
	convert_image($image, $image_dir, $image_prefix, $rows, $columns, $width, $height);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title></title>
	<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/headers.php"); ?>
	<link rel="STYLESHEET" type="text/css" href="style/slider.css"/>
	<link rel="icon" type="image/ico" href="images/icon.png"/>
</head>
<body>
	<div class="container">
		<h2 class=text-center>SLIDER</h2>
		<div class="row">
			<div class="span3">
				<div class="main-box2 text-center"><img class=img-polaroid src=<?echo $ref_image?> /></div>
			</div>
			<div class="span6" style="display:none" id="slider">
				<div class='main-box' data-rows=<? echo $rows?> data-columns=<? echo $columns?>>
					<?add_grids($image_dir, $image_prefix, $rows, $columns, $class_name);?>
				</div>
				<div class="main-box3">
					<a class="shuffle btn btn-custom2 btn-block" href="javascript:void(0);">Shuffle</a>
				</div>
			</div>
			<div class="span2 well right-border" style="margin:10px auto;">
				<h4 class=text-center><span class="" id=status>PLAYING</span></h4>
				<h4 class=text-center><span class="" id=moves>0</span></h4>
				<h4 class=text-center id="clock">0:00</h4>
				<a id="pause-button" class="btn btn-custom1 btn-block" href="javascript:pausePlay();" data-play=true>Pause</a>
			</div>
			<div class="clearfix"></div>
			<div class="span11 well background-concrete">
				<div class="span6">
					<form action='slider.php' id='input-form' method='post' enctype="multipart/form-data" accept-charset='UTF-8'>
						<input type='hidden' name='submitted' id='submitted' value='1'/>
						<input type='hidden' name='searchstr' id='searchstr' value='<?echo $searchstr;?>'/>
						<input type='hidden' name='searchcolor' id='searchcolor' value='<?echo $searchcolor;?>'/>
						<input type='hidden' name='searchsize' id='searchsize' value='<?echo $searchsize;?>'/>
						<input class="btn" type="file" name="image" id="image" accept="image/jpeg"/>
						<span class=text-center>OR</span>
						<input type="url" class="" name="link" id="link" placeholder="Enter Image URL here"/>
						<input type='submit' class='btn btn-custom5' name='upload' value='create'/>
						<br/><h5 class="text-center" id="error"><?echo $error_msg;?></h5>
					</form>
				</div>
				<div class="span4">
					<form method='post' id=search-form>
						<span class=text-center>OR</span>
						<input id="search-query" type="text" required placeholder="search google images"/>
						<input type=submit class="btn btn-custom5"  value="search"/>
						<br/>
						<input type="radio" class=size-radio id=small-radio name="group1" value="small">Small
						<input type="radio" class=size-radio id=medium-radio name="group1" value="medium" checked>Medium
						<input type="radio" class=size-radio id=large-radio name="group1" value="large">Large
						<input type="radio" class=size-radio id=xlarge-radio name="group1" value="xlarge">XLarge
						<input type="radio" class=size-radio id=any-radio name="group1" value="">Any
						<br/>
						<input type="radio" class=color-radio  name=group2 value="black">black
						<input type="radio" class=color-radio  name=group2 value="white">white
						<input type="radio" class=color-radio  name=group2 value="red">red
						<input type="radio" class=color-radio  name=group2 value="blue">blue
						<input type="radio" class=color-radio  name=group2 value="green">green
						<input type="radio" class=color-radio  name=group2 value="yellow">yellow
						<input type="radio" class=color-radio  name=group2 value="brown">brown
						<input type="radio" class=color-radio  name=group2 value="teal">teal
						<input type="radio" class=color-radio  name=group2 value="purple">purple
						<input type="radio" class=color-radio  name=group2 value="gray">gray
						<input type="radio" class=color-radio  name=group2 value="pink">pink
						<input type="radio" class=color-radio  name=group2 value="orange">orange
						<input type="radio" class=color-radio  name=group2 value="any" checked>any
					</form>
				</div>
				<div class="clearfix"></div>
				<ul id="content" class="clearfix unstyled inline text-center"></ul>
				<div id="page-content" class="clearfix unstyled inline text-center"></div>
				<a id="next-page" class="btn btn-inverse pull-right">Next Page</a>
				<a id="prev-page" class="btn btn-inverse pull-left">Previous Page</a>
				<h4 id="page-info" class="text-center"></h4>

			</div>
		</div>
	</div>
	<script src="scripts/slider.js"></script>
	<script src="scripts/imagesearch.js" type="text/javascript"></script>
	<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/footers.php");?>
</body>
</html>
