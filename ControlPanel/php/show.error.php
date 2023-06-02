<?php 
error_reporting(E_ALL);
$dir = "error/it/";
$istr = $_GET['text'];
$type = $_GET['type']; 
$fileN = $dir . 'error_' . $istr . '.txt';
if(!is_file($fileN))
		{ 
			echo '<div id="test_istr">Oops ! - Messaggio inesistente<div id="close_istr" title="chiudi" onclick="chiudiIstr();">X</div></div>';
			echo '<div id="fine_istruzioni">&nbsp;</div>';
			//var_dump($fileN);
		}
else
		{
			try 
					{
						echo '<div id="test_istr">Avviso<div id="close_istr" title="chiudi" onclick="chiudiIstr();">X</div></div><br />';
						$fileContent = file_get_contents($fileN);
						//	sostituisci accapo
						$pattern = '[ \s \n \r]';
						$replacement = '<br />';
						$results = preg_replace($pattern, $replacement, $fileContent);
						//	scrivi il testo
						echo $results;
						echo '<div id="fine_istruzioni">&nbsp;</div>'; 
					}
			catch (Exception $e) 
					{
						//echo $e->getMessage();			//  riporta il messaggio di errore
						echo "tentativo fallito per qualche ragione... vedi";
						var_dump($e);  // try this
					}
}

?>