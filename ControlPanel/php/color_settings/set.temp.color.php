<?php
include "../db.inc.php";
	$conf = new CONFIG();
	$conf->doServer();  
	$data = explode(",", $_POST['data']);
	$Div = $data[0];
	//   div_contenitore es.:  general_back
	$color = substr($data[1], 1);
	//	colore assegnato es.:  #898989  ->  898989
	$type = $data[2];
	//	tipo di attributo_css es.: background
	$error = $conf->setNewColor($Div, $color, 'temp');
	echo $error;
	//exit(var_dump($data)); 
?>  
