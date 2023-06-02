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
//------------S I C U R E Z Z A ---------------// 
if(!isset($_GET['login']) || $_GET['login'] != $sessione || !isset($_GET['page']))
	{
		header("location: index.php");
	}
//------------S I C U R E Z Z A ---------------//
	include "php/db.inc.php";
	//attributi
	$index = $_GET['page'];
	$sheet = $_GET['sheet'];
	$upload = new FUNCT();
	$upload->doServer();
	// carica notizia
	$notizia = $upload->doNews($index, $sheet);
	//numero di notizie posteriori OK
	$numNews = $upload->renumNews($index, $sheet);
	$nome_file = array();		//array che conterra' i nomi dei file
								//immagini per eliminazione fisica

	$nome_file = $upload->doMultiImageNew($index, $sheet, 'img');
	$error = $upload->eliminaImmagini($nome_file, $sheet);
	//exit (var_dump($nome_file));
	// elimina riga notizia dal database
	$sql = "DELETE FROM $sheet WHERE real_id = '$index' ";
	$upload->insertSql($sql);
				
	// elimina riga immagine dal database
	$sql = "DELETE FROM `img_" . $sheet . "` WHERE id_notizia = '$index' ";
	$upload->insertSql($sql);

	// preleva record pdf dal database
	$sql = "SELECT `filename`, `ext` FROM `pdf_" . $sheet . "` WHERE id_notizia = '$index' ";
	$upload->sql($sql);

	// prepara link al file
	$pdf_name = 'php/pdf_' . $sheet . '/' . $upload->row['filename'];
	$pdf_name .= '.' . $upload->row['ext'];

	//elimina file pdf
	@unlink($pdf_name);

	// elimina riga pdf dal database
	$sql = "DELETE FROM `pdf_" . $sheet . "` WHERE id_notizia = '$index' ";
	$upload->insertSql($sql);

	//da index+1 a index + $notizie_posteriori		= $i
	$start = ($index + 1);
	$end = ($index + $numNews);
	
	for ($i=$start; $i<=$end; $i ++)
		{
				// rinumerazione notizie su tabella FDB #487
			$new_id = $upload->rinumeraNotizie($i, $sheet);
				// rinumerazione immagini su tabella FDB #501
			$upload->rinumeraImmagini($i, $sheet, $new_id);

		}
	// AGGIORNA TABELLA RACCOLTA DATI
	$sql = "SELECT news_del FROM raccolta_dati ";
	$upload->sql($sql);
	$del_news = $upload->row['news_del'];
	$del_news++;
	$sql = "UPDATE raccolta_dati SET news_del = '$del_news' ";
	$upload->insertSql($sql);	
		
		$load = "location: pseudo.main.php?login=" . $sessione;
		$load .="&page=1";			//ritorna alla main page notizia num 1
		$load .="&sheet=" . $sheet;
		header($load);
		
	
	
?>

</body>
</html>