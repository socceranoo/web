<?PHP
	function add_people(){
		$people_arr = array( 
			array("fname"=>"Colin", "lname"=>"Wessels", "extn"=>"jpg", "post"=>"CEO and Founder"),
			array("fname"=>"", "lname"=>"Ali", "extn"=>"jpg", "post"=>"Sr Scientist"),
			array("fname"=>"Satyajit", "lname"=>"Phadke", "extn"=>"jpg", "post"=>"Scientist"),
			array("fname"=>"Joe", "lname"=>"Miller", "extn"=>"jpg", "post"=>"Sr Engineer"),
			array("fname"=>"Camilo", "lname"=>"Cabrera", "extn"=>"jpg", "post"=>"Intern"),
			array("fname"=>"Fname4", "lname"=>"Lname4", "extn"=>"jpg", "post"=>"Intern")
		);
		$i=0;
		foreach ($people_arr as $person) {
			$firstname = $person["fname"];
			$lastname = $person["lname"];
			$extn = $person["extn"];
			$post = $person["post"];
			$image = "images/people/".$firstname."_".$lastname.".".$extn;
			echo "<li id=person$i><img id=ic$i src=$image class='person-img img-circle img-polaroid'/><div id=tg$i class=textgroup><h2>$firstname $lastname</h2><h4>$post</h4></div></li>";
			$i++;
		}
	}
?>
<ul id=people-container class="well inline text-center">
	<?add_people();?>
	<!--
	<li id=person1"><img id=ic1 class="img-circle img-polaroid" /><div id=tg1 class="textgroup"><h2></h2><h4></h4></div></li>
	<li id=person2"><img id=ic2 class="img-circle img-polaroid" /><div id=tg2 class="textgroup"><h2></h2><h4></h4></div></li>
	<li id=person3"><img id=ic3 class="img-circle img-polaroid" /><div id=tg3 class="textgroup"><h2></h2><h4></h4></div></li>
	<li id=person4"><img id=ic4 class="img-circle img-polaroid" /><div id=tg4 class="textgroup"><h2></h2><h4></h4></div></li>
	<li id=person5"><img id=ic5 class="img-circle img-polaroid" /><div id=tg5 class="textgroup"><h2></h2><h4></h4></div></li>
	-->
</ul>
