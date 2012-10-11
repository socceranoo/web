<?PHP
	$cardback="b2fv.gif";
	//$cardback="cardback.gif";
	function generatecards($position)
	{
		$persuit=13;
		global $cardback;
		$pos =-200;
		$card_spacing=20;
		if ($position%2==0)
			$axis="left:";
		else	
			$axis="top:";
		$j=10;
		for($k=0; $k<13;$k++)
		{
			$j++;
			$pos = $pos+$card_spacing;
			$pos_str= $axis.$pos."px";
			$img_id= $position*$persuit + $k;
			//print "<img id='$img_id' alt='$img_id' src='images/$cardback' style='z-index:$j;position:absolute;$pos_str;' onclick=\"cardclick('$img_id')\">\n";
			print "<img id='$img_id' alt='$img_id' src='images/$cardback' style='z-index:$j;position:absolute;$pos_str;'>\n";
		}
	}
	function initcentercards()
	{
		$spacing ="60px";
		//print "<img id='rcenter' alt='rcenter' src='images/2c.gif' style='z-index:15;position:absolute;top:0px;left:$spacing;'>\n";
		print "<img id='0center' alt='bcenter' src='images/abottom.png' style='z-index:16;position:absolute;top:$spacing;left:0px'>";
		print "<img id='1center' alt='rcenter' src='images/aright.png' style='z-index:15;position:absolute;top:0px;left:$spacing;'>";
		print "<img id='2center' alt='tcenter' src='images/atop.png' style='z-index:14;position:absolute;top:-$spacing;left:0px'>";
		print "<img id='3center' alt='lcenter' src='images/aleft.png' style='z-index:13;position:absolute;top:0px;left:-$spacing;'>";
	}
	function setbidimages($pos)
	{
		for($k=14; $k<=28;$k++)
		{
			$img_id= $k*10 + $pos;
			$src = $k.".jpg";
			print "<img id='$img_id' class='bidimg' src='images/$src' style='position:absolute;top:0px;left:0px;' onclick=\"bidonclick(event)\" onDoubleClick=\"bidondblclick(event)\">\n";
		}
	}
?>
