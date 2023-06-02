<?php 
include "../db.inc.php";
$set = new CONFIG();
$set->doServer();
$tema = $_POST['tema'];
$elimina = $set->eliminaRiga();
$results = $set->nuovaRiga($tema);
// in questo caso modifica template e copialo in icone.temp.css
echo $elimina . '<br /> ' . $results;
?>