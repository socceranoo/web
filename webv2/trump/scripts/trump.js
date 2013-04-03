var card_w = 111;
var card_h = 148;
var num_w = 85;
var num_h = 99;
var num_total_rows=10, num_total_columns=10;
var row=0, column=0;
var total_rows=6, total_columns=9;
var socket;
var host = "ws://gatoraze.tk:9000/webv2/trump/testwebsock.php"; // SET THIS TO YOUR SERVER
var cardArr = new Array();
var cardArr1 = new Array();
var cardimg = new Array(2, 3, 1, 0);
var imgcard = new Array(3, 2, 0, 1);
var player_pos;
var winning_bid;
var num_players = 6;
var num_rounds = 6;
var current_round = 0;
var current_hand = 0;
var roundArr = new Array(num_players);
var roundinprogress = false;
var lead_card;
var current_bid = 0;
var bidding_player;
var bidDone=false;
var trump_holder=false;
var trump_set=false;
var trump_id;
var trump_revealed=false;
var trump_reveal_round=false;
var trump_index;
var persuit = 13;

$(document).ready(function() {
	//socket_init();
	//$('.usercards').click(cardclick);
	//$('.player').click(posclick);
	//$('#li_bid').click(posclick);
	//$('#li_bid').fadeIn("slow");
	$('#li_bid').addClass("li_bid_pos0");
	$('#revealtrump').click(revealtrump);
	log('Welcome to the gameroom');
	init_roundArr();
	setscore(100,100);
});

function init_roundArr () {
	for (i = 0;i< num_players;i++) {
		roundArr[i] = new Array(num_rounds);
	}
}

var setscore = function (val1, val2) {
	$("#team1").html(val1);	
	$("#team2").html(val2);	
}
var socket_init = function (user) {
	try {
		socket = new WebSocket(host);
		socket.onopen    = function(msg) {
			$("#name").fadeOut();
			log("Connected"); 
			user_msg = "USER:"+user;
			socket.send(user_msg); 
		};
		socket.onmessage = function(msg) {
			process(msg.data)
		};
		socket.onclose   = function(msg) {
			log("Disconnected"); 
		};
	} catch(ex){ 
		log(ex); 
	}
}

var cardclick = function (event) {
	id = event.target.id;
	pos_str = $("#"+id).css("background-position");
	index = card_index_for_bg_position(pos_str);
	num = 100;
	if (trump_holder && !trump_set) {
		$('.usercards').unbind('click');
		msg = "TRUMPSET:"+num+" "+player_pos+" "+index;
		trump_id = id;
		$("#"+id).fadeOut();
		trump_index=index;
		trump_set = true;
		socket.send(msg);
		return;
	}
	if (is_valid_card(index)) {
		msg = "CLICK:"+player_pos+" "+num+" "+index;
		$('.usercards').unbind('click');
		socket.send(msg);	
		$("#"+id).fadeOut();
		for (i = 0; i< cardArr1.length; i++){
			if (cardArr1[i] == index){
				break;
			}
		}
		cardArr1.splice(i, 1);
		/*
		*/
	}
}
var posclick = function (event) {
	id = event.target.id;
	current_bid+=10;
	pos_str = get_bg_pos_str_for_bid(current_bid);
	$("#li_bid").css("background-position", pos_str);
}
var log = function (msg) {
	getid("chat").innerHTML += msg+"\n";
	getid("chat").scrollTop = getid("chat").scrollHeight;
}
function getid(id){
	return document.getElementById(id);
}
function onkey(event) {
	if(event.keyCode==13) { 
		var msg = getid("msg").value;
		if (msg == "")
			return;
		if (msg == "clear") {
			getid("chat").innerHTML = "";
			getid("msg").value="";
			return;
		}
		send(msg);
		getid("msg").value="";
	}
}

function joinserver(event) {
	if(event.keyCode==13) { 
		var msg = getid("name").value;
		if (msg == "")
			return;
		log('Connecting to the server ...');
		socket_init(msg);
		getid("name").value="";
	}
}
var send = function(msg){
	if(!msg) { 
		//alert("Message can not be empty"); 
		return; 
	}
	try { 
		socket.send(msg); 
		log('You : '+msg); 
	} catch(ex) { 
		log(ex); 
	}
}

var bg_position = function (id) {
	row++;
	row %=6;
	column++;
	column%=9;
	x_pos = row * card_w;
	y_pos = column * card_h;
	pos = " "+x_pos+"px "+y_pos+"px ";
	$("#"+id).css("background-position", pos);
}
var get_bg_pos_str_for_bid = function (bid){
	bid = parseInt(bid/10);
	bid--;
	rw = bid/num_total_columns;
	cl = bid%num_total_columns;	
	rw=parseInt(rw);
	x_pos = (cl) * num_w;
	y_pos = rw * num_h;	
	pos = "-"+x_pos+"px -"+y_pos+"px";
	return pos;
}
var bg_pos_for_card_index = function (index) {
	quo = index/13;
	rem = index%13;
	quo=parseInt(quo);
	suit = cardimg[quo];
	card = (suit * 13)+rem+2;
	rw = card/total_columns;
	cl = card%total_columns;	
	rw=parseInt(rw);
	cl++;
	x_pos = cl * card_w;
	y_pos = rw * card_h;	
	pos = x_pos+"px -"+y_pos+"px";
	return pos;
}
var card_index_for_bg_position = function (pos_str) {
	var match = /(\d+)px -?(\d+)px/i.exec(pos_str);
	if(match && match[1] && match[2]) {
		x_pos = parseInt(match[1]);
		y_pos = parseInt(match[2]);	
		cl = x_pos/card_w;
		rw = y_pos/card_h;	
		cl--;
		card = rw * total_columns + cl;
		card-=2;
		suit = parseInt(card/13);
		rem = card%13;
		suit = imgcard[suit];
		index = (suit*13) + rem;
	}
	return index;
}
function process(msg)
{
	log(msg);
	var match = /CARDS:(.*)/i.exec(msg);
	if(match && match[1]) {
		str = match[1].trim();
		var arr = str.split(" ");
		cardArr = arr;
		cardArr1 = arr;
		len = parseInt(arr.length/2);
		for (j=0;j<len;j++) {
			index=parseInt(arr[j]);
			pos_str = bg_pos_for_card_index(index);
			$("#li"+j).css("background-position", pos_str);
			$("#li"+j).fadeIn("1000");
		}

		$('#revealtrump').fadeIn("slow");
		return;
	}
	match = /DUPLICATE:(.*)/i.exec(msg);
	if(match && match[1]) {
		$(".player").hide();
		return;
	}
	match = /CLICK:(.*)/i.exec(msg);
	if (match && match[1])
	{
		var carddetail = match[1].split(" ");
		position=parseInt(carddetail[0]);
		id=parseInt(carddetail[1]);
		cardindex=parseInt(carddetail[2]);
		if (roundinprogress == false) {
			roundinprogress=true;
			lead_card=cardindex;
			$("#scorecard").fadeOut();
		}
		pos_str = bg_pos_for_card_index(cardindex);
		li_id = get_li_id_for_position(position);
		//alert("LIID"+li_id);
		$("#li_p"+li_id).css("background-position", pos_str);
		$("#li_p"+li_id).fadeIn("slow");
		roundArr[current_round][current_hand] = cardindex;
		current_hand++;
		return;
	}
	match = /POS:(.*)/i.exec(msg);
	if (match && match[1])
	{
		position=parseInt(match[1]);
		player_pos=position;
		for (i=0;i<num_players;i++){
			li_id = get_li_id_for_position(i);
			myclass="team2";
			if(i%2 == 0)
				myclass="team1";
			$("#li_p"+li_id).addClass(myclass);
			$("#li_pl"+li_id).addClass(myclass);
		}
		user_msg = "POS:1";
		socket.send(user_msg); 
		return;
	}
	match = /JOINED:(.*)/i.exec(msg);
	if (match && match[1])
	{
		var joinedArr = match[1].split(" ");
		userpos = joinedArr[0];
		fbusr = joinedArr[1];
		username = joinedArr[2];
		imgsrc="http://graph.facebook.com/"+fbusr+"/picture";
		imgid = "#li_pl"+userpos;
		//$(imgid).css("background-image","url(imgsrc)");
		return;
	}
	match = /TOKEN:(.*)/i.exec(msg);
	if(match && match[1]) {
		token = parseInt(match[1]);	
		if (token == player_pos) {
			if(roundinprogress == false)
				alert("PLAY"+player_pos);
			playsound("yourturn.oga");
			if (bidDone) {
				$('.usercards').click(cardclick);
			}
		}
		return;
	}
	match = /TRUMPSET:(.*)/i.exec(msg);
	if(match && match[1])
	{
		id = match[1];
		$("#li_trump").fadeIn();
		return;
	}
	match = /REVEALTRUMP:(.*)/i.exec(msg);
	if(match && match[1])
	{
		index = parseInt(match[1]);
		trump_index=index;
		pos_str = bg_pos_for_card_index(index);
		$("#li_trump").css("background-position", pos_str);
		$("#li_trump").fadeIn("slow");
		if (trump_holder) {
			$("#"+trump_id).fadeIn("slow");
		}
		trump_revealed = true;
		$("#revealtrump").fadeOut("slow");
		return;
		
	}
	match = /ROUND:(.*)/i.exec(msg);
	if(match && match[1])
	{
		var scoreArr = match[1].split(" ");
		roundinprogress = false;
		current_round++;
		team1=parseInt(scoreArr[0]);
		team2=parseInt(scoreArr[1]);
		setscore(team1, team2);
		$("#scorecard").fadeIn();
		current_hand = 0;
		if (trump_reveal_round)
			trump_reveal_round = false;
		$(".roundcard").hide();
		log("CARDLENGTH"+cardArr1.length);
		return;
	}
	match = /GAME:(.*)/i.exec(msg);
	if(match && match[1])
	{
		var scoreArr = match[1].split(" ");
		team1=parseInt(scoreArr[0]);
		team2=parseInt(scoreArr[1]);
		setscore(team1, team2);
		$("#scorecard").fadeIn();
		$("#revealtrump").fadeOut("slow");
		trump_holder=false;
		trump_set=false;
		current_round = 0;
		bidDone=false;
		trump_revealed=false;
		roundinprogress = false;
		pos_str = "113px 0px";
		$("#li_trump").css("background-position", pos_str);
		$("#li_trump").hide();
		return;
	}
	match = /BIDSTART:(.*)/i.exec(msg);
	if(match && match[1])
	{
		$('#li_bid').fadeIn("slow");
		$("#scorecard").fadeOut("slow");
		return;
	}
	match = /CANCELTRUMP:(.*)/i.exec(msg);
	if(match && match[1]) {
		if (trump_holder && player_pos == match[1]) {
			trump_holder=false;
			$("#"+trump_id).fadeIn("slow");
		}
		return;
	}
	match = /SETTRUMP:(.*)/i.exec(msg);
	if(match && match[1]) {
		var arr = match[1].split(" ");
		bidding_player=parseInt(arr[0]);
		winning_bid=parseInt(parseInt(arr[1])/10);
		$("#li_bid").fadeOut("slow");
		if (player_pos == bidding_player) {
			trump_holder=true;
			trump_set=false;
			$('.usercards').click(cardclick);
		}
		return;
	}
	match = /BIDOVER:(.*)/i.exec(msg);
	if(match && match[1]) {
		if (match[1] == "FIRST") {
			for (j=parseInt(cardArr1.length/2);j<cardArr1.length;j++) {
				index=parseInt(cardArr1[j]);
				pos_str = bg_pos_for_card_index(index);
				$("#li"+j).css("background-position", pos_str);
				$("#li"+j).fadeIn("1000");
			}
			$("#li_bid").fadeIn("slow");
		}
		if (match[1] == "SECOND") {
			bidDone=true;
			$("#li_bid").fadeOut("slow");
		}
		return;
	}
	match = /BID:(.*)/i.exec(msg);
	if(match && match[1]) {
		var arr = match[1].split(" ");
		current_bid = parseInt(arr[0]);
		current_bid = parseInt(current_bid/10) * 10;
		position = arr[1];
		pos_str = get_bg_pos_str_for_bid(current_bid);
		$("#li_bid").css("background-position", pos_str);
		li_id = get_li_id_for_position(position);
		log("LI_ID:"+li_id)
		var myclass = $("#li_bid").attr("class");
		var match = /(li_bid_pos(\d+))/i.exec(myclass);
		if(match && match[1] && match[2]) {
			newclass = "li_bid_pos"+li_id;
			$('#li_bid').removeClass(match[1]).addClass(newclass);
		}
		if (position == player_pos) {
			$('#li_bid').click(posclick);
			$('#bid').click(bidclick);
			$('#pass').click(bidclick);
			//alert("BID"+player_pos);
		}
		return;
	}
	log(msg);
}

var bidclick = function (event) {
	id=event.target.id;
	if (id == "bid") {
		msg="BID:"+current_bid+" "+player_pos+" bid";
	}else if (id == "pass"){
		msg="BID:"+current_bid+" "+player_pos+" pass";
	}
	li_id = get_li_id_for_position(position);
	var myclass = $("#li_bid").attr("class");
	var match = /(li_bid_pos(\d+))/i.exec(myclass);
	if(match && match[1] && match[2]) {
		newclass = "li_bid_pos"+li_id;
		$('#li_bid').removeClass(match[1]).addClass(newclass);
	}
	$("#li_bid").unbind('click');
	$("#bid").unbind('click');
	$("#pass").unbind('click');
	socket.send(msg);
}
function is_valid_card(index) {
	cur_suit = parseInt(index/persuit);
	if (roundinprogress) {
		lead_suit_found=false;
		trump_suit_found=false;
		lead_suit = parseInt(lead_card/persuit);
		if (trump_reveal_round)
			trump_suit = parseInt(trump_index/persuit);
		log("INDEX:"+index+"LEAD_CARD:"+lead_card+"Lead Suit"+lead_suit+"CUR SUIT:"+cur_suit+"CARD ARRAY LENGTH:"+cardArr1.length);
		for(i=0; i<cardArr1.length; i++) {
			if (lead_suit == parseInt(cardArr1[i]/persuit))
				lead_suit_found=true;
			if (trump_reveal_round){
				if (trump_suit == parseInt(cardArr1[i]/persuit))
					trump_suit_found = true;
			}
		}
		if (trump_reveal_round && trump_suit_found && cur_suit != trump_suit) {
			return false;
		}
		if (!lead_suit_found)
			return true;
		if (lead_suit_found && cur_suit==lead_suit)
			return true;
	}
	else {
		if (trump_holder && !trump_revealed) {
			trump_suit = parseInt(trump_index/persuit)
			if (cur_suit != trump_suit) {
				return true;
			}
			other_suit_found = false;
			for(i=0; i<cardArr1.length; i++) {
				if (trump_suit != parseInt(cardArr1[i]/persuit)) {
					other_suit_found=true;
					break;
				}
			}
			if (other_suit_found) {
				return false;
			}else {
				return true;
			}
		}
		return true;
	}

	return false;
}
var revealtrump = function () {
	if (roundinprogress == false)
		return;
	lead_suit_found=false;
	lead_suit = parseInt(lead_card/persuit);
	for(i=0; i<cardArr1.length; i++) {
		if (lead_suit == parseInt(cardArr1[i]/persuit))
			lead_suit_found=true;
	}
	if (lead_suit_found)
		return;	
	
	r=confirm("Are you sure you want to reveal the trump?");
	if(r)
	{
		msg="REVEALTRUMP:DONE";
		socket.send(msg);
	}
	trump_reveal_round = true;

}

function get_li_id_for_position(position) {
	if (player_pos == position) {
		li_id = 0;
	} else if (player_pos > position){
		diff = player_pos - position;
		li_id = num_players - diff;
	} else if (player_pos < position){
		diff = position - player_pos;
		li_id = diff;
	}
	return li_id;
}
function playsound(song) {
	alert("asad");
	src="sounds/"+song;
	$("#aud-token").attr("src", src);
	getid("aud-token").play();
}
