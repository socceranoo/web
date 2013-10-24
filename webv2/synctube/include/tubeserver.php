#! /usr/local/bin/php
<?php

require_once('websockets.php');

class echoServer extends WebSocketServer {
	protected function process ($user, $message) {
		if (preg_match('/(?<user>USER):(?<name>.*);(?<session>SESSION):(?<session_id>.*)/', $message, $matches)) {
			$name = $matches['name'];
			$session_id = $matches['session_id'];
			print $session_id."\n";
			$session_id = intval($session_id);
			print $session_id;
			$user->username = $name;
			$session_obj = $this->getSessionForSessionId($session_id);
			$session_obj->pushUser($user);
			$server_info = $session_obj->getServerDetails();
			$user_msg = "INIT:".$user->id.";SERVER_INFO:".$server_info;
			$this->send($user, $user_msg);
			$user_msg = "NEWUSER:".$user->username.":".$user->id;
			$this->broadcast_except_sender($user, $user_msg);
			return;
		} else if (preg_match('/(?<ADD>ADD):(?<src>.*);(?<img>SRC):(?<imgsrc>.*);(?<TITLE>TITLE):(?<title_val>.*)/', $message, $matches)) {
			$videoid=$matches['src'];
			$album_title=$matches['title_val'];
			$img_src=$matches['imgsrc'];
			$user->session_obj->setVideo($videoid, $album_title, $img_src);
			//$message="ADD:".$this->videoid.";SRC:".$matches['imgsrc'].";TITLE:".$matches['title_val'];
			$this->broadcast_except_sender($user, $message);
			$this->send($user,$message);
			$user->session_obj->state= 1;
			$user->session_obj->updateEntry(1, "state", false);
			return;
		} else if (preg_match('/(?<ADD>ADD_TO_PLAYLIST):(?<src>.*);(?<IMG>SRC):(?<imgsrc>.*);(?<TITLE>TITLE):(?<title_val>.*)/', $message, $matches)) {
			$videoid=$matches['src'];
			$album_title=$matches['title_val'];
			$img_src=$matches['imgsrc'];
			if ($user->session_obj->pushVideo($videoid, $album_title, $img_src)) {
				$this->broadcast_except_sender($user, $message);
				$this->send($user, $message);
			}
			return;
		} else if (preg_match('/(?<ADD>REMOVE_FROM_PLAYLIST):(?<src>.*)/', $message, $matches)) {
			$videoid=$matches['src'];
			if ($user->session_obj->popVideo($videoid)) {
				$this->broadcast_except_sender($user, $message);
				$this->send($user, $message);
			}
			return;
		} else if (preg_match('/(?<OPR>OPR):(?<opr_val>.*):(?<arg>.*)/', $message, $matches)) {
			$opr = $matches['opr_val'];
			$opr_arg = $matches['arg'];
			if ($opr == "PLAY" || $opr == "PAUSE") {
				$user->session_obj->state= intval($opr_arg);
				$user->session_obj->updateEntry(intval($opr_arg), "state", false);
			} else if ($opr == "SYNC_REQ") {
				$user->session_obj->req_user = $user;
				$this->send($user->session_obj->long_user_array[0], $message);
				return;
			} else if ($opr == "SYNC_RESP_PLAY" || $opr == "SYNC_RESP_PAUSE") {
				$this->send($user->session_obj->req_user, $message);
				return;
				
			} else if ($opr == "SEEK") {

			}
			$this->broadcast_except_sender($user, $message);
			$this->send($user,$message);
			return;
		} else {
			$message = $user->username.":".$message;
			$this->broadcast_except_sender($user, $message);
		}

	}
	protected function getSessionForSessionId($id){
		foreach ($this->sessions as $session) {
			if ($session->session_id == $id) {
				return $session;
			}
		}
		$new_obj = new Session($id, "session".$id, $this->db_object);
		array_push($this->sessions, $new_obj);
		return $new_obj;
	}
		/*
		if (preg_match('/(?<USER>USER):(?<name>\w+)/', $message, $matches)) {
			$name = $matches['name'];
			$message = "USER:".$name." joined the conference room";
			$this->broadcast_except_sender($user, $message);
			$user->username = $name;
			//
			$message="USERID:".$user->id;
			$this->send($user,$message);
			sleep(1);
			array_push($this->userArr, array('userid' => $user->id, 'username'=>$user->username));
			$message="USERLIST:".json_encode($this->userArr);
			$this->send($user,$message);
			sleep(1);
			//
			if (count($this->videoArr) > 0) {
				$message = "LIST:".json_encode($this->videoArr);
				$this->send($user,$message);
				sleep(1);
			}
			if (count($this->users) > 0 && $user != $this->users[0] && $this->videoid) {
				$message="ADD:".$this->videoid.";SRC:asdasdas;TITLE:".$this->album_title;
				$this->send($user,$message);
				sleep(1);
				$syncmsg = "SYNC:PLEASE";
				$this->send($this->users[0], $syncmsg);
			}
		} else if (preg_match('/(?<SEEK>SEEK):(?<time>\w+)/', $message, $matches)) {
			$this->broadcast_except_sender($user, $message);
			$this->send($user,$message);
			print $message;
			return;
		} else if (preg_match('/(?<ADD>ADD):(?<src>.*);(?<img>SRC):(?<imgsrc>.*);(?<TITLE>TITLE):(?<title_val>.*)/', $message, $matches)) {
			$this->videoid=$matches['src'];
			$this->album_title=$matches['title_val'];
			$message="ADD:".$this->videoid.";SRC:".$matches['imgsrc'].";TITLE:".$matches['title_val'];
			print $message."\n";
			$this->broadcast_except_sender($user, $message);
			$this->send($user,$message);
			return;
		} else if (preg_match('/(?<ADD>ADD_TO_PLAYLIST):(?<src>.*);(?<IMG>SRC):(?<imgsrc>.*);(?<TITLE>TITLE):(?<title_val>.*)/', $message, $matches)) {
			$message="ADD_TO_PLAYLIST:".$matches['src'].";SRC:".$matches['imgsrc'].";TITLE:".$matches['title_val'];
			$retval = $this->videoInArray($matches['src']);
			if (!$retval){
				array_push($this->videoArr, array('videoId' => $matches['src'], 'imgsrc' => $matches['imgsrc'], 'title' => $matches['title_val']));
				print $message."\n";
				$this->broadcast_except_sender($user, $message);
				$this->send($user,$message);
				echo json_encode($this->videoArr);
			}
			return;
		} 
		else if (preg_match('/(?<PLAY>PLAY):(?<idx>\w+)/', $message, $matches)) {
			$this->state ="PLAY";
			$this->broadcast_except_sender($user, $message);
			$this->send($user,$message);
			print $message;
			return;
		} else if (preg_match('/(?<PAUSE>PAUSE):(?<src>\w+)/', $message, $matches)) {
			$this->state ="PAUSE";
			$this->broadcast_except_sender($user, $message);
			$this->send($user,$message);
			print $message;
			return;
		} else {
			$message = $user->username.":".$message;
			$this->broadcast_except_sender($user, $message);
		}
		//$this->send($user,$message);
	*/
	
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
}
$echo = new echoServer("0.0.0.0","443", null);
