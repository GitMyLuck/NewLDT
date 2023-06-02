<?php
echo '<center>';

	//TASTO NUOVO
	echo	'<div class="tastiera_example">
	<input class="add add_ex" name="nuovo" type="button" value=""  ><br>&nbsp;</div>';
	// TASTO MODIFICA
	echo '<div class="tastiera_example">
	<input class="edit edit_ex" name="modifica" type="button" value=""  ><br>&nbsp;</div>';

	//TASTO ELIMINA	
	echo '<div class="tastiera_example">
	<input class="delete delete_ex" name="elimina" type="reset" value="" ><br>&nbsp;</div>';
	
	// TASTO APRI BOX
	echo '<div class="tastiera_example">
	<input class="maximize maximize_ex" name="expand" type="button" value=""  title="espandi"><br>&nbsp;</div>';

	//TASTO LOG-OUT
	echo '<div class="tastiera_example"><input class="out out_ex" name="log_out" type="reset" value=""  title="esci"><br>&nbsp;</div>';
	
		
	echo '</center>';
	// ultimo div chiude il content tastiera
?>