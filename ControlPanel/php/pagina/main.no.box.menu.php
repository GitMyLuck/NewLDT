<?php 
$user_type = array("silver", "base", "gold", "premium");
$this_type_string = $user_type[($admin-3)];
//preleva immagine
$immagine = preleva($index, $sheet, 'img', $conn);
//preleva pdf
$pdf = preleva($index, $sheet, 'pdf', $conn);
echo '<div class="box_cp double triple_height" id="box_search_news">';

$titolo = $notizia['titolo'];
if (strlen($titolo) > 22)
	{
		$titolo = substr($notizia['titolo'], 0, 23) . '...';
	}
$titolo_breve = '#&nbsp;' . $notizia['real_id'] .  '&nbsp;&nbsp;' . $titolo;
//$titolo_breve .= '&nbsp;MENU'; 
echo 	'<div class="testata elenco" >' . $titolo_breve . '<div id="btn_test_search" class="arrow_up"></div></div>';
echo 	'SCHEDA STRUTTURA ' . strtoupper($this_type_string) . '<br />';
echo	'<b> DIMOSTRATIVO </b>';
echo 	'<div id="menu_notizie" style="font-size: 0.8em;position:relative;top:50px;">';
			// NOME STRUTTURA
echo 	'&nbsp; Nome: <b>' . $notizia['titolo'] . '</b><br />';
			// TIPO STRUTTURA
echo	'&nbsp; Tipo: <b>' . $notizia['tipo_str'] . '</b><br />';
			// INDIRIZZO STRUTTURA
echo	'&nbsp; Indirizzo: <b>' . $notizia['indirizzo_str'] . '</b><br />';
			// LOCALITA' STRUTTURA
echo	'&nbsp; Località: <b>' . $notizia['citta_str'] . '</b><br />';
			// TELEFONO STRUTTURA
if($notizia['telefono_str']!='')
	{ echo '&nbsp; Telefono: <b>' . $notizia['telefono_str'] . '</b><br />';}else{echo '&nbsp; Telefono: no <br /> ';}
			// STELLE STRUTTURA
if($notizia['stelle']!='')
	{ echo '&nbsp; Stelle: <b>' . $notizia['stelle'] . '</b><br />';}else{echo '&nbsp; Stelle: no <br /> ';}
			// LINK A SITO STRUTTURA
if($notizia['link_str']!='')
	{ echo '&nbsp; SitoWeb: <b>' . $notizia['link_str'] . '</b><br />';}else{echo '&nbsp; SitoWeb: no <br /> ';}


echo	'<br />';


			// tags
if($notizia['tags']!='' && $admin > 4)
	{ echo '&nbsp; Tags: <b>' . $notizia['tags'] . '</b><br />';}else{echo '&nbsp; Tags: no <br /> ';}
			// mappa
if($notizia['embed']!='' && $admin > 2)
	{ echo '&nbsp; Mappa: <b>' . 'si' . '</b><br />';}else{echo '&nbsp; Mappa: no <br /> ';}
			// offerta
if($notizia['offerta_str']!='' && $admin > 5)
	{ echo '&nbsp; Offerta: <b>' . 'si' . '</b><br />';}else{echo '&nbsp; Offerta: no <br /> ';}
			// immagine
selectImmagine($admin);
selectPdf($admin);
echo	'<br />';
if($notizia['contratto']!='')
	{ echo '&nbsp; Contratto: <b>' . $notizia['contratto'] . '</b><br />';}else{echo '&nbsp; Contratto: no <br /> ';} //$notizia['contratto']
if($notizia['data_evento']!='')
	{ echo '&nbsp; Scadenza: <b>' . $notizia['data_evento'] . '</b><br />';}else{echo '&nbsp; Contratto: no <br /> ';}

echo	'</div></div>'; 


		function preleva($index, $sheet, $type, $conn)
			{
				$conn->doImage($index, $sheet, $type);
				$file = $conn->row['filename'] . '.';
				$file .= $conn->row['ext'];
				return $file;
			}

		function selectImmagine($admin)
			{
					switch ($admin)
				{
					case 3:
						echo '&nbsp; Immagine: ' . 'no' . '<br />';
						break;
					case 4:
						echo '&nbsp; Immagine: <b>' . 'no' . '</b><br />';
						break;
					case 5:
						echo '&nbsp; Immagine: <b>' . 'si - preimpostata' . '</b><br />';
						break;
					case 6:
						echo '&nbsp; Immagine: <b>' . 'si - modificabile' . '</b><br />';
						break;
				}
	
			}
		
		function selectPdf($admin)
			{
					switch ($admin)
				{
					case 3:
						echo '&nbsp; Pdf: ' . 'no' . '<br />';
						break;
					case 4:
						echo '&nbsp; Pdf: ' . 'no' . '<br />';
						break;
					case 5:
						echo '&nbsp; Pdf: <b>' . 'no' . '</b><br />';
						break;
					case 6:
						echo '&nbsp; Pdf: <b>' . 'si - modificabile' . '</b><br />';
						break;
				}
	
			}


?>