<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> New Document </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<script type="text/javascript">
    function loadArray(){
        var realAnswers =new Array("0010","1010");
        var answers = new Array();
        for(var i=0;i<realAnswers.length;i++)
        {
            answers[i] = realAnswers[i];
       //     alert(answers[i]);
        }
        document.getElementById('hidArray').value = answers;
        alert("loaded Successfully "+document.getElementById('hidArray').value);
    }
    function displayArray()
    {
        var myhidObj = new Array (document.getElementById('hidArray').value);
        alert("myhidObj = "+myhidObj);
        alert("length = "+myhidObj.length);
    }
</script>
</HEAD>
<BODY>
<form id="myForm" name="myForm" method=post >
    <input type="hidden" name="hidArray" id="hidArray" value=""/>
</form>
<input type="button" value="loadArray" onclick="loadArray();" />
<input type="button" value="displayArray" onclick="displayArray();" />
</BODY>
</HTML>
