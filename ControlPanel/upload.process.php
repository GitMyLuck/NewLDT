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
		$type = 'img';
		echo '<div id="super_contenitore"  style="position:relative;top: -25px;" >';
		echo '<div id="contenitore_immagine">'; 
		echo '<div class="testata">IMMAGINE</div>';
        echo '<h3 style="color:#f36e2d;">Impossibile caricare immagine...</h3><br /><br /><br /><br />
        Errori: 
        <ul>
        ';
        foreach($this->error as $error)
        {
            echo '<li>' . $error . '</li>';
        }
        echo '</ul>';
		echo '<input id="indietro" class="buttons" type="button" value="indietro"  style="float:right;" onclick="caricaMultiImgUpload(\'img\');" />';
		echo '<script type="text/javascript">timer(\'' . $type . '\', 8000);</script>';
		echo '</div></div>';
		}
    
    protected function onSuccess()
    {
		$upload = new FUNCT();
		$destroi = new NEWS();
		$upload->doServer();
		$index = $_GET['id'];
		$sheet = $_GET['sheet'];
		$old_file = $_POST['old_file'];
		// crea le immagini
		$this->createImage();
		$img_width = $this->img_x;
		$img_height = $this->img_y;
		// salva nuova immagine nel database
		$function = $this->opt['imageFunction'];
		$results = $upload->doImageNew($this->filename, $this->extension, $index, $sheet, $function, $old_file, $img_width, $img_height);
		//exit(var_dump($results)); 
		$didascalia = $results['didascalia'];
		/***************************   E L I M I N A Z I O N E ********************/
		// SE LA FUNZIONE TRASMESSA NON E' ADD ALLORA PUOI ELIMINARE L'IMMAGINE
		
		if ($function === "change")
			{
		//cerca nome vecchia immagine, elimina dati vecchia immagine dal db, inserisci i dati della nuova immagine
		include "php/config.inc.php";
		// elimina dalla cartella vecchia immagine
		$file = $dir_cache . 'immagini_' . $sheet . '/' . $old_file;
		$destroi->desFile($file);
		// estrapola dalla var $old_file il nome del file e l'estensione
		$dotPos = stripos($old_file, ".");
		$len = strlen($old_file);
		$lenght = $len - 4;
		$filename = substr($old_file, 0, $lenght);
		$ext = substr($old_file, -3,3);
		// elimina dalla cartella vecchia immagine-thumbnail
		$file = $dir_cache . 'immagini_' . $sheet . '/thumb/' . $filename . '-thumb.' . $ext;
		$destroi->desFile($file);
		/***************************   E L I M I N A Z I O N E ********************/
			}		//END OF FUNCTION
		// aggiorna DATI STATISTICI
		$upload->aggDatiImm();
		// contenuto del box
		echo '<div id="super_contenitore"  style="position:relative;top: -25px;" >';
		echo '<div id="contenitore_immagine">'; 
		echo '<div class="testata">IMMAGINE</div>';
        echo '<center><h3  style="color:#f36e2d;">File caricato correttamente</h3> ';
        echo '<p>&laquo;' . $this->filename . '.' . $this->extension . '&raquo;</p>';

		/*echo 'Inserisci la didascalia per questa immagine...<br /> <br /></center> ';
		echo '<label>Didascalia: </label><br />
		echo '<form name="form_did" class="form_input" >

<input name="nomefile" type="hidden" value="' . $this->filename . '">

<input name="extension" type="hidden" value="' . $this->extension . '">

<input class="buttons varia" type="button" value="avanti.."  onclick="spedisciImg($(this).parent());">

</form>';*/
		echo '</div></div>';
		echo '<script type="text/javascript">timer(\'img\', 2000);</script>';
    }
	
	 protected function createImage()
			{
				if($this->extension == 'jpg')
					{
						$this->image = imagecreatefromjpeg($this->opt['uploadDir'] . $this->filename . '.' . $this->extension);
					}
				elseif($this->extension == 'png')
					{
						$this->image = imagecreatefrompng($this->opt['uploadDir'] . $this->filename . '.' . $this->extension);
					}
				else
					{
						return;
		
					}
		//create image********************************** I M A G E
		$this->createCanvas('imageSize', 'uploadDir','');
		
		//create Thumbnail***************************** T H U M B N A I L
		$this->createCanvas('thumbSize', 'thumbDir', '-thumb');
        
    }

	protected function createCanvas($size, $directory, $subDir)
			{
				$width = imagesx($this->image);
				$height = imagesy($this->image);
				$prop = min($this->opt[$size]/$width, $this->opt[$size]/$height);
        
				$thumb_width = intval($prop*$width);
				$thumb_height = intval($prop*$height);
					if ( $subDir === '')
						{
							$this->img_x = $thumb_width;
							$this->img_y = $thumb_height;
						}
				$thumb = imagecreatetruecolor($thumb_width,$thumb_height);
        
				imagecopyresampled($thumb,$this->image,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
				imagejpeg($thumb,$this->opt[$directory] . $this->filename . $subDir . '.' . $this->extension,90);

			}
}
$conn = new FUNCT();
$conn->doServer();
$index = $_GET['id'];
$sheet = $_GET['sheet'];
$function = $_GET['function'];
// prelevare numero dell'imagine corrente
$num_img = $conn->contaFoto($sheet, $index);
if ($function != 'undefined')
	{
$opt = array(	'uploadDir' => $dir_cache . 'immagini_' . $sheet . '/',
						'allowedExtensions' => $allExt,
						'maxSize' => $size,
						'number' => $num_img, 
						'imageFunction' => $function,
						'imageSize' => 600,
						'thumbSize' => 250,
						'thumbDir' => $dir_cache . 'immagini_' . $sheet . '/thumb/');
$upload = new Upload_file($opt, $sheet);
	}

?>

</div>
</body>
</html>