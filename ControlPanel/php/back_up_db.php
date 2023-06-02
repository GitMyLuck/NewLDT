<?php
header('Content-type: text/html;charset=utf-8');
include 'db.inc.php';
$nome_file = '';
$function = exist('function');
$sheet = exist('sheet');
$nome_file = exist('file');
$back_dir = '../mysqlBackups/';
$root = '../php/immagini_' . $sheet . '/';
$this_tables = array();
$backup = new BCK($sheet, $back_dir);			//ISTANZA DELLA CLASSE BCK
$backup->doServer();
$data = $backup->getDataFile();		//preleva data per il salvataggio del file
	if ( $function === 'back-up' )
		{
			$results = true;
			$this_tables = array($sheet, "img_" . $sheet, "pdf_" . $sheet, "tags_" . $sheet);
			$backup->createHash();
			//backup delle tabelle del database
			$results = $results && $backup->backupTables($this_tables);
			//backup_immagini ('../myimmBackups');
			$results = $results && $backup->backupImmagini($root);
			if ($results)
				{
					echo 'Back-up effettuato con successo.';
				}else{
					echo 'Si sono verificati dei problemi.';
				}
		}
	//INIZIALIZZAZIONE RESTORE CON LA SCELTA DEL FILE
	else if ($function === 'restore' && $nome_file === '')
		{
			$array_file = array();
			$hash_file = array();
			//preleva i back-up effettuati dalla cartella
			$array_file = $backup->elencaFileBackup();
	if ($array_file)
		{
			// scrivi elenco
			echo '<div id="bu_contents">BACK-UP DISPONIBILI...<ul id="elenco" > ';
		for ($i = 0; $i <= (count($array_file)-1); $i++)
				{
					//formatta data ed estraila per visualizzazione
					$hash_file = $backup->formattaData($array_file[$i]);
		echo '<li id="' . $i . '" class="elenco_bu" name="' . $array_file[$i] .'"
		onclick="selectBackUp($(this));">
		Back-Up : ' . $hash_file[0] . '</li>';
		
					}	// END FOR CICLE
			echo ' </ul></div>';
			} 	//END IF ARRAY EXIST
	else
		{
			echo 'Nessun Back-Up disponibile.';
		}

		 }		//END ELENCO BACK-UPS
	//RESTORE VERO E PROPRIO IN CUI VIENE PASSATO IL FILE 
	else if ($function === 'restore' && $nome_file != '')
		{
			$results = true;
			$array_dir = array();
			//cerca la dir-immagine di back-up
			$array_dir = $backup->elencaDirImmagini($nome_file);
			$nome_dir = $array_dir[0];
			//exit (var_dump($array_dir));
// se esiste file ed esiste dir, prosegui
if ($nome_file && $nome_dir)      
	{
($nome_file)?
//esegui il restore delle tabelle del database
$results = $results && restoreDBBackups($back_dir . $nome_file):
$results = false;
//esegui il restore della crtella immagini
($nome_dir)?
///siamo a questo punto
$results = $results && $backup->restoreDirImmagini($nome_dir, $root):
$results = false;
	}	//END IF EXIST FILE AND DIRECTORY
else
	{
		$results = false;
	}
			if ($results)
				{
					echo 'Restore effettuato con successo.';
				}
			else
				{
					echo 'Restore non effettuato!';
				}
	}
	else
		{
			return;
		}



function restoreDBBackups($sqlfile)
{
	//return true;
	$conn3 = new FUNCT();
	$conn3->doServer();
	// estraggo il contenuto del file
	$queries = file_get_contents($sqlfile);
	// Rimuovo eventuali commenti
	$queries = preg_replace(array('/\/\*.*(\n)*.*(\*\/)?/', '/\s*--.*\n/', '/\s*#.*\n/'), "\n", $queries);
	// recupero le singole istruzioni
	$statements = explode(";\n", $queries);
	$statements = preg_replace("/\s/", ' ', $statements);
	$statements = preg_replace("[#]", " ", $statements);
	// ciclo le istruzioni
	foreach ($statements as $query) 
		{
			$query = trim($query);
			//utf-8 encoding..
			$query = utf8_decode($query);
			if ($query) 
				{
					// eseguo la singola istruzione
					$result = mysql_query($query);
					// e stampo eventuali errori
					if (!$result)
						{
							echo 'Impossibile eseguire la query ' . $query . ': ' . mysql_error();
								return false;
						}
				}		//end IF $query
		}		//end FOR EACH

		return true;
}

	
/*****************INTERNAL SIMPLE DATA COMPUTING******************/	
function exist($var)
			{
				if (isset ($_GET[$var]))
					{
						$var_temp = $_GET[$var];
						return $var_temp;
					}
				else
					{
						$var_temp = '';
						return $var_temp;
					}
		}


?> 