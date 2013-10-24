<!DOCTYPE html>
<html lang="en">
	<meta charset="UTF-8">
	<title></title>
	<head>
	<title>Alveo Energy</title>
	<!--#include virtual="include/alveoheaders.php" -->
	<?require_once("include/alveoheaders.php");?>
	</head>
	<body class=alveo>
		<div class="main-container">
			<?require_once("include/header.php");?>
			<div id=people-exists class="maincontent">
				<div class="pagecontent">
					<h2>Team Alveo</h2>
					<div id=people-container class="fivecircles circleholder">
						<div id=person0 class="inactive circle"><div id=ic0 class="innercircle"><div class="textgroup"><h2></h2><span class=person-span id=person-span0 ></span></div></div></div>
						<div id=person1 class="inactive circle"><div id=ic1 class="innercircle"><div class="textgroup"><h2></h2><span class=person-span id=person-span1 ></span></div></div></div>
						<div id=person2 class="inactive circle"><div id=ic2 class="innercircle"><div class="textgroup"><h2></h2><span class=person-span id=person-span2 ></span></div></div></div>
						<div id=person3 class="inactive circle"><div id=ic3 class="innercircle"><div class="textgroup"><h2></h2><span class=person-span id=person-span3 ></span></div></div></div>
						<div id=person4 class="inactive circle"><div id=ic4 class="innercircle"><div class="textgroup"><h2></h2><span class=person-span id=person-span4 ></span></div></div></div>
					</div>
					<div id=person-content-container class='full height-300 display-none'>
						<div id=person-about class="person-content onethird test rounded fl-right display-none">
							<h2>The person</h2>
							<p>Describe more about you as a person, your likes, your hobbies, what do you like to do apart from work and your favorite place</p>
							<?//require("include/lorem.php");?>
						</div>
						<div id=person-post class="person-content onethird test rounded fl-left display-none">
							<h2>The CEO</h2>
							<p>Describe your association with the company, how long you have been associated with the company and explain your role in the company in more detail</p>
							<?//require("include/lorem.php");?>
						</div>
						<div id=person-techie class="person-content onethird test rounded fl-center display-none">
							<h2>The techie</h2>
							<p>Describe more about your technical background, your education, your experience, your expertise and your career goal</p>
							<?//require("include/lorem.php");?>
						</div>
					</div>
					<div class=cleardiv></div>
				</div>
			</div>
		</div>
		<?require_once("include/footer.php");?>
	</body>
</html>
