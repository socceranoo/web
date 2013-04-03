<?php

	require_once 'tinysong.php';
	
	$api_key = '31b0d942bce7417f006b4a4fe543de76';
	
	$query = $_GET['query'];
	
	$tinysong = new Tinysong($api_key);
	
	$result = $tinysong
	            ->single_tinysong_metadata($query)
	            ->execute();
	
	echo $_GET['callback'] . "(" . json_encode($result) . ");";

?>
