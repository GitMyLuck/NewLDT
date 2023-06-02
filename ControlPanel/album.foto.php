<html>
<head>
<?php 
$sheet = $_GET['sheet'];
$index = $_GET['id'];
$function = $_GET['funct'];
include "php/db.inc.php";
require_once "php/config.inc.php";
$conn = new FUNCT();
$conn->doServer();
$fotos = array();
// preleva numero di immagini per questa notizia con id_not_real
$fotos = $conn->doMultiImageNew($index, $sheet, 'img');

$len_fotos = count($fotos);
//  $fotos
//	@array_start = 1
// prelevo funzione per regolare il click sulle clip
$click_clip = 'onclick="caricaMultiImgUpload';
if ($function === 'mostra')
	{
		$click_clip = 'onclick="caricaMultiImg';
	}
?>
<style type="text/css">
	.posy {
			position: relative;
			top: -27px;
			}
</style>
</head>
<body>
	<div class="testata posy">FOTO ALBUM<div id="btn_test" class="freccia arrow_down" onclick="abbassa($(this));"></div>
		<!--<div id="btn_help" class="help new_funct"  onclick="doIstr('album-foto');" ></div>-->
	</div>
		<div class="cont_thumbs"> 
<?php 
if ($len_fotos > 0)
			{
switch ($len_fotos)
	{
		case $len_fotos <= 6:
		$width = '128';
		$min_height = '70';
		$height = '80';
		$max_height = '70';
		break;
		
		case $len_fotos <= 9:
		$width = '80';
		$min_height = '60';
		$height = '80';
		$max_height = '60';
		break;
		default :
		$width = '80';
		$min_height = '50';
		$height = '50';
		$max_height = '40';
		break;
	
	}		// END  OF  SWITCH
	
$lightbox = '';
$light_final = '';	
	for ($i = 1; $i <= $len_fotos ; $i++)
		{	
			$pref = '';
			$checked = '';
			$didascalia = 'FOTO - ' . $i . ' -';
			//exit ($fotos[$i]['preferita']);
		if ($fotos[$i]['preferita'] == 1)
				{
					$pref = 'preferita';
					$didascalia = ' ' . $i . '  &#10004;&nbsp;&nbsp;default';
				
				}
		($fotos[$i]['preferita'] == 1) ? $checked = 'checked="checked"' : $checked;
			$file = $fotos[$i]['filename'] . '.' . $fotos[$i]['ext'];
			if ($function === 'mostra')
				{
					$lightbox = '<a href="' . $dir_cache . 'immagini_' . $sheet . '/' . $fotos[$i]['filename'] . '.' . $fotos[$i]['ext'] . '" title="' . $fotos[$i]['didascalia'] . '" data-lightbox="roadtrip">';
					$light_final = '</a>';
				}
			echo '<div class="clip ' . $pref . '"  style="	width: ' . $width . 'px;
																		min-height:' . $min_height . 'px;
																		height:' . $height . 'px;">';
			echo '<div class="cont_img"';
			echo $click_clip . '(\'img\', \'' . $file . '\', \'' . $i . '\');"';
			echo '>';
			echo '<center>'. $lightbox;
			echo '<img src="' . $dir_cache . 'immagini_' . $sheet .'/thumb/';
			echo $fotos[$i]['filename'] . '-thumb.' . $fotos[$i]['ext'] . '"  style="max-height:' . $max_height . 'px;"/>';
			echo $light_final . '</div>';
			echo '<div name="' . $fotos[$i]['filename'] . '" class="album_didas" ondblclick="initCheck($(this));">' . $didascalia . '</div></div>';
			echo '</center>';
			echo '';
		}		//end FOR CICLE
			}
else
		{
			echo 'nessuna immagine presente...';
		}
?>
			</div>

</body>
</html>