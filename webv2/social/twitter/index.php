<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');
require_once('access_token.php');

/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/
$data ='friends/list';
$data ='statuses/home_timeline';
$data ='search/tweets';
$type = '.json';
$count = 1;
$screen_name = "socceranoo";

$url = 'https://api.twitter.com/1.1/';
$url = $url.$data;
$url = $url.$type;
//$getfield = "?screen_name=$screen_name&count=$count";
$getfield = "?q=chelsea&count=10&result_type=popular";
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$result = $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();
$json_arr = json_decode($result);
//print count($json_arr);
//print var_dump($json_arr);
print "<ul>";
foreach ($json_arr->statuses as $temp) {
	$sname = $temp->user;
	$sname = $sname->screen_name;
	print "<li>$temp->text by @ $sname</li>";
}
print "</ul>";
/*
*/
?>
