<?php 
include "../db.inc.php";
$set = new CONFIG();
$set->doServer();
$nome = $_POST['nome'];
$results = $set->nuovaRiga('temp', $nome);
//bisogna salvare anche cartella icone e icone.css
echo $results;
?>