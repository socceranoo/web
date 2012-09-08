function loadContent() 
{ 
	$("#includedContent").load("tux.php"); 
} 
function updateTime() 
{
	document.getElementById("theTimer").firstChild.nodeValue =
	new Date().toTimeString().substring(0, 8);
}

