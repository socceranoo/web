var socket, socket2, txtareaelem, teamchat;
var totalcards, totalplayers, curopencount;
var deck=52;
var rankArr = new Array("a1", "2", "3", "4", "5", "6", "7", "8", "9", "t", "j", "q", "k");
var suitArr = new Array("c", "d", "h", "s");
var myArray = new Array("bottom", "right", "top", "left");
var player_pos=100;
var user;
var cardArr = new Array();
var cardArr1;

function checkRefresh()
{
	if( document.refreshForm.visited.value == "" )
	{
		// This is a fresh page load
		document.refreshForm.visited.value = "1";
		alert("yes");
		// You may want to add code here special for
		// fresh page loads
	}
	else
	{
		// This is a page refresh
		confirm("Are you sure you want to refresh?");
		// Insert code here representing what to do on
		// a refresh
	}
}
function init() {
	//checkRefresh();
	//var host = "ws://10.180.157.222:9000/GIT/PHP-Websockets/testwebsock.php"; // SET THIS TO YOUR SERVER
	//var host = "ws://98.234.216.9:9000/github/PHP-Websockets/testwebsock.php"; // SET THIS TO YOUR SERVER
	var host = "ws://98.234.216.9:9000/Gameroom/testwebsock.php"; // SET THIS TO YOUR SERVER
	//alert("INIT");
	try {
		deck = 52;
		socket = new WebSocket(host);
		txtareaelem = getid("chat");
		//log('WebSocket - status '+socket.readyState);

		teamchat = getid("tchat");
		user=document.refreshForm.uname.value;

		log('Welcome to the gameroom');
		log('Connecting to the server ...');

		//log2('Welcome to the gameroom');
		//log2('Connecting to the server ...');

		socket.onopen    = function(msg) { 
								//log("Welcome - status "+this.readyState); 
								log("Connected"); 
								log('You joined the conference room'); 
								//log2("Connected"); 
								//log2('You joined the conference room'); 
								totalcards=deck;	
								totalplayers=4;	
								cardperplayer=(totalcards/totalplayers);
								curopencount = totalcards;
								showpositions();
								var user_msg = "USER:"+user;
								socket.send(user_msg); 
						   };
		socket.onmessage = function(msg) { 
							   process(msg.data)
							   //log(msg.data); 
							   //log2(msg.data); 
						   };
		socket.onclose   = function(msg) { 
							   log("Disconnected"); 
							   //log2("Disconnected"); 
							   //log("Disconnected - status "+this.readyState); 
						   };

	}
	catch(ex){ 
		log(ex); 
	}
	getid("msg").focus();
}

function process(msg)
{
	log(msg);
	var match = /CARDS:(.*)/i.exec(msg);
	if(match && match[1])
	{
		str = match[1].trim();
		var arr = str.split(" ");
		cardArr = arr;
		cardArr1 = arr;
		//return;
	}
	match = /CLICK:(.*)/i.exec(msg);
	if (match && match[1])
	{
		hideimage((player_pos*rankArr.length)+parseInt(match[1]));
	}
	match = /POS:(.*)/i.exec(msg);
	if (match && match[1])
	{
		position=parseInt(match[1]);
		initcards(position);
	}
}

function showpositions()
{
	for(i=0; i<myArray.length; i++) {
		showimage(i+"num");
	}

}
function selectposition(pos)
{
	msg = "POS:"+pos;
	socket.send(msg);
}

function initcards(pos)
{
	player_pos = pos;
	setusercardrow(player_pos, cardArr);
	showimages();
	for (i=0; i<myArray.length; i++) 
	{
		if (i != player_pos) 
		{
			disableonclickrow(i);
		}
	}
}
function send(){
	var txt,msg;
	txt = getid("msg");
	msg = txt.value;
	if(!msg) { 
		//alert("Message can not be empty"); 
		return; 
	}
	txt.value="";
	txt.focus();
	try { 
		socket.send(msg); 
		log('You : '+msg); 
	} catch(ex) { 
		log(ex); 
	}
}

function send2(){
	var txt,msg;
	txt = getid("tmsg");
	msg = txt.value;
	if(!msg) { 
		//alert("Message can not be empty"); 
		return; 
	}
	txt.value="";
	txt.focus();
	try { 
		//socket.send(msg); 
		//log2('You : '+msg); 
	} catch(ex) { 
		//log2(ex); 
	}
}

function quit(){
	if (socket != null) {
		log("Goodbye!");
		socket.close();
		//socket.disconnect();
		socket=null;
	}
}

function reconnect() {
	quit();
	init('Anoop');
}

/*
function log2(msg)
{
	teamchat.value += msg;
	teamchat.value += "\n";
	teamchat.scrollTop = teamchat.scrollHeight;
}
*/
// Utilities
function getid(id){ return document.getElementById(id); }
function log(msg)
{
	txtareaelem.value += msg;
	txtareaelem.value += "\n";
	txtareaelem.scrollTop = txtareaelem.scrollHeight;
// JQUERY EQUIVALENT FOR Text area append;
// getid("log").innerHTML+="<br>"+msg; 
}
function onkey(event)
{
	if(event.keyCode==13)
	{ 
		send(); 
	}
}
function onkey2(event)
{
	if(event.keyCode==13)
	{ 
		send2(); 
	}
}

function cardclick(event)
{
	id = event.target.id;
	//msg = "clicked "+id;
	msg = "CLICK:"+indexforid(id);
	socket.send(msg);	
	hideimage(id);
}

function showimages()
{
	for(i=0; i<myArray.length; i++) 
	{
		showrow(i);
	}
	showimage("lcenter");
	showimage("bcenter");
	showimage("tcenter");
	showimage("rcenter");
}

function disableonclickrow(row)
{
	for(j=0;j<rankArr.length; j++)
	{
		id = (row*(rankArr.length)) +j;
		disableonclick(id);
	}

}

function enableonclickrow(row)
{
	for(j=0;j<rankArr.length; j++)
	{
		id = row*rankArr.length +j;
		enableonclick(id);
	}

}

function setusercardrow(pos, index)
{
	for(j=0;j<index.length; j++)
	{
		id = pos*rankArr.length +j;
		src=imagenameforindex(index[j]);
		//showimage(id);
		setimgsrc(id, src);
	}
}

function showrow(pos)
{
	for(j=0;j<rankArr.length; j++)
	{
		id = pos*rankArr.length +j;
		showimage(id);
	}
	numid = pos+"num";
	hideimage(numid);
}

function imagenameforindex(index)
{
	var suit=parseInt(index/rankArr.length);
	var rank=index%rankArr.length;
	return "images/"+rankArr[rank]+suitArr[suit]+".gif";
}

function indexforid(id)
{
	return cardArr[id%13];
}

function hideimage(id)
{
	getid(id).style.visibility='hidden';
	getid(id).style.opacity=0;
}

function showimage(id)
{
	getid(id).style.visibility='visible';
	getid(id).style.opacity=1;
}

function disableonclick(id)
{
	getid(id).onclick="";
}

function enableonclick(id)
{
	getid(id).onclick=function(){cardclick(event);};
}

function setimgsrc(id, src)
{
	getid(id).src=src;	
}
