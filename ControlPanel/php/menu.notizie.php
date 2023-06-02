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
$connection = new FUNCT();
$connection->doServer();
$sheet = $_GET['sheet'];
$index = $_GET['index'];
$data_odierna = date ("d/m/Y");
$search = '';
if (isset ($_GET['search']) && ($_GET['search'] != 'undefined') && ($_GET['search'] != 'serdab') && ($_GET['search'] != 'nefer'))
	{
		$search = $_GET['search'];
	}

$data_evento = '';
$funct = 'showData';
$connection->{$funct}($sheet, $search);	//recupera i titoli degli eventi
																//anche con $search
$date_eventi = $connection->date;		//sono memorizzati in array
$num_notizie = $connection->num_news;
//$tasto_search = tastoSearch($admin);
//echo $tasto_search;
if ($num_notizie == 0)
	{
		echo '&nbsp; &nbsp; &nbsp; nessun dato presente...';
	}
if ($search != '')
	{
		//scrivi la parola che hai cercato prima dell'elenco deio risultati
		echo '<div id="ris_ricerca">Risultati della ricerca di  <center><b>" ' . $search . ' "</b></center>';
		$risposta = 'trovati ' . $num_notizie . ' titoli :<br /> </div>';
		$num_notizie == 1 ? $risposta = 'trovato un solo titolo :<br /> ' : $risposta;
		$num_notizie == 0 ? $risposta = 'nessun titolo trovato...<br /> ' : $risposta;
		echo $risposta;
	}
for ($m = 1; $m <= $num_notizie; ++$m) 
	{
			if ($sheet == 'eventi')
				{
					$data_evento = ' - ' . $date_eventi[$m]['data_evento'] . ' - ';
				}
			
				
			$testo = $date_eventi[$m]['titolo'];
			$sostituto = '<span>' . $search . '</span>';
			$nuovo_testo = str_ireplace($search, $sostituto , $testo);
			$real_id = $date_eventi[$m]['real_id'];
		if ($sheet == 'eventi')
			{
			if ($date_eventi[$m]['real_id'] == $index) 
				{ 
					echo '<div class="selected" title="' . $date_eventi[$m]['titolo'] . '">' . $real_id . $data_evento . $nuovo_testo. '</div>';
				}
			else
				{
					$load = "pseudo.main.php?login=" . $sessione;
					$load .="&page=" . $date_eventi[$m]['real_id'] . '&sheet=' . $sheet;
					echo '<div class="unselected" title="' . $date_eventi[$m]['titolo'] . '" onclick="location.href = \'' . $load . '\';">' . $real_id . $data_evento . $nuovo_testo . '</div>';
				}			//end IF-ELSE
			}		//end if visualizzazione per pagina eventi
		else
			{
			if ($date_eventi[$m]['real_id'] == $index) 
				{ 
					echo '<div class="selected" title="' . $date_eventi[$m]['titolo'] . '">' . $real_id . ' - ' . $nuovo_testo . $data_evento .'</div>';
				}
			else if ($date_eventi[$m]['real_id'] != $index && $m != $num_notizie)
				{
					$load = "pseudo.main.php?login=" . $sessione;
					$load .="&page=" . $date_eventi[$m]['real_id'] . '&sheet=' . $sheet;
					echo '<div class="unselected" title="' . $date_eventi[$m]['titolo'] . '" onclick="location.href = \'' . $load . '\';">' . $real_id . ' - ' . $nuovo_testo . $data_evento . '</div>';
				}
			else 
				{
					$load = "pseudo.main.php?login=" . $sessione;
					$load .="&page=" . $date_eventi[$m]['real_id'] . '&sheet=' . $sheet;
					echo '<div id="last" class="unselected" title="' . $date_eventi[$m]['titolo'] . '" onclick="location.href = \'' . $load . '\';">' . $real_id . ' - ' . $nuovo_testo . $data_evento . '</div>';
				
				}//end IF-ELSE
			}		//end of else visualizzazione altra pagina
	}			//end FOR CICLE
			

		
		for ($i = 1; $i <= 13; $i++)
			{
				echo '<div class="unselected">&nbsp; </div>';
			}

			function tastoSearch($admin)
				{
					$tasto_search = '';
	if ($admin < 3)
			{
				$tasto_search .= '<div id="search_titoli">';
				$tasto_search .= '<div class="search_title">'; 
				/*//DATE BUTTON
				$tasto_search .= '<input id="date_button" class="current buttons" type="button" value="" title="refresh elenco" style="width: 40px;" >';*/
				$tasto_search .= '<input id="refresh_button" class="refreshing buttons" type="button" value="" title="refresh elenco" style="width: 40px;" >';
				//		INPUT  TEXT
				$tasto_search .= '&nbsp;<input id="search_index" class="text_input" name="" type="text" value="" style="width: 110px;">';
				//		SEARCH  BUTTON
				$tasto_search .= '&nbsp;<input id="search_button" class="searching buttons" name="" type="button" value=""  title="cerca nell\'elenco" style="width: 40px;" ></div></div>';

			}
	return $tasto_search;
				}
?>

</body>
</html>

