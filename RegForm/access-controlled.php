<?PHP
	require_once("access.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<?require_once("includes.php");?>
		<!--<meta http-equiv="refresh" content="60"/>-->
		<title>Welcome!!</title>
		<script>
			window.setTimeout("updateTime()", 0);// start immediately
			window.setInterval("updateTime()", 1000);// update every second
			window.setInterval("loadContent('#includedContent', 'tux.php')", 30000);// update every second
					
		</script>
		<!--<script type="text/javascript" src="scripts/tumblr.js" ></script>-->
	</head>
	<body>
	<!--	<object width=100% height="50" classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" id="gsPlaylist529016272" name="gsPlaylist529016272"><param name="movie" value="http://grooveshark.com/widget.swf" /><param name="wmode" value="window" /><param name="allowScriptAccess" value="always" /><param name="flashvars" value="hostname=cowbell.grooveshark.com&playlistID=52901627&bbg=FFFFFF&bth=FFFFFF&pfg=FFFFFF&lfg=FFFFFF&bt=377D9F&pbg=377D9F&pfgh=377D9F&si=377D9F&lbg=377D9F&lfgh=377D9F&sb=377D9F&bfg=F6D61F&pbgh=F6D61F&lbgh=F6D61F&sbh=F6D61F&p=0" /><object type="application/x-shockwave-flash" data="http://grooveshark.com/widget.swf" width="250" height="250"><param name="wmode" value="window" /><param name="allowScriptAccess" value="always" /><param name="flashvars" value="hostname=cowbell.grooveshark.com&playlistID=52901627&bbg=FFFFFF&bth=FFFFFF&pfg=FFFFFF&lfg=FFFFFF&bt=377D9F&pbg=377D9F&pfgh=377D9F&si=377D9F&lbg=377D9F&lfgh=377D9F&sb=377D9F&bfg=F6D61F&pbgh=F6D61F&lbgh=F6D61F&sbh=F6D61F&p=0" /><span><a href="http://grooveshark.com/playlist/Coldplay/52901627" title="Coldplay by Anoop on Grooveshark">Coldplay by Anoop on Grooveshark</a></span></object></object>
-->
		<div id='homepage'>
		<div id='fg_membersite_content'>
			<h1><br><br><br>money Matters</h1>
			<?require_once("operations.php");?>
			<table class="imagetable" align=center>
			<caption></caption>
			<tr><th>Who ???</th><th>How much ???</th><th>Status</th> </tr>
			<?PHP
				//require_once("table-exists.php");
				$result = $fgmembersite->RunQuery("SELECT * FROM $uname");
				// Get all the data from the "example" table
				// keeps getting the next row until there are no more to get
				while($row = mysql_fetch_array( $result )) 
				{
					// Print out the contents of each row into a table
					echo "<tr><td>";
					echo $row['user2'];
					echo "</td><td>";
					echo abs($row['amount']);
					echo "</td><td>";
					if ($row['amount'] > 0 )
						echo "Owes you";
					else if ($row['amount'] < 0 )
						echo "You owe";
					else
						echo "Even";
					echo "</td> </tr>";
				}
			?>
			</table>
			<div id='tuxcorner'>
				<div bold align=center id="theTimer">00:00:00</div>
				<div id="includedContent"></div>
				<script>loadContent('#includedContent', 'tux.php')</script>
				<button onclick="loadContent('#includedContent', 'tux.php')">change</button>
			</div>
		</div>

		</div>
	</body>
</html>
