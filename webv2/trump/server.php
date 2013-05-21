<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
	<title>Trump Server</title>
	<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/headers.php");?>
	<?require_once("./include/servheaders.php");?>
</head>
<body class=gameroom>
	<h2>Server State</h2>
	<div id=scorecard class=team1>
		<table id='gradient-style' align='center'>
			<tr><th>Team #</th><th>Points</th></tr>
			<tr><td>Server</td><td id="servstate">Running</td></tr>
			<tr><td>Port</td><td id="servport">9000</td></tr>
		</table>
		<input type=button value='server state' id="servbutton"/>
	</div>
</body>
</html>	
