<?PHP
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/membersite_config.php");
	$retval = "true";
	$info = "";
	$listname ="";
	function filemain() {
		global $fgmembersite, $info, $retval, $listname;
		global $tagtable, $songtable, $maptable;
		$user =$_POST['user'];
		$listname =$_POST['playlist'];
		$songarr = $_POST['songarr']; 
		if (playlist_already_exists($listname, $user)){
			$info .="Playlist already exists";
			$retval="false";
			return;
		}
		$playlist_id = get_playlist_id($listname, $user);
		$info .="Playlist created with id $playlist_id\n";
		tag_songs($songarr, $playlist_id);
	}
	function playlist_already_exists($playlist, $uname) {
		global $fgmembersite, $info, $retval;
		global $tagtable, $songtable, $maptable;
		$result = $fgmembersite->RunQuery("SELECT tag_id FROM $tagtable WHERE (tagname LIKE '$playlist' AND username LIKE '$uname')");
		if (mysql_num_rows($result) > 0)
			return true;
		return false;
	}

	function tag_songs($songarr, $playlist_id){
		global $fgmembersite, $info, $retval;
		global $tagtable, $songtable, $maptable;
		foreach ($songarr as $song) {
			$song_id = get_song_id($song);
			$result = $fgmembersite->RunQuery("INSERT INTO $maptable (song_id, tag_id) values($song_id, $playlist_id)");
			$info .="song $song added to playlist\n";
        }
	}
	function get_playlist_id($playlist, $uname) {
		global $fgmembersite, $info, $retval;
		global $tagtable, $songtable, $maptable;
		$result = $fgmembersite->RunQuery("INSERT INTO $tagtable (username, tagname) values('$uname', '$playlist')");
		return mysql_insert_id();
	}
	function get_song_id($song) {
		global $fgmembersite, $info, $retval;
		global $tagtable, $songtable, $maptable;
		$result = $fgmembersite->RunQuery("SELECT song_id FROM $songtable WHERE path LIKE '$song'");
		if (mysql_num_rows($result) > 0) {
			$row = mysql_fetch_array($result);
			return $row['song_id'];
		}else {
			$result = $fgmembersite->RunQuery("INSERT INTO $songtable (path) values('$song')");
			return mysql_insert_id();
		}
	}
	function get_db_error_message() {
		global $fgmembersite, $info, $retval;
		global $tagtable, $songtable, $maptable;
		return $fgmembersite->GetErrorMessage();
	}
filemain();
$arr = array("retval"=>$retval, "info"=>$info, "listname"=>$listname);
echo json_encode($arr);
?>
