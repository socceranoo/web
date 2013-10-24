<style>
	.img-thumbnail {
		width:60px;
		height:45px;
		cursor:pointer;
	}
</style>
<div class="span8 offset2 wellq text-center">
<ul class=inline>
<?PHP 
	$end = 21;
	for ($i = 1; $i<=$end ; $i++){
		$j = $i - 1;
		$str = "0".$i;
		if ($i < 10) {
			$str = "0".$str;
		}
		echo "<li><img id=img-tn$j class='img-thumbnail img-polaroid' src='images/snowkick/$str.jpg' /></li>";
	}
?>
</ul>
</div>
