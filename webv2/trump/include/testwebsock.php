#! /usr/local/bin/php
<?php

require_once('websockets.php');
require_once('card_class.php');

class echoServer extends WebSocketServer {
	//protected $maxBufferSize = 1048576; //1MB... overkill for an echo server, but potentially plausible for other applications.
	
	protected function process ($user, $message) {
		//$pattern='/^USER:(\S+)$/';
		//preg_match($pattern, $message, $matches);
		if (preg_match('/(?<USER>USER):(?<name>\w+)/', $message, $matches)) {
			$user->username = $matches['name'];	
			$message = $user->username.$user->id." joined the conference room";
			$player = $this->gameobj->addUser($user->username, array_search($user, $this->users), $user->id);
			$posmsg = "POS:".$player->position;
			$this->send($user, $posmsg);
			foreach ($this->gameobj->playerArr as $player) {
				if ($player->position !=100) {
					$result=$this->runquery("select fbusername from regusers where username='$player->player_name'");
					$row = mysql_fetch_array($result);
					$joinedmsg ="JOINED:".$player->position." ".$row['fbusername']." ".$player->player_name.$player->player_id;
					$this->send($user, $joinedmsg);
				}
			}
			/*
			if ($this->gameobj->getPlayerIndexById($user->username, $user->id)!= -1) {
				$position=$this->gameobj->isPlayerPositionSet($user->username, $user->id);
				if ($position !=100) {
					$dupmsg="DUPLICATE:DONE";
					$this->send($user, $dupmsg);
					$userCardStr = $this->gameobj->addUser($user->username, array_search($user, $this->users), $user->id);
					$this->send($user, $userCardStr);
					$posmsg="POS:".$position;
					$this->send($user, $posmsg);
				}
			}
			*/
		}
		else if(preg_match('/(?<CLICK>CLICK):(?<pos>\d+) (?<id>\d+) (?<index>\d+)/', $message, $matches)) {
			$this->broadcast_except_sender($user, $message);
			$this->send($user, $message);
			$this->gameobj->token++;
			$this->gameobj->round++;
			$this->gameobj->cur_player++;
			$this->gameobj->cur_player%=$this->gameobj->PLAYERS;
			$player_pos = $matches['pos'];	
			$id = $matches['id'];
			$index = $matches['index'];
			$this->gameobj->addCardToRound($player_pos, $id, $index);
			if ($this->gameobj->round == $this->gameobj->PLAYERS)
			{
				$this->gameobj->game++;
				$this->gameobj->round=0;	
				$this->gameobj->token=0;	
				$this->gameobj->setNextPlayer();	
				$roundmsg = "ROUND:".$this->gameobj->getScore();
				$this->broadcast_except_sender($user, $roundmsg);
				$this->send($user, $roundmsg);
				if ($this->gameobj->game == $this->gameobj->CARDPERUSER){
					$this->gameobj->game = 0;	
					$gamemsg ="GAME:".$this->gameobj->getScore();
					$this->broadcast_except_sender($user, $gamemsg);
					$this->send($user, $gamemsg);
					$this->gameobj->newgame();
					$this->gameobj->token=0;
					$this->gameobj->cur_player=$this->gameobj->prev_player;
					$this->gameobj->cur_player++;
					$this->gameobj->cur_player=$this->gameobj->cur_player % $this->gameobj->PLAYERS;
					$this->gameobj->prev_player=$this->gameobj->cur_player;
					$this->broadcast_card_str();
					$bidmsg="BIDSTART:DONE";
					$this->send($user, $bidmsg);
					$this->broadcast_except_sender($user, $bidmsg);
					$this->gameobj->setPlayerBid(240, 0);
					$bidmsg = "BID:240 ".$this->gameobj->cur_player;
					$this->broadcast_except_sender($user, $bidmsg);
					$this->send($user, $bidmsg);
					return;
				}
			}
			$tokenmsg="TOKEN:".$this->gameobj->cur_player;
			$this->broadcast_except_sender($user, $tokenmsg);
			$this->send($user, $tokenmsg);
			return;
		}
		else if(preg_match('/(?<pos>POS):(?<id>\d+)/', $message, $matches)) {
			if ($this->gameobj->playerCountReached()) {
				$this->broadcast_card_str();
				$this->gameobj->token=0;
				$this->gameobj->prev_player=0;
				$this->gameobj->cur_player=$this->gameobj->prev_player;
				$bidmsg="BIDSTART:DONE";
				$this->send($user, $bidmsg);
				$this->broadcast_except_sender($user, $bidmsg);
				$this->gameobj->setPlayerBid(240, 0);
				$bidmsg = "BID:240 ".$this->gameobj->cur_player;
				$this->broadcast_except_sender($user, $bidmsg);
				$this->send($user, $bidmsg);
			}
			return;
		}
		else if(preg_match('/(?<pos>BID):(?<id>\d+) (?<ppos>\d+) (?<bidpass>\w+)/', $message, $matches)) {
			$this->gameobj->token++;
			$this->gameobj->cur_player++;
			$this->gameobj->cur_player=$this->gameobj->cur_player % $this->gameobj->PLAYERS;
			if ($matches['bidpass']=="bid")
				$this->gameobj->setplayerBid(intval($matches['id']), $matches['ppos']);

			if ($this->gameobj->token == $this->gameobj->PLAYERS) {
				$pos=$this->gameobj->trump_holder->position;
				$bidmsg="SETTRUMP:$pos ".$this->gameobj->current_bid;
				$this->send($user, $bidmsg);
				$this->broadcast_except_sender($user, $bidmsg);
				print $bidmsg."\n";
				return;
			}
			else if ($this->gameobj->token == 2 * $this->gameobj->PLAYERS) {
				if ($this->gameobj->trump_holder->bid > $this->gameobj->round1bid){
					$pos=$this->gameobj->trump_holder1->position;
					$bidmsg="CANCELTRUMP:$pos";
					$this->send($user, $bidmsg);
					$this->broadcast_except_sender($user, $bidmsg);
					$pos=$this->gameobj->trump_holder->position;
					$bidmsg="SETTRUMP:$pos $this->gameobj->current_bid";
					$this->send($user, $bidmsg);
					$this->broadcast_except_sender($user, $bidmsg);
					print $bidmsg."\n";
				}else {
					$this->gameobj->token=0;
					$this->gameobj->cur_player=$this->gameobj->prev_player;
					$bidmsg="BIDOVER:SECOND";
					$this->send($user, $bidmsg);
					$this->broadcast_except_sender($user, $bidmsg);
					$tokenmsg="TOKEN:".$this->gameobj->cur_player;
					$this->broadcast_except_sender($user, $tokenmsg);
					$this->send($user, $tokenmsg);
				}
				return;
			}
			$bidmsg="BID:".$matches['id']." ".($this->gameobj->cur_player);
			//$bidmsg="BID:".$this->gameobj->current_bid." ".($this->gameobj->cur_player);
			$this->send($user, $bidmsg);
			$this->broadcast_except_sender($user, $bidmsg);
			//print $matches['id']."\n";
			return;
		}
		else if(preg_match('/(?<pos>TRUMPSET):(?<id>\d+) (?<ppos>\d+) (?<index>\d+)/', $message, $matches))
		{
			$card = $this->gameobj->trump_holder->getCardByIndex(intval($matches['index']));
			$this->gameobj->trump=$card;
			print "TRUMPINDEX:".$this->gameobj->trump->index."\n";
			print "TRUMP HOLDER".$this->gameobj->trump_holder->position."\n";
			$trumpset ="TRUMPSET:".$matches['id'];
			$this->send($user, $trumpset);
			$this->broadcast_except_sender($user, $trumpset);
			if ($this->gameobj->round1 == false) {
				$this->gameobj->round1bid = $this->gameobj->trump_holder->bid;
				$this->gameobj->trump_holder1 = $this->gameobj->trump_holder;
				$bidmsg="BIDOVER:FIRST";
				$this->send($user, $bidmsg);
				$this->broadcast_except_sender($user, $bidmsg);
				/*
				$tokenmsg="TOKEN:".$this->gameobj->cur_player;
				$this->broadcast_except_sender($user, $tokenmsg);
				$this->send($user, $tokenmsg);
				*/
				$bid=max(360, $this->gameobj->current_bid);
				$bidmsg = "BID:".$bid." ".($this->gameobj->cur_player);
				$this->broadcast_except_sender($user, $bidmsg);
				$this->send($user, $bidmsg);
				$this->gameobj->round1 = true;
				return;
			}else {
				$this->gameobj->token=0;
				$this->gameobj->cur_player=$this->gameobj->prev_player;
				$bidmsg="BIDOVER:SECOND";
				$this->send($user, $bidmsg);
				$this->broadcast_except_sender($user, $bidmsg);
				$tokenmsg="TOKEN:".$this->gameobj->cur_player;
				$this->broadcast_except_sender($user, $tokenmsg);
				$this->send($user, $tokenmsg);
				return;
			}
		}
		else if(preg_match('/(?<pos>REVEALTRUMP):(?<id>\w+)/', $message, $matches))
		{
			$trumpindex = $this->gameobj->trump->index;
			$revtrump ="REVEALTRUMP:".$trumpindex;
			$this->gameobj->trump_revealed=true;
			$this->send($user, $revtrump);
			$this->broadcast_except_sender($user, $revtrump);
			return;
		}
		else {
			$message = $user->username.":".$message;
		}
		$this->broadcast_except_sender($user, $message);
		//$this->send($user,$message);
	}
	
	protected function connected ($user) {
		//print $user;
		// Do nothing: This is just an echo server, there's no need to track the user.
		// However, if we did care about the users, we would probably have a cookie to
		// parse at this step, would be looking them up in permanent storage, etc.
	}
	
	protected function closed ($user) {
		//print $user;
		// Do nothing: This is where cleanup would go, in case the user had any sort of
		// open files or other objects associated with them.  This runs after the socket 
		// has been closed, so there is no need to clean up the socket itself here.
	}
}

$trump = new Trump();
$echo = new echoServer("0.0.0.0","9000", $trump);
//$echo = new echoServer("127.0.0.1","9000");
