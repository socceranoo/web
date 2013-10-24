<?php
// load Zend classes
ini_set("display_errors", 1);
// define search query
$query = isset($_POST['query'])?$_POST['query']:'tony hawk video';
$query = isset($_REQUEST['query'])?$_REQUEST['query']:'tony hawk video';
$count = isset($_REQUEST['count'])?$_REQUEST['count']:25;
$retval = array();
$info = $query;

$query = rawurlencode($query);
try {
	// initialize REST client
	/*
	$reddit = new Zend_Rest_Client("http://reddit.com/search.json");
	$reddit->q($query);
	$reddit->limit(10);
	// set query parameters
	// perform request
	// iterate over XML result set
	$result = $reddit->get();
	*/
	$json = file_get_contents("http://reddit.com/search.json?q=$query&limit=$count");
	$result = json_decode($json);
	//echo var_dump($result);
} catch (Exception $e) {
    die('ERROR: ' . $e->getMessage());
}
foreach ($result->data->children as $r):
	//echo $r->kind;
	//echo var_dump($r);
	$title = $r->data->title;
	$titlestr = $title;
	$media_arr = null;
	$score = $r->data->score;
	$ups = $r->data->ups;
	$downs = $r->data->downs;
	$desc = $r->data->selftext_html;
	$num_comments = $r->data->num_comments;
	if ($r->data->media) {
		$embed_url = $r->data->media->oembed->url;
		if ($r->data->media->type == "youtube.com") {
			parse_str(parse_url($r->data->media->oembed->url, PHP_URL_QUERY), $my_array_of_vars );
			$embed_url = "http://youtube.com/embed/".$my_array_of_vars['v']."?autoplay=1"; 
		}
		$media_arr = array("url"=>$embed_url, "thumbnail_url"=>$r->data->media->oembed->thumbnail_url);
	}
	$url = $r->data->url;
	array_push($retval, array("title"=>$titlestr, "description"=>$desc, "score"=>$score, "num_comments"=>$num_comments, "ups"=>$ups, "downs"=>$downs, "url"=>$url, "media"=>$media_arr));
endforeach;
$arr = array("retval"=>$retval, "info"=>$info);
echo json_encode($arr);
