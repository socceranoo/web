<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
<title>An Access Controlled Page</title>
<link rel="STYLESHEET" type="text/css" href="style/fg_membersite.css">
<script type='text/javascript' src='scripts/myscripts.js'></script>
</head>
<body>
<div id='fg_membersite_content'>
<h2>Add Page2</h2>
<p>Jump Menu:</p>
<form name=form1>
<select name="jumpmenu" onChange="jumpto(document.form1.jumpmenu.options[document.form1.jumpmenu.options.selectedIndex].value)">
  <option>Jump to...</option>
  <option value=add-user1.php>Quackit Homepage</option>
  <option value=add-user1.php>JavaScript</option>
  <option value=add-user1.php>HTML</option>
</select>
</div>
</body>
</html>

