<div  style="position:relative;top:-20px;">
<center>DATA PUBBLICAZIONE</center>
<div id="data_box">
<?php 
$data = '';
$dati = $conn->leggiRaccoltaDati();	//carica dati statistici
$conn->leggiAccessi();		
$accessi = $conn->index;		//numero di accessi
$lastAcc = $conn->row['data'];  //data ultimo accesso
$lastAccDate = $news->doTimeBrev($lastAcc);//traduci data
if (isset ($notizia))
	{
		if ($notizia['data'] != 0) 
			{
				$news->doTime($notizia['data']);
				$data = $news->data;	
			}
	}
echo  $data;
?>
</div>
<center>STATISTICHE</center>
<div id="dati_box">
<?php 
echo '&nbsp; &nbsp; &nbsp; ACCESSI <br> ';
echo '<div id="dato_var">effettuati : </div>';
echo '<div id="dato_ris">' . $accessi . '</div> <br> ';
echo '<div id="dato_var">ultimo : </div>';
echo '<div id="dato_ris">' . $lastAccDate . '</div><br><br>  ';
echo '&nbsp; &nbsp; &nbsp; NOTIZIE <br> ';
echo '<div id="dato_var">caricate : </div>';
echo '<div id="dato_ris">' . $dati['news_load'] . '</div><br> ';
echo '<div id="dato_var">eliminate : </div>';
echo '<div id="dato_ris">' . $dati['news_del'] . '</div><br><br>';
echo '&nbsp; &nbsp; &nbsp; IMMAGINI <br> ';
echo '<div id="dato_var">caricate : </div>';
echo '<div id="dato_ris">' . $dati['img_load'] . '</div><br> ';
echo '<div id="dato_var">eliminate : </div>';
echo '<div id="dato_ris">' . $dati['img_del'] . '</div><br><br>';
?>
</div>
</div>