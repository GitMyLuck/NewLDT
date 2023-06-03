<?php 
$secur->creaCode($index, $sheet);
$get_tag = '?login=' . $secur->sec_sess . '&page=' . $secur->sec_news . '&sheet=' . $secur->sec_sheet;
echo '<div id="content_tastiera"><center>
	
	<div class="tastiera"><input id="btn_conferma" class="ok menu_button" name="btn_conferma" type="button" value="" onclick="salvaUser(\'' . $max_id . '\');" title="salva"><br>&nbsp;</div>';


// TASTO APRI BOX
echo '<div class="tastiera">
	<input class="maximize" name="expand" type="button" value="" onclick="apriBox();" title="espandi"><br>&nbsp;</div>';

//  	TASTO  INDIETRO
echo '<div class="tastiera"><input id="btn_indietro" class="back" name="btn_indietro" type="button" value="" onclick="javascript:location.href = \'main-user.php' . $get_tag . '\';" title="torna indietro"><br>&nbsp;</div>';	
	
echo '	</center>
	</div>';
	// ultimo div chiude il content tastiera
	
?>