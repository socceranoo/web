<?php
// load Zend classes
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Rest_Client');

// define search query
$query = 'Michaelangelo';
if (isset($_POST['query'])) {
	$query = $_POST['query'];
}
$retval = array();
$info = $query;

try {
	// initialize REST client
	$wikipedia = new Zend_Rest_Client('http://en.wikipedia.org/w/api.php');
	// set query parameters
	$wikipedia->action('query');
	$wikipedia->list('search');
	$wikipedia->srwhat('text');
	$wikipedia->format('xml');
	$wikipedia->srsearch($query);

	// perform request
	// iterate over XML result set
	$result = $wikipedia->get();
} catch (Exception $e) {
    die('ERROR: ' . $e->getMessage());
}
//$retval .= "<ol>";
foreach ($result->query->search->p as $r):
	$title = $r['title'];
	$snippet = $r['snippet'];
	//$retval .= "<li><a href='http://www.wikipedia.org/wiki/$title'>$title</a><br/><small>$snippet</small></li>";
	array_push($retval, $r);
endforeach;
//$retval .= "</ol>";
$arr = array("retval"=>$retval, "info"=>$info);
echo json_encode($arr);
