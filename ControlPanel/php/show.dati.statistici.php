<?php 
include 'db.inc.php';
$conn = new FUNCT();
$news = new NEWS();
$conn->doServer();
$dati = $conn->leggiRaccoltaDati();	//carica dati statistici
$conn->leggiAccessi();		
$accessi = $conn->index;		//numero di accessi
$lastAcc = $conn->row['data'];  //data ultimo accesso
$lastAccDate = $news->doTimeBrev($lastAcc);//traduci data
?>
<div  style="position:relative;top:-20px;">
<center>STATISTICHE</center>
<div id="dati_box">
<?php 
echo '&nbsp; &nbsp; &nbsp; ACCESSI <br> ';
echo '<div id="dato_var">effettuati : </div>';
echo '<div id="dato_ris">' . $accessi . '</div> <br> ';
echo '<div id="dato_var">&nbsp; &nbsp; &nbsp; ultimo : </div>';
echo '<div id="dato_ris">' . $lastAccDate . '</div><br><br>  ';
echo '&nbsp; &nbsp; &nbsp; NOTIZIE <br> ';
echo '<div id="dato_var">&nbsp; &nbsp; &nbsp;caricate : </div>';
echo '<div id="dato_ris">' . $dati['news_load'] . '</div><br> ';
echo '<div id="dato_var">&nbsp; &nbsp; &nbsp;eliminate : </div>';
echo '<div id="dato_ris">' . $dati['news_del'] . '</div><br><br>';
echo '&nbsp; &nbsp; &nbsp; IMMAGINI <br> ';
echo '<div id="dato_var">&nbsp; &nbsp; &nbsp;caricate : </div>';
echo '<div id="dato_ris">' . $dati['img_load'] . '</div><br> ';
echo '<div id="dato_var">&nbsp; &nbsp; &nbsp;eliminate : </div>';
echo '<div id="dato_ris">' . $dati['img_del'] . '</div>';
?>
</div>
</div>
