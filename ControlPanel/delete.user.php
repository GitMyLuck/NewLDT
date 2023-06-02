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
	include "php/secur_policy.php";
	$secur = new SECUR();
	include "php/db.inc.php";
	//attributi
	$index = $_POST['page'];
	$sessione = $_POST['login'];
	$sheet = '0_utenti';
	$upload = new FUNCT();
	$utenti = new UTENTE($sessione, true);
	$upload->doServer();
	// carica utente
	$utente = $utenti->prelevaUtenti($index, '');
	//numero di notizie posteriori OK
	$numNews = $upload->renumNews($index, $sheet);
	
	// elimina riga notizia dal database
	$sql = "DELETE FROM $sheet WHERE real_id = '$index' ";
	$upload->insertSql($sql);

	//da index+1 a index + $notizie_posteriori		= $i
	$start = ($index + 1);
	$end = ($index + $numNews);
	
	for ($i=$start; $i<=$end; $i ++)
		{
				// rinumerazione notizie su tabella FDB #487
			$new_id = $upload->rinumeraNotizie($i, $sheet);
		}
		
		$secur->creaCode($index, 'user');
		$get_tag = '?login=' . $secur->sec_sess . '&page=' . $secur->sec_news . '&sheet=' . $secur->sec_sheet;
?>

</body>
</html>