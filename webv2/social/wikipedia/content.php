<?php
ini_set('display_errors', 1);
// load Zend classes
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Rest_Client');

// define page title
$query = isset($_POST['page'])? $_POST['page']:"Caffeine";
//$query = isset($_REQUEST['dest'])? $_REQUEST['dest']:"Caffeine";
try {
  // initialize REST client
  $wikipedia = new Zend_Rest_Client('http://en.wikipedia.org/w/api.php');

  // set query parameters
  $wikipedia->action('parse');
  $wikipedia->prop('text');
  $wikipedia->format('xml');
  $wikipedia->page($query);

  // perform request
  // get page content as XML
  $result = $wikipedia->get();
  $content = $result->parse->text;
} catch (Exception $e) {
    die('ERROR: ' . $e->getMessage());
}
$arr = array("retval"=>$content, "info"=>"asdasd");
echo json_encode($arr);
?>
