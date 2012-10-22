#! /usr/local/bin/php
<?php

require_once('include/websockets.php');

class echoServer extends WebSocketServer {
	protected $videoArr = array();	
	protected $state ="INVALID";
	protected $currentVideoIndex = -1;
	protected function process ($user, $message) {
		if (preg_match('/(?<USER>USER):(?<name>\w+)/', $message, $matches))
		{
			$name = $matches['name'];
			$message = $name." joined the conference room";
			$this->send($user,$message);
			if ($this->isUniqueUser($name)) {
				$this->uniqueUserCount++;
			}
			$user->username = $name;
			$videolistmsg ="LIST:".$this->arrayToStr($this->videoArr);
			//print $videolistmsg;
			$this->send($user,$videolistmsg);
			
			if (count($this->users) > 0 && $user != $this->users[0])
			{
				if ($this->currentVideoIndex != -1 && $this->state != "INVALID")
				{
					$indexmsg ="VIDEOAT:".$this->currentVideoIndex;
					$this->send($user,$indexmsg);
					sleep(1);
					$statemsg = $this->state.":DONE";
					$this->send($user,$statemsg);
					sleep(1);
					$syncmsg = "SYNC:PLEASE";
					$this->send($this->users[0], $syncmsg);
				}
			}
			/*
			if ($this->uniqueUserCount == 100) {
				//sleep(1);
				$msg ="VIDEO:START";
				$this->send($user,$msg);
				$this->broadcast_except_sender($user, $msg);
			}
			*/
		}
		else if (preg_match('/(?<VIDEO>VIDEO):(?<src>\w+)/', $message, $matches))
		{
			if ($matches['src'] == "NEXT")
				$this->currentVideoIndex = min((count($this->videoArr)-1), ($this->currentVideoIndex +1));
			
			if ($matches['src'] == "PREV")
				$this->currentVideoIndex = max(0 , ($this->currentVideoIndex - 1));
			//print $this->currentVideoIndex;
			$this->broadcast_except_sender($user, $message);
			$this->send($user,$message);
			//print $message;
			return;
		}
		else if (preg_match('/(?<SEEK>SEEK):(?<time>\w+)/', $message, $matches))
		{
			$this->broadcast_except_sender($user, $message);
			$this->send($user,$message);
			//print $message;
			return;
		}
		else if (preg_match('/(?<ADD>ADD):(?<src>\S+)/', $message, $matches))
		{
			//print "SRC:".$matches['src']."\n";
			$videoId=$this->youtubeIdFromUrl($matches['src']);
			if ($videoId == false){
				//print $message."\n"."false";
				return;
			}
			if (!in_array($videoId, $this->videoArr))
			{
				array_unshift($this->videoArr, $videoId);
				$message="ADD:".$videoId;
				$this->broadcast_except_sender($user, $message);
				$this->send($user,$message);
				$this->currentVideoIndex = 0;
				//print $message;
			}
			return;
		}
		else if (preg_match('/(?<PLAY>PLAY):(?<idx>\w+)/', $message, $matches))
		{
			$this->state ="PLAY";
			$this->broadcast_except_sender($user, $message);
			$this->send($user,$message);
			//print $message;
			return;
		}
		else if (preg_match('/(?<PAUSE>PAUSE):(?<src>\w+)/', $message, $matches))
		{
			$this->state ="PAUSE";
			$this->broadcast_except_sender($user, $message);
			$this->send($user,$message);
			//print $message;
			return;
		}
		else if (preg_match('/(?<index>INDEX):(?<idx>\w+)/', $message, $matches))
		{
			$this->currentVideoIndex = $matches['idx'];
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
	
	protected function youtubeIdFromUrl($url) {
		$pattern = '#^(?:https?://)?';    # Optional URL scheme. Either http or https.
		$pattern .= '(?:www\.)?';         #  Optional www subdomain.
		$pattern .= '(?:';                #  Group host alternatives:
		$pattern .=   'youtu\.be/';       #    Either youtu.be,
		$pattern .=   '|youtube\.com';    #    or youtube.com
		$pattern .=   '(?:';              #    Group path alternatives:
		$pattern .=     '/embed/';        #      Either /embed/,
		$pattern .=     '|/v/';           #      or /v/,
		$pattern .=     '|/watch\?v=';    #      or /watch?v=,    
		$pattern .=     '|/watch\?.+&v='; #      or /watch?other_param&v=
		$pattern .=   ')';                #    End path alternatives.
		$pattern .= ')';                  #  End host alternatives.
		$pattern .= '([\w-]{11})';        # 11 characters (Length of Youtube video ids).
		$pattern .= '(?:.+)?$#x';         # Optional other ending URL parameters.
		preg_match($pattern, $url, $matches);
		return (isset($matches[1])) ? $matches[1] : false;
	}	
	protected function arrayToStr($arr)
	{
		$str=" ";
		foreach($arr as $k) {
			$str= $str.$k." ";
		}
		return $str;
	}

}
$echo = new echoServer("0.0.0.0","9002", null);
