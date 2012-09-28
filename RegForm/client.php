<?PHP
	require_once("access.php");
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<?require_once("gameincludes.php");?>
		<title>Gameroom</title>
		<?require_once("card.php");?>
	</head>
	<body class='gameroom' onload="init()">
		<h3>Gameroom v2.00</h3>
		<form name="refreshForm">
		<input type="hidden" name="visited" value="" />
		<input type="hidden" id='uname' name="uname" value=<?echo $uname;?>>
		</form>
		<div class="chatroom">
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
				<div id="botpos" class="bottomnum">
					<img id="0num" class="pos" alt="NUMBER 1" src="images/number-1.jpg" onclick="selectposition(0);">
				</div>
				<div class="bottomref">
					<?generatecards(0);?>
				</div>
				<div id="rightpos" class="rightnum">
					<img id="1num" class="pos" alt="NUMBER 2" src="images/number-2.jpg" onclick="selectposition(1);">
				</div>
				<div class="rightref">
					<?generatecards(1);?>
				</div>
				<div id="toppos" class="topnum">
					<img id="2num" class="pos" alt="NUMBER 3" src="images/number-3.jpg" onclick="selectposition(2);">
				</div>
				<div class="topref">
					<?generatecards(2);?>
				</div>
				<div id="leftpos" class="leftnum">
					<img id="3num" class="pos" alt="NUMBER 4" src="images/number-4.jpg" onclick="selectposition(3);">
				</div>
				<div class="leftref">
					<?generatecards(3);?>
				</div>
				<div class="centerref">
					<?initcentercards();?>
				</div>
			</div>
	</body>
</html>
