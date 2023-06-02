<?php 

include "../db.inc.php";
$config = new CONFIG();
$config->doServer();
$perc = $config->getDefaultPerc();
$res = $config->setPerc($perc);
echo $perc; 

?>