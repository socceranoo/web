<html>
	<head>
	<link href="style.css" rel="stylesheet" type="text/css" />
	 <script src="../scripts/jquery.js"></script>
	<script type="text/javascript">
	$(document).ready(function()
	{
		$("img").load(function() 
		{
			$(this).wrap(function(){
			return '<span class="image-wrap ' + $(this).attr('class') + '" style="position:relative; display:inline-block; background:url(' + $(this).attr('src') + ') no-repeat center center; width: ' + $(this).width() + 'px; height: ' + $(this).height() + 'px;" />';
			});
			$(this).css("opacity","0");
		});

	});
</script>
	</head>
<body>
<body>

<h1>Demo</h1>
<h2>CSS3 Image Styles</h2>
<p class="credits">Tutorial by </p>

<div class="box normal">
	<h3>Normal Image (without jQuery background image wrap)</h3>
	<img src="images/img.png">
	<img src="images/image-2.jpg">
	<img src="images/image-3.jpg">
	<img src="images/image-4.jpg">
</div>

<div id="demo">
	<div class="box circle">
		<h3>Basic Circle</h3>
		<img src="images/img.png">
		<img src="images/image-2.jpg">
		<img src="images/image-3.jpg">
		<img src="images/image-4.jpg">
	</div>
	
	<div class="box card">
		<h3>Card Style</h3>
		<img src="images/img.png">
		<img src="images/image-2.jpg">
		<img src="images/image-3.jpg">
		<img src="images/image-4.jpg">
	</div>
	
	<div class="box embossed">
		<h3>Embossed Style</h3>
		<img src="images/img.png">
		<img src="images/image-2.jpg">
		<img src="images/image-3.jpg">
		<img src="images/image-4.jpg">
	</div>
	
	<div class="box soft-embossed">
		<h3>Soft Embossed Style</h3>
		<img src="images/img.png">
		<img src="images/image-2.jpg">
		<img src="images/image-3.jpg">
		<img src="images/image-4.jpg">
	</div>
	
	<div class="box cutout">
		<h3>Cutout Style</h3>
		<img src="images/img.png">
		<img src="images/image-2.jpg">
		<img src="images/image-3.jpg">
		<img src="images/image-4.jpg">
	</div>
	
	<div class="box morphing-glowing">
		<h3>Morphing + Glowing (mouse over images here)</h3>
		<img src="images/img.png">
		<img src="images/image-2.jpg">
		<img src="images/image-3.jpg">
		<img src="images/image-4.jpg">
	</div>
	
	<div class="box glossy"> 
		<h3>Glossy Overlay</h3>
		<img src="images/img.png">
		<img src="images/image-2.jpg">
		<img src="images/image-3.jpg">
		<img src="images/image-4.jpg">
	</div>
	
	<div class="box reflection">
		<h3>Reflection (mouse over images here)</h3>
		<img src="images/img.png">
		<img src="images/image-2.jpg">
		<img src="images/image-3.jpg">
		<img src="images/image-4.jpg">
	</div>
	
	<div class="box tape">
		<h3>Tape Style</h3>
		<img src="images/img.png">
		<img src="images/image-2.jpg">
		<img src="images/image-3.jpg">
		<img src="images/image-4.jpg">
	</div>

	<div class="box glossy-reflection">
		<h3>Glossy + Reflection</h3>
		<img src="images/img.png">
		<img src="images/image-2.jpg">
		<img src="images/image-3.jpg">
		<img src="images/image-4.jpg">
	</div>
	
	<div class="box morphing-tinting">
		<h3>Morphing + Tinting (mouse over images here)</h3>
		<img src="images/img.png">
		<img src="images/image-2.jpg">
		<img src="images/image-3.jpg">
		<img src="images/image-4.jpg">
	</div>
	
	<div class="box feather">
		<h3>Feather Circle</h3>
		<img src="images/img.png">
		<img src="images/image-2.jpg">
		<img src="images/image-3.jpg">
		<img src="images/image-4.jpg">
	</div>

</div>
<!-- /demo -->

</body>
</html>
