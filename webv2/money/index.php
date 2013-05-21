<?PHP
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/membersite_config.php");
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/topright.php");
	checklogin();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<title>Money Money Money!!</title>
		<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/headers.php");?>
		<?require_once("include/moneyheaders.php");?>
	</head>
	<body id=moneybody class='money'>
		<h2>Money Matters</h2>
			<ul class='box operations' id='operations1'>
				<li id=li_summary><a href="JavaScript:(void);">Summary</a></li>
				<li id=li_add-friend><a href='JavaScript:(void);'>Add Friend(s)</a></li>
				<li id=li_add-bill><a href='JavaScript:(void);'>Add Bill</a></li>
				<li id=li_add-payment><a href='JavaScript:(void);'>Report Payment</a></li>
				<li id=li_view-transaction><a href='JavaScript:(void);'>Transaction(s)</a></li>
				<li id=li_view-del-transaction><a class='small' href='JavaScript:(void);'>Deleted Transaction(s)</a></li>
			</ul>
			<!--
			<ul class='box topleft' id='operations2'>
				<li><a href='../webv2/1login-home.php'>Home</a></li>
				<li><a href='money-matters.php'>Money Matters</a></li>
				<li><a href='../webv2/trump'>Gameroom</a></li>
				<li><a href='synctube-home.php'>SyncTube</a></li>
				<li><a href='../webv2/audio.php'>My Music</a></li>
				<li><a href='recipes.php' target="_blank">My Recipes</a></li>
			</ul>
			<div class='box topleft' id='operations2'>
				<a href='../webv2/1login-home.php'>Home</a>
				<a href='money-matters.php'>Money Matters</a>
				<a href='../webv2/trump'>Gameroom</a>
				<a href='synctube-home.php'>SyncTube</a>
				<a href='../webv2/audio.php'>My Music</a>
				<a href='recipes.php' target="_blank">My Recipes</a>
			</div>
			-->
			<?require_once("include/friendbox.php");?>
		<div class=moneycontent id=moneycontent>
			<div class=current-content id=current-content>
				<?//require_once("include/summary.php");?>
			</div>
			<?require_once("include/hiddenforms.php");?>
		</div>
	</body>
</html>
