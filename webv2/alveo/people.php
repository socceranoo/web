<!DOCTYPE html>
<html lang="en">
	<meta charset="UTF-8">
	<head>
	<?require_once("include/alveoheaders.php");?>
	</head>
	<body class=alveo>
		<?require_once("include/header.php");?>
		<div class="container alveo-container">
			<div id=people-exists class="row">
				<hr class="featurette-divider2" />
				<h2 class="text-center">Alveo's team</h2>
				<div class="text-center offset2 span8">
					<? require_once("include/teamalveo.php");?>
					
				</div>
			</div>
			<div id=person-content-container class='modal fade out hide' style="display:none">
				<div class="modal-header text-center">
					<h2 id=modal-name></h2>
					<img id=modal-image class="img-circle img-polaroid" />
				</div>
				<div class="modal-body well background-clouds rounded display-none person-content">
					<h4 class=text-center >The person</h4>
					<p>Describe more about you as a person, your likes, your hobbies, what do you like to do apart from work and your favorite place. Describe more about your technical background, your education, your experience, your expertise and your career goal</p>
					<h4 id=person-post class=text-center ></h4>
					<p>Describe your association with the company, how long you have been associated with the company and explain your role in the company in more detail</p>
				</div>
				<div class="modal-footer">
					<a data-dismiss="modal" class="btn btn-inverse">Close</a>
				</div>
			</div>
		</div>
		<?require_once("include/footer.php");?>
	</body>
</html>
