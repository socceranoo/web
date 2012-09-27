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

$(document).ready(function()
{
	$("img").load(function() 
	{
		$(this).wrap(function()
		{
			return '<span class="image-wrap ' + $(this).attr('class') + '" style="position:relative; display:inline-block; background:url(' + $(this).attr('src') + ') no-repeat center center; width: ' + $(this).width() + 'px; height: ' + $(this).height() + 'px;" />';
		});
		$(this).css("opacity","0");
	});

});

function addToArray(a, divid, text, hidid, php)
{
	var friend = "";
	if (text == "email")
		friend = document.getElementById(text).value; 
	else if(text == "paid2" || text == "part2")
	{
		var e = document.getElementById(text);
		friend = e.options[e.selectedIndex].value;
	}
	if (friend !="" && !inArray(friend, a))
	{
		a.push(friend);
	}
	document.getElementById(text).value = "";
	var str = serializeArray(a);
	document.getElementById(hidid).value = str;
	var id="#"+divid;
	var phpfile = php+"?id="+divid+"&arg="+str;
	$(id).load(phpfile);
}
function serializeArray(a)
{
	var serializedString = '';
	var arrayLength = 0;
	for(var aKey in a)
	{
		//key definition
		if(aKey * 1 == aKey) //is_numeric?
		{
			//integer keys look like i:key
			serializedString += 'i:' + aKey + ';';	
		}
		else
		{
			//string keys look like s:key_length:key;
			serializedString += 's:' + aKey.length + ':"' + aKey + '";';
		}

		//value definition
		if(a[aKey] * 1 == a[aKey])
		{
			//integer value look like i:value
			serializedString += 'i:' + a[aKey] + ';';	
		}
		else if(typeof(a[aKey]) == "string")
		{
			//string value look like s:key_length:value;
			serializedString += 's:' + a[aKey].length + ':"' + a[aKey] + '";';
		}
		else if(a[aKey] instanceof Array)
		{
			serializedString += serializeArray(a[aKey]);
		}
		arrayLength++;
	}
	serializedString = 'a:' + arrayLength + ':{' + serializedString + '}';
	return serializedString;
}
function inArray(needle, haystack) 
{
	var length = haystack.length;
	for(var i = 0; i < length; i++) {
		if(haystack[i] == needle) return true;
	}
	return false;
}
