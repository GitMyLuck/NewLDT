<!DOCTYPE html> 
<html>
<head>
<?php 
$sheet = $_GET['sheet'];
$index = $_GET['id'];
$function = $_GET['funct'];
include "php/db.inc.php";
$conn = new FUNCT();
$conn->doServer();
$tags = '';
$tags = $conn->prelevaTags($sheet);
//exit(var_dump($tags)); 
$notizia = $conn->doNews($index, $sheet);//notizia caricata con il $_GET
//exit(var_dump($notizia)); 
$tag_risultato = $notizia['tags'];
?>
</head>
<body> 

<?php 
$display = 'block';
$display_risul = 'block';
$introd = 'TAGS DISPONIBILI <br />';
$introd_risul = 'TAGS AGGIUNTI<br />';
if ($function == 'mostra')
		{
			$display = 'none';
			$introd = ''; 
		}
else if ($function == 'nuovo')
		{
			$display = 'none';
			$introd = '';
			$display_risul = 'none';
			$introd_risul = '';
			echo 	'<p  style="position: relative; left: 10px;">
					ATTENZIONE: per inserire i tags <br /> 
					bisogna prima inserire la nuova <br /> 
					struttura, quindi, entrare in <br />
					variazione e inserire i TAGS.</p>';
		}
echo $introd . '<center><div id="elenco" class="elenco_tags" title="tags disponibili" style="display:' . $display . ';">';
$elenco = $conn->creaElencoTags($tags, 'Add');
echo $elenco . '</div></center><br />';
echo '&nbsp; &nbsp; &nbsp;' .  $introd_risul . '<center>'; 
echo '<div id="risultato" class="risultato_tags" title="tags" style="display:' . $display_risul . ';">';
$risultato = $conn->creaRisultatoTags($tag_risultato, $function);
echo $risultato . '</div></center><br />';
?>
</body>
</html>