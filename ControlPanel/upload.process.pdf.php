<!DOCTYPE html>
<html>
<head>
<script type="text/javascript"> 
		$(document).ready( function()
			{
				prepareSpin('wait_spin_eli');
			});
</script>
</head>
<body>
<div id="container">
<div id="wait_spin_eli" class="show_spin"></div>
<?php
include 'php/upload.class.php';
include 'php/db.inc.php';
require_once "php/config.inc.php";

class Upload_file extends Upload
{
    protected function onAbort()
    {
		$index = $_GET['id'];
		$sheet = $_GET['sheet'];
		$type = 'pdf';
        echo '<div  style="position:relative;top:-50px;"><h3>Impossibile caricare immagine...</h3></div>
        Errori:<br /> 
        <ul>
        ';
        foreach($this->error as $error)
        {
            echo '<li>' . $error . '</li>';
        }
        echo '</ul>';
		echo '<input id="indietro" class="buttons" type="button" value="indietro"  style="float:right;" onclick="caricaImgUpload(\'' . $type . '\');" />';
		echo '<script type="text/javascript">timer(\'' . $type . '\', 8000);</script>';
		}
    
    protected function onSuccess()
    { 
		$upload = new FUNCT();
		$destroi = new NEWS();
		$upload->doServer();
		$index = $_GET['id'];
		$sheet = $_GET['sheet'];
		$type = 'pdf';
		//cerca nome vecchia immagine, elimina dati vecchia immagine dal db, inserisci i dati della nuova immagine
        $upload->doImageNewPdf($this->filename, $this->extension, $index, $sheet, $type);
		// se esiste
		// rileva indirizzo vecchia immagine per eliminazione
		if($upload->row['filename'])
		{
		$file = $this->opt['uploadDir'] . $upload->row['filename'] . '.' . $upload->row['ext'];
		// elimina dalla cartella vecchia immagine
		$destroi->desFile($file);
		}
		// aggiorna DATI STATISTICI
		$upload->aggDatiImm();

       echo '<div id="super_contenitore"  style="position:relative;top: -25px;" >';
		echo '<div id="contenitore_immagine">'; 
		echo '<div class="testata">FILE PDF</div>';
        echo '<center><h3  style="color:#f36e2d;">File caricato correttamente</h3><br /><br /><br /><br /> ';
        echo '<p>elaborazione con nuovo nome<br> &laquo;' . $this->filename . '.' . $this->extension . '&raquo;</p></center>';
		echo '<script type="text/javascript">timer(\'pdf\', 2000);</script>';
       
    }
	
      
}
$sheet = $_GET['sheet']; 
$opt = array('uploadDir' => $dir_cache . 'pdf_' . $sheet . '/',
            'allowedExtensions' => 'pdf',
            'maxSize'=> $size,
			'thumbSize' => 600,		//600
            'thumbDir' => 'thumb/');

$upload = new Upload_file($opt, $sheet);
?>
</div>
</body>
</html>