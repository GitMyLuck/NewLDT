<?php 
include "../db.inc.php";
$set = new CONFIG();
$set->doServer();
$elimina = $set->eliminaRiga();
$results = $set->nuovaRiga();
$css_dir = "../../css/";
$old_file = $css_dir . "icone.default.css";
$new_file = $css_dir . "icone.temp.css";
$contenuto = file_get_contents($old_file);
file_put_contents($new_file, $contenuto);
echo '<br />Trasferito contenuto <br />';
echo 'file " ' . $old_file . ' "<br />';
echo 'nel file " ' . $new_file . ' "<br /><br /> ';
echo $elimina . '<br /> ' . $results;
//		RAGGIO DELL'ARROTONDAMENTO ANGOLI
$old_file = $css_dir . "radius/border.radius.default.css";
$new_file = $css_dir . "radius/border.radius.temp.css";
$contenuto = file_get_contents($old_file);
file_put_contents($new_file, $contenuto);
echo '<br />Trasferito contenuto <br />';
echo 'file " ' . $old_file . ' "<br />';
echo 'nel file " ' . $new_file . ' "<br /><br /> ';
echo $elimina . '<br /> ' . $results;
//		ICONE BARRA
$old_file = $css_dir . "pulsanti.barra.menu.default.css";
$new_file = $css_dir . "pulsanti.barra.menu.temp.css";
$contenuto = file_get_contents($old_file);
file_put_contents($new_file, $contenuto);
echo '<br />Trasferito contenuto <br />';
echo 'file " ' . $old_file . ' "<br />';
echo 'nel file " ' . $new_file . ' "<br /><br /> ';
echo $elimina . '<br /> ' . $results;
//		APPENDICI  ALERT
$old_file = $css_dir . "appendici/appendici.alert.default.css";
$new_file = $css_dir . "appendici/appendici.alert.temp.css";
$contenuto = file_get_contents($old_file);
file_put_contents($new_file, $contenuto);
echo '<br />Trasferito contenuto <br />';
echo 'file " ' . $old_file . ' "<br />';
echo 'nel file " ' . $new_file . ' "<br /><br /> ';
echo $elimina . '<br /> ' . $results;
?>