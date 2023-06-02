<?php
include "../php/db.inc.php";
$conf = new CONFIG();
// inserisci titolo
if (isset ($_POST['titolo']))
	{
$dato = $_POST['titolo']; 
$conf->doTitle($dato);
	}
// inserisci versione
if (isset ($_POST['versione']))
	{
$dato = $_POST['versione']; 
$conf->doVersione($dato);
	}
?>
