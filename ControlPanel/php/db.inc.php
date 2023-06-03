
<?php
include "elenco.class.php";
class CONNECT
{

	// parametri per la connessione al database
	private $conn = array ("UW1MeFBXVDhPbUg0UEY3e1JXUEA=", "WDZJdlFtZjZRbVQ4", "XXBVbF1aWWtRcFRA", "UFdMNk9tRHhQRjd7", "ZnA8eWdEQEA=", "");
	// "UktqNmhHVWxcfUxA"
  	private $nomehost;    
  	private $nomeuser;         
  	private $password;
	
	private $db;
	private $db_dec;
	// controllo sulle connessioni attive..
  	private $isActive = false;
	// funzione per il controllo della posizione
	// del server: LOCALE o REMOTO
	public function doServer()
		{
			//  settando a "null" $pos si connette sempre con esterno
			$pos = '127.0.0.1';		//local database
			$server = $_SERVER['SERVER_ADDR'];
				if ($server == $pos)
					{
						$this->nomehost = $this->conn[3];
						$this->nomeuser = $this->conn[4];
						$this->password = $this->conn[5];
						//$this->db_dec = 'THxQbWVwWTZXSFVY';	//"###newLDT"
						$this->db_dec = 'THxQbWVwWTZbNXtuZ0RAQA==';	//"###new_ldt"
						$this->connect();
						$this->doDB();
					}
				else
					{
						$this->nomehost = $this->conn[0];
						$this->nomeuser = $this->conn[1];
						$this->password = $this->conn[2];
						$this->db_dec = 'WDZJdlFtZjZRbVQ4W31UQA==';
						$this->connect();
						$this->doDB();
					}
		}
	
	// cerca database (nome memorizzato in [$db])
	public function doDB()
	{
		if($this->connect())
			{
				// database trovato
				$this->onConnect();
			}
		else
			{
				// database non trovato
				$this->onInconnect();
			}
	}
	
	// trovato il database gestisci con jump alla routine mostra
	
	public function onConnect()
	{
		$this->db = $this->shift64($this->db_dec);
		if(@mysql_select_db($this->db))
			{
				return 'Data Base connesso!';
			}
		else
			{
				// database non trovato abortita connessione
				// con messaggio
				$this->disconnect();
				return 'Impossibilitato a trovare il db';
			
			}
		
	}
	
	// connessione al server non riuscita
	public function onInconnect()
	{
	
			echo 'connessione fallita.';

	}
	
	
  	// funzione per la connessione a MySQL
  	public function connect()
  	{
  		if(!$this->isActive)
   		{

			$host = $this->shift64($this->nomehost);
			$nomeuser = $this->shift64($this->nomeuser);
			$psw = $this->shift64($this->password);
   		$connessione = @mysql_connect($host,$nomeuser,$psw);
			//$this->isActive = true;
   			return true;
    	}
    	else 
    	{
    		return false;
    	}
    }
    
	// funzione per la chiusura della connessione
	public function disconnect()
	{
		if($this->isActive)
        {
        	if(@mysql_close())
            {
            	$this->isActive = false;
             	return true;
            }
            else
            {
            	return false;
            }
        }
 	}
	
	private function shift64($string)
		{
				$temp = '';
				$temp_2 = '';
				$temp_3 = '';
				// da chiaro a base 64
				$temp = base64_decode($string);
				
				// shift di 3
				$valore = 3; 
				for ($i=0; $i<strlen($temp); $i++) 
					{
						$carattere = $temp[$i];
						$xor = ord($temp[$i]) - $valore;
						$car = chr($xor);
						$temp_2 .= $car;
					}
				$ris = base64_decode($temp_2);
				return $ris;
		
		}
		
}      
?>