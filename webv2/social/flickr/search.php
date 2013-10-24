<?PHP
ini_set('display_errors', 1);
require_once 'Flickr/API.php';
# create a new api object
$api =& new Flickr_API(array('api_key'=>'085d575ce3323bf92397e48fa92e5766','api_secret'=>"2e556fef571dc18f"));

$retval = "";
$info = "";
$query = "ivanovic";
if (isset($_POST['query'])) {
	$query = $_POST['query'];
}

# call a method
$query = preg_replace("!\s+!", ",", $query);
$response = $api->callMethod('flickr.photos.search', array('tags' =>$query, 'per_page'=>10));

# check the response

if ($response){
	$retval = "<ol>";
	foreach($response->children[1]->children as $photo) { 
		// the image URL becomes somthing like 
		// http://farm{farm-id}.static.flickr.com/{server-id}/{id}_{secret}.jpg  
		$attr = $photo->attributes;
		if (count($attr)) {
			$retval .= '<li><img src="' . 'http://farm' . $attr["farm"] . '.static.flickr.com/' . $attr["server"] . '/' . $attr["id"] . '_' . $attr["secret"] . '_q.jpg" /></li>'; 
		}
	}
	$retval .= "</ol>";
	# response is an XML_Tree root object
}else{
	# fetch the error
	$code = $api->getErrorCode();
	$message = $api->getErrorMessage();
	//print $code.$message;
}
$arr = array("retval"=>$retval, "info"=>$info);
echo json_encode($arr);
?>
