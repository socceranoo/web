<script>
	window.setTimeout("updateTime()", 0);// start immediately
	window.setInterval("updateTime()", 1000);// update every second
	window.setInterval("loadContent('#includedContent', 'tux.php')", 120000);// update every second
</script>
<div id="container">
	<div class="menu">
		<ul>
		<li class="l1"><a href="#">Linux</a></li>
		<li class="l2"><a href="#">is really</a></li>
		<li class="l3"><a href="#">powerful</a></li>
		</ul>
	</div>

	<div class="bubble">
		<div class="rectangle"><h2>Tux Corner</h2></div>
		<div class="triangle-l"></div>
		<div class="triangle-r"></div>

		<div class="info">
			<div id="includedContent"></div>
			<script>loadContent('#includedContent', 'tux.php')</script>
			<p align="center">
			<img src="../images/brewani0.gif" width="96" height="107">
			<img src="../images/brewani1.gif" width="96" height="107">
			<button onclick="loadContent('#includedContent', 'tux.php')">change</button>
			<br/>
		<div align=center id="theTimer">00:00:00</div>
		</div>
	</div>

</div>
