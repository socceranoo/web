<!DOCTYPE HTML>
<html>
<head>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script type="text/javascript">
   $(function() {
     $(".playback").click(function(e) {
       e.preventDefault();

       // This next line will get the audio element
       // that is adjacent to the link that was clicked.
       var song = $(this).next('audio').get(0);
//var song = $(#paparazzi).get(0);
       if (song.paused)
         song.play();
       else
         song.pause();
     });
   });
</script>
</head>
<body>
<div class="thumbnail" id="xx">
<a class="playback" href="#">
<img id="play" src="../images/number-1.jpg">
</a>
<audio id="paparazzi">
<source src="test.mp3" type="audio/ogg" />
Your browser does not support HTML5 audio.
</audio>
</div>

</body>
</html>
