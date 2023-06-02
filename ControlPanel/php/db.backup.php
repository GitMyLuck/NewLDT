<?php 
//header('Content-type: text/html;charset=utf-8');
class BCK extends FUNCT
{

public $sheet;
public $bck_dir;
public $data;
public $hash;
public $tables = array();
/****
	* Construct method
	* @param	string		$sheet			Nome della pagina per cui istanziamo la classe
	* @param	string		$back_dir		Percorso della cartella che contiene i back-up
	* @test		si			11/08/2014		
*****/
	public function __construct($sheet, $back_dir) 
		{
			$this->sheet = $sheet;
			$this->bck_dir = $back_dir;
			$this->tables = array($sheet, "img_" . $sheet, "pdf_" . $sheet, "tags_" . $sheet, "0_boxes");
		}
		
	public function getTablesList() 
	{ 
    
		$tables = array();     
		$this->row = $this->sql('SHOW TABLES'); 
    
		while($this->row = mysql_fetch_row($this->results))     
			{         
				$tables[] = $row[0];     
			}   
 
	return $tables; 

	} 

/**
 * Copy a file, or recursively copy a folder and its contents
 * @param       string   $source    Source path
 * @param       string   $dest      Destination path
 * @param       string   $permissions New folder creation permissions
 * @return      bool     Returns true on success, false on failure
 */

	//STACK => back_up_db.php
	//copia la serie di immagini relative alla pagina
	public function xcopy($source, $dest)
{
    // Check for symlinks
    if (is_link($source)) 
			{
				return symlink(readlink($source), $dest);
			}

    // Simple copy for a file
    if (is_file($source)) 
			{
				return copy($source, $dest);
			}

    // Make destination directory
    if (!is_dir($dest)) 
			{
				mkdir($dest);
			}

    // Loop through the folder
    $dir = dir($source);
    while (false !== $entry = $dir->read()) 
		{
			// Skip pointers
				if ($entry == '.' || $entry == '..') 
					{
						continue;
					}

			// Deep copy directories
			$this->xcopy("$source/$entry", "$dest/$entry");
		}

    // Clean up
    $dir->close();
    return true;
}

/****
	* Calcola in formato giusto la data per il salvataggio del file
	* 	@return		string		Formato (aammgghhmm'-')
	*	@public		string		$this->data
	* 	@test		si				08/08/2014				
*****/

	public function getDataFile()
		{
			$now = @time();
			$giorno = date("d", $now);
			$mese = date("m", $now);
			$anno = date("y", $now);
			$ora = date("H", $now);
			$minuto = date("i", $now);
			$secondo = date("s", $now);
			$data = $anno . $mese . $giorno . $ora . $minuto . $secondo;
			$this->data = $data;
			return $data;
		}

/****
	* Salva sul DB il back-up effettuato
	* 	@param		string		$nome_file		Nome del file di backup
	* 	@return		bool						Success or Not Success
	* 	@test		no
*****/

	public function saveBackUp($nome_file)
		{
			$file = array();
			$file = explode("-", $nome_file);
			$data = $file[3];
			$sql = "INSERT INTO `backup` (`file`, `data`) VALUES ('$nome_file', '$data') ";
			$this->insertSql($sql);
			return true;
		}

/****
	* Preleva elenco file di back-up dalla cartella
	*	@return		array		$arrayfiles		Elenco dei nomi dei file contenuti nella cartella
	*	@test		si			09/08/2014
*****/

	public function elencaFileBackup()
		{
			$dirname = $this->bck_dir;
			$sheet = $this->sheet;
			$arrayfiles = array();
			$nomefile = array();
			if(file_exists($dirname))
				{
					$handle = opendir($dirname);
					while (false !== ($file = readdir($handle))) 
						{ 
							if(is_file($dirname.$file))
								{
									$nomefile = explode("-", $file);
									//controlla se il back-up in analisi 
									//corrisponde a questa pagina
									if (in_array($sheet, $nomefile))
										{
											//inserisci nell'array-contenitore
											array_push($arrayfiles,$file);
										}
								}
						}		//end WHILE
					$handle = closedir($handle);
				}		//end IF file_exist
		sort($arrayfiles);
		return $arrayfiles;
		}

/****
	* Traduci data prelevata dal nome del file	
	* @param		string		$nome_file		Nome del file preso in esame
	* @return		array		$data_file		[0]Data tradotta nel formato (gg/mm/aaaa hh:mm)
												[1]Hash file 
	* @test			si			09/08/2014	
*****/

	public function formattaData($nome_file)
		{
			$data_file = array();
			$temp = array();
			$temp = explode("-", $nome_file);
					// puliamo array da chiavi che non servono
					$temp = array_reverse($temp);
					for ($i = 1; $i <= 3; $i++)
							{
								array_pop($temp);
							}
					$temp = array_reverse($temp);

			$data_file[1] = substr($temp[1], 0, 12);
					//preparo data
					$data_file[0] = '';
					//prelevo giorno
					$data_file[0] .= substr($temp[0], 4, 2) . '/';
					//prelevo mese
					$data_file[0] .= substr($temp[0], 2, 2) . '/';
					//prelevo anno
					$data_file[0] .= '20' . substr($temp[0], 0, 2) . ' ';
					//prelevo ora
					$data_file[0] .= substr($temp[0], 6, 2) . ':';
					//prelevo minuti
					$data_file[0] .= substr($temp[0], 8, 2) . ':';
					//prelevo secondi
					$data_file[0] .= substr($temp[0], 10, 2);
			
			$data_file = array_reverse($data_file);
			return $data_file;
			
		}

/****
	* Copia le immagini della pagina indicata da sheet nella directory dei BackUp
	* @param		string		$root			Percorso assoluto della cartella che conterrà immagini
	* @return		bool		$results		Ritorna true se	success
	* @test			si			11/08/2014
*****/

	public function backupImmagini($root)
		{
			$dest  = $this->bck_dir . 'immagini_' . $this->sheet . '-imm-backup-';
			$dest .= $this->data . '-' . $this->hash;
			$results = $this->xcopy($root, $dest);
			return $results;
		}
	
	
/****
	* Preleva elenco cartelle di back-up delle immagini dalla cartella principale di back-up
	*	@param		string		$nome_file		Nome del file di back-up per confronto
	*	@return		array		$arrayDir		Elenco dei nomi delle cartelle contenuti nella cartella
	*	@test		si 			11/08/2014
*****/

	public function elencaDirImmagini($nome_file)
		{
			$dirname = $this->bck_dir;
			$arrayDir = array();
			$hash_file = $this->formattaData($nome_file);
			//return $hash_file[1];
			if (is_dir($dirname))
				{
					$handle = opendir($dirname);
					while (false !== ($file = readdir($handle))) 
							{ 
			if(!is_file($dirname.$file) && $file != '.' && $file != '..')
									{
										//CONFRONTARE GLI HASH CARTELLA CON GLI HASH FILE DI BACK-UP
										$temp_dir = substr($file, -12, 12);
										if ($temp_dir === $hash_file[1])
											{
												array_push($arrayDir,$file);
											}
									}
							}		//end WHILE
						$handle = closedir($handle);

				}		//END IF DIR EXIST
		sort($arrayDir);
		return $arrayDir;
		}
		
/****
	* Crea hash univoco che identifica parte del nome
	* @return		string						valore hash formato (12 caratteri)
	* @this			string		$this->hash		
	* @test			no	
*****/

	public function createHash()
		{
			$temp = strtoupper(substr(sha1(microtime()),0, 12));
			$this->hash = $temp;
			return $temp;
		}

	public function backupTables($tables)
		{
			$return = '';
			$sheet = $this->sheet;
			$directory = $this->bck_dir;
			//get all of the tables
			if($tables == '*')
				{
					$tables = array();
					$result = mysql_query('SHOW TABLES');
					while($row = mysql_fetch_row($result))
						{
							$tables[] = $row[0];
						}
				}else{
					$tables = is_array($tables) ? $tables : explode(',',$tables);
				}
			//cycle through
			foreach($tables as $table)
				{
					$result = mysql_query('SELECT * FROM '.$table);
					$num_fields = mysql_num_fields($result);
	
					if ($table !== 'accessi') // non copiare i dati degli accessi
						{
							$return.= 'DROP TABLE IF EXISTS '.$table.';';
							$row2 = mysql_fetch_row(mysql_query('SHOW CREATE TABLE '.$table));
							$return.= "\n\n".$row2[1].";\n\n";
							for ($i = 0; $i < $num_fields; $i++) 
								{
									while($row = mysql_fetch_row($result))
										{
											$return.= 'INSERT INTO '.$table.' VALUES(';
											for($j=0; $j<$num_fields; $j++) 
												{
													// vai ad integrita' dato ?
													$row[$j] = utf8_encode(addslashes($row[$j]));
													/**** GESTISCE I NEW-LINE *****/
													$pattern = "/\n/";
													$replacement = "\\n";
													$row[$j] = preg_replace($pattern, $replacement, $row[$j]);
													/**** ELIMINA I '#' *****/
													$pattern = "/[#]/";
													$replacement = " ";
													$row[$j] = preg_replace($pattern, $replacement, $row[$j]);
													if (isset($row[$j])) 
															{
																$valore_campo = '"'.$row[$j].'"' ;
																$return.= $valore_campo;
															}else{ 
																$return.= '""'; 
															}
													if ($j<($num_fields-1)) { $return.= ','; }
												}
											$return.= ");\n";
										}	
			
								}
							$return.="\n\n\n";
						}		//end IF table != 'accessi'
				}
			// prepare hash
			
			$nome_file = $directory . $sheet . '-db-backup-' . $this->data . '-' . $this->hash . '.sql';
			$handle = fopen($nome_file,'w+');
			fwrite($handle,$return);
			fclose($handle);
			//registra su db
			//saveBackUp($nome_file);
			return true;
	
		
		
		}

/****
	* Rimuovi tutti i file da una directory
	* @param		string		$dirname		Percorso assoluto directory da vuotare
	* @return		bool		$results		Ritorna true se	success
	* @test			si			11/08/2014
*****/

	public function removeFilesFromDir($dirname)
		{
			if(file_exists($dirname))
				{
					$handle = opendir($dirname);
					while (false !== ($file = readdir($handle))) 
						{ 
							if(is_file($dirname.$file))
								{
									unlink($dirname.$file);
								}
						}		//end WHILE
					$handle = closedir($handle);
				}		//end IF file_exist
			return true;
		}

/****
	* Restore della directory immagini
	* @param		string		$nome_dir		Nome della directory che contiene imm questo back-up
	* @param		string		$root			Percorso assoluto della directory che contiene immagini
	* @return		bool		$results		Ritorna true se ha successo
	* @test			si			11/08/2014
*****/

	public function restoreDirImmagini($nome_dir, $root)
		{
			$dirname = $this->bck_dir . $nome_dir;
			$results = true;
			//elimina i file dalla directory $root (cartella immagini)
			$results = $results && $this->removeFilesFromDir($root);
			//elimina i file dalla cartella (thumb);
			$results = $results && $this->removeFilesFromDir($root.'thumb/');
			//elimina root (cartella thumb originale)
			$results = $results && @rmdir($root.'thumb/');
			//elimina root (cartella immagini originale)
			$results = $results && @rmdir($root);
			$results = $results && $this->xcopy($dirname, $root);
			return $results;
		}
		
		
		
}	//END OF CLASS (BCK())
?>



