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
		//header("location: index.php");
	}
//------------ S I C U R E Z Z A ---------------//
	include "php/db.inc.php";
	$fotos = array();
	//attributi
	$index = $_GET['page'];
	$sheet = $_GET['sheet'];
	$type = $_GET['type'];
	$upload = new FUNCT();
	$destroy = new NEWS();
	$upload->doServer();
	$return = $upload->contaNews($sheet);		//conta le notizie effettive per il ritorno
	//CERCA IMMAGINE/I IN TABELLA
	$fotos = $upload->searchMultiImage($index, $sheet, $type);
	for ($i = 1; $i <= count($fotos); $i++)
	
		{
			$file = 'php/immagini_' . $sheet . '/' . $fotos[$i]['filename'];
				if ($type == 'pdf')
					{
						$file = 'php/pdf_' . $sheet . '/' . $fotos[$i]['filename'];
					}
			$file .= '.' . $fotos[$i]['ext'];
			//exit(var_dump($file)); 
			$destroy->desFile($file);
			// se e' file immagine elimina anche thumb
			if ($type == 'img')
				{
					$file = 'php/immagini_' . $sheet . '/thumb/' . $fotos[$i]['filename'] . '-thumb.' . $fotos[$i]['ext'];
					$destroy->desFile($file);
				}

		}
	$upload->delImage($index, $sheet, $type);
	$load = "location: main-nuovo.php?login=" . $sessione;
	$load .="&page=" . $return;		//($return = ultima notizia)
	$load .="&sheet=" . $sheet;
	
		//header($load);
?>
</body>
</html>