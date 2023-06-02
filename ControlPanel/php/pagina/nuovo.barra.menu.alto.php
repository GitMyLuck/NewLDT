<?php 
echo '<div id="content_tastiera"><center>
	<div class="tastiera"><input id="btn_conferma" class="ok menu_button" name="btn_conferma" type="button" value="" onclick="inviaNotizia();"><br>&nbsp;</div>
	
	<div class="tastiera"><input id="btn_indietro" class="back menu_button" name="btn_indietro" type="button" value="" onclick="annullaIns(false);"><br>&nbsp;</div>';

// TASTO APRI BOX
echo '<div class="tastiera">
	<input class="maximize" name="expand" type="button" value="" onclick="apriBox();" title="espandi"><br>&nbsp;</div>';	
	
echo '	</center>
	</div>';
	// ultimo div chiude il content tastiera
	
?>