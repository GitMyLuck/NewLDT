<?php 
//header('Content-type: text/html;charset=utf-8');
class UTENTE extends FUNCT
{

public $sess;
public $success;
public $time_session;
public $num_utenti;
public $utenti = array();
/****
	* Construct method
	* @param	string		$sessione		Sessione Corrente
	* @param	bool		$success		Stato 'success' 	true  or  false		
	* @test		no					
*****/
	public function __construct($sessione, $success) 
		{
			$this->sess = $sessione;
			$this->time_session = @time();
		}

		
/****		registra sessione utente
	* @return		bool		$res		True on Success
	*@stack		index.php
*****/
	public function registraUtente()
	
		{
			$res = true;
			$intervallo = intval($this->time_session - (60 * 2));		// 2 MINUTI		
			// CONTROLLA ESISTENZA SULLA BLACK LIST
			$res = $res && $this->checkBlackList();
			// AGGIORNAMENTO SESSIONE
			$res = $res && $this->aggSessione();
			// CANCELLA DATI SESSIONI OBSOLETE
			$res = $res && $this->deleteOldData($intervallo);
			return $res;
		}


	public function aggSessione()
		{
			$token = $_SESSION['token_utente']; 
			$sessione = $this->sess;
			$time = $this->time_session;
			$serverIp = $_SERVER['REMOTE_ADDR'];
			# confronto tra identificatore di sessione e dati in tabella
			$sql = "SELECT * FROM utenti_on_line WHERE sessione = '$sessione' AND token_utente = '$token' ";
			$this->insertSql($sql);
			# se l'identificatore non è presente viene creato un nuovo record
			if(@mysql_num_rows($this->results) == 0)
				{
					$sql = "INSERT INTO utenti_on_line ( sessione, ip_utente, tentativi, token_utente, timestamp ) VALUES ( '$sessione', '$serverIp', '0', '$token', '$time' )";
					$this->insertSql($sql);
					return true;
				}else{
					# se l'identificatore è già presente viene aggiornato il valore relativo al momento di connessione
					$sql  = "UPDATE utenti_on_line SET timestamp = '$time' ";
					$sql .= "WHERE sessione = '$sessione' ";
					$sql .= "AND token_utente = '$token' ";
					$this->insertSql($sql);
					return true;
				}
			return true;
		}
		
	public function deleteOldData($intervallo)
		{
			$sessione = $this->sess;
			$token = $_SESSION['token_utente']; 
			$sql  = "DELETE FROM utenti_on_line ";
			$sql .= "WHERE timestamp < '$intervallo' ";
			$sql .= "AND sessione = '$sessione' ";
			$sql .= "AND token_utente != '$token' ";
			$this->insertSql($sql);
			return true;
		}
		
		
/****	Controlla esistenza dei dati utente nella Black-List
	* @return		boolean		$test		FALSE se utente e' in Black-List 	
													TRUE se utente NON esiste in Black-List
	*@stack		$this->registraUtente()
*****/
	public function checkBlackList()
		{
			$test = true;
			$serverIp = $_SERVER['REMOTE_ADDR'];
			$req_time = $_SERVER['REQUEST_TIME'];
			$agent = $_SERVER['HTTP_USER_AGENT'];
			
				// CONTROLLA BLACK LIST
				$sql  = "SELECT * FROM `black_list` ";
				$sql .= "WHERE `ip_black` = '$serverIp' ";
				$sql .= "AND `agent_black` = '$agent' ";
				$this->sql($sql);
				if ($this->row)
					{
						// CONTROLLO SERVER
						$test = $test && ($this->row[1] === $serverIp);
				
						// CONTROLLO USER-AGENT
						$test = $test && (trim($this->row[2]) === $agent);
				
						// CONTROLLO DATA
						// @test = data_entrata in Black-List + valore di una settimana > data_attuale
						// settimana = 1 giorno (86400) * 7	=  604800
						$data = $this->row[3];		//prelevo data iscrizione nella BL
						$control_data = intval($data + 600);
						if($control_data < ($this->time_session))
							{
								//cancella da black list
								$sql  = "DELETE FROM `black_list` ";
								$sql .= "WHERE `ip_black` = '$serverIp' ";
								$sql .= "AND `agent_black` = '$agent' ";
								$sql .= "AND `time_black` = '$data' ";
								$this->insertSql($sql);
								$test = $test && true;
								return $test;
							}else{
								$this->login_error = 'Account Bloccato!';
								$test = $test && false;
								return $test;
							}
						return $test;
					}	//END IF EXIST ROW
				return true;
			}

/****
	*	inserisci dati errore nella BlackList
	*	@ return	bool	true on success
*****/

	public function doBlackList()
		{
			$time = @time();
			$serverIp = $_SERVER['REMOTE_ADDR'];
			$agent = $_SERVER['HTTP_USER_AGENT'];
			// CONTROLLA ESISTENZA RECORD
			$sql  = "SELECT * FROM `black_list` WHERE ";
			$sql .= "`ip_black` = '$serverIp' AND ";
			$sql .= " `agent_black` = '$agent' ";
			$res = @mysql_query($sql) or die(mysql_error());
			if(@mysql_num_rows($res)==0)
				{
					$sql  = "INSERT INTO `black_list` ( ip_black, agent_black, time_black) ";
					$sql .= "VALUES ('$serverIp', '$agent', '$time')";
					$error = $this->insertSql($sql);
				}else{
					// Preleva  `id`
					$this->row = @mysql_fetch_array($res);
					$index = $this->row['id'];
					$sql  = "UPDATE `black_list` SET `time_black` = '$time'  WHERE";
					$sql .= " `id` = '$index' ";
					$error = $this->insertSql($sql);
				}
			if ($error)
				{
					return false;
				}else{
					return true;
				}
		}

/****	
	*	preleva i dati degli utenti registrati dalla tabella 0_utenti
	*	@param	string		$index						numero utente da prelevare
	*	@return		string		$this->num_utenti			numero di utenti trovati nella tabella
	*	@return		array		$this->utenti				elenco utenti 
	*	@stack		'php/menu.user.php', 'main-user.php'
	*	@type		public
*****/

	public function prelevaUtenti($index, $search)
		{
			$sql  = "SELECT * FROM `0_utenti`";
			if ($search != 'null')
								{
									$sql .= "WHERE `nome_utente` LIKE '%$search%' ";
									$sql .= "OR `nome_utente` LIKE '$search%' ";
									$sql .= "OR `nome_utente` LIKE '%$search' ";
								}
			$this->insertSql($sql);
			$counter = 1;
			while ($this->row = mysql_fetch_array($this->results))
						{
							// non vengono mostrati users con la credenziale administrator
							// per evitare che possano essere modificati...
							if ( $this->row['credenziali'] != 1 )
								{
									$this->utenti[$counter] = 
									array (		'num' => $this->row['real_id'], 
													'id' => $this->row['id'], 
													'user' => $this->row['usr'], 
													'password' => $this->row['psw'], 
													'admin' => $this->row['credenziali'],
													'token' => $this->row['token'], 
													'nome' => $this->row['nome_utente'], 
													'nick_name' => $this->row['nick_name'],
													'indirizzo-mail' => $this->row['e_mail'],
													'pagina' => $this->row['nome_pagina'],
													'struttura' => $this->row['id_struttura'],
													'data_scad' => $this->row['payment_str'], 
													'contratto' => $this->row['contratto']);
									$counter++;
								}
						}
			$this->num_utenti = ($counter-1);
			if ( $this->num_utenti === 0)
				{
					return;
				}
			// 	SCEGLI UTENTE DA RESTITUIRE
			if ($index !== '' && $search == 'null')
				{
					return $this->utenti[$index]; 
				}
			
		}		//  END  OF  FUNCTION  prelevaUtenti

/****
	*	inserisci variazione nella tabella user
	*	@param	string		$node		nome del campo che viene variato
	*	@param	string		$value		valore del campo che viene variato
	*	@param	string		$id 			indice che indica l'id dell'utente in questione
	* 	@param	string		$sheet		nome della tabella di solito corrispondente al nome della pagina 
	*  	@stack 				spedisciUser(o) -> gestioni.user.js -> data.user.update.php
	*	@type		public
*****/		

	public function insDataUser($node, $value, $id)
		{
				$campo = 'real_id';
				// CAMPI  USERNAME E PASSWORD CRIPTAZIONE
				if ( $node == 'usr' || $node == 'psw' )
					{
						$crypt = new DECR();
						$crypt->doServer();
						$value = $crypt->shift64enc($value);
					}
				// CONTROLLO UNICITA' STRUTTURA
				if ( $node == 'id_struttura' )
					{
						//	controllo unicita struttura
					
					}
				$sql = "UPDATE `0_utenti` SET $node = '$value' WHERE $campo = '$id' ";
				$this->insertSql($sql);
		}		//  END  OF  FUNCTION  insDataUser()
		
/****	
	*	preleva i dati dell'utente dalla pagina main-nuovo-user e salvalo nel DB
	*	@param		array			$utente				elenco del POST_ inviato da ...
	*	@return		boolean		$this->error			on success return true
	*	@stack         gestioni.user.php -> save.user.php
	*	@type		public
*****/
	public function saveUtente($utente)
		{
				$sql = " INSERT INTO `0_utenti` ( `real_id`, `usr`, `psw`, `credenziali`,`nome_pagina`,`nome_utente`,`nick_name`, `e_mail`, `payment_str`, `token` ) ";
				$sql .= "VALUES ( "
				. $utente['id'] . ", '"
				. $utente['usr'] . "' , '" 
				. $utente['psw']. "' , '" 
				. $utente['credenziali'] . "' , '" 
				. $utente['nome_pagina']. "' , '"
				. $utente['nome_utente']. "' , '" 
				. $utente['nick_name']. "' , '"
				. $utente['e_mail']. "' , '"
				. $utente['payment_str']. "' , '"
				. $utente['token']. "' ) ";
				
				$error = $this->insertSql($sql);	
				return $error;							
		
		}		//  END  OF  FUNCTION saveUtente()


}			//  END  OF  CLASS
?>