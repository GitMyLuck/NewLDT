<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php 
include "php/db.inc.php";
$index = $_GET['id'];
$sheet = $_GET['sheet'];
$type = $_GET['type'];  
$destroi = new NEWS();
$conn = new FUNCT();
$conn->doServer();
$conn->doImage($index, $sheet, $type);
$ext = $conn->row['ext'];
$immagine = 'immagini_' . $sheet . '/';
if ($ext == 'pdf')
	{
		$immagine = 'pdf_' . $sheet . '/';
	}
$immagine .= $conn->row['filename'] . '.';
$nome_immagine = $conn->row['filename'];
$ext_immagine = $conn->row['ext'];
$immagine .= $conn->row['ext'];
$conn->delImage($index, $sheet, $type);
$immagine = 'php/' . $immagine;
//exit (var_dump($immagine));
@unlink($immagine);
// se non e' un pdf elimina anche la thumbnail
if ($ext != 'pdf')
	{
		$thumb = $dir_cache . 'immagini_' . $sheet . '/thumb/';
		$thumb .= $nome_immagine . '-thumb.' . $ext_immagine;
		$destroi->desFile($thumb);
	}

?>
<script type="text/javascript"> 
		$(document).ready( function()
			{
				prepareSpin('wait_spin_eli');
			});
</script>
</head>
<body>
<div id="container">
<div class="testata"  style="position:relative;top:-30px;" >IMMAGINE</div>
<div id="wait_spin_eli" class="show_spin"></div><br /> 
<center><p>Immagine &laquo;<?php echo $nome_immagine . '.' . $ext_immagine;?>&raquo;</p>
		<p>in eliminazione dal database ...</p></center><br /> <br />
<script type="text/javascript">timer('<?php echo $type; ?>', 3000);</script>
</div> 

</body>