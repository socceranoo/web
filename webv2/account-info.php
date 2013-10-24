<?PHP
	system("lessc style/home.less > style/home.css");
	require_once($_SERVER['DOCUMENT_ROOT']."webv2/include/access.php");
	function display_user_info()
	{
		global $fgmembersite, $uname;
		$result = $fgmembersite->RunQuery("SELECT name,username,fbusername from regusers where username='$uname'");
		$row = mysql_fetch_array($result);
		foreach ($row as $i => $values) {
			if (!is_numeric($i)) {
				if ($i != "fbusername")
					echo "<span class=input-field>".ucwords($i)." : ".$values."</span>";	
				else
				{
					echo "<span class=input-field >Password : *********<a class='small' href='change-pwd.php'>change</a><br/></span>";
					echo "<br/>";
					echo "<a class=input-field href='https://www.facebook.com/".$values."' target=_blank >Facebook profile</a>";
				}
					
				echo "<br/>";
				echo "<br/>";

			}
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-US" lang="en-US" ng-app>
	<head>
		<?require_once("include/headers.php");?>
		<?require_once("include/loginheaders.php");?>
	</head>
	<body class='background-cloud login'>
		<div class=container>
			<?require_once($_SERVER['DOCUMENT_ROOT']."webv2/topright.php");?>
			<div class="featurette-divider4"></div>
			<h3 class="text-right website-heading" style="font-size:50px;">GATORAZE.COM</h3>
			<hr class="featurette-divider4">
			<div class=row>
				<div class="span4">
					<img class="img-polaroid img-circle" src='../images/users/<?echo $uname?>'/>
					<a href='javascript:void(0);' onclick="$('#foto-uploader').show(); $('#edit-add').hide();" id="edit-add" class=input-field><label align=center>edit/add<label></a>
					<div id="foto-uploader">
						<form action="include/upload-image.php" method="post" enctype="multipart/form-data" name="uploadImage" id="uploadImage">
							<legend>Upload Image</legend>
							<input type="hidden" name="MAX_FILE_SIZE" value="<?php echo MAX_FILE_SIZE; ?>" />
							<input class="btn btn-inverse" type="file" name="image" id="image" />
							<br/>
							<input type="submit" class="btn btn-success" name="upload" id="upload" value="Upload" />
							<a href='javascript:void(0);' class="btn btn-danger" id="cancel" onclick="$('#foto-uploader').hide();$('#edit-add').show();">Cancel</a>
						</form>
					</div>
					<script>$('#foto-uploader').hide();</script>
					<?display_user_info();?>
				</div>
			</div>
		</div>
		<?require_once("include/footers.php");?>
	</body>
</html>
	</body>
</html>
