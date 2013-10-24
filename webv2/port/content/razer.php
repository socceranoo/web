<div class="fullcontent">
	<p>A free, online music streaming website which was inspired from grooveshark and hence the name. This site lets you search for songs, create, playlists and listen to them anywhere. All registered users have access to the tool and can add other registered users as their friends.</p>
	<div class="circleholder sevencircles">
		<div class="circle"><div class="innercircle green"><span>php</span></div></div>
		<div class="circle"><div class="innercircle violet"><span>mysql</span></div></div>
		<div class="circle"><div class="innercircle orange"><span>HTML</span></div></div>
		<div class="circle"><div class="innercircle blue"><span>jquery</span></div></div>
		<div class="circle"><div class="innercircle green"><span>javascript</span></div></div>
		<div class="circle"><div class="innercircle violet"><span>ajax</span></div></div>
		<div class="circle"><div class="innercircle red"><span>CSS</span></div></div>
	</div>
	<div class="halfcontent left">
	<h4>Motivation:</h4>
	<p>I had a bunch of my songs in my hard disk which i had collected over the years and i wanted to listen to it whenever i liked. It was too difficult to carry the hard disk around every time i travelled. So decided to hook up my hard disk with the website to listen to my songs on the go. </p>

	<h4>Table details : (MySQL)</h4>
	<ul class="proj-ul">
		<li><p><b>A song table </b>: This table contains information about the song, artist, album and the path to the song on the computer. This table is updated whenever a playlist is updated with certain songs (I thought it will be an overkill to add all the songs to the table in one shot).</p></li>
		<li><p><b>A playlist table </b>: Stores the playlists created by all users, user who created them and the playlist id.</p></li>
		<li><p><b>A song-playlist-map table </b>: this table to store the mapping information between the song id and the playlist id.</p></li>
	</ul>
	<a class="big-button left" href="http://gatoraze.info/webv2/audio/" target=_blank >Visit site</a>
	<a class="big-button right" href="https://github.com/socceranoo/web/tree/master/webv2/audio" target=_blank>View source</a>
	<div class="pagediv"><p></p></div>
	</div>
		<div class="halfcontent right">
	<h4>Features:</h4>
	<ul class="proj-ul">
		<li><p><b>Search while you play </b>: You can dynamically search while the song is playing (It is an excellent feature that grooveshark has and youtube doesn’t).</p></li>
		<li><p><b>Integrated with HTML5 audio</b>: This enables listening songs on my iPhone and iPad without any App.</p></li>
		<li><p><b>Integration with jPlayer </b>: used <audio> element at first and then switched to jPlayer for aesthetic reasons. The jPlayer really looked cool and had operations to add, edit current playlists which minimized my work of maintaining it myself.</p></li>
		<li><p><b>Playlist functions </b>: Allows to search songs and add to playlists. Also can create playlists.</p></li>
	</ul>

	<h4>Nice to haves ( Working on it):</h4>
	<ul class="proj-ul">
		<li><p><b>Expand database </b>: Since the song database is limited to my collection alone, does not scale well if i want to expand the database. So planning it to integrate with grooveshark and spotify widgets to make it a one stop solution for any song using their public APIs.</p></li>
		<li><p><b>Improve search </b>: Improve my search on the back end (Php) in my hard disk mounted on ubuntu virtual machine. Just implemented a brute force file name search currently which can take a while to complete for generic searches.</p></li>
		<li><p><b>Modify playlists </b>: Modifying the existing playlists as to remove or add songs.</p></li>
	</ul>
	</div>

	<div class="pagediv"><p></p></div>
	<!--
	AJAX : It is a completely non refresh site which allows to do the operations dynamically.
	PHP: takes care of database operations and search operations.
	JavaScript, jQuery : Processing user input and processing information from the server. 
	HTML5 : <audio> element makes it to work on iPhone and other devices without flash.
	CSS3: Styling the player and the page.
	-->
</div>
