<?PHP
	system("lessc style/home.less > style/home.css");
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/access.php");
/*
if(isset($_POST['submitted']))
{
	if($fgmembersite->ChangePassword())
	{
	    $fgmembersite->RedirectToURL("changed-pwd.php");
	}
}
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US" ng-app>
	<head>
		<?require_once("include/headers.php");?>
		<?require_once("include/loginheaders.php");?>
		<meta http-equiv='Content-Type' content='text/html; charset=utf-8'/>
		<title>Change password</title>
	</head>
	<body class='background-cloud login'>
		<div class=container>
			<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/topright.php");?>
			<div class="featurette-divider4"></div>
			<h3 class="text-right website-heading" style="font-size:50px;">GATORAZE.COM</h3>
			<hr class="featurette-divider4">
			<div class=row>
				<?require_once("include/changepwdform.php");?>
			</div>
		</div>
	<?require_once("include/footers.php");?>
	</body>
</html>
