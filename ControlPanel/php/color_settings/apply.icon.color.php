<?php
include "../db.inc.php";
$set = new CONFIG();
$set->doServer();
$r = $_REQUEST;
$act = $r['action']; 
if($act == "get_all") 
	{
			$js = "";
			$dir = "../../images/icone/F9B234/";
			$tipo = $r['tipo'];
			if ( $tipo == "bar" )
				{
					// icone della barra
					$dir = "../../images/icone_barra/FFFFFF/";
				}
			else if ( $tipo == "alert" )
				{
					// icone corpo alert
					$dir = "../../images/appendici/FFFFFF/";
				}
			$images = glob($dir."/*.png",GLOB_BRACE);
			foreach($images as $image) 
				{
						$name = basename($image);
						$js[] = $name;
				}
			// ritorna elenco array elenco file
			echo json_encode($js);
			die();
		}
elseif($act == "save") {
    $img = $r['file'];
    $name = $r['name'];
    $tipo = $r['tipo'];
    $color = substr($r['color'], 1);
    $dir = "../../images/icone/$color";
    if ( $tipo == "bar" )
			{
				$dir = "../../images/icone_barra/$color";
			}
		else if ( $tipo == "alert" )
			{
				$dir = "../../images/appendici/$color";
			}
    if(!file_exists($dir) || !is_dir($dir)) mkdir($dir,777,true);
    $file = $dir."/$name";
    file_put_contents($file,file_get_contents("data://".$img));
   
		if ( $tipo == "main" )
			{
				$old_dir = "../../images/icone/";
				$w_file = array("help-white.png","help-black.png");
				for ($i = 0; $i <= count($w_file) - 1; $i++)
						{
							copy($old_dir . $w_file[$i], $dir . "/" . $w_file[$i]);
						}

				$color = substr($r['color'], 1);
				$css_dir = "../../css/";
				$f = $css_dir . "icone.template.css";
				$contenuto = file_get_contents($f); 
				$contenuto = preg_replace("/color/", $color, $contenuto);
				$dest = $css_dir . "icone.temp.css";
				file_put_contents($dest,$contenuto);
			}
	elseif ( $tipo == "bar" )
			{
				$color = substr($r['color'], 1);
				$css_dir = "../../css/";
				$f = $css_dir . "pulsanti.barra.menu.template.css";
				$contenuto = file_get_contents($f); 
				$contenuto = preg_replace("/color/", $color, $contenuto);
				$dest = $css_dir . "pulsanti.barra.menu.temp.css";
				file_put_contents($dest,$contenuto);
				$set->setNewColor("ink_bar", $color, "temp");
				
			}
		elseif ( $tipo == "alert" )
			{
				$color = substr($r['color'], 1);
				$css_dir = "../../css/";
				$f = $css_dir . "appendici/appendici.alert.template.css";
				$contenuto = file_get_contents($f); 
				$contenuto = preg_replace("/color/", $color, $contenuto);
				$dest = $css_dir . "appendici/appendici.alert.temp.css";
				file_put_contents($dest,$contenuto);
				$set->setNewColor("pannelli_back", $color, "temp");
				
			}
	else
			{
					$contenuto = 'tipo sconosciuto...';
			}
	 echo $contenuto;
	
	}