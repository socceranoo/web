function isNumeric(elem, helperMsg)
{
	var numericExpression = /^[0-9]+$/;
	if(elem.value.match(numericExpression))
	{
		return true;
	}
	else
	{
		//alert(helperMsg);
		elem.focus();
		return false;
	}
}
