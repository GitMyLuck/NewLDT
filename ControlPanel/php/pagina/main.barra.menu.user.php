<?php
$secur->creaCode($index, $sheet);
$get_tag = '?login=' . $secur->sec_sess . '&page=' . $secur->sec_news . '&sheet=' . $secur->sec_sheet; 
echo '<div id="content_tastiera"><center>';

	//aggiungi nuovo evento
	$tipo = 'utente';

		//TASTO NUOVO
		echo	'<div class="tastiera">
				<input class="add" name="nuovo" type="button" value="" onclick="javascript:location.href = \'main-nuovo-user.php' . $get_tag . '\';"><br>&nbsp;</div>';
		if ( $utente )
			{
		// TASTO MODIFICA
		echo 	'<div class="tastiera">
				<input class="edit" name="modifica" type="button" value="" onclick="javascript:location.href = \'main-varia-user.php' . $get_tag . '\';" ' . $stato . ' title="modifica ' . $tipo . '"><br>&nbsp;</div>';
			}
		if ($admin < 2 && $utente) //SOLO ADMINISTRATOR E SE ESISTE UTENTE

	{
		//TASTO ELIMINA	
		echo 	'<div class="tastiera">
				<input class="delete" name="elimina" type="reset" value="" onclick="doConfermaUser(' . $index . ', \'' . $sessione . '\');" ' . $stato . ' title="elimina ' . $tipo . '"><br>&nbsp;</div>';
	}

		// TASTO APRI BOX
		echo 	'<div class="tastiera">
				<input class="maximize" name="expand" type="button" value="" onclick="apriBox();" title="espandi"><br>&nbsp;</div>';
				
		// TASTO INDIETRO		
		echo 	'<div class="tastiera">
				<input class="out" name="indietro" type="button" title="torna a pagina principale" value="" onclick="javascript:location.href = \'pseudo.main.php?login=' . $sessione . '&page=1&sheet=eventi\';"><br>&nbsp;</div>';

		echo '</div></center></div>';
	// ultimo div chiude il content tastiera
?>