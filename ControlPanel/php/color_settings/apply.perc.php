<?php 
$perc = $_POST['perc'];
include "../db.inc.php";
$config = new CONFIG();
$config->doServer();
$res = $config->setPerc($perc);
echo $res; 

?>