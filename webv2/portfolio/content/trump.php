<div class=fullcontent>
	<p>This is an online multiplayer site for playing indian trick-taking card game. The game is a variant of spades where the order of the ranks are changed significantly (J, 9, A, 10, K, Q, 8, 7). Jack ranks the highest with 3 points and nine comes second with 2 and so on. The total points in the game is 28 and hence the name.</p>

	<p>There are other variants to the game with addition of 3 (5 points) or sometimes also with 2 (10 points ) making it a total of 48 or 88 points. Sometimes the game is also called as 304 which a revised point allocation.</p>
	<div class="circleholder fivecircles">
		<div class="circle"><div class="innercircle green"><span>php</span></div></div>
		<div class="circle"><div class="innercircle orange"><span>HTML</span></div></div>
		<div class="circle"><div class="innercircle blue"><span class=twolines>Web sockets</span></div></div>
		<div class="circle"><div class="innercircle green"><span>javascript</span></div></div>
		<div class="circle"><div class="innercircle red"><span>CSS</span></div></div>
	</div>
	<div class="halfcontent left">
	<h4>Motivation:</h4>
	<p>This card game is really uncommon and it was very difficult to find a portal to play with friends. 
	So decided to write one myself using websockets (server Php and client javascript) interaction model.</p>
		<h4>Server details:</h4>
		<p>The Server opens a php web sock on a specific port and waits for incoming connections. The server was written in object oriented Php to create objects like</p>
		<ul class="proj-ul">
			<li><p><b>Rank </b>: Ace, King, Queen . so on and their value</p></li>
			<li><p><b>Suit </b>: Spades, Clubs, .. so on.</p></li>
			<li><p><b>Card </b>: Ace of spades, …so on and their indexes.</p></li>
			<li><p><b>Hand </b>: Set of Cards in an array .</p></li>
			<li><p><b>Player </b>: Player name, player’s hand, Id, position, team id</p></li>
			<li><p><b>Round </b>: Cards of the current round.</p></li>
			<li><p><b>Game </b>: Players, Rounds, Function to implement Rules.</p></li>
			<li><p>The first 6 objects was written so that it could be extended to any game in future.</p></li>
		</ul>
	<a class="big-button left" href="http://gatoraze.info/webv2/trump" target=_blank >Visit site</a>
	<a class="big-button right" href="https://github.com/socceranoo/web/tree/master/webv2/trump" target=_blank>View source</a>
	</div>

	<div class="halfcontent right">
		<h4>The Client details :</h4>
		<p>The client connects to the server on the opened websocket using JavaScript websockets. Once the connection is established , data can be transferred and the client operations are based on the data that is received from the server. Some game functionality is implemented on the Client side so that simple card validations can be done in the client itself need not go all the way to the server. The client also has a in-game chat which allows players to send messages to each other.</p>

		<h4>Nice to haves (working on it ) :</h4>
		<ul class=proj-ul>
			<li><p><b>Game AI </b>:Creating a AI engine for the game which can think on its own and can replace the human player which can remove the dependency of all the players being present at the same time.</p></li>
			<li><p><b>Store state information on the server </b>: If the client refreshes the page or closes the page doesn’t get reconnected to the previous state.</p></li>
			<li><p><b>Integration with node.js</b>: to eliminate the use of Php and moving towards the standard.</p></li>
			<li><p><b>More standard communication</b> :Exchange information between Server and Client using a more standardized model, currently using string and string parsing.</p></li>
			<li><p><b>One connection per user</b> :Detect duplicate connections from the same user and reject.</p></li>
			<li><p><b>Game statistics</b> : maintain statistics and history of games in the database like user’s winning percentage so on.</p></li>
			<li><p><b>Improve client code quality</b>: Modularize the client side code (which is currently very cluttered ) using OO concepts of JavaScript</p></li> 
			<li><p><b>Better UI</b>: Develop the client side UI and styling it for better playing experience.</p></li>
		</ul>
	</div>

	<div class="pagediv"><p></p></div>
	<!--
	-->
</div>
