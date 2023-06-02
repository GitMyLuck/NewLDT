<?php 
//header('Content-type: text/html;charset=utf-8');
class FUNCT extends CONNECT
{
		//attributi
		public $results;
		public $row = array();
		public $errorNum;
		public $login;
		public $index;
		public $admin;
		public $id_str;
		public $my_error;
		public $pagina;
		public $idUtente;
		public $token;
		public $login_error = '';
		public $Max_tentativi;
		

		public function testF()
			{
				return 'ok';
			}
		
/****
		Esegue query SQL su stringa $sql
		@param		string		$sql		Stringa SQL per la query
		@return		array		$this->row	Array contenente risultato query
*****/

		public function sql($sql)
			{
				$this->results = @mysql_query($sql) or die('$sql inviato : ' . $sql . '<br />' . mysql_error());
				$this->row = mysql_fetch_array($this->results);
			}
			
/****
		Esegue query Sql su stringa $sql
		@param		string		$sql		Stringa SQL per la query
		@return		string		$this->results	Stringa contenente le righe Query
*****/

		public function insertSql($sql)
			{
				//$this->doServer();
				$this->results = @mysql_query($sql) or die('$sql inviato : ' . $sql . '<br />' . mysql_error());
			}

		public function noErrorSql($sql)
			{
				$this->doServer();
				$this->results = @mysql_query($sql);
			}

		public function errorNoSql($sql)
			{
				//  permette di gestire errore mySql, indicandone il numero 
				//  se presente errore ritornalo nella variabile [$this->errorNum]
				//  e non caricare le [$this->row]
				//$this->doServer();
				$this->results = @mysql_query($sql);
				$this->errorNum = mysql_error() . ' errorNoSql()';			//incaso di errore non prelevare le righe
				if (! $this->errorNum )
					{
				$this->row = mysql_fetch_array($this->results);
					}
			}
			
		public function isTabella($table)
			{
				$this->doServer();
		if( mysql_num_rows( mysql_query("SHOW TABLES LIKE '".$table."'")))
			{
				return true;
			}
		else
			{
				return false;
				//$this->creaTabella($table);
			}
					
			}


			
			
		public function isTabelleBase()
			{
				$this->doServer();
		if( mysql_num_rows( mysql_query("SHOW TABLES LIKE 'accessi'")))
			{
				return 'true';
			}
		else
			{
				return 'false';
			}
					
			}
		
//---------------------------------- L O G I N ----------------------------------------------------//
/****	Effettua Login (controllo completo con tabelle `accessi` e `black_list`)
		*@param		string		$user			username
		*@param		string		$psw			password
		*@return		bool		true/false		on success
		*@stack						index.php
*****/
		public function doLogin($user, $psw)
			{
				$time = @time();
				$sessione = @session_id();
				$serverIp = $_SERVER['REMOTE_ADDR'];
				$agent = $_SERVER['HTTP_USER_AGENT'];
				$crypt = new DECR();
				$crypt->doServer();
				$user = htmlspecialchars($user);
				$psw = htmlspecialchars($psw);
				$new_user = $crypt->shift64enc($user);
				$new_psw = $crypt->shift64enc($psw);
				$sql = "SELECT * FROM `0_utenti` WHERE usr='$new_user' AND psw='$new_psw' ";
				$this->sql($sql);
				$this->login = false;
				if (isset($this->row[0]))
					{
						// aggiorna accesso
						error_reporting(0);
						$this->login = true;
						$this->idUtente = $this->row['id'];
						$this->admin = $this->row['credenziali'];
						$this->id_str = $this->row['id_struttura'];
						$this->token = $this->row['token'];
						$sql = "UPDATE `accessi` SET `tentativi` = '1'  WHERE `ip_access` = '$serverIp' ";
						$sql .= "AND `agent_access` = '$agent' AND `session_access` = '$sessione' ";
						$this->errorNoSql($sql);
						//se non esistono tabelle (primo accesso) vai avanti comunque senza generare errore 
					}else{
						//GENERA REGISTRAZIONE CON ERRORE
						// confronto tra identificatore di sessione e dati in tabella
						$sql  = "SELECT * FROM accessi WHERE session_access = '$sessione'";
						$res = @mysql_query($sql) or die(mysql_error());

							// se l'identificatore non è presente viene creato un nuovo record nella tabella `accessi`
							// con il valore di n°  tentativi settato a  1
						if(@mysql_num_rows($res) == 0)
							{
								$sql  = "INSERT INTO accessi (data, tentativi, ip_access, agent_access, session_access) ";
								$sql .= "VALUES ($time, '1', '$serverIp', '$agent', '$sessione') ";
								$this->insertSql($sql);
								$diff = $this->Max_tentativi - 1;
								$this->login_error = 'Rimangono altri ' . $diff . ' tentativi...';
						}else{
						
							// se l'identificatore è già presente viene aggiornato il  valore del numero di tentativi
							//preleva numero di tentativi
							$sql  = "SELECT `id`, `tentativi` FROM `accessi` WHERE `ip_access` = '$serverIp' ";
							$sql .= "AND `agent_access` = '$agent' AND `session_access` = '$sessione' ";
							$this->sql($sql);
							//	 preleva id per identificazione
							$index = $this->row[0];
							//	preleva n°  tentativi ed incrementalo
							$tentativi = $this->row[1];
							$diff = $this->Max_tentativi - $tentativi - 1;
							$tentativi++;
							// se n°  tentativi == Max_tentativi allora Black List
							// altrimenti continua e registra nuovo n°  tentativo.
							if ($tentativi == $this->Max_tentativi)
								{
									// RECORD NELLA BLACK LIST
									$utente = new UTENTE($sessione, true);
									$error = $utente->doBlackList();
									$this->login_error = 'Sei stato inserito nella Black List';
								}else{
									$sql = "UPDATE `accessi` SET `tentativi` = '$tentativi'  WHERE id = '$index' ";
									$this->insertSql($sql);
									$error_text = 'Rimangono altri ' . $diff . ' tentativi...';
									if ( $diff == 1 )
										{
											$error_text = 'Rimane un solo tentativo !';
										}
									$this->login_error = $error_text;
								}	// END OF TENTATIVI
							
						}	//END IF RECORD EXIST
					}	//END IF  NOT LOGIN
			}	//END OF FUNCTION
//----------------------------------  F I N E    L O G I N ----------------------------------------------------//

		//---------------P R E L E V A   M A X   I D--------------------------//
		
		public function maxId ($sheet)
			{
				$sql = "SELECT max(real_id) FROM $sheet ";
				$this->sql($sql);
				return $this->row[0];
			}
			
		public function maxIdd ($sheet)
			{
				$sql = "SELECT max(`id`) FROM $sheet ";
				$this->sql($sql);
				return $this->row[0];
			}

		//---------------P R E L E V A   M A X   I D--------------------------//

		//---------	P R E L E V A   D A T I   U T E N T E   B A S E ----------//

		public function getPageUser($index)
			{
				$sql = "SELECT * FROM `0_utenti` WHERE `id` = $index";
				$this->sql($sql);
				$page = $this->row['nome_pagina'];
				return $page;
			}
			
		public function doId($index)
			{
				$sql = "SELECT id, real_id FROM `strutture` WHERE id = $index";
				$this->sql($sql);
				return $this->row;

			}

		
		//---------	P R E L E V A   D A T I   U T E N T E   B A S E ----------//


		//------------	P R E L E V A  N O M I  P A G I N E------------------//
		
		public function doPages()
			{
				$sql = "SELECT name_pagina FROM `0_struttura` ";
				$this->insertSql($sql);
					$counter = 1;
				while ($this->row = mysql_fetch_array($this->results))
						{
							$this->pagina[$counter]= $this->row['name_pagina'];
							$counter++;
						}
				return $this->pagina;
				
			}

		//--------------- N O T I Z I A --------------------------
		//		preleva notizia # [$id]
		public function doNews($id, $tabella)				//OK FOR ******** 
			{
					//$news = array();
					$sql = "SELECT * FROM $tabella WHERE real_id = '$id' ";
					$this->sql($sql);
					return $this->row;
			}
			
			
		public function contaNews($tabella)					//OK FOR ********
			{
				$sql = "SELECT id FROM $tabella WHERE id!=0 ";
				$this->sql($sql);
				$notizie = @mysql_num_rows($this->results);
				return $notizie;
			}
	//*****************************************************************************************************//
	//************************  FUNZIONI LEGATE AI TAGS   *************************************************//
	//*****************************************************************************************************//
		var $superTags = array();
		public function prelevaTags($sheet)
			{
					$sql  = "SELECT `single_tag` ";
					$sql .= " FROM `tags_" . $sheet . "` ";
					$sql .= " ORDER BY `single_tag` ASC ";
					$this->insertSql($sql);
					while (list($result) = mysql_fetch_array($this->results)) 
						{
							if ($result != '')
								{
									$this->superTags[] .= $result;
								}
						}
					
					return $this->superTags;
			}
			
		public function delTag($tag, $sheet)
			{
					$sql  = "DELETE FROM `tags_" . $sheet . "`";
					$sql .= "WHERE `single_tag` = '$tag' ";
					$this->insertSql($sql);
			}
			
		public function addTag($tag, $sheet)
			{
					// controlla unicita'
					$sql  = "SELECT * FROM `tags_" . $sheet . "` ";
					$sql .= "WHERE `single_tag` = '$tag' ";
					$this->insertSql($sql);
					if(@mysql_num_rows($this->results) == 0)
						{
					$sql  = "INSERT INTO `tags_" . $sheet . "`(`single_tag`) VALUES ('$tag') ";
					$this->insertSql($sql);
						}
					else
						{
							return false;
						}
			}
			
			
		public function elencoTags($sheet)
			{
					$sql  = "SELECT `single_tag` ";
					$sql .= " FROM `tags_" . $sheet . "` ";
					$sql .= " ORDER BY `single_tag` ASC ";
					$this->insertSql($sql);
					$elenco = '';
					while (list($result) = mysql_fetch_array($this->results)) 
						{
							if ($result != '')
								{
									$elenco .= $result . ',';
								}
						}
					
					return $elenco;
			}
			
			// POPOLA LA TABELLA ELENCO TAG DISPONIBILI
			public function creaElencoTags($tags, $fun)
				{
					$title = 'clicca per aggiungere';
					if ( $fun == "Sub" )
						{
							$title = 'clicca per eliminare';
						}
					$testo_menu = '';
					$testo_menu .= '<!-- ELENCO TAGS --> 
									<ul class="tag_elenco_content">';
					$tags = array_unique($tags);
					//var_dump ($tags);
					$news_len = count($tags) - 1;
					for ($i = 0; $i <= $news_len; $i++)
						{
								$testo_menu .='<li title="' . $title . '" onclick="click' . $fun . 'Tag(\'' . $tags[$i] . '\');">' . $tags[$i] . '</li>';
						}
					$testo_menu .= '</ul>';
					$testo_menu .= '<div style="clear:both;height:10px;width:1px;"></div>';
					return $testo_menu;
				}

			public function creaRisultatoTags($tags_struttura, $function)
				{
					
					$tags = array();
					$testo_menu = '';
					$testo_menu .= '<!-- RISULTATO TAGS --> 
									<ul class="tag_risultato_content">';
					if ($tags_struttura != '')
						{
							$tags = explode(",", $tags_struttura);
							$news_len = count($tags) - 1;
							for ($i = 0; $i <= $news_len; $i++)
								{
									if ($tags[$i] !== '' && $function != 'mostra')
										{
											$testo_menu .='<li title="clicca per eliminare" onclick="clickDelTag(\'' . $tags[$i] . '\');">' . $tags[$i] . '</li>';
										}
									else if ($tags[$i] !== '' && $function == 'mostra')
										{
									$testo_menu .='<li>' . $tags[$i] . '</li>';
										}
								}		//end ciclo 'for'
						}		//end if esiste tag?
					else
						{
							$testo_menu .='<span>Nessun tag presente...</span>';
						}
					$testo_menu .= '</ul>';
					$testo_menu .= '<div style="clear:both;height:10px;width:1px;"></div>';
					return $testo_menu;
				}
	//*****************************************************************************************************//
	//*********************   FINE FUNZIONI LEGATE AI TAGS   **********************************************//
	//*****************************************************************************************************//

		//-------------------FUNZIONI CHE CARICANO ELENCO NEWS -----------------------------------// 	
		var $date = array();
		var $num_news;
					/*************** NOTIZIE (ORDINATE PER DATA INSERIMENTO) ***************/
		public function showData($sheet, $search)
			{
				$sql = "SELECT * FROM `" . $sheet . "` ";
						if ($search != '')
								{
									$sql .= "WHERE `titolo` LIKE '%$search%' ";
									$sql .= "OR `titolo` LIKE '$search%' ";
									$sql .= "OR `titolo` LIKE '%$search' ";
								}
				if ($sheet == 'eventi' )
					{
						$sql .= "ORDER BY `time_evento` ASC ";
					}
				
				//trigger_error('  I N T E R R U Z I O N E  ', E_USER_ERROR); 

				$this->insertSql($sql);
					$counter = 1;
				while ($this->row = mysql_fetch_array($this->results))
						{
							//  sotituisce titolo inesistente
							$titolo = $sheet . ' num ' . $this->row['real_id'];
							if ( $this->row['titolo'] != '' )
								{
									$titolo = $this->row['titolo'];
								}
							$this->date[$counter]= array ('id' => $this->row['id'],
																			 'real_id' => $this->row['real_id'],
																			 'titolo' => $titolo,
																			 'data_evento' => $this->row['data_evento']);
							$counter++;
						}
				$this->num_news = ($counter-1);
				return $this->date;
			}

					/*************** STRUTTURE (ORDINATE ALFABETICAMENTE) ***************/
		public function showDataStrutture($sheet, $search)
			{
				$sql = "SELECT titolo, tipo_str, real_id FROM `" . $sheet . "`";
						if ($search != 'null')
								{
									$sql .= "WHERE `titolo` LIKE '%$search%' ";
									$sql .= "OR `titolo` LIKE '$search%' ";
									$sql .= "OR `titolo` LIKE '%$search' ";
								}
				$sql .= " ORDER BY titolo ASC ";
				$this->insertSql($sql);
					$counter = 1;
				while ($this->row = mysql_fetch_array($this->results))
						{
							$this->date[$counter]= array ('id' => $this->row['real_id'], 'titolo' => $this->row['titolo'], 'tipo_str' => $this->row['tipo_str']);
							$counter++;
						}
				$this->num_news = ($counter-1);
				return $this->date;
			}
		//------------------------------------------------------------------------------------------// 

		//----------------- 			 F I N E    N O T I Z I A 			------------------------//	
		
		//--------------- I M M A G I N E --------------------------
		public function doImage($id, $tabella, $type)			//OK FOR ********
			{
				// STACK => show.multi.image.php, show.image.php
				$sql = "SELECT filename,ext FROM `" . $type . "_" . $tabella . "` WHERE id_notizia='$id' ";
				$this->sql($sql);
				return $this->row;
			}

		public function contaFoto($sheet, $index)
			{
				// STACK => upload.process.php
				$sql = "SELECT filename FROM `img_" . $sheet . "` ";
				$sql .= "WHERE `id_notizia` = '$index' ";
				$this->sql($sql);
				$immagini = @mysql_num_rows($this->results);
				return $immagini;
			}

		public function cercaIdFoto($filename, $sheet)
			{
					$dotPos = stripos($filename, ".");
					$len = strlen($filename);
					$lenght = $len - 4;
					$file = substr($filename, 0, $lenght);
					$sql = "SELECT `id` FROM `img_" . $sheet . "` WHERE `filename` = '$file' ";
					$this->sql($sql);
					return $this->row['id'];

			}


		public function doMultiImage($id, $sheet, $type)			//OK FOR ********
			{
				// usata nel caso in cui bisogna cercare fra molte immagini
				// STACK => album.foto.php
				$fotos = array();
				$sql = "SELECT `id`, `filename`, `ext` FROM `" . $type . "_" . $sheet . "` WHERE id_not_real='$id' ";
				$this->insertSql($sql);
				$counter = 1;
				while ($this->row = mysql_fetch_array($this->results))
						{
							$fotos[$counter]= array ('id' => $this->row['id'], 'filename' => $this->row['filename'], 'ext' => $this->row['ext']);
							$counter++;
						}
				return $fotos;
			}

		public function doMultiImageNew($id, $sheet, $type)			//OK FOR ********
			{
				// usata nel caso in cui bisogna cercare fra molte immagini
				// STACK => album.foto.php
				$fotos = array();
				$sql = "SELECT `id`, `filename`, `ext`, `didascalia`, `img_default` FROM `" . $type . "_" . $sheet . "` WHERE id_notizia = '$id' ";
				$this->insertSql($sql);
				$counter = 1;
				while ($this->row = mysql_fetch_array($this->results))
						{
							$fotos[$counter]= array ('id' => $this->row['id'], 'filename' => $this->row['filename'], 'ext' => $this->row['ext'], 'didascalia' => $this->row['didascalia'], 'preferita' => $this->row['img_default']);
							$counter++;
						}
				return $fotos;
			}

		public function doMultiImage2($id, $sheet, $type)			//OK FOR ********
			{
				// usata nel caso in cui bisogna cercare fra molte immagini chiave id
				// STACK => show.multi.image.php
				$fotos = array();
				$sql = "SELECT `id`, `filename`, `ext` FROM `" . $type . "_" . $sheet . "` WHERE `id` = '$id' ";
				$this->sql($sql);
				
				return $this->row;
			}

		public function doImageNew($filename, $extension, $real_id, $sheet, $function, $old_file, $width, $height)
			{


				$id = $this->estraiId($sheet, $real_id);
				(!$id )? $id = 1: $id;
				//return $id;
				$img_default = 0;
				//se funzione trasmessa da upload.process non e' "add" allora sostituisci nel DB
				//eliminando l'immagine collegata a ['real_id']
				if ($function == 'add')
						{
							$results = (int)0;
							//  esiste gia' immagine di default per questo id ?
							$sql  = "SELECT `img_default` FROM `img_" . $sheet . "` ";
							$sql .= "WHERE `id_not_real` = $id ";
							$this->insertSql($sql);
							while ($this->row = mysql_fetch_array($this->results))
									{
										$results = $results + (int)($this->row['img_default']);
									}
							
							//  $results = 1  ==  si -> procedi
							if ( !$results )
								//  no -> setta default a 1
								{
									$img_default = 1;
								}

							$sql = "INSERT INTO `img_" . $sheet . "` (filename, ext, id_notizia, id_not_real, img_default, img_width, img_height) VALUES ('$filename','$extension', '$real_id', '$id', '$img_default', '$width', '$height')";
							$this->insertSql($sql);
							return;
						}
				else
						{
							//sostituisci vecchio record con nuovo (la procedura mantiene lo stesso id)
							$old_id = $this->cercaIdFoto($old_file, $sheet);  //ok $old_id restituito giusto
							//  old_id deve restituire anche valore flag default se default = 1
							//  allora per questa immagine settare a uno
							$sql  = "UPDATE `img_" . $sheet . "` SET `filename` = '$filename',  ";
							$sql .= "`ext` = '$extension', `id_notizia` = '$real_id', `id_not_real` = '$id', ";
							$sql .= "`img_width` = '$width', `img_height` = '$height' ";
							$sql .= "WHERE `id` = '$old_id' ";
							$this->insertSql($sql);
							//restituisci didascalia per questa immagine
							$sql = "SELECT * FROM `img_" . $sheet . "` ";
							$sql .= "WHERE `filename` = '$filename' AND `id` = '$old_id' ";
							$this->sql($sql);
							return $this->row;
						}
			}

		//		***ESTRAE IL VERO ID PER SALVATAGGIO
		public function estraiId($tabella, $real_id)
			{
				$sql  = "SELECT id, real_id ";
				$sql .= "FROM `" . $tabella . "` "; 
				$sql .= "WHERE real_id = '$real_id' ";
				$this->sql($sql);
				return $this->row['id'];
					
			}
		

		// STACK => upload.img.preferita.php
		// cambia l'immagine preferita dall'elenco immagini per questa notizia
		public function cambiaPreferita($id, $nomefile, $sheet)
			{
					$index = $this->estraiId($sheet, $id);		//estrai id_not_real
					//azzera la preferita per questa notizia
					$sql  = "UPDATE `img_" . $sheet . "` SET `img_default` = '0' ";
					$sql .= "WHERE `id_not_real` = '$index' ";
					$this->insertSql($sql);

					//aggiorna quella indicata
					$sql  = "UPDATE `img_" . $sheet . "` SET `img_default` = '1' ";
					$sql .= "WHERE `filename` = '$nomefile' ";
					$this->insertSql($sql);

			}


		public function delImage($id, $tabella, $type)				//OK FOR ********
			{
				$sql = "DELETE FROM `" . $type . "_" . $tabella . "` WHERE id_notizia = '$id' ";
				$this->insertSql($sql);	//cancella record da tabella
				//  inserire l'aggiornamento del flag default
				//  selezionando la prima immagine appartenente a questo $id
				//  e settando il flag a uno...
				$sql = "SELECT `img_del` FROM `raccolta_dati` ";
				$this->sql($sql);
				$num_imm = $this->row['img_del'];
				$num_imm++;
				$sql = "UPDATE `raccolta_dati` SET `img_del` = '$num_imm' ";
				$this->insertSql($sql);
			}

		public function delMultiImage($file, $sheet)
			{
				$sql = "DELETE FROM `img_" . $sheet . "` WHERE `filename` = '$file' ";
				$this->insertSql($sql);	//cancella record da tabella
				$sql = "SELECT img_del FROM raccolta_dati ";
				$this->sql($sql);
				$num_imm = $this->row['img_del'];
				$num_imm++;
				$sql = "UPDATE raccolta_dati SET img_del = '$num_imm' ";
				$this->insertSql($sql);


			}
		
		public function aggDatiImm ()
			{
				//aumenta di un il contatore delle immagini caricate
				//STACK => upload.process.php   e  upload.process.pdf
				$sql = "SELECT img_load FROM raccolta_dati ";
				$this->sql($sql);
				$num_imm = $this->row['img_load'];
				$num_imm++;
				$sql = "UPDATE raccolta_dati SET img_load = '$num_imm' ";
				$this->insertSql($sql);

		}
		
		
		// STACK => annulla.image.php, annulla.pdf.php
		public function searchImage($id, $tabella, $type)			//OK FOR ********
			{
				$sql = "SELECT * FROM `" . $type . "_" . $tabella . "` WHERE id_notizia = '$id' ";
				$this->sql($sql);
				$isImage = @mysql_num_rows($this->results);
				return $isImage;
			}

		public function searchMultiImage($id, $tabella, $type)			//OK FOR ********
			{
				$fotos = array();
				$sql = "SELECT * FROM `" . $type . "_" . $tabella . "` WHERE id_notizia = $id ";
				$this->insertSql($sql);
				$counter = 1;
				while ($this->row = mysql_fetch_array($this->results))
						{
							$fotos[$counter]= array ('id' => $this->row['id'], 'filename' => $this->row['filename'], 'ext' => $this->row['ext']);
							$counter++;
						}
				return $fotos;
				//return $this->row;
			}
		
		public function eliminaImmagini($fotos, $sheet)
			{
				// STACK => delete.news.php
				$dir = 'php/immagini_' . $sheet . '/';
				$dirThumb = 'php/immagini_' . $sheet . '/thumb/';
				for ($i = 1; $i <= count($fotos); $i++)
						{
							$file = $fotos[$i]['filename'];
							$ext = $fotos[$i]['ext'];
							$nome_file = $dir . $file . '.' . $ext;
							@unlink($nome_file);
							$nome_file = $dirThumb . $file . '-thumb.' . $ext;
							@unlink($nome_file);
						}
			}
		
		var $id_notizia;
		public function rinumeraNotizie($i, $sheet)
			{
				//STACK => delete.news.php
				$sql = "SELECT `id`, `real_id` FROM `" . $sheet . "` WHERE `real_id` = '$i' ";
				$this->sql($sql);
				$this->id_notizia = $this->row['id'];				//test OK
				$old_real_id = $this->row['real_id'];		//test OK
				$real_id = $this->row['real_id'];		//test OK
				$real_id--;					//decrementa
				$sql = "UPDATE `" . $sheet . "` SET `real_id` = '$real_id' WHERE `real_id` = '$i' ";
				$this->insertSql($sql);	//aggiorna
				return $old_real_id;
			}

		public function rinumeraImmagini($i, $sheet, $new_id)
			{
				//STACK => delete.news.php
				$sql = "SELECT * FROM `img_" . $sheet . "` WHERE `id_notizia` = '$new_id' ";
				$this->sql($sql);
				$real_id = $this->row['id_notizia'];		//test OK
				$real_id--;					//decrementa
				$sql = "SELECT * FROM `img_" . $sheet . "` WHERE `id_notizia` = '$i' ";
				$this->sql($sql);
				$sql = "UPDATE `img_" . $sheet . "` SET `id_notizia` = '$real_id', `id_not_real` = '$this->id_notizia' ";
				$sql .= " WHERE `id_notizia` = '$i' ";
				$this->insertSql($sql);	//aggiorna

			}


		 public function updateDid($id, $sheet, $didas, $nomefile)
			{
				//STACK => update.didascalia.php
				// inserisce nella tabella 
				$sql = "UPDATE `img_" . $sheet . "` SET `didascalia` = '$didas' ";
				$sql .= " WHERE `id_notizia` = '$id'  AND `filename` = '$nomefile' ";
				$this->insertSql($sql);
			}
		//--------------- F I N E   I M M A G I N E --------------------------		
			
		//--------------- P D F  --------------------------
		public function doPdf($id, $tabella)			//OK FOR ********
			{
				$sql = "SELECT filename,ext FROM pdf_$tabella WHERE id_notizia='$id' ";
				$this->sql($sql);
				return $this->row;
			}

		public function doImageNewPdf($filename, $extension, $real_id, $tabella, $type)//OK FOR ********
			{
				$id = $this->estraiId($tabella, $real_id);
				//return $id;
				$sql = "SELECT filename,ext FROM `" . $type . "_" . $tabella . "` WHERE id_notizia = '$real_id' ";
				$this->sql($sql);
				$sql = "DELETE FROM `" . $type . "_" . $tabella . "` WHERE id_notizia = '$real_id' ";
				$this->insertSql($sql);
				$sql = "INSERT INTO `" . $type . "_" . $tabella . "` (filename,ext,id_notizia, id_not_real) VALUES ('$filename','$extension', '$real_id', '$id')";
				$this->insertSql($sql);
				return $this->row;
			}
		//--------------- F I N E  P D F  --------------------------


		//	PULISCI CAMPO TAGS - PULISCE IOL CAMPO TAGS DA SPAZI INDESIDERATI
		public function pulisciTags($tags)
			{
				$temp = array();
				if ($tags == '')
					{
						return $tags;
					}
				//se ultimo carattere  e' una virgola eliminalo
				$ultimo_carattere = substr($tags, -1, 1);
				if ($ultimo_carattere == ',')
							{
								$tags = substr($tags, 0, -1);
							}
				//leva ogni spazio all'inizio ed alla fine di ogni tags
				$temp = explode(",", $tags);
				$len_temp = (count($temp) - 1);
				$tags = '';
					for ($i = 0; $i <= $len_temp; $i++)
						{
							$tags .= trim($temp[$i]) . ",";
						}
				//ricomponi la stringa con le virgole

				//in ultimo controlla se l'ultimo carattere e' una virgola
				//se non lo e' aggiungila
				$ultimo_carattere = substr($tags, -1, 1);
				if ($ultimo_carattere != ',')
						{
							$tags .= ',';
						}
				return $tags;

			}

		//INSDATA INSERISCE IL VALORE DEI CAMPI UNO ALLA VOLTA DALLA PAGINA VARIA
		
		public function insData($node, $value, $id, $sheet)			//OK FOR ******** 
			{
				include "config.inc.php";
				//ECCEZIONE PER IL NODE 'data_evento' PERCHE' DEVE AGGIORNARE ANCHE  'time_evento'
				if ($node == 'data_evento')
						{
								$data_evento = $value;
								$time_ = strtotime(str_replace('/', '-', $data_evento));
								$sql = "UPDATE $sheet SET time_evento = '$time_' WHERE real_id = '$id' ";
								$this->insertSql($sql);
						}
				if ( $node == 'tags' )
						{
								$campo = 'real_id';
								$sql = "UPDATE $sheet SET $node = '$value' WHERE $campo = '$id' ";
								$this->insertSql($sql);
								$sql = "SELECT `tags` FROM `$sheet` WHERE real_id = '$id' ";
								$this->sql($sql);
								//  se rimane solo una virgola nel campo `tags`
								//  allora eliminala;
								if ( $this->row[0] == "," )
									{
										$sql = "UPDATE $sheet SET $node = '' WHERE $campo = '$id' ";
										$this->insertSql($sql);
									}
								return;	
								//return $this->row[0];
						}

				$campo = 'real_id';
				$sql = "UPDATE $sheet SET $node = '$value' WHERE $campo = '$id' ";
				$this->insertSql($sql);
			}


//--------------------------------------------------------------------------------------------------------//
//		TEST ESEGUITO IL 04/04/2014 SENZA ALCUN TIPO DI ECCEZIONE PER ALCUNI CAMPI OK 					  //
		public function updateNews ($campi)
			{
				$sheet = $campi['sheet'];		//prelevo nome pagina		OK
				$id = $campi['id'];				//prelevo id notizia		OK
				array_pop ($campi);
				array_pop ($campi);				//elimino dall'array $campi gli ultimi due valori corr. a $sheet e $id, ormai memorizzati
				$len = (count ($campi)-1);		//prelevo la lunghezza dell'array per posizionare la virgola
				//controlla se esistono tutte le colonne
				foreach ($campi as $key => $value)
						{
							$sql = "SELECT $key FROM $sheet ";
							$this->noErrorSql($sql);
										if ( !$this->results )
												{
														//$newCampi[$key] =  $value;
														$sql = "ALTER TABLE $sheet ADD $key TEXT NOT NULL";
														$this->insertSql($sql);
												}
						}
				//campo data_evento
				if (isset ($campi['data_evento']))
					{
						$data_evento = $campi['data_evento'];
						$time_ = strtotime(str_replace('/', '-', $data_evento));
						$campi['time_evento'] = $time_;
					}
				// dopo aver aggiunto eventuali campi che non esistono passo a
				// popolare tutti i campi della tabella con i dati
				$sql = "UPDATE $sheet SET";
				$counter = 0;
				foreach ($campi as $key => $value)
						{
							
							if ($counter < $len)
								{
									
									$sql .= " $key = '$value',";
									$counter++;
								}
							else 
								{
									
									$sql .= " $key = '$value' ";
									$counter++;
								}
						}
				$sql .= "WHERE real_id = $id ";
				$this->insertSql($sql);
				if ($this->results)
					{
						return $this->results;
					}
				
			}


//--------------------------------------------------------------------------------------------------------//

//------------------------------   CARICA NUOVA NOTIZIA 	---------------------------------------------//			
		public function newInsData($campi)
			{
				$sheet = $campi['sheet'];		// prelevo nome pagina		OK
				$id = $campi['id'];				// prelevo id notizia		OK
				unset($campi['id']);
				unset($campi['sheet']);				// elimino dall'array $campi gli ultimi due valori corr. a $sheet e $id, ormai memorizzati
				$this->aggData();				// aggiorno il contatore delle notizie inserite
				// controlla se esistono tutte le colonne
				foreach ($campi as $key => $value)
						{
							$sql = "SELECT $key FROM $sheet ";
							$this->noErrorSql($sql);
										if ( !$this->results )
													// se non esiste una colonna corrispondente ad una chiave allora
													// viene aggiunta con ALTER TABLE
												{
														$sql = "ALTER TABLE $sheet ADD $key TEXT NOT NULL";
														$this->insertSql($sql);
												}
						}
				//campo data_evento
				if (isset ($campi['data_evento']))
					{
						$data_evento = $campi['data_evento'];
						$time_ = strtotime(str_replace('/', '-', $data_evento));
						$campi['time_evento'] = $time_;
					}
				//campo tags
				if (isset ($campi['tags']))
					{
						$tags = $campi['tags'];
						$campi['tags'] = $tags;
					}
				//campo data di pubblicazione
				$times = @time();
				$campi['data'] = $times;
				//campo visite settato a 0
				$campi['visite'] = 0;
				//campo real_id
				$campi['real_id'] = $id;
				$len = (count ($campi)-1);			//prelevo la lunghezza dell'array per posizionare la virgola
				// dopo aver aggiunto eventuali campi che non esistono passo a
				// popolare tutti i campi della tabella con i dati
				$sql = "INSERT INTO $sheet (";
				$counter = 0;
				foreach ($campi as $key => $value)
						{
							if ($counter < $len)
								{
									$sql .= " $key,";
									$counter++;
								}
							else 
								{
									$sql .= " $key ";
									$counter++;
								}
						}
				$sql .= " ) VALUES (";
				$counter = 0;
				foreach ($campi as $key => $value)
						{
							if ($counter < $len)
								{
									
									$sql .= " '$value',";
									$counter++;
								}
							else 
								{
									
									$sql .= " '$value'";
									$counter++;
								}
						}
				$sql .= ") ";
				$this->insertSql($sql);
				if ($this->results)
					{ 
						return $this->results;
					}

			}
		
		public function aggImg($real_id, $id, $sheet)
		//funzione che al salvataggio della notizia aggiorna il campo ['id_not_real'] nelle
		//tabelle immagini e pdf
			{
				$tbl[1] = 'img_' . $sheet;
				$tbl[2] = 'pdf_' . $sheet;
					for ($t = 1; $t <= 2; $t++)
							{

								$sql = "UPDATE `" . $tbl[$t] . "` SET `id_not_real` = '$id' ";
								$sql .= " WHERE `id_notizia` = '$real_id' ";
								$this->insertSql($sql);
							}
				if ($this->results)
					{
						return $this->results;
					}

			}


		/*-----------------   FINE CARICA NUOVA NOTIZIA 	----------------------*/			
		public function aggData()
			{
				
				// aggiorna tabella raccolta dati
				$sql = "SELECT news_load FROM raccolta_dati ";
				$this->sql($sql);
				$num_imm = $this->row['news_load'];
				$num_imm++;
				$sql = "UPDATE raccolta_dati SET news_load = '$num_imm' ";
				$this->insertSql($sql);
			}
			
			
		public function resDate($data_evento)
			{
				$time_evento = strtotime(str_replace('/', '-', $data_evento));
			}
			
		public function renumNews($id, $tabella)					//OK FOR ********
			{
				// cerca notizia posteriori a quella eliminata per rinumerarle
				$sql = " SELECT * FROM $tabella WHERE real_id > '$id' ";
				$this->sql($sql);
				$numNews = @mysql_num_rows($this->results);
				return $numNews;
			}
			
		public function leggiRaccoltaDati()
			{
				$sql = "SELECT * FROM raccolta_dati ";
				$this->sql($sql);
				return $this->row;
			}
			
		public function leggiAccessi()
			{
				$sql = "SELECT * FROM accessi ";
				$this->sql($sql);
				$this->index = @mysql_num_rows($this->results);
				$last = ($this->index - 1);
				$sql = "SELECT data FROM accessi WHERE id = '$this->index' ";
				$this->sql($sql);
				return $this->row;
			}
			
/***		SUPER SELECT				***
**			* @param 		$tabella		string		nome della tabella
***/
		public function getValori($tabella)
			{
				$query = @mysql_query("SELECT * FROM $tabella");

				if($query)
					{
						$valori = array();
						$sql  = "SELECT `id`,`titolo` FROM `" . $tabella . "` ";
						$sql .= "ORDER BY `titolo` ASC ";
						$this->insertSql($sql);
						$counter = 1;
						while($this->row = @mysql_fetch_array($this->results))
							{
								$valori[$counter] = array(		'id' => $this->row['id'],
																			'titolo' => $this->row['titolo']);
								$counter++;									
							}	// END OF WHILE CYCLE
						return $valori;						
					}		//  END  OF  IF  STATEMENT 
				else
					{
						return '...';
					}	//  END  OF  ELSE  STATEMENT 
			}	//  END  OF  FUNCTION 
	
		public function isUnique($array_val)
			{
				//		$array_val [1]  ['id'];
				$valori = array();
				$new_array = array();
				$sql = "SELECT ut.id_struttura, str.titolo
							FROM 0_utenti AS ut, strutture AS str
							WHERE ut.id_struttura > 0
							AND str.id = ut.id_struttura";
				/*$sql = "SELECT str.id, str.titolo
							FROM strutture AS str
							WHERE str.id NOT IN 
								(
									SELECT ut.id_struttura
									FROM 0_utenti AS ut
								)";*/
				$this->insertSql($sql);
						$counter = 1;
						while($this->row = @mysql_fetch_array($this->results))
							{
								$valori[$counter] = array(		'id' => $this->row['id_struttura'],
																			'titolo' => $this->row['titolo']);
								$counter++;									
							}	// END OF WHILE CYCLE
				//return $valori;			
				//$new_array = $this->arrayRecursiveDiff($array_val, $valori);
				//$new_array = array_diff($array_val, $valori);
				return $valori;
			}
			
		 //$arr1 =    arrayRecursiveDiff($big_array,$small_array);
		public function arrayRecursiveDiff($aArray1, $aArray2) 
			{
			
					if(sizeof($aArray1) > sizeof($aArray2))
						{
							$small_arr = $aArray2;
							$big_arr = $aArray1;
							$arr1_is_big = 1;
						}
					else
						{
							$small_arr= $aArray1;
							$big_arr = $aArray2;
							$arr1_is_big = 0;
						}

					$aReturn = array();

					foreach ($big_arr as $mKey => $mValue) 
						{
							if (array_key_exists($mKey, $small_arr)) 
								{
									if (is_array($mValue)) 
											{
												$aRecursiveDiff = $this->arrayRecursiveDiff($mValue, $small_arr[$mKey]);
												if (count($aRecursiveDiff)) 
														{ 
																$aReturn[$mKey] = $aRecursiveDiff; 
														}
											} 
									else 
											{
												if ($mValue != $small_arr[$mKey]) 
														{
																$aReturn[$mKey] = $mValue;
														}
											}
								} 
						else 
								{
										$aReturn[$mKey] = $mValue;
								}
					}		//END  FOR  EACH
			return $aReturn;
		} 

		public function arrayDiffEmulation($arrayFrom, $arrayAgainst)
    {
        $arrayAgainst = array_flip($arrayAgainst);
        
        foreach ($arrayFrom as $key => $value) {
            if(isset($arrayAgainst[$value])) {
                unset($arrayFrom[$key]);
            }
        }
        
        return $arrayFrom;
    }

		public function getValues()
			{
				// controlla se esiste tabella
				$query = @mysql_query("SELECT * FROM `0_struttura` ");

				if($query)
					{
						$sql = '';
						$sql = " SELECT `id`, `name_pagina` FROM `0_struttura` ";
						$this->insertSql($sql);
						$counter = 1;
						while($this->row = @mysql_fetch_array($this->results))
							{
								if ( $this->results != 0 )
									{
								$pagine[$counter] = array(
											'id' => $this->row['id'],
											'pagina' => $this->row['name_pagina']);
								$counter++;
									}
							}
						return $pagine;
					}
				else
					{
						return 'tabella inesistente';
					}
			}
				
		
		public function getOptionValue($tabella, $id)
			{
				// controlla se esiste tabella
				$query = @mysql_query("SELECT * FROM $tabella");

				if($query)
				{
				$sql='';
				$sql  = "SELECT `titolo` FROM `$tabella` ";
				$sql .= "WHERE `id` = $id ";
				$this->sql($sql);
				return $this->row[0];
				}
			else
				{
					return 'tabella inesistente';
				}
			}	//  END  OF  FUNCTION 
			
			public function creaLookUp($tabella1, $tabella2)
				{
					$name = $tabella1 . '_' . $tabella2;
					$campo1 = $tabella1 . '_id';
					$campo2 = $tabella2 . '_id';
					$sql = "CREATE TABLE IF NOT EXISTS `" . $name . "`
					( 	`" . $campo1 . "` int(11) NOT NULL , 
						`" . $campo2 . "` int(11) NOT NULL ,
						PRIMARY KEY ( `" . $campo1 . "`, `" . $campo2 . "`))
						 ENGINE=InnoDB  DEFAULT CHARSET=utf8;";
					$error = $this->insertSql($sql);
					return $error;
				
				}
			
			public function delTables()
				{
					$sql = "DROP TABLE `accessi`, `backup`, `black_list`, `configuration`, `eventi`, `eventi_luoghi`, `img_eventi`, `img_strutture`, `pdf_eventi`, `pdf_strutture`, `raccolta_dati`, `strutture`, `strutture_luoghi`, `strutture_eventi`, `strutture_tipi_strutture`, `tags_eventi`, `tags_strutture`, `utenti_on_line`;";
					$this->insertSql($sql);
				
				}
				
			public function resetStr()
				{
					$sql = "UPDATE `0_struttura` SET `tot_box`= '0', `tot_funct`= '0' WHERE `id` = 1";
					$this->insertSql($sql);
				
				}
				
}		// END  OF  CLASS 
?>



