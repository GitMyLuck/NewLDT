<html>
<head>
<?php
$type = $_GET['type'];
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
<p>&nbsp; </p> 
<?php echo $testo_p; ?>
	<form id="upload_form" name="upload_form" enctype="multipart/form-data" >
	
	<input id="upload_name" name="upload_name" type="file"><br><br>
	
	<input id="button_carica" class="buttons" type="button" value="carica" >
		
	<input class="buttons" type="reset" value="annulla" style="float:right;" onclick="caricaImgUpload('<?php echo $type; ?>');"/>
</form>

</body>