<!DOCTYPE html> 
<html> 
<head> 
<style type="text/css">
span {
			color: #fb8b04;
		}
#ris_ricerca {
			border: 1px solid #999;
			border-radius: 3px;
			background: #c9c9c9;
			width: 100%;
			height: 60px;
			text-align: center;
			color: #666;
			}
</style> 
</head>
<body> 
<?php
@session_start();
$sessione = @session_id();
$admin = $_SESSION['admin'] ;
include 'db.inc.php';
$conn = new UTENTE($sessione, true);
$conn->doServer();
$sheet = '0_utenti';
$index = $_GET['index'];
$search = '';
if (isset ($_GET['search']) && ($_GET['search'] != 'undefined'))
	{
		$search = $_GET['search'];
	}
echo $search;
$results = $conn->prelevaUtenti($index, $search);
$num_utenti = $conn->num_utenti; // utenti memorizzati in array
$utenti = $conn->utenti;
if ($num_utenti == 0)
	{
		echo '&nbsp; &nbsp; &nbsp; NESSUN DATO <br />';
	}
if ($search != '')
	{
		//scrivi la parola che hai cercato prima dell'elenco deio risultati
		echo '<div id="ris_ricerca">Risultati della ricerca di  <center><b>" ' . $search . ' "</b></center>';
		$risposta = 'trovati ' . $num_utenti . ' titoli :<br /> </div>';
		$num_utenti == 1 ? $risposta = 'trovato un solo titolo :<br /> ' : $risposta;
		$num_utenti == 0 ? $risposta = 'nessun titolo trovato...<br /> ' : $risposta;
		echo $risposta;
	}
	
for ($m = 1; $m <= $num_utenti; ++$m) 
	{

			$nome = $utenti[$m]['nome'];
			$token = $utenti[$m]['token'];
			$sostituto = '<span>' . $search . '</span>';
			$nuovo_testo = str_ireplace($search, $sostituto , $nome);
			$real_id = $utenti[$m]['id'];
			$id = $utenti[$m]['num'];
			if ($id == $index) 
				{ 
					echo '<div class="selected" title="' . $utenti[$m]['nome'] . '">' . $id . ' - ' . $nuovo_testo . '</div>';
				}
			else  
				{
					$load = 'pseudo.main-user.php?login=' . $sessione;
					$load .='&page=' . $id . '&sheet=' . $sheet;
					echo '<div class="unselected" title="' . $utenti[$m]['nome'] . '" onclick="location.href = \'' . $load . '\';">' . $id . ' - ' . $nuovo_testo . '</div>';
				}			//end IF-ELSE
			
			
	}			//end FOR CICLE
			

		
		for ($i = 1; $i <= 13; $i++)
			{
				echo '<div class="spacer">&nbsp; </div>';
			}
		//echo var_dump($utenti); 

?>

