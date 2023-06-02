<html>
<head>
<?php
$type = $_GET['type'];
$old_file = '';
	if (isset ($_GET['filename']))
		{
			$old_file = $_GET['filename'];
		}
$intestazione = 'IMMAGINE';
	if ($type == 'pdf')
		{
			$intestazione = 'FILE PDF';
		}
$box_display = ''; 
$box_display .= '<div class="testata">' . $intestazione;		//inserire <btn_test>
$box_display .= '<div id="btn_test_image" class="freccia arrow_up"';
$box_display .= 'onclick="abbassa($(this));">';
$box_display .= '</div>';
$box_display .= '</div>';
$box_display .= '<div id="new_image" >';
$testo_p = '<p>Sfoglia sul tuo computer e scegli la nuova immagine da caricare.<br>Essa verrà salvata e mostrata con questa notizia</p>
<p>[Estensioni ammesse .jpg - .png]</p>';
if ($type == 'pdf')
	{
		$testo_p = '<p>Sfoglia sul tuo computer e scegli il nuovo <br /> file PDF da caricare.<br>Esso verrà salvato e indicato con link in questo evento</p>
		<p>[Unica estensione ammessa ".pdf"]</p>';
	}
?>
</head>
<body> 
<?php 
echo $box_display . $testo_p; 
?>
	<form id="upload_form" name="upload_form" enctype="multipart/form-data" >
	
	<input id="upload_name" name="upload_name" type="file"><br><br>

	<input name="old_file" type="hidden" value="<?php echo $old_file; ?>"> 
	
	<input id="button_carica" class="buttons" type="button" value="carica" >

	<input class="buttons" type="reset" value="annulla" style="float:right;" onclick="caricaMultiImgUpload('<?php echo $type; ?>');"/>
</form>

		</div>  <!-- fine #image -->

</body>