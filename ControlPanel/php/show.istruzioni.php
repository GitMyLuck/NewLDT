<?php 
error_reporting(E_ALL);
$dir = "istruzioni/it/functions/";
$type = 'istr';
$istr = $_GET['istr'];
$pagina = $_GET['pagina']; 
$fileN = $dir . $pagina . '.' . $istr . '.txt';
if(!is_file($fileN))
		{ 
			$text =  'Oops ! - Istruzioni inesistenti';
			echoes($text, $type, $istr);
		}
else
		{
			try 
					{
						$fileContent = file_get_contents($fileN);
						//	sostituisci accapo
						$pattern = '[ \s \n \r]';
						$replacement = '<br />';
						$results = preg_replace($pattern, $replacement, $fileContent);
						$results = nl2br($results);
						//	scrivi il testo
						echoes($results, $type, $istr);
					}
			catch (Exception $e) 
					{
						//echo $e->getMessage();			//  riporta il messaggio di errore
						$results = "tentativo fallito per qualche ragione... vedi";
						echoes($results, $type, $istr);
						var_dump($e);  // try this
					}
}

function echoes($text, $type, $istr)
	{
			echo '<div class="linguetta_' . $type . '">&nbsp;</div>' . PHP_EOL;
			echo '<div class="content_title_alert">' . PHP_EOL;
			echo '<div class="alert_icon ' . $type . '" title="' . $type . '"></div>' . PHP_EOL;
			echo '<div id="test_istr">istruzioni</div><div class="close_icon close_alert" title="chiudi" onclick="newAlert.closeIstr();"></div></div>' . PHP_EOL;
			echo '<div class="sottotitolo_istr">' . $istr . '</div>' . PHP_EOL;
			echo '<div class="mess_text">' . PHP_EOL;
			//	scrivi il testo
			echo $text . PHP_EOL;
			echo '</div>' . PHP_EOL;
			echo '<div id="fine_istruzioni">&nbsp;</div>';
	
	
	}
?>