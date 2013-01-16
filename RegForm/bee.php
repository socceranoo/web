<div id="bee"></div>
<span id="span1"></span>
<span id="span2"></span>
<script>
var beeid;
//$("#bee").mousemove(function(e){
$("#bee").click(function(e){
	var pageCoords = "( " + e.pageX + ", " + e.pageY + " )";
	var clientCoords = "( " + e.clientX + ", " + e.clientY + " )";
	//$("#span1").text(pageCoords);
	//$("#span2").text(clientCoords);
	random_move('bee', 0.9, 3, 800);
});

function random_move(div, opac, totalCount, delay)
{
	if (typeof random_move.count == 'undefined')
		random_move.count=0;
	var rleft=Math.floor(Math.random()*85);
	var rtop=Math.floor(Math.random()*80);
	random_move.count++;
	var lstr =""+rleft+"%";
	var tstr =""+rtop+"%";
	id="#"+div;
	$(id).animate({opacity:opac,left:lstr,top:tstr}, {duration:delay, queue:false}, {easing:"linear"});
	if(random_move.count == totalCount)
		clearInterval(beeid);
}

function initialize()
{
	beeid=window.setInterval("random_move('bee', 0.9, 10, 800)", 700);
}

initialize();
</script>
