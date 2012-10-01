<!DOCTYPE HTML>
<html>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js">
$(document).ready(function(){
var audio = $('mySoundClip')[0];
  $("p").click(function(){
  audio.play();
  alert("hello");
  });
});
</script>
</head>
<body>
<button id ="p">Para</div>
<audio id= "mySoundClip">
<source src="test.mp3" type="audio/mp3">
</audio>

</body>
</html>
