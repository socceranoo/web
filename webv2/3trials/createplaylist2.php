<?PHP
	require_once("./include/membersite_config.php");
	$songtable = "song";
	$tagtable = "songtag";
	$maptable = "songtagmap";
	$retval = "true";
	$info = "";
	$array = array("1","2","3");
	function filemain() {
		print "echo filemain>> /tmp/play";
		global $fgmembersite, $info, $retval, $array;
		global $tagtable, $songtable, $maptable;
		$user ="guest1";
		$listname ="temp";
		$songarr = $array;
		if (playlist_already_exists($listname, $user)){
			$info ="PlayList already exists";
			$retval="false";
			return;
		}
		$playlist_id = get_playlist_id($listname, $user);
		tag_songs($songarr, $playlist_id);
	}
	function playlist_already_exists($playlist, $uname) {
		print "echo plalready >> /tmp/play";
		global $fgmembersite, $info, $retval;
		global $tagtable, $songtable, $maptable;
		$result = $fgmembersite->RunQuery("SELECT tag_id FROM $tagtable WHERE (tagname LIKE '$playlist' AND username LIKE '$uname')");
		if (mysql_num_rows($result) > 0)
			return true;
		return false;
	}

	function tag_songs($songarr, $playlist_id){
		print "echo tagsongs >> /tmp/play";
		global $fgmembersite, $info, $retval;
		global $tagtable, $songtable, $maptable;
		foreach ($songarr as $song) {
			$song_id = get_song_id($song);
			$result = $fgmembersite->RunQuery("INSERT INTO $maptable (song_id, tag_id) values($song_id, $playlist_id)");
        }
	}
	function get_playlist_id($playlist, $uname) {
		print "echo get_playlist_id >> /tmp/play";
		global $fgmembersite, $info, $retval;
		global $tagtable, $songtable, $maptable;
		$result = $fgmembersite->RunQuery("INSERT INTO $tagtable (username, tagname) values('$uname', '$playlist')");
		$err = get_db_error_message();
		print "echo $err >> /tmp/play";
		$info .="PlaylistCreated with ID". mysql_insert_id();
		return mysql_insert_id();
	}
	function get_song_id($song) {
		print "echo get_song_id >> /tmp/play";
		global $fgmembersite, $info, $retval;
		global $tagtable, $songtable, $maptable;
		$result = $fgmembersite->RunQuery("SELECT song_id FROM $songtable WHERE path LIKE '$song'");
		$err = get_db_error_message();
		print "echo $err >> /tmp/play";
		if (mysql_num_rows($result) > 0) {
			$row = mysql_fetch_array($result);
			return $row['song_id'];
		}else {
			$result = $fgmembersite->RunQuery("INSERT INTO $songtable (path) values('$song')");
		$err = get_db_error_message();
		print "echo $err >> /tmp/play";
			return mysql_insert_id();
		}
	}
	function get_db_error_message() {
		global $fgmembersite, $info, $retval;
		global $tagtable, $songtable, $maptable;
		return $fgmembersite->GetErrorMessage();
	}
filemain();
$arr = array("retval"=>$retval, "info"=>$info);
echo json_encode($arr);
?>
