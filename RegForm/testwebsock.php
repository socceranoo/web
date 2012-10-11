#! /usr/local/bin/php
<?php

require_once('./include/websockets.php');
require_once('./include/card_class.php');

class echoServer extends WebSocketServer {
	//protected $maxBufferSize = 1048576; //1MB... overkill for an echo server, but potentially plausible for other applications.
	
	protected function process ($user, $message) {
		//$pattern='/^USER:(\S+)$/';
		//preg_match($pattern, $message, $matches);
		if (preg_match('/(?<USER>USER):(?<name>\w+)/', $message, $matches))
		{
			$user->username = $matches['name'];	
			$message = $user->username." joined the conference room";
			$takenPosStr = $this->gameobj->getTakenPositions();			
			$this->send($user, $takenPosStr);
			foreach ($this->gameobj->playerArr as $player) {
				if ($player->position !=100) {
					
					$result=$this->runquery("select fbusername from regusers where username='$player->player_name'");
					$row = mysql_fetch_array($result);
					$joinedmsg ="JOINED:".$player->position." ".$row['fbusername']." ".$player->player_name;
					$this->send($user, $joinedmsg);
				}
			}
			if ($this->gameobj->getPlayerIndexById($user->username, $user->id)!= -1)
			{
				$position=$this->gameobj->isPlayerPositionSet($user->username, $user->id);
				if ($position !=100) {
					$dupmsg="DUPLICATE:DONE";
					$this->send($user, $dupmsg);
					/*	
					$userCardStr = $this->gameobj->addUser($user->username, array_search($user, $this->users), $user->id);
					$this->send($user, $userCardStr);
					$posmsg="POS:".$position;
					$this->send($user, $posmsg);
					*/
				}
			}
			
		}
		else if(preg_match('/(?<CLICK>CLICK):(?<pos>\d+) (?<id>\d+) (?<index>\d+)/', $message, $matches))
		{
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
				$this->gameobj->round=0;	
				$this->gameobj->token=0;	
				$this->gameobj->setNextPlayer();	
				$roundmsg = $this->gameobj->getScore();
				$this->broadcast_except_sender($user, $roundmsg);
				$this->send($user, $roundmsg);
			}
			$tokenmsg="TOKEN:".$this->gameobj->cur_player;
			$this->broadcast_except_sender($user, $tokenmsg);
			$this->send($user, $tokenmsg);
			return;
		}
		else if(preg_match('/(?<pos>POS):(?<id>\d+)/', $message, $matches))
		{
			$userCardStr = $this->gameobj->addUser($user->username, array_search($user, $this->users), $user->id);
			$this->send($user, $userCardStr);
			$id=$matches['id'];
			$this->gameobj->setUserPosition($user->username, $id);
			$posmsg = "POS:".$id;
			$this->send($user, $posmsg);
			$dupmsg="DUPLICATE:DONE";
			$this->broadcast_to_multiple_signins($user, $dupmsg);
			//$this->broadcast_to_multiple_signins($user, $posmsg);
			$takenPosStr = $this->gameobj->getTakenPositions();			
			$this->broadcast_except_sender($user, $takenPosStr);
			$result=$this->runquery("select fbusername from regusers where username='$user->username'");
			$row = mysql_fetch_array($result);
			$joinedmsg ="JOINED:".$id." ".$row['fbusername']." ".$user->username;
			//print $joinedmsg."\n";
			$this->broadcast_except_sender($user, $joinedmsg);
			$this->send($user, $joinedmsg);
			if ($this->gameobj->playerCountReached())
			{
				$this->gameobj->token=0;
				$this->gameobj->cur_player=0;
				$bidmsg="BIDSTART:DONE";
				$this->send($user, $bidmsg);
				$this->broadcast_except_sender($user, $bidmsg);
				/*
				$tokenmsg="TOKEN:".$this->gameobj->cur_player;
				$this->broadcast_except_sender($user, $tokenmsg);
				$this->send($user, $tokenmsg);
				$this->gameobj->setPlayerBid(140, 0);
				$bidmsg = "BID:140 ".$this->gameobj->cur_player;
				$this->broadcast_except_sender($user, $bidmsg);
				$this->send($user, $bidmsg);
				*/
				$bidmsg="BIDOVER:FIRST";
				$this->send($user, $bidmsg);
				$this->broadcast_except_sender($user, $bidmsg);
				$bidmsg="BIDOVER:SECOND";
				$this->send($user, $bidmsg);
				$this->broadcast_except_sender($user, $bidmsg);
				$trumpset ="TRUMPSET:51";	
				$this->send($user, $trumpset);
				$this->broadcast_except_sender($user, $trumpset);
				$tokenmsg="TOKEN:".$this->gameobj->cur_player;
				$this->broadcast_except_sender($user, $tokenmsg);
				$this->send($user, $tokenmsg);
				$this->gameobj->token=0;
			}
			return;
		}
		else if(preg_match('/(?<pos>BID):(?<id>\d+) (?<ppos>\d+) (?<bidpass>\w+)/', $message, $matches))
		{
			$this->gameobj->token++;
			$this->gameobj->cur_player++;
			$this->gameobj->cur_player=$this->gameobj->cur_player % $this->gameobj->PLAYERS;
			if ($this->gameobj->token == $this->gameobj->PLAYERS)
			{
				$pos=$this->gameobj->trump_holder->position;
				$bidmsg="SETTRUMP:$pos";
				$this->send($user, $bidmsg);
				$this->broadcast_except_sender($user, $bidmsg);
				print $bidmsg."\n";
				return;
			}
			else if ($this->gameobj->token == 2 * $this->gameobj->PLAYERS)
			{
				$this->gameobj->token=0;
				$this->gameobj->cur_player=0;
				$bidmsg="BIDOVER:SECOND";
				$this->send($user, $bidmsg);
				$this->broadcast_except_sender($user, $bidmsg);
				$tokenmsg="TOKEN:".$this->gameobj->cur_player;
				$this->broadcast_except_sender($user, $tokenmsg);
				$this->send($user, $tokenmsg);
				return;
			}	
			if ($matches['bidpass']=="bid")
				$this->gameobj->setplayerBid($matches['id'], $matches['ppos']);
			$bidmsg="BID:".$matches['id']." ".($this->gameobj->cur_player);
			$this->send($user, $bidmsg);
			$this->broadcast_except_sender($user, $bidmsg);
			//print $matches['id']."\n";
			return;
		}
		else if(preg_match('/(?<pos>TRUMPSET):(?<id>\d+) (?<ppos>\d+) (?<index>\d+)/', $message, $matches))
		{
			$this->gameobj->trump=$matches['index'];
			print "TRUMPINDEX:".$this->gameobj->trump."\n";
			print "TRUMP HOLDER".$this->gameobj->trump_holder->player_name."\n";
			$trumpset ="TRUMPSET:".$matches['id'];	
			$this->send($user, $trumpset);
			$this->broadcast_except_sender($user, $trumpset);

			$bidmsg="BIDOVER:FIRST";
			$this->send($user, $bidmsg);
			$this->broadcast_except_sender($user, $bidmsg);
			$tokenmsg="TOKEN:".$this->gameobj->cur_player;
			$this->broadcast_except_sender($user, $tokenmsg);
			$this->send($user, $tokenmsg);
			$bid=max(200, $this->gameobj->current_bid);
			$bidmsg = "BID:".$bid." ".($this->gameobj->cur_player);
			$this->broadcast_except_sender($user, $bidmsg);
			$this->send($user, $bidmsg);
			return;
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
		else
		{
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
