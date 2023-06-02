<?php
$secur->creaCode($index, $sheet);
$get_tag = '?login=' . $secur->sec_sess . '&page=' . $secur->sec_news . '&sheet=' . $secur->sec_sheet; 
echo '<div id="content_tastiera"><center>';

	//aggiungi nuovo evento
	$tipo = 'utente';


		// TASTO APRI BOX
		echo 	'<div class="tastiera">
				<input class="maximize" name="expand" type="button" value="" onclick="apriBox();" title="espandi"><br>&nbsp;</div>';
				
		// TASTO INDIETRO		
		echo 	'<div class="tastiera">
				<input class="out" name="indietro" type="button" title="torna a pagina principale" value="" onclick="javascript:location.href = \'pseudo.main.php?login=' . $sessione . '&page=1&sheet=eventi\';"><br>&nbsp;</div>';

		echo '</div></center></div>';
	// ultimo div chiude il content tastiera
?>