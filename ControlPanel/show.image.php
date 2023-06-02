<html>
<head>
<style type="text/css">
		.posy {
			position: relative;
			top: -30px;
			}

		.no-btn {
			display: none;
			}

		#image {
			top: -20px;
			-moz-box-shadow: 0 0 3px 0 rgba(0,0,0,.6);
			-webkit-box-shadow: 0 0 3px 0 rgba(0,0,0,.6);
			box-shadow: 0 0 3px 0 rgba(0,0,0,.6);
			}
</style>

<?php
require_once "php/config.inc.php"; 
include "php/db.inc.php";
$index=$_GET['id'];
$sheet=$_GET['sheet'];
$type=$_GET['type'];
// preleva funzione pagina (mostra, varia, nuovo)
$funzione = '';
	if (isset ($_GET['funzione_pagina']))
		{
			$funzione = $_GET['funzione_pagina'];
		}
$conn2 = new FUNCT();
$conn2->doServer();
$conn2->doImage($index, $sheet, $type);
$ext = $conn2->row['ext'];
$immagine = $dir_cache . 'immagini_' . $sheet . '/';
if ($ext == 'pdf')
	{
		$immagine = $dir_cache . 'pdf_' . $sheet . '/';
	}
$immagine .= $conn2->row['filename'] . '.';
$immagine .= $conn2->row['ext'];
?>
</head>
<body>
<?php if($conn2->row['filename']):
// CASO IN CUI ESISTE UN FILE>>>>>>>>>>>>>>>>>>>>
// la variazione della notizia carica tutta la pagina
// ossia il div [image] e i pulsanti "nuova" ed "elimina"
$display = '';
$funzione == 'mostra'? $display = ' no-btn': $display;
$intestazione = 'IMMAGINE';
$ext == 'pdf'?$intestazione = 'FILE PDF':$intestazione;
echo '<div class="testata posy">' . $intestazione;		//inserire <btn_test>
echo '<div id="btn_test_image" class="freccia arrow_down" onclick="abbassa($(this));"></div></div>';
echo '<div id="image" >';
// si tratta di una immagine jpg o png ?
if ($ext == 'jpg' || $ext == 'png')
	{
		echo '<img id="foto" src="' .$immagine . '" title="immagine correlata" onload="anteprima();">';
	}
	
else if ($ext == 'pdf')
	{
		echo '<p>&nbsp; &nbsp; Documento Pdf : ' . $conn2->row['filename'] . '.' . $conn2->row['ext'] . '</p>';
		echo '<a href="' . $immagine .'" target="_blank">';
		echo '<img id="foto" src="images/pdf.png" height="100" style="cursor:pointer;position:relative;left:80px;" ></a>';
		echo '<br /> &nbsp; &nbsp; clicca per vedere anteprima';
	
	}
// fine del div [image]
echo '</div>';
// stringa html per immagine ....
$html_pulsanti = '
<input id="nuova" name="nuova" class="buttons" type="button" value="cambia..." onclick="caricaUpload(\'img\');" />
<input id="elimina" name="elimina" class="buttons" type="button" value="elimina..."  style="float:right;" onclick="deleteImg(\'' . $type . '\');"/>';
// stringa html per file pdf
if ($ext == 'pdf')
	{
		$html_pulsanti = '
<input id="nuova" name="nuova" class="buttons" type="button" value="cambia..." onclick="caricaUpload(\'pdf\');" />
<input id="elimina" name="elimina" class="buttons" type="button" value="elimina..."  style="float:right;" onclick="deleteImg(\'' . $type . '\');"/>';
	}
// STAMPA NEL BOX_[TYPE] IL RISULTATO
echo $html_pulsanti;
?>

<!--CASO IN CUI NON VENGA TROVATO NESSUN FILE IMMAGINE-->
<?php else :?>

<?php
$type=$_GET['type'];
$testo = '<div class="testata posy">IMMAGINE';		//inserire <btn_test>
$testo .= '<div id="btn_test_image" class="freccia arrow_down" onclick="abbassa($(this));"></div>';
$testo .= '</div><div id="image" ><!-- inserire meccanismo ingrandimento-->';
$testo .= '<img src="images/image.png" height="150" style="position:relative;left:80px;opacity:0.6;" ><br /><center><p>Nessuna Immagine Correlata.</p></center>';
$button_text = 'nuova immagine...'; 
if ($type == 'pdf')
	{
		$testo = '<div class="testata posy">FILE PDF';
		$testo .= '<div id="btn_test_image" class="freccia arrow_down" onclick="abbassa($(this));"></div>';
		$testo .= '</div><div id="image" ><!-- inserire meccanismo ingrandimento-->';
		$testo .= '<img src="images/no-pdf.png" height="150" style="position:relative;left:80px;opacity:0.6;" ><br /><center><p>Nessun file PDF.</p></center>';
		$button_text = 'nuovo pdf...';
	}

echo $testo;
?>
</div>		<!-- fine div image --> 
<input id="nuova" name="nuova" class="buttons" type="button" value="<?php echo $button_text; ?>" onclick="caricaUpload('<?php echo $type; ?>');" />
<?php endif; ?>
</body>