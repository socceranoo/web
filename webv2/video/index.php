<?PHP
	$width="1920";
	$height="1080";
	//$linktovideo ="../../external/linkhdd/Movies/HiQ Movies/DM_720p.avi";
	$rootdir ="../../external/linkhdd/Movies/";
	$linktovideo = $rootdir."HiQ Movies/";
	$linktovideo .= "English/";
	//$filename = "Shawshank Redemption/The.Shawshank.Redemption.1994.720p.BRRip.XviD.AC3-FLAWL3SS.avi";
	$filename = "HARRY POTTER Series/HP&5TOOTP/Harry.Potter.And.The.Order.Of.The.Phoenix.2007.720p.BRRip.XviD.AC3-ViSiON.avi";
	$linktovideo .= $filename;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US">
	<head>
		<title>Manjunath | Front End Developer</title>
		<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/headers.php");?>
	</head>
	<body>
<!--
	<video width="320" height="240" controls>
	<source src="../../external/linkhdd/Movies/HiQ Movies/The.Chronicles.of.Narnia.The.Voyage.of.the.Dawn.Treader.2010.720p.BDRip.XviD.AC3-ViSiON.avi" type="video/avi">
	Your browser does not support the video tag.
	</video>
<param name="src" value="../../external/linkhdd/Movies/HiQ Movies/The.Chronicles.of.Narnia.The.Voyage.of.the.Dawn.Treader.2010.720p.BDRip.XviD.AC3-ViSiON.avi" />
src="../../external/linkhdd/Movies/HiQ Movies/The.Chronicles.of.Narnia.The.Voyage.of.the.Dawn.Treader.2010.720p.BDRip.XviD.AC3-ViSiON.avi" 
-->
	<object id="ie_plugin" classid="clsid:67DABFBF-D0AB-41fa-9C46-CC0F21721616" 
            width="<?echo $width?>" 
            height="<?echo $height?>" 
            codebase="http://go.divx.com/plugin/DivXBrowserPlugin.cab"> 
	<param name="custommode" value="stage6" />
	<param name="autoPlay" value="false" />
	<param name="src" value="<?echo $linktovideo?>">
	<param name="bannerEnabled" value="false" />

<embed id="np_plugin" type="video/divx" 
src="<?echo $linktovideo?>"
custommode="stage6" 
width="<?echo $width?>" 
height="<?echo $height?>" 
volume=200
autoPlay="true"  
bannerEnabled="false"
pluginspage="http://go.divx.com/plugin/download/">
</embed>
</object>
	</body>
</html>	
