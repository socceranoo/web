<?php
// load Zend classes
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Rest_Client');

// load wikitext converter
require_once 'Text/Wiki.php';

// instantiate a Text_Wiki object from the given class
// and set it to use the Mediawiki adapter
$wiki = & Text_Wiki::factory('Mediawiki');

// set some rendering rules  
$wiki->setRenderConf('xhtml', 'wikilink', 'view_url', 'http://en.wikipedia.org/wiki/');
$wiki->setRenderConf('xhtml', 'wikilink', 'pages', false);
  
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
  /*
  $wikipedia->format('json');
  $wikipedia->action('query');
  $wikipedia->prop('revisions');
  $wikipedia->rvprop('content');
  $wikipedia->format('xml');
  $wikipedia->redirects('1');
  $wikipedia->titles($query);
  */

  // perform request
  // get page content as XML
  $result = $wikipedia->get();
  $content = $result->parse->text;
} catch (Exception $e) {
    die('ERROR: ' . $e->getMessage());
}
?>
<?php echo $content; ?>
<?php //echo $wiki->transform($content, 'xhtml'); ?>
