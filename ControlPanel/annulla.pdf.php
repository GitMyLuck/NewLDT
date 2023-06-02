<?php 
header('Content-type: text/html;charset=utf-8');
			@session_start();
			$sessione = @session_id();
?>
<html> 
<head>
</head>
<body>
<?php
//------------ S I C U R E Z Z A ---------------// 
if(!isset($_GET['login']) || $_GET['login'] != $sessione || !isset($_GET['page']))
	{
		header("location: index.php");
	}
//------------ S I C U R E Z Z A ---------------//
	include "php/db.inc.php";
	//attributi
	$index = $_GET['page'];
	$sheet = $_GET['sheet'];
	$type = 'pdf';
	$upload = new FUNCT();
	$upload->doServer();
	$return = $upload->contaNews($sheet);		//conta le notizie effettive per il ritorno
	//CERCA IMMAGINE IN TABELLA
	$isImage = $upload->searchImage($index, $sheet, $type);
	//$isImage; [0] non esiste [>0] esiste
	if ($isImage > 0)
		{
			$destroi = new NEWS();
			$file = 'immagini_' . $sheet . '/' . $upload->row['filename'];
			$file .= '.' . $upload->row['ext'];
			$destroi->desFile($file);
			$upload->delImage($index, $sheet, $type);
		}
	$load = "location: main-nuovo.php?login=" . $sessione;
	$load .="&page=" . $return;		//($return = ultima notizia)
	$load .="&sheet=" . $sheet;
	
		header($load);
?>

</body>
</html>