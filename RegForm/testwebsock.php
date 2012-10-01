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
		else if(preg_match('/(?<CLICK>CLICK):(?<id>\d+)/', $message, $matches))
		{
			$this->broadcast_except_sender($user, $message);
			$this->send($user, $message);
			$this->gameobj->token++;
			$this->gameobj->token%=$this->gameobj->PLAYERS;
			
			$this->gameobj->round++;
			if ($this->gameobj->round == $this->gameobj->PLAYERS)
			{
				$this->gameobj->round=0;	
				$roundmsg ="ROUND:OVER";
				$this->broadcast_except_sender($user, $roundmsg);
				$this->send($user, $roundmsg);
			}
			$tokenmsg="TOKEN:".$this->gameobj->token;
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
			
			if ($this->gameobj->playerCountReached())
			{
				$tokenmsg="TOKEN:".$this->gameobj->token;
				$this->broadcast_except_sender($user, $tokenmsg);
				$this->send($user, $tokenmsg);
				$bidmsg = "BID:140 ".$this->gameobj->token;;
				$this->broadcast_except_sender($user, $bidmsg);
				$this->send($user, $bidmsg);
			}
			return;
		}
		else if(preg_match('/(?<pos>BID):(?<id>\d+) (?<ppos>\d+)/', $message, $matches))
		{
			$this->gameobj->token++;
			if ($this->gameobj->token == $this->gameobj->PLAYERS)
			{
				$bidmsg="BIDOVER:FIRST";
				$this->send($user, $bidmsg);
				$this->broadcast_except_sender($user, $bidmsg);
				$tokenmsg="TOKEN:".$this->gameobj->token;
				$this->broadcast_except_sender($user, $tokenmsg);
				$this->send($user, $tokenmsg);
			}
			else if ($this->gameobj->token == 2 * $this->gameobj->PLAYERS)
			{
				$this->gameobj->token=0;
				$bidmsg="BIDOVER:SECOND";
				$this->send($user, $bidmsg);
				$this->broadcast_except_sender($user, $bidmsg);
				$tokenmsg="TOKEN:".$this->gameobj->token;
				$this->broadcast_except_sender($user, $tokenmsg);
				$this->send($user, $tokenmsg);
				return;
			}	
			$bidmsg="BID:".$matches['id']." ".($this->gameobj->token%$this->gameobj->PLAYERS);
			$this->send($user, $bidmsg);
			$this->broadcast_except_sender($user, $bidmsg);
			print $matches['id']."\n";
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
