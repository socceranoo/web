<?PHP
	function get_playlists_for_user() {
		$uname = "guest1";
		global $fgmembersite;
		global $tagtable, $songtable, $maptable;
		$result = $fgmembersite->RunQuery("SELECT tagname,tag_id FROM $tagtable WHERE username LIKE '$uname'");
		$i = 0;
		while ($row = mysql_fetch_array($result)) {
			$name = $row['tagname'];
			echo "<li class=''><a href='javascript:void(0);' class='playlist-link btn btn-info' data-name='$name'>$name</a></li>";
			$i++;
		}
	}
?>
<h4 class=lead>Playlists</h4>
<ul class='unstyled inline' id=playlistcontent>
	<?get_playlists_for_user();?>
</ul>
