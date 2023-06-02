<?php 
include "../db.inc.php";
$set = new CONFIG();
$set->doServer();
$elimina = $set->eliminaRiga('current');
$results = $set->nuovaRiga('temp', 'current');
$css_dir = "../../css/";
//   ICONE   
$old_file = $css_dir . "icone.temp.css";
$new_file = $css_dir . "icone.css";
$contenuto = file_get_contents($old_file);
file_put_contents($new_file, $contenuto);
echo '<br />Trasferito contenuto <br />';
echo 'file " ' . $old_file . ' "<br />';
echo 'nel file " ' . $new_file . ' "<br /><br /> ';
echo $elimina . '<br /> ' . $results;
//		RAGGIO DELL'ARROTONDAMENTO ANGOLI
$old_file = $css_dir . "radius/border.radius.temp.css";
$new_file = $css_dir . "radius/border.radius.css";
$contenuto = file_get_contents($old_file);
file_put_contents($new_file, $contenuto);
echo '<br />Trasferito contenuto <br />';
echo 'file " ' . $old_file . ' "<br />';
echo 'nel file " ' . $new_file . ' "<br /><br /> ';
echo $elimina . '<br /> ' . $results;
//		ICONE BARRA
$old_file = $css_dir . "pulsanti.barra.menu.temp.css";
$new_file = $css_dir . "pulsanti.barra.menu.css";
$contenuto = file_get_contents($old_file);
file_put_contents($new_file, $contenuto);
echo '<br />Trasferito contenuto <br />';
echo 'file " ' . $old_file . ' "<br />';
echo 'nel file " ' . $new_file . ' "<br /><br /> ';
echo $elimina . '<br /> ' . $results;

//		APPENDICI ALERT
$old_file = $css_dir . "appendici/appendici.alert.temp.css";
$new_file = $css_dir . "appendici/appendici.alert.css";
$contenuto = file_get_contents($old_file);
file_put_contents($new_file, $contenuto);
echo '<br />Trasferito contenuto <br />';
echo 'file " ' . $old_file . ' "<br />';
echo 'nel file " ' . $new_file . ' "<br /><br /> ';
echo $elimina . '<br /> ' . $results;

?>