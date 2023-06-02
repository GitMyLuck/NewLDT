<?php 
$tipo = $_GET['color-type'];
include "../db.inc.php";
$config = new CONFIG();
$config->doServer();
$res = $config->defaultColor($tipo);
echo $res; 
?>