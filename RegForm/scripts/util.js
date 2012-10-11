var socket, socket2, txtareaelem, teamchat;
var totalcards, totalplayers, curopencount;
var deck=52;
var rankArr = new Array("a1", "2", "3", "4", "5", "6", "7", "8", "9", "t", "j", "q", "k");
var suitArr = new Array("c", "d", "h", "s");
var myArray = new Array("bottom", "right", "top", "left");
var arrowimages = new Array("abottom.png", "aright.png", "atop.png", "aleft.png");
var player_pos=100;
var user;
var cardArr = new Array();
var cardArr1 = new Array();
var current_bid;
var bidDone=false;
var trump_holder=false;
var trump_revealed=false;
var roundinprogress=false;
var lead_card;
var trump_index;
var trump_id;

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
	hideElem("noserver");
	hideElem("gradient-style");
	//checkRefresh();
	//var host = "ws://10.180.157.222:9000/GIT/PHP-Websockets/testwebsock.php"; // SET THIS TO YOUR SERVER
	//var host = "ws://98.234.216.9:9000/github/PHP-Websockets/testwebsock.php"; // SET THIS TO YOUR SERVER
	var host = "ws://98.234.216.9:9000/RegForm/testwebsock.php"; // SET THIS TO YOUR SERVER
	//alert("INIT");
	getid('team2').value="60"
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
								//showcentercards();
								var user_msg = "USER:"+user;
								socket.send(user_msg); 
						   };
		socket.onmessage = function(msg) { 
							   process(msg.data)
							   //log(msg.data); 
							   //log2(msg.data); 
						   };
		socket.onclose   = function(msg) { 
							   showElem("noserver");
							   hidecardimages();
							   hidecentercards();
							   hidepositions();
							   hideprofiles();
							   hideElem("gradient-style");
							   hideElem("trump");
							   hideElem("revealtrump");
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

function playsound()
{
	// play test sound here 
	var song = $(".token").next('audio').get(0);
	song.play();

}
function process(msg)
{
	var match = /CARDS:(.*)/i.exec(msg);
	if(match && match[1])
	{
		str = match[1].trim();
		var arr = str.split(" ");
		cardArr = arr;
		cardArr1 = cardArr.slice();
		return;
	}
	match = /DUPLICATE:(.*)/i.exec(msg);
	if(match && match[1])
	{
		hidepositions();
		showElem('dup');	
		setTimeout("top.location.href = 'login-home.php'",3000);
	//	setTimeout("window.location='login-home.php'",5000);
		return;
	}
	match = /CLICK:(.*)/i.exec(msg);
	if (match && match[1])
	{
		var carddetail = match[1].split(" ");
		position=carddetail[0];
		id=parseInt(carddetail[1]);
		cardindex=parseInt(carddetail[2]);
		if (roundinprogress == false)
		{
			hideElem('gradient-style');
			roundinprogress=true;
			lead_card=cardindex;	
		}
		hideElem(id);
		centerid=position+"center";
		setimgsrc(centerid, imagesrcforindex(cardindex));
		showElem(centerid);
		//hideElem((player_pos*rankArr.length)+idforindex(parseInt(match[1])));
		return;
	}
	match = /POS:(.*)/i.exec(msg);
	if (match && match[1])
	{
		position=parseInt(match[1]);
		player_pos=position;
		hideElem(position+"num");
		disablepositionclick();
		return;
	}
	match = /JOINED:(.*)/i.exec(msg);
	if (match && match[1])
	{
		var joinedArr = match[1].split(" ");
		userpos = joinedArr[0];
		fbusr = joinedArr[1];
		username = joinedArr[2];
		span="#"+userpos+"span";
		imgsrc="http://graph.facebook.com/"+fbusr+"/picture";
		imgid = userpos+"profile";
		setimgsrc(imgid, imgsrc);
		$(span).text(username);
		showElem(imgid);
		return;
	}
	match = /TAKEN:(.*)/i.exec(msg);
	if(match && match[1])
	{
		str = match[1].trim();
		var takenArr = str.split(" ");
		for (j=0;j<takenArr.length;j++)
		{
			pos=parseInt(takenArr[j]);
			if (pos != 100)
				hideElem(takenArr[j]+"num");
		}
		return;
	}
	match = /TOKEN:(.*)/i.exec(msg);
	if(match && match[1])
	{
		token = parseInt(match[1]);	
		if (token == player_pos)
		{
			playsound();	
			if (bidDone)
				enableonclickrow(player_pos);
			if (bidDone && roundinprogress && !trump_revealed)	
				showElem("revealtrump");
		}
		id = token+"center";
		src="images/"+arrowimages[token];
		setimgsrc(id, src);
		showElem(id);
		return;
	}
	match = /TRUMPSET:(.*)/i.exec(msg);
	if(match && match[1])
	{
		id = match[1];
		hideElem(id);
		trump_id=id;
		showElem("trump");
		return;
	}
	match = /REVEALTRUMP:(.*)/i.exec(msg);
	if(match && match[1])
	{
		index = match[1];
		showElem(trump_id);
		trump_revealed = true;
		src = imagesrcforindex(index);
		setimgsrc("trump", src);
		hideElem("revealtrump");
		return;
		
	}
	match = /ROUND:(.*)/i.exec(msg);
	if(match && match[1])
	{
		var scoreArr = match[1].split(" ");
		team1=scoreArr[0];
		team2=scoreArr[1];
		setvaluejq("#team1", team1);
		setvaluejq("#team2", team2);
		roundinprogress = false;
		hidecentercards();
		showElem('gradient-style');
		return;
	}
	match = /BIDSTART:(.*)/i.exec(msg);
	if(match && match[1])
	{
		setusercardrow(1);
		showcardimages(1);
		return;
	}
	match = /SETTRUMP:(.*)/i.exec(msg);
	if(match && match[1])
	{
		if (player_pos == match[1])
		{
			trump_holder=true;
			enableonclickrow(player_pos);	
		}
		return;
	}
	match = /BIDOVER:(.*)/i.exec(msg);
	if(match && match[1])
	{
		if (match[1] == "FIRST")
		{
			setusercardrow(2);
			showcardimages(2);
		}
		if (match[1] == "SECOND")
		{
			bidDone=true;
		}
		return;
	}
	match = /BID:(.*)/i.exec(msg);
	if(match && match[1])
	{
		var arr = match[1].split(" ");
		current_bid = parseInt(arr[0]);
		current_bid = parseInt(current_bid/10) * 10;
		pos = arr[1];
		if (pos == player_pos)
		{
			//alert(pos+" "+current_bid);
			showElem(current_bid+parseInt(pos));	
			showElem(pos+"bid");	
			showElem(pos+"pass");	
		}
		return;
	}
	log(msg);
}

function showpositions()
{
	for(i=0; i<myArray.length; i++) {
		showElem(i+"num");
	}

}
function selectposition(pos)
{
	msg = "POS:"+pos;
	socket.send(msg);
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
	if (bidDone) {
		if(isvalidcard(id) == false)
		{
			alert("NOT a valid card");
			return;
		}	
		msg = "CLICK:"+player_pos+" "+id+" "+indexforid(id);
		var index = cardArr1.indexOf(indexforid(id));
		cardArr1.splice(index, 1);
	}
	else {
		msg = "TRUMPSET:"+id+" "+player_pos+" "+indexforid(id);
		trump_index = indexforid(id);
	}
	socket.send(msg);	
	disableonclickrow(player_pos);
}

function bidonclick(event)
{
	id = event.target.id;
	newid = parseInt(id)+10;		
	pos = newid%10;
	if (newid >= 290)
	{
		newid=140+pos;
	}
	current_bid = parseInt(newid) - pos;
	hideElem(id);
	showElem(newid);

}
function bidondblclick(event)
{
	id = event.target.id;
	newid = parseInt(id)-10;		
	if (newid == 130)
		newid=140;
	hideElem(id);
	showElem(newid);
}
function showcardimages(bidnum)
{
	for(i=0; i<myArray.length; i++) 
	{
		showcardrow(i, bidnum);
	}
}

function showcentercards()
{
	showElem("0center");
	showElem("1center");
	showElem("2center");
	showElem("3center");
}

function hidecentercards()
{
	hideElem("0center");
	hideElem("1center");
	hideElem("2center");
	hideElem("3center");
}

function hidecardimages()
{
	for(i=0; i<myArray.length; i++) 
	{
		hidecardrow(i);
	}
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

function setusercardrow(bidnum)
{
	pos = player_pos;
	if (bidnum == 1) {
		start = 0;	
		end = parseInt(cardArr.length/2);
	}
	else {
		start = parseInt(cardArr.length/2);
		end = cardArr.length;
	}
	for(j=start;j<end; j++)
	{
		id = pos*cardArr.length +j;
		src=imagesrcforindex(cardArr[j]);
		setimgsrc(id, src);
	}
}

function showcardrow(pos, bidnum)
{
	if (bidnum == 1) {
		start = 0;	
		end = parseInt(cardArr.length/2);
	}
	else {
		start = parseInt(cardArr.length/2);
		end = cardArr.length;
	}
	for(j=start;j<end; j++)
	{
		id = pos*cardArr.length +j;
		showElem(id);
	}
}

function hidecardrow(pos)
{
	for(j=0;j<rankArr.length; j++)
	{
		id = pos*rankArr.length +j;
		hideElem(id);
	}
}

function hidepositions()
{
	for(i=0; i<myArray.length; i++) {
		hideElem(i+"num");
	}
}

function hideprofiles()
{
	for(i=0; i<myArray.length; i++) {
		hideElem(i+"profile");
		hideElem(i+"span");
	}
}
function imagesrcforindex(index)
{
	var suit=parseInt(index/rankArr.length);
	var rank=index%rankArr.length;
	return "images/"+rankArr[rank]+suitArr[suit]+".gif";
}

function indexforid(id)
{
	return cardArr[id%13];
}

function idforindex(index)
{
	for(j=0;j<cardArr.length; j++)
	{
		if (cardArr[j]==index)
			return j;
	}
}

function hideElem(id)
{
	getid(id).style.visibility='hidden';
	getid(id).style.opacity=0;
}

function showElem(id)
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

function bid_pass(choice)
{
	id = event.target.id;
	pos = parseInt(id)%10;
	var match = /\d(.*)/i.exec(id);
	if (match[1]=="pass")
		msg="BID:"+current_bid+" "+pos+" pass";
	else
		msg="BID:"+current_bid+" "+pos+" bid";
	hideElem(id);
	previd=current_bid + parseInt(pos);
	hideElem(previd);
	hideElem(pos+"bid");	
	hideElem(pos+"pass");	
	socket.send(msg);
}

function disablepositionclick()
{
	for(i=0; i<myArray.length; i++) {
		disableonclick(i+"num");
	}
}

function isvalidcard(id)
{
	index = indexforid(id);
	persuit = rankArr.length;
	if (roundinprogress) {
		cur_suit = parseInt(index/persuit);
		lead_suit_found=false;
		lead_suit = parseInt(lead_card/persuit);
		//alert("INDEX:"+index+"LEAD_CARD:"+lead_card+"Lead Suit"+lead_suit+"CUR SUIT:"+cur_suit+"CARD ARRAY LENGTH:"+cardArr1.length);
		for(i=0; i<cardArr1.length; i++) {
			if (lead_suit == parseInt(cardArr1[i]/persuit))
				lead_suit_found=true;
		}
		if (!lead_suit_found)
			return true;
		if (lead_suit_found && cur_suit==lead_suit)
			return true;
	}
	else
		return true;

	return false;
}
function setvaluejq(id, val)
{
	$(id).html(val);
}


function revealtrump()
{
	lead_suit_found=false;
	lead_suit = parseInt(lead_card/persuit);
	for(i=0; i<cardArr1.length; i++) {
		if (lead_suit == parseInt(cardArr1[i]/persuit))
			lead_suit_found=true;
	}
	
	if (lead_suit_found)
		return;	
	
	r=confirm("Are you sure you want to reveal the trump?");
	if (r)
	{
		msg="REVEALTRUMP:DONE";
		socket.send(msg);
	}

}

function sleep(milliseconds) 
{
	var start = new Date().getTime();
	for (var i = 0; i < 1e7; i++) 
	{
		if ((new Date().getTime() - start) > milliseconds)
		{
			break;
		}
	}
}
/*
function bidding(pos)
{
	current_bid = parseInt(current_bid)+10;
	if (pos == 0)
		bidanimatebottom();
	else if (pos ==1)
		bidanimateright();
	else if (pos ==2)
		bidanimatetop();
	else if (pos ==3)
		bidanimateleft();
}

function bidanimateleft()
{
	$(current_bid).animate({
	top:'37%',
	left:'20%',	
	opacity:'0.5',
	height:'150px',
	width:'150px'
	});
}

function bidanimatebottom()
{
	$("bidb").animate({
	bottom:'40%',
	left:'45%',
	opacity:'0.5',
	height:'150px',
	width:'150px'
	});
}

function bidanimateright()
{
	$("bidb").animate({
	top:'37%',
	left:'65%',
	opacity:'0.5',
	height:'150px',
	width:'150px'
	});
}
function bidanimatetop()
{
	getid(current_bid).animate({
	top:'10%',
	left:'45%',
	opacity:'0.5',
	height:'150px',
	width:'150px'
	});
}

function animatetest()
{
	$("bid").animate({
      left:'250px',
      opacity:'0.5',
      height:'150px',
      width:'150px'
    });
}
*/	
