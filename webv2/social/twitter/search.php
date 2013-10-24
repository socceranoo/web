<?php
ini_set('display_errors', 1);
require_once('TwitterAPIExchange.php');
require_once('access_token.php');
$retval = array(); 
$info = "";
/** Perform a GET request and echo the response **/
/** Note: Set the GET field BEFORE calling buildOauth(); **/
$count = 20;
$result_type = "mixed";
$result_type = "popular";
$query = isset($_POST['query'])?$_POST['query']:'ana ivanovic';
$query = isset($_REQUEST['query'])?$_REQUEST['query']:'ana ivanovic';
$count = isset($_REQUEST['count'])?$_REQUEST['count']:$count;
$result_type = isset($_REQUEST['type'])?$_REQUEST['type']:$result_type;
$data ='search/tweets';
$type = '.json';
$screen_name = "socceranoo";

$url = 'https://api.twitter.com/1.1/';
$url = $url.$data;
$url = $url.$type;
$encoded_query = rawurlencode($query);
$getfield = "?q=$encoded_query&count=$count&result_type=$result_type&lang=en";
//$getfield = "?screen_name=$screen_name&count=$count&result_type=$result_type";
$requestMethod = 'GET';
$twitter = new TwitterAPIExchange($settings);
$result = $twitter->setGetfield($getfield)->buildOauth($url, $requestMethod)->performRequest();
$json_arr = json_decode($result);
//$retval = "<ol>";
foreach ($json_arr->statuses as $temp) :
	//$sname = $temp->user;
	//$sname = $sname->screen_name;
	//$retweet_count = $temp->retweet_count;
	array_push($retval, array("user"=>$temp->user->screen_name, "retweet_count"=>$temp->retweet_count, "tweet"=>$temp->text));
	//$retval .= "<li>$temp->text by @ $sname <br/>Retweeted $retweet_count times.</li>";
endforeach;
//$retval .="</ol>";
//print count($json_arr);
//print var_dump($json_arr);
/*
print "<ul>";
foreach ($json_arr->users as $temp) {
	print "<li>$temp->name</li>";
}
print "</ul>";
$retval = var_dump($json_arr);
*/
$arr = array("retval"=>$retval, "info"=>$info);
echo json_encode($arr);
?>
