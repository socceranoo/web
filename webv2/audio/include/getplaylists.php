<?PHP
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/membersite_config.php");
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/global_values.php");
	$retval = "true";
	$info = "";
	$playarr = array();
	$songarr = array();
	function filemain() {
		global $fgmembersite, $info, $retval;
		global $tagtable, $songtable, $maptable;
		global $playarr, $songarr;
		$reason =$_POST['reason'];
		$user =$_POST['user'];
		$playlist =$_POST['playlist'];
		if ($reason == "playlist") {
			get_playlists_for_user($user);
			return $playarr;
		} else if ($reason == "songs") {
			get_songs($playlist, $user);
			return $songarr;
		}
	}
	function get_playlists_for_user($uname) {
		global $fgmembersite, $playarr, $retval;
		global $tagtable, $songtable, $maptable;
		$result = $fgmembersite->RunQuery("SELECT tagname,tag_id FROM $tagtable WHERE username LIKE '$uname'");
		while ($row = mysql_fetch_array($result)) {
			array_push($playarr, $row['tagname']);
		}
	}

	function get_songs($playlist, $uname){
		global $fgmembersite, $info, $retval;
		global $tagtable, $songtable, $maptable;
		global $songarr;
		$playlist_id = get_playlist_id($playlist , $uname);
		$result = $fgmembersite->RunQuery("SELECT song_id FROM $maptable WHERE tag_id LIKE $playlist_id");
		while ($row = mysql_fetch_array($result)) {
			$song_id = $row['song_id'];
			$result1 = $fgmembersite->RunQuery("SELECT path FROM $songtable WHERE song_id LIKE $song_id");
			if (mysql_num_rows($result1) > 0) {
				$row1 = mysql_fetch_array($result1);
				array_push($songarr, $row1['path']);
			}
		}
	}
	function get_playlist_id($playlist, $uname) {
		global $fgmembersite, $info, $retval;
		global $tagtable, $songtable, $maptable;
		$result = $fgmembersite->RunQuery("SELECT tag_id FROM $tagtable WHERE (tagname LIKE '$playlist' AND username LIKE '$uname')");
		$row = mysql_fetch_array($result);
		return $row['tag_id'];
	}
	/*
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
	*/
$arr = filemain();
echo json_encode($arr);
?>
