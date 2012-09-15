<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
   "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>CSS Ribbon</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="../style/fg_membersite.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../scripts/jquery.js"></script>
<script type="text/javascript" src="../scripts/time.js"></script>
</head>
<body>

<div id="container">
<div class="menu">
<ul>
<li class="l1"><a href="#">Linux</a></li>
<li class="l2"><a href="#">is really</a></li>
<li class="l3"><a href="#">powerful</a></li>
</ul>
</div>

<div class="bubble">
<div align=center id="theTimer">00:00:00</div>
<div class="rectangle"><h2>Tux Corner</h2></div>
<div class="triangle-l"></div>
<div class="triangle-r"></div>
<div class="info">
<div id="includedContent"></div>
<script>loadContent('#includedContent', 'tux2.php')</script>
<p align="center">
<img src="../images/brewani0.gif" width="96" height="107">
<img src="../images/brewani1.gif" width="96" height="107">
<button onclick="loadContent('#includedContent', 'tux2.php')">change</button>
</div>
</div>


</body>
</html>
