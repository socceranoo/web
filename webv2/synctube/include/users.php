<?php
class WebSocketUser {

	public $socket;
	public $id;
	public $headers = array();
	public $handshake = false;

	public $handlingPartialPacket = false;
	public $partialBuffer = "";

	public $sendingContinuous = false;
	public $partialMessage = "";
	
	public $hasSentClose = false;
	public $username;
	public $session_obj;

	function __construct($id,$socket) {
		$this->id = $id;
		$this->socket = $socket;
	}
}
class Db{
	public $db_host='localhost';
	public $db_name='Main';
	public $db_user='root';
	public $db_pwd='Orange';
	public $table='sync_sessions';
	public $connection;
	function __construct() {
		if(!$this->dbLogin()) {
			exit(0);
		}
		$this->dropSessionTable();
		$this->createSessionTable();
	}
	public function runQuery($qry) {
		$result = mysql_query($qry,$this->connection);
		return $result;
	}
	public function dbLogin() {
		$this->connection = mysql_connect($this->db_host,$this->db_user,$this->db_pwd);
		if(!$this->connection) {
			return false;
		}
		if(!mysql_select_db($this->db_name, $this->connection)) {
			return false;
		}
		if(!mysql_query("SET NAMES 'UTF8'",$this->connection)) {
			return false;
		}
		return true;
	}
	function dropSessionTable(){
		$qry = "drop Table $this->table";
		$this->runQuery($qry);
	}
	function createSessionTable(){
		$qry = "Create Table $this->table (".
            "id INT NOT NULL AUTO_INCREMENT ,".
            "name VARCHAR(100) NOT NULL ,".
            "video_id TEXT NOT NULL ,".
            "user_array TEXT NOT NULL ,".
            "playlist  TEXT NOT NULL ,".
            "state INT NOT NULL ,".
            "PRIMARY KEY ( id )".
            ")";
		$this->runQuery($qry);
	}
}

class Video {
	public $title;
	public $img_src;
	public $video_id;
	function __construct($id, $img_src, $title) {
		$this->setVideoDetails($id, $img_src, $title);
	}

	function setVideoDetails($id, $img_src, $title) {
		$this->video_id = $id;
		$title = preg_replace('/\'/', '`', $title);
		$this->title = $title;
		$this->img_src = $img_src;
	}
}

class User {
	public $username;
	public $id;
	function __construct($id, $name) {
		$this->id = $id;
		$this->username = $name;
	}
}
class Session{
	public $session_name;
	public $session_id;
	public $db_obj;
	public $long_user_array = array();
	public $short_user_array = array();
	public $playlist = array();
	public $current_video;
	public $req_user;
	public $state;
	function __construct($id, $name, $db_obj) {
		$this->session_id = $id;
		$this->session_name = $name;
		$this->db_obj = $db_obj;
		$this->createSessionEntry();
		$this->current_video = new Video("id", "src", "title");
	}
	function pushVideo($id, $title, $img_src) {
		foreach ($this->playlist as $video){
			if ($video->video_id == $id){
				return false;
			}
		}
		array_push($this->playlist, new Video($id, $img_src, $title));
		$this->updateEntry($this->playlist, "playlist", true);
		return true;
	}
	function popVideo($id) {
		$video_found = null;
		foreach ($this->playlist as $key => $value) {
			if ($value->video_id == $id){
				$video_found = $key;
			}
		}
		if ($video_found !== null) {
			unset($this->playlist[$video_found]);
			$this->playlist = array_values($this->playlist);
			if (count($this->playlist)) {
				$this->updateEntry($this->playlist, "playlist", true);
			}else {
				$this->updateEntry("", "playlist", false);
			}
			return true;
		}
		return false;
	}
	function getServerDetails() {
		$qry = "SELECT * from sync_sessions where id = $this->session_id";
		$result = $this->db_obj->runQuery($qry);
		$row = mysql_fetch_array($result);
		$info = json_encode($row);
		return $info;
	}
	function setVideo($id, $title, $img_src) {
		$this->current_video->setVideoDetails($id, $img_src, $title);
		$this->updateEntry($this->current_video, "video_id", true);
	}
	function updateEntry($obj, $db_field, $json_encode) {
		$table = $this->db_obj->table;
		if ($json_encode) {
			$value = json_encode($obj);
		}else {
			$value = $obj;
		}
		//print $value."\n";
		$qry = "UPDATE $table set $db_field='$value' WHERE id=$this->session_id";
		echo mysql_error($this->db_obj->connection);
		$this->db_obj->runQuery($qry);
	}
	function pushUser($user) {
		array_push($this->long_user_array, $user);
		array_push($this->short_user_array, new User($user->id,$user->username));
		$user->session_obj = $this;
		$this->updateEntry($this->short_user_array, "user_array", true);
	}
	function createSessionEntry() {
		$table = $this->db_obj->table;
		$qry = "INSERT INTO $table (name, id, state)".
				"VALUES('$this->session_name','$this->session_id', '-1')";
		$this->db_obj->runQuery($qry);
	}
	function removeUser($user){
		$found_user = null;
		foreach ($this->long_user_array as $k => $value){
			if ($value->id == $user->id){
				$found_user = $k;
			}
		}
		if ($found_user !== null) {
			unset($this->long_user_array[$found_user]);
			$this->long_user_array = array_values($this->long_user_array);
		}
		
		$found_user = null;
		foreach ($this->short_user_array as $k => $value){
			if ($value->id == $user->id){
				$found_user = $k;
			}
		}
		if ($found_user !== null) {
			unset($this->short_user_array[$found_user]);
			$this->short_user_array= array_values($this->short_user_array);
		}

		if (!count($this->short_user_array)) {
			/*
			unset($this->playlist);
			$this->playlist = array();
			*/
			foreach ($this->playlist as $key => $value) {
				unset($this->playlist[$key]);
			}
			$this->playlist = array_values($this->playlist);
			/*
			*/
			$this->updateEntry("", "user_array", false);
			$this->updateEntry("", "video_id", false);
			$this->updateEntry("", "playlist", false);
			$this->updateEntry(-1, "state", false);
			print "ALL USERS GONE";
			return;
		}
		$this->updateEntry($this->short_user_array, "user_array", true);
	}
}
?>
