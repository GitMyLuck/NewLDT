<?php 
$sheet = $_GET['sheet'];
$function = 'varia';
include "php/db.inc.php";
$conn = new FUNCT();
$conn->doServer();
$tags = '';
$tags = $conn->prelevaTags($sheet); //deve essere array
$display = 'block';
$display_risul = 'block';
$introd = '<b>TAG DISPONIBILI</b>';

echo $introd . '<center><div id="elenco" class="elenco_tags" title="tags disponibili" style="display:' . $display . ';">';
$elenco = $conn->creaElencoTags($tags, 'Sub');
echo $elenco . '</div></center><br />';
echo 'ATTENZIONE : <br /> cliccando sul tag esso viene eliminato dall\'elenco dei tag disponibili per questa pagina.';

?>

<br /> <br /> 
<label>Inserisci nuovo tag: </label>
<center>
<form name="nuovo_tags" class="form_input" >	
<input class="text_input" id="tag" type="text" name="tag" title="" value="" />
<input class="buttons varia" type="button" value="invia"  onclick="spedisciTag($(this).parent());" />
</form>
<br /> <br /> 
