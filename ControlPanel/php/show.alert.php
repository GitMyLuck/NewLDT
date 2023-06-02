<?php

// DEFAULT   	ALERT
$type = 'alert';
$closer = 'Alert';
$sottotitolo = $_GET['sottotitolo'];
$testo = $_GET['text'];
if (isset ($_GET['type']))
	{
		$type = $_GET['type']; 
		switch ($type)
			{
					case 'info':
					$tit = 'INFO';
					break;
					
					case 'alert':
					$tit = 'ATTENZIONE';
					break;
					
					case 'error':
					$tit = 'ERRORE';
					break;
			
					case 'page':
					$tit = 'PAGINA';
					$testo = doPage($sottotitolo);
					$sottotitolo = '';
					$closer = 'Page';
					break;
					
					default:
					$tit = 'AVVISO - Control Panel®';
					break;
			}
	}
	if ( $type != 'error' )
		{
			echo '<div class="linguetta_' . $type . '">&nbsp;</div>' . PHP_EOL;
		}
	else
		{
			echo '<div  style="min-height:44px;">&nbsp;</div>';
		}
echo '<div class="content_title_alert">' . PHP_EOL;
echo '<div class="alert_icon ' . $type . '" title="' . $type . '"></div>' . PHP_EOL;
echo '<div id="test_istr">' . $tit . '</div><div class="close_icon close_alert" title="chiudi" onclick="close' . $closer . '();"></div></div>' . PHP_EOL;
echo '<div class="sottotitolo_istr">' . $sottotitolo . '</div>' . PHP_EOL;
echo '<div class="mess_text">' . PHP_EOL;
//	scrivi il testo
echo $testo . PHP_EOL;
echo '</div>' . PHP_EOL;
echo '<div id="fine_istruzioni">&nbsp;</div>';
if ( $type == 'error' )
		{
			echo '<div class="linguetta_' . $type . '">&nbsp;</div>' . PHP_EOL;
		}
					
		function doPage($sottotitolo)
			{
				// preleva root" sito/ControlPanel/ "
				require_once "classes/address.class.php";
				$addr = new ADRS();
				$cpRoot = $addr->getCPRoot(); 
				//  apertura buffer output
				ob_start();
				//  preleviamo contenuto pagina
				$pagina = file_get_contents( $cpRoot . $sottotitolo);
				//  creiamo l'output della pagina (HTML)
				$output_pagina = eval("?>" . $pagina);
				//  poniamo il buffer output in $testo
				$testo = trim(ob_get_contents());
				// puliamo il buffer
				ob_get_clean();
				return $testo;
			}

?>