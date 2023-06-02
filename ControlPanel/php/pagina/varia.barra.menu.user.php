<?php
$secur->creaCode($index, $sheet);
$get_tag = '?login=' . $secur->sec_sess . '&page=' . $secur->sec_news . '&sheet=' . $secur->sec_sheet;
echo '<div id="content_tastiera"><center>';

// TASTO INDIETRO 
		echo '<div class="tastiera"><input class="back" name="indietro" type="button" value="" onclick="javascript:location.href = \'main-user.php' . $get_tag . '\';" title="torna indietro"><br>&nbsp;</div>';

// TASTO APRI BOX
		echo '<div class="tastiera">
			<input class="maximize" name="expand" type="button" value="" onclick="apriBox();" title="espandi"><br>&nbsp;</div>';

// TASTO LOG-OUT			
		echo '<div class="tastiera"><input class="out" name="log_out" type="reset" value="" onclick="javascript:location.href = \'pseudo.main.php?login=' . $sessione . '&page=1&sheet=' . $sheet . '\';" title="esci da gestione utenti"><br>&nbsp;</div>
	
	</div></center></div>';
	// l'ultimo div chiude content_tastiera
?>