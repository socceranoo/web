<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<title>Gameroom</title>
		<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/headers.php");?>
		<?require_once("./include/gameheaders.php");?>
		<?require_once("./include/card.php");?>
	</head>
	<body class='gameroom' id='gameroombody'>
	<h2>Welcome to the Gameroom</h2>
	<div class="chatbox">
		<textarea class="chat" id="chat" disabled></textarea>
		<input type="input" class="msg" id="msg" onkeypress="onkey(event)" disabled/>
	</div>
	<div id=cardholder class=carddiv>
		<ul id=mycards>
			<!--
			<li class=card id=li1></li>
			<li class=card id=li2></li>
			<li class=card id=li3></li>
			-->
			<?usercards();?>
		</ul>
	</div>
	<div id=cardtable class=carddiv>
		<audio class="audiotemp" id="aud-token">
		Your browser does not support HTML5 audio.
		</audio>
		<div id=scorecard class=team1>
		<table id='gradient-style' align='center'>
			<tr><th>Team #</th><th>Points</th></tr>
			<tr><td>Team 1</td><td id="team1"></td></tr>
			<tr><td>Team 2</td><td id="team2"></td></tr>
		</table>
		</div>
		<input type="input" class="msg" id="name" onkeypress="joinserver(event)"required placeholder="<Enter name and press ENTER>"/>
		<ul id=round>
			<?centercards();?>
			<div id=revealtrump><br/>&nbsp REVEAL<br/>&nbsp&nbsp TRUMP</div>
		</ul>
		<ul id=playerlist>
			<?playericons();?>
		</ul>
	</body>
</html>	
