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
$funzione = exist('funzione_pagina');
$filename = exist('filename');
$n_foto = exist('index');
$conn2 = new FUNCT();
$conn2->doServer();
if ($filename === 'undefined' || $filename === '')
	{
		$conn2->doImage($index, $sheet, $type);
	}
else if ($filename !== '')
	{
		
		$index = $conn2->cercaIdFoto($filename, $sheet);
		$conn2->doMultiImage2($index, $sheet, $type);
	}
//exit(var_dump($n_foto)); 
$foto_did = '';
if ($n_foto != '' && $n_foto != "undefined")
		{
			$foto_did = '<div class="num_foto">FOTO - ' . $n_foto . ' - </div>';
		}
$ext = $conn2->row['ext'];

$immagine = $dir_cache . 'immagini_' . $sheet . '/';
if ($ext == 'pdf')
	{
		$immagine = $dir_cache . 'pdf_' . $sheet . '/';
	}
$immagine .= $conn2->row['filename'] . '.';
$immagine .= $conn2->row['ext'];
$old_file = $conn2->row['filename'] . '.';
$old_file .= $conn2->row['ext'];
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
($type === 'pdf') ? $intestazione = 'FILE PDF' : $intestazione;
echo '<div class="testata posy">' . $intestazione;		//inserire <btn_test>
echo '<div id="btn_test" class="freccia arrow_down"';
echo 'onclick="abbassa($(this));"></div>';
echo '</div>';
// si tratta di una immagine jpg o png ?
if ($ext == 'jpg' || $ext == 'png')
	{
echo '<div id="image" >';
echo '<a href="' . $immagine . '" rel="lightbox">';
echo '<img id="foto" src="' .$immagine . '" title="immagine correlata" onload="anteprima();">';
echo $foto_did;
echo '</a>';
	}
else if ($ext == 'pdf')
	{
		echo '<div id="image_pdf" >';
		echo '<p>&nbsp; &nbsp; Documento Pdf : ' . $conn2->row['filename'] . '.' . $conn2->row['ext'] . '</p>';
		echo '<a href="' . $immagine .'" target="_blank">';
		echo '<img id="foto" src="images/pdf.png" height="100" style="cursor:pointer;position:relative;left:80px;" ></a>';
		echo '<br /> &nbsp; &nbsp; clicca per vedere anteprima';
	
	}
// fine del div [image]
echo '</div>';

// stringa html per immagine ....
$html_pulsanti = '<center>
<input id="nuova" name="nuova" class="buttons img_upload' . $display . '" type="button" value="nuova..." onclick="caricaMultiUpload(\'img\', \'add\', \'' . $old_file . '\');" />&nbsp; &nbsp; 
<input id="cambia" name="cambia" class="buttons img_upload' . $display . '" type="button" value="cambia..." onclick="caricaMultiUpload(\'img\', \'change\', \'' . $old_file . '\');" />&nbsp; &nbsp; 
<input id="elimina" name="elimina" class="buttons img_upload' . $display . '" type="button" value="elimina..."  onclick="deleteMultiImg(\'img\', \'' . $old_file . '\');"/>
</center>';
// stringa html per file pdf
if ($ext == 'pdf')
	{
		$html_pulsanti = '<br /> <br /> 
<input id="nuova" name="nuova" class="buttons' . $display . '" type="button" value="cambia..." onclick="caricaUpload(\'pdf\');" />
<input id="elimina" name="elimina" class="buttons' . $display . '" type="button" value="elimina..."  style="float:right;" onclick="deleteImg(\'' . $type . '\');"/>';
	}
// STAMPA NEL BOX_[TYPE] IL RISULTATO
echo $html_pulsanti;

?>

<!--CASO IN CUI NON VENGA TROVATO NESSUN FILE IMMAGINE-->
<?php else :
$display = '';
$funzione == 'mostra'? $display = ' no-btn': $display;
/****************IMMAGINE*******************************/
$type=$_GET['type'];
$testo = '<div class="testata posy">IMMAGINE';		
$testo .= '<div id="btn_test" class="freccia arrow_down"';
$testo .= 'onclick="abbassa($(this));">';
$testo .= '</div></div><div id="image_pdf" >';
$testo .= '<img src="images/image.png" height="150" style="position:relative;left:80px;opacity:0.6;" ><br /><center><p>Nessuna Immagine Correlata.</p></center>';
$button_text = 'nuova immagine...';
/********************PDF*******************************/
if ($type == 'pdf')
	{
		$testo = '<div class="testata posy">FILE PDF';
		$testo .= '<div id="btn_test_image" class="freccia arrow_down"';
		$testo .= 'onclick="abbassa($(this));">';
		$testo .= '</div></div><div id="image_pdf" >';
		$testo .= '<img src="images/no-pdf.png" height="150" style="position:relative;left:60px;opacity:0.6;" ><br /><center><p>Nessun file PDF.</p></center>';
		$button_text = 'nuovo pdf...';
	}
echo $testo;
?>
</div>		<!-- fine div image -->
<br>
<?php 
if ($type === 'img')
	{
		echo '<input id="nuova" name="nuova" class="buttons'. $display .'" type="button" value="' . $button_text . '" onclick="caricaMultiUpload(\'img\', \'add\', \'\');" />';
	}
else if ($type === 'pdf')
	{
		echo '<input id="nuova" name="nuova" class="buttons'. $display .'" type="button" value="' . $button_text . '" onclick="caricaUpload(\'pdf\');" />';

	}

echo '</div>';
endif; ?>
</body>

<?php 
		function exist($var)
			{
				if (isset ($_GET[$var]))
					{
						$var_temp = $_GET[$var];
						return $var_temp;
					}
				else
					{
						$var_temp = '';
						return $var_temp;
					}
		}
?>