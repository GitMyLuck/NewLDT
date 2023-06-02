<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<?php 
include "php/db.inc.php";
$filename = exist('filename');
$sheet = exist('sheet');
$dotPos = stripos($filename, ".");
$len = strlen($filename);
$lenght = $len - 4;
$file = substr($filename, 0, $lenght);
$ext_immagine = substr($filename, -3, 3); 
$destroi = new NEWS();
$conn = new FUNCT();
$conn->doServer();
$immagine = 'immagini_' . $sheet . '/' . $filename;
$conn->delMultiImage($file, $sheet);
$immagine = $dir_cache . $immagine;
$destroi->desFile($immagine);

		$thumb = $dir_cache . 'immagini_' . $sheet . '/thumb/';
		$thumb .= $file . '-thumb.' . $ext_immagine;
		$destroi->desFile($thumb);

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
<center><p>Immagine &laquo;<?php echo $filename;?>&raquo;</p>
		<p>in eliminazione dal database ...</p></center><br /> <br />
<script type="text/javascript">timer('img', 3000);</script>
</div>
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