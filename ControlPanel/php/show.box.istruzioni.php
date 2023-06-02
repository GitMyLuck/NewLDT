<?php 
error_reporting(E_ALL);
$dir = "istruzioni/it/box/";
$testo = file_get_contents($dir. 'strutture.dati.txt');

echo $testo;

?>