#! /usr/local/bin/php
<?php

require_once('include/websockets.php');

class echoServer extends WebSocketServer {
	
	protected function process ($user, $message) {
		if (preg_match('/(?<USER>USER):(?<name>\w+)/', $message, $matches))
		{
			$user->username = $matches['name'];	
			$message = $user->username." joined the conference room";
		}
		else if (preg_match('/(?<VIDEO>VIDEO):(?<src>\w+)/', $message, $matches))
		{
			$this->broadcast_except_sender($user, $message);
			$this->send($user,$message);
			print $message;
			return;
		}
		else if (preg_match('/(?<PLAY>PLAY):(?<src>\w+)/', $message, $matches))
		{
			$this->broadcast_except_sender($user, $message);
			//$this->send($user,$message);
			print $message;
			return;
		}
		else if (preg_match('/(?<PAUSE>PAUSE):(?<src>\w+)/', $message, $matches))
		{
			$this->broadcast_except_sender($user, $message);
			//$this->send($user,$message);
			print $message;
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
$echo = new echoServer("0.0.0.0","9002", null);
