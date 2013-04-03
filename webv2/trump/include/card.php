<?PHP
	$deck = 52;
	$number = 6;
	$card_w = 111;
	$card_h = 148;
	function usercards() {
		global $deck, $number;
		$persuit=13;
		$j=100;
		for($k=0; $k<$persuit;$k++) {
			$j++;
			$li_id= "li".$k;
			print "<li class='card usercards' id=$li_id></li>\n";
			#print "<li class=card id=$li_id style='z-index:$j;'></li>\n";
			#print "<li class=card id=$li_id><img id='$img_id' alt='$img_id' src='images/cards/$cardback' style='z-index:$j;position:relative;$pos_str;'/></li>\n";
		}
	}

	function centercards() {
		global $deck, $number;
		for($k=0; $k<$number;$k++) {
			/*
			$class="team2";
			if ($k%2 == 0){
				$class="team1";
			}
			*/
			$j= $k+1;
			$z= $number-$k;
			$li_id= "li_p".$k;
			print "<li class='card roundcard $class' id=$li_id style='z-index:$z;'></li>";
		}
		print "<li class='card' id=li_trump style='z-index:$z;'></li>";
	}

	function playericons() {
		global $deck, $number;
		for($k=0; $k<$number;$k++) {
			/*
			$class="team2";
			if ($k%2 == 0){
				$class="team1";
			}
			*/
			$j= $k+1;
			$li_id= "li_pl".$k;
			print "<li class='player $class playername' id=$li_id></li>";
		}
		print "<li class='player' id=li_bid><button id=bid>BID</button><button id=pass>PASS</button></li>";
	}
?>
