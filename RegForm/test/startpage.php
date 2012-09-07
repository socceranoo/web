<html>
<head>
<title>test page</title>
<script language=javascript>
scriptAr = new Array();
scriptAr[0] = "one";
scriptAr[1] = "two";
scriptAr[2] = "three";
</script>

<script language=javascript>
function setValue()
{
	var arv = scriptAr.toString();
	// This line converts js array to String document.test.arv.value=arv;
}
</script>
</head>
<body>
<form action="process1.php" method=post name=test onSubmit=setValue()>
<input name=arv type=hidden>
<input type=submit>
</form>
<form action="process.php" method="post" name=two>
Name: <input type="text" name="fname" />
Age: <input type="text" name="age" />
<input type="submit" />
</form>
</body>
</html>
