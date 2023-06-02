<?php
$admin = $_SESSION['admin'];
//FAI PARTIRE IL CONTO DELLE PAGINE VISUALIZZATE DAL VALORE
//$start  SE ADMIN = SIMPLE USER FALLO PARTIRE DALLA PAGINA 2
//(PAGINA 'strutture')
//error_reporting(0);
$start = 1;
if ($admin > 2)
	{
		$start = 2;
	}
for ($i = $start; $i<=count($pagine); $i++)
{
	// IN QUESTO PUNTO ESEGUIRE CONTROLLO
	// SU UTENTE PER MOSTRARE O NO PAGINE
	//  PER CUI ESSO E' ABILITATO
	if ($pagine[$i] == $sheet)
		{
			echo '<div class="tasto_pagina" id="inattivo">' . $pagine[$i] . '</div>';
		}
	else
		{
	$href =  'pseudo.main.php?login=' . $sessione . '&page=1&sheet=' . $pagine[$i];
	
	echo '<div class="tasto_pagina" id="attivo" title="vai a ' . $pagine[$i] . '" onclick="location.href = \'' . $href . '\';">' . $pagine[$i] . '</div>';
		}

	
	if ($admin == 1 && $sheet == 'settings')
		{
	// GESTIONE SPECIALE LINGUETTA PAGINA SETTINGS
	$temp = '<a href="main-settings.php?login=' . $sessione . '&page=' . $index . '&sheet=settings"> 
	<div class="tasto_pagina" id="attivo" title="vai a settings">settings</div></a>';
	
		if ($sheet == 'settings')
			{
				$temp = '<div class="tasto_pagina" id="inattivo">settings</div>';
			}
	echo $temp;
		}
}

?>