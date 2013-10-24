<?PHP 
	$result = $fgmembersite->RunQuery("SELECT * FROM $pairtable WHERE user1='$uname' or user2='$uname'");
	$stack = array();
	while($row = mysql_fetch_array($result)) {  
		if ($row['user1'] == $uname)
		array_push($stack, $row['user2']);
		else if($row['user2'] == $uname)
		array_push($stack, $row['user1']);
	}
	sort($stack);
	function echoActiveClassIfRequestMatches($requestUri) {
		$active_class_str = "active";
		$current_file_name = basename($_SERVER['REQUEST_URI'], ".php");
		echo "$current_file_name\n";
		echo "$requestUri\n";
		if ($requestUri == "index" && $current_file_name == "money") {
			echo "class=$active_class_str";
			return;
		}
		if ($current_file_name == $requestUri)
			echo "class=$active_class_str";
	}
?>
		<!-- NAVBAR
		================================================== -->
		<div class="navbar-wrapper">
			<!-- Wrap the .navbar in .container to center it within the absolutely positioned parent. -->
			<div class="navbar navbar-fixed-top navbar-inverse" >
				<div class="navbar-inner">
					<div class="container">
					<!-- Responsive Navbar Part 1: Button for triggering responsive navbar (not covered in tutorial). Include responsive CSS to utilize. -->
						<a type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</a>
						<a class="brand" href="#biglogo" data-toggle=modal ><img src="images/shopify-bag.png" alt="" /></a>
						<a class="brand" href="index.php">Money Matters</a>
						<!-- Responsive Navbar Part 2: Place all navbar contents you want collapsed withing .navbar-collapse.collapse. -->
						<div class="nav-collapse collapse">
							<ul class="nav">
								<li <?echoActiveClassIfRequestMatches("index")?> ><a href="index.php">Summary</a></li>
								<li <?echoActiveClassIfRequestMatches("add-friend")?> ><a href="add-friend.php">Add Friend</a></li>
								<li <?echoActiveClassIfRequestMatches("add-bill-payment")?> ><a href="add-bill-payment.php">Add Bill</a></li>
								<li <?echoActiveClassIfRequestMatches("view-transactions.php?page=new")?> ><a href='view-transactions.php?page=new'>Current Bills</a></li>
								<li <?echoActiveClassIfRequestMatches("view-transactions.php")?>><a href='view-transactions.php'>Deleted Bills</a></li>
								<!--
								-->
								<li class="dropdown">
								<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown"><? echo $uname;?><b class="caret"></b></a>
									<ul class="dropdown-menu text-left">
										<li><a href='/home.php'>home</a></li>
										<li><a href='/account-info.php'>account</a></li>
										<li class="divider"></li>
										<li><a href='/logout.php'>logout</a></li>
									</ul>
								</li>
							</ul>
						</div><!--/.nav-collapse -->
					</div> <!-- /.container -->
				</div><!-- /.navbar-inner -->
			</div><!-- /.navbar -->

		</div><!-- /.navbar-wrapper -->
		<hr class="featurette-divider" />


	<div class="container"> 
		<div id="biglogo" class="modal hide fade out background-white" style="display: none;">   
			<div class="modal-header text-center">   
				<a class="close" data-dismiss="modal">×</a>   
				<h3>Money Matters</h3> 
			</div>   
			<div class="modal-body text-center">   
				<img style="height:400px;width:400px;" src="images/shopify-bag.png" alt="" />   
			</div>   
			<div class="modal-body text-center">   
				<h4 class="btn btn-danger" data-dismiss="modal">Close</h4> 
			</div>   
		</div>   
	</div>
