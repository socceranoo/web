<?PHP
	require_once("access.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<?require_once("gameincludes.php");?>
		<title>Gameroom</title>
		<?require_once("card.php");?>
	</head>
	<body id='roomid' class='gameroom' onload="init()">
		<h3>Gameroom v2.00</h3>
		<h3 id='noserver' style='visibility:hidden;'>SERVER NOT FOUND</h3>
		<h3 id='dup' style='visibility:hidden;'>DUPLICATE LOGIN FOUND YOU WILL BE REDIRECTED IN 5 Seconds...</h3>
		<form name="refreshForm">
		<input type="hidden" name="visited" value="" />
		<input type="hidden" id='uname' name="uname" value=<?echo $uname;?>>
		</form>
		
		<div class="token"></div>
		<audio class="audiotemp" id="aud-token">
		<source src="sounds/yourturn.oga" type="audio/ogg" />
		Your browser does not support HTML5 audio.
		</audio>
		<div id="chatboxtest" class="chatroom">
			<div class="chatbox">
				<textarea class="chat" id="chat" disabled="disabled"></textarea>
				<input class="msg" id="msg" onkeypress="onkey(event)"/>
				<!--
				<button class="b1" onclick="send()">Send</button>
				<button class="b1" onclick="quit()">Quit</button>
				<button class="b1" onclick="reconnect()">Reconnect</button>
				-->
			</div>
		</div>
		<!--
		<div class="teamchat">
			<div class="chatbox">
			<textarea class="chat" id="tchat" disabled="disabled"></textarea>
			<input class="msg" id="tmsg" onkeypress="onkey2(event)"/>
			</div>
		</div>
		-->
			<div class="card">
					
				<div id="bbid" class="bbid">
					<?setbidimages(0)?>
					<button id="0bid" class="bidbutton" onclick="bid_pass('bidb')">BID</button><button id="0pass" class="bidbutton" onclick="bid_pass('passb')">PASS</button>
				</div>
				<div id="botpos" class="bottomnum">
					<img id="0num" class="pos" alt="NUMBER 1" src="images/number-1.jpg" onclick="selectposition(0);">
				</div>
				<div id="botprof" class="bottomprof">
					<img id="0profile" class="profile" alt="USER 1">
					<span id="0span" class="profilespan" ></span>
				</div>
				<div class="bottomref">
					<?generatecards(0);?>
				</div>
				<div id="rbid" class="rbid">
					<?setbidimages(1)?>
					<button id="1bid" class="bidbutton" onclick="bid_pass()">BID</button><button id="1pass" class="bidbutton" onclick="bid_pass()">PASS</button>
				</div>
				<div id="rightpos" class="rightnum">
					<img id="1num" class="pos" alt="NUMBER 2" src="images/number-2.jpg" onclick="selectposition(1);">
				</div>
				<div id="rightprof" class="rightprof">
					<img id="1profile" class="profile" alt="USER 2">
					<span id="1span" class="profilespan" ></span>
				</div>
				<div class="rightref">
					<?generatecards(1);?>
				</div>
				<div id="tbid" class="tbid">
					<?setbidimages(2)?>
					<button id="2bid" class="bidbutton" onclick="bid_pass()">BID</button><button id="2pass" class="bidbutton" onclick="bid_pass()">PASS</button>
				</div>
				<div id="toppos" class="topnum">
					<img id="2num" class="pos" alt="NUMBER 3" src="images/number-3.jpg" onclick="selectposition(2);">
				</div>
				<div id="topprof" class="topprof">
					<img id="2profile" class="profile" alt="USER 3">
					<span id="2span" class="profilespan" ></span>
				</div>
				<div class="topref">
					<?generatecards(2);?>
				</div>
				<div id="lbid" class="lbid">
					<?setbidimages(3)?>
					<button id="3bid" class="bidbutton" onclick="bid_pass()">BID</button><button id="3pass" class="bidbutton" onclick="bid_pass()">PASS</button>
				</div>
				<div id="leftpos" class="leftnum">
					<img id="3num" class="pos" alt="NUMBER 4" src="images/number-4.jpg" onclick="selectposition(3);">
				</div>
				<div id="leftprof" class="leftprof">
					<img id="3profile" class="profile" alt="USER 4">
					<span id="3span" class="profilespan" ></span>
				</div>
				<div class="leftref">
					<?generatecards(3);?>
				</div>
				<div class="centerref">
					<?initcentercards();?>
				</div>
				
				<div id="reveal">	
				<img id="trump" class="trump" src="images/b2fv.gif">
				<button id="revealtrump" class="revealtrump" onclick="revealtrump()">REVEAL TRUMP</button>
				</div>
				
				<table id='gradient-style' align='center'>
				<tr><th>Team #</th><th>Points</th></tr>
				<tr><td>Team 1</td><td id="team1"></td></tr>
				<tr><td>Team 2</td><td id="team2"></td></tr>
				</table>
			</div>
	</body>
</html>
