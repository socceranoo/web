<!DOCTYPE html>
<html>
<head>
<title>Bootstrap 101 Template</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<!-- Optionally enable responsive features in IE8 -->
<link href="http://getbootstrap.com/assets/css/docs.css" rel="stylesheet" media="screen">
<link href="http://getbootstrap.com/dist/css/bootstrap.css" rel="stylesheet" media="screen">

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script src="jquery-ui-1.10.3.mouse_core.js"></script>
<script src="jquery.ui.touch-punch.js"></script>

<!-- Optionally enable responsive features in IE8 -->
<link href="http://getbootstrap.com/assets/css/docs.css" rel="stylesheet" media="screen">
<link href="http://getbootstrap.com/dist/css/bootstrap.css" rel="stylesheet" media="screen">
<script src="http://getbootstrap.com/dist/js/bootstrap.js"></script>
<script src="bootstrapslider.js"></script>
<style>
.slider-bar{
display:block; width:80px; background-color:darkred; position:relative;
}

.slider, .slider-bar{
height:30px;
}
</style>
<script>
$(function(){

var $alert = $($(".alert")[0]);
var $p = $($(".progress")[0]);
var $b = $($("[type='submit']")[0]);
var $d = $("#btn_enabled");
var $t = $("#progress-value");

$p.on( "sliderchange", function(e,result){
$alert.html( "action: " + result.action + ", value: " + result.value );
});

$p.on( "slidercomplete", function(e,result){
console.log( 'slider completed!' );
});

$b.on( 'click', function(e){

var value =  parseFloat( $t.val() );
$p.slider( "option", "now", value );

return false;
});

$d.on('click', function ()
{
if (!$d.hasClass('active'))
		{
							$d.text('Disabled ');
												$p.slider( "option", "disabled", true );
																}
																				else
																								{
																													$d.text('Enabled');
																																		$p.slider( "option", "disabled", false );
																																						}
																																									});


																																											});
																																												</script>
																																												</head>
																																												<body>

																																												<div class="bs-example">
																																													<div class="progress slider">
																																															<div aria-valuemax="100" aria-valuemin="0" aria-valuenow="30" role="progressbar" class="progress-bar progress-bar-warning">
																																																		<span class="sr-only">60%</span>
																																																				</div>
																																																					</div>
																																																						<div class="alert alert-success">hello world</div>

																																																							<div class="form-inline">
																																																								<div class="form-group">
																																																											<label class="sr-only" for="progress-value">Email Value</label>
																																																														<input type="number" id="progress-value" min="0" max="100" class="form-control" placeholder="enter value">
																																																																</div>
																																																																		<div class="btn-group">
																																																																					<button type="submit" class="btn btn-default">Update</button>
																																																																								<button class="btn btn-default" data-toggle="button" id="btn_enabled">Enabled</button>
																																																																										</div>
																																																																											</div>
																																																																											</div>
																																																																											</body>
																																																																											</html>

