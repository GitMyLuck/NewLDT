<?php 
$sheet = $_POST['sheet'];
$index = $_POST['id'];
$didascalia = $_POST['didascalia'];
$nomefile = $_POST['nomefile'];
$ext = $_POST['extension'];
include 'php/db.inc.php';
$conn = new FUNCT();
$conn->doServer();
//pubblica didascalia nella tabella 
$error = $conn->updateDid($index, $sheet, $didascalia, $nomefile);

echo trim($nomefile . '.' . $ext);
?>