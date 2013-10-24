<?PHP
	//system("lessc style/piece.less > style/piece2.css");
?>
<!DOCTYPE html>
<html>
	<head>
		<?require_once("include/pieceheaders.php");?>
	</head>
	<body class=piece>
		<?require_once("include/header.php");?>
		
		<?require_once("include/carousel.php");?>
		
		<!-- Marketing messaging and featurettes
		================================================== -->
		<!-- Wrap the rest of the page in another container to center all the content. -->

		<div class="container marketing">
		  <!-- Three columns of text below the carousel -->
		  <div class="row">
			<div class="span4">
			  <img src="images/tetris.jpg" class="img-circle" data-src="holder.js/140x140">
			  <h2>Create</h2>
			  <p>Full prototyping services</p>
			  <p>3D content creation and consultation</p>
			  <p>Complete 3D printing systems</p>
			  <p><a data-toggle="modal" href="#example" class="btn btn-success">View details &raquo;</a></p>
			</div><!-- /.span4 -->
			<div class="span4">
			  <img src="images/expand2.jpg" class="img-circle" data-src="holder.js/140x140">
			  <h2>Expand</h2>
			  <p>On-demand custom pieces</p>
			  <p>Extensive library of quality assured printable content</p>
			  <p>Low cost post processing for consumer grade products</p>
			  <p><a data-toggle="modal" href="#example" class="btn btn-success">View details &raquo;</a></p>
			</div><!-- /.span4 -->
			<div class="span4">
			  <img src="images/simplify.jpg" class="img-circle" data-src="holder.js/140x140">
			  <h2>Simplify</h2>
			  <p>We provide file organization, management, and inventory monitoring. We can work to integrate with your existing inventory system.</p>
			  <p>Eliminate entire supply chains</p>
			  <p>Buy the product once and own it forever</p>
			  <p>Seamless content inventory management and tracking</p>
			  <p><a data-toggle="modal" href="#example" class="btn btn-success">View details &raquo;</a></p>
			</div><!-- /.span4 -->
		  </div><!-- /.row -->


		  <!-- START THE FEATURETTES -->

		  <hr class="featurette-divider">
		  <div class="featurette">
			<img class="featurette-image pull-right" src="bootstrap/docs/assets/img/examples/browser-icon-chrome.png">
			<h2 class="featurette-heading">Do &nbsp;<span class="muted">you ...</span></h2>
				<p class="lead">wish you could easily test new products in small quantities?</p>
				<p class=lead>wish that your inventory could adapt as fast as customer trends change?</p>
				<p class=lead>lose sales because you just don't have the exact product your customer wants?</p>
				<p class=lead>lose capital and sales due to supply chain issues and delays?</p>
		  </div>

		  <hr class="featurette-divider">

		  <div class="featurette">
			<img class="featurette-image pull-left" src="bootstrap/docs/assets/img/examples/browser-icon-firefox.png">
			<h2 class="featurette-heading">What sets us apart. <span class="muted">Seriously.</span></h2>
			<p class="lead">Our specialty is helping you integrate 3D printing to your business at an appropriate level of cost and commitment, applying this technology to create new products, broaden your offering, or simplify your supply chain. We do this by offering a range of services from custom parts to in-house 3d printing systems and software.</p>
		  </div>

		  <hr class="featurette-divider">

		  <div class="featurette">
			<img class="featurette-image pull-right" src="bootstrap/docs/assets/img/examples/browser-icon-safari.png">
			<h2 class="featurette-heading">Support<span class="muted">?</span></h2>
			<p class="lead">Our goal is to make the process of 3d Printing, from content to fabrication, as simple and intuitive as possible. We are here to walk you through every step of the process and make sure you are getting the exact pieces you want.</p>
			<p class=lead>If you have any questions or problems please conact <b>support@piecemaker.com</b> or call support hotline: <b>(786) 897-4771</b></p>
		  </div>

		  <hr class="featurette-divider">

		  <div class="featurette">
			<img class="featurette-image pull-left" src="images/social_sprite2.png">
			<h2 class="featurette-heading">And lastly, this one. <span class="muted">Get in touch.</span></h2>
			<p class="lead">Like us or tweet about us.</p>
		  </div>

		  <!-- /END THE FEATURETTES -->

		</div><!-- /.container -->
		<?require_once("include/footer.php");?>
	</body>
</html>

