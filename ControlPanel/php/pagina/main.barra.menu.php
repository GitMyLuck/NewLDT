<?php
$secur->creaCode($index, $sheet);
$get_tag = '?login=' . $secur->sec_sess . '&page=' . $secur->sec_news . '&sheet=' . $secur->sec_sheet;
echo '<div id="content_tastiera"><center>';
$tipo = $sheet;
$sheet == 'strutture'?$tipo = 'struttura':$tipo;
$sheet == 'eventi'?$tipo = 'evento':$tipo;
if ($admin < 2) //SOLO ADMINISTRATOR E SUPER-USER
	{

	//TASTO NUOVO
	echo	'<div class="tastiera">
	<input class="add" name="nuovo" type="button" value="" onclick="javascript:location.href = \'main-nuovo.php?login=' . $sessione . '&page=new&sheet=' . $sheet . '\';" title="aggiungi ' . $tipo . '"><br>&nbsp;</div>';
	}
	// TASTO MODIFICA
	echo '<div class="tastiera">
	<input class="edit" name="modifica" type="button" value="" onclick="javascript:location.href = \'main-varia.php' . $get_tag . '\';" ' . $stato . ' title="modifica ' . $tipo . '"><br>&nbsp;</div>';


if ($admin < 2) //SOLO ADMINISTRATOR E SUPER-USER
	{
	//TASTO ELIMINA	
	echo '<div class="tastiera">
	<input class="delete" name="elimina" type="reset" value="" onclick="doConferma(' . $index . ', \'' . $sessione . '\', \'' . $sheet . '\');" ' . $stato . ' title="elimina ' . $tipo . '"><br>&nbsp;</div>';
	}
	
	if ($admin < 2) //SOLO ADMINISTRATOR

	{
		
		//TASTO ESPORTA
		/*if ($sheet == 'eventi')
			{
		echo '<div class="tastiera">
		<input class="export" name="export" type="reset" value="" onclick="location.href = \'../ControlPanel/exports/export.csv.php\';" title="esporta pdf"><br>ESPORTA</div>';
		
			}*/
		//TASTO AGGIUNGI user_error
		/*if ($sheet == 'strutture')
			{
		echo '<div class="tastiera">
		<input class="adduser" name="new_user" type="reset" value="" onclick="alert ();" title="aggiungi nuovo user"><br />NUOVO USER</div>';
			}*/


	}

		// TASTO APRI BOX
		echo '<div class="tastiera">
			<input class="maximize" name="expand" type="button" value="" onclick="apriBox();" title="espandi"><br>&nbsp;</div>';

		//TASTO LOG-OUT
		echo '<div class="tastiera"><input class="out" name="log_out" type="reset" value="" onclick="javascript:location.href = \'index.php\';" title="esci"><br>&nbsp;</div>';
	
	if ($admin < 2) //SOLO ADMINISTRATOR

	{
		echo '<div class="tastiera">
		<input class="menu" name="menu" type="button" value="" onclick="apriMenu();" title="menu"><br />&nbsp;</div>';

	}
		
	echo '</div></center></div>';
	// ultimo div chiude il content tastiera
?>