<?php
// load Zend classes
require_once 'Zend/Loader.php';
Zend_Loader::loadClass('Zend_Rest_Client');

// define search query
$query = 'Ana ivanovic';

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
?>
<html>
  <head></head>
  <body>
    <h2>Search results for '<?php echo $query; ?>'</h2>
    <ol>
    <?php foreach ($result->query->search->p as $r): ?>
      <li><a href="http://www.wikipedia.org/wiki/
        <?php echo $r['title']; ?>">
        <?php echo $r['title']; ?></a> <br/>
      <small><?php echo $r['snippet']; ?></small></li>
    <?php endforeach; ?>
    </ol>
  </body>
</html>
