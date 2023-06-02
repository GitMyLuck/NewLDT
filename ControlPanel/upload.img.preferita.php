<?php 
include 'php/db.inc.php';
$conn = new FUNCT();
$conn->doServer();
$nomefile = $_GET['nomefile'];
$index = $_GET['id']; 		//real_id
$sheet = $_GET['sheet'];
//exit(var_dump($nomefile)); 
$error = $conn->cambiaPreferita($index, $nomefile, $sheet);
//echo $error;

?>