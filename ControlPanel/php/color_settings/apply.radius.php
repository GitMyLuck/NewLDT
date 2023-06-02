<?php 
$radius = $_POST['radius'];
include "../db.inc.php";
$config = new CONFIG();
$config->doServer();
$res = $config->setRadius($radius);
$css_dir = "../../css/";
	 $f = $css_dir . "radius/border.radius.template.css";
	 $contenuto = file_get_contents($f); 
	 $contenuto = preg_replace("/raggio/", $radius, $contenuto);
    $dest = $css_dir . "radius/border.radius.temp.css";
    file_put_contents($dest,$contenuto);
if (!$res)
	{
		echo @date(r) . '<br /> ';
		echo 'applicato raggio di ' . $radius . 'px ...';
	}
else
	{
		echo $res; 
	}

?>