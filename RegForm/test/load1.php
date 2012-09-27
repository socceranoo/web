<?PHP
$array = unserialize($_POST['hidArray']);
foreach ($array as $k)
        echo $k; 
?>
