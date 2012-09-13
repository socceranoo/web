function loadContent(id, php) 
{ 
	$(id).load(php); 
} 
function updateTime() 
{
	document.getElementById('theTimer').firstChild.nodeValue =
	new Date().toTimeString().substring(0, 8);
}
function initialize(divid, timerid, phpfile)
{
	window.setTimeout("updateTime(timerid)", 0);// start immediately
	window.setInterval("updateTime(timerid)", 1000);// update every second
	window.setInterval("loadContent(divid, phpfile)", 3000);// update every second
}
