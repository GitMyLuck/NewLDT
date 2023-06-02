<?php 
//header('Content-type: text/html;charset=utf-8');
class WORD extends FUNCT
{
public $word = array("music","dance","noia","gatto","dog","vera","word","fiasco","vino","veloce","parole","fatti","song","conto","caldo","freddo","gioco","game","signore","castello","ducato","regina","reame","palazzo","casa","break","pena","pace","libero","free","lorem","volo","bird","smilzo","parte","inizio","fine","valore","valvola","viola","fiore","carta","felice","fiera","banda","pink","gryzzly","flauto","figura","sballo","ballo","danza","numero","logica","cara","usura","favola","baby","tondo","giallo","paura","nebbia","fog","crema","notte","buio","fly","base","play","may","aprile","sole","cool","vita","car","ser","gigo","nenfo","rosa","sem","bob","ipsum","merc","dark","side");
//public $word = array("music","dance","noia");
private $userName;
private $passWord;

	public function nNum($n)
	//		AGGIUNGE  [$n]  NUMERI CASUALI ALLA STRINGA  [$str]
							{
								$str = '';
								for ( $i = 1; $i <= $n; $i++ )
									{
											$num = (string)(rand(0, 9));
											$str .= $num;
									}
								return $str;
							}
	public function nChr()
	//		AGGIUNGE UN CARATTERE CASUALE  DA  'a'   A 'z'
							{
								$str = chr(rand(97, 122));
								return $str;
							}
	//		CREA  USERNAME  O   PASSWORD
	public function doUser($type)				///  'user'   o    'psw'
			{
				$results = false;
				$user = '';
				// crea username
				do
					{
						//  CICLO DA EFFETTUARE   ...
						$user = $this->dWord($type);
						//controlla unicita'
						$results = $this->uniqueUser($user);		//controllo OK 08/03/2015
					} while (!$results);
					
				return $this->userName;
			}

	public function dWord($type = 'psw')
			{
				$dWord = "";
				$ind = rand(0, (count($this->word) - 1));
				$tempWord = $this->word[$ind];
				switch ($type)
					{
						case 'psw' :
											$dWord .= $this->nNum(1);
											$dWord .= $this->nChr();
											$dWord .= $tempWord;
											$dWord .= $this->nChr();
											$dWord .= $this->nChr();
											$dWord .= $this->nNum(2);
											$this->userName = $dWord;
						break;
						
						case 'usr' :			//  formato =   [0 - 3] numeri - parola - [0 - 1]numeri
											$dWord .= $this->nNum(rand(0,3));		// tra 0 e 3 numeri
											$dWord .= $tempWord;
											$dWord .= $this->nNum(rand(0,1));		// tra 0 e 1 numero
											$this->userName = $dWord;
						break;
						
						default :
											//$dWord .= $this->nNum(1);
											$dWord .= $tempWord;
											//$dWord .= $this->nNum(3);
						break;
					}			//  END  OF  SWITCH
				$crypt = new DECR();
				$crypt->doServer();
				$dWord = $crypt->shift64enc($dWord);
				return $dWord;
			}
		
		public function uniqueUser($dWord)
				{
				$sql  = "SELECT * FROM `0_utenti` ";
				$sql .= " WHERE `usr` = '$dWord' ";
				$sql .= " OR `psw` = '$dWord' ";
				$this->insertSql($sql);
				// parola unica
				if(@mysql_num_rows($this->results) == 0)
					{
						return true;
					}
				else
					{
						return false;
					}
			
			}
	public function doToken()
			{
				$temp_str = sha1($this->doUsr(5));
				$temp_time = (strtoupper(substr(sha1(microtime()),0, 6)));
				$risultato = strtoupper($temp_str . $temp_time);
				//$this->risultato = sha1($string, true);

			return $risultato;
			}
			
	public function doUsr($len)
	{
		$text_usr = '';
		$number = 122;
		for($r=1; $r<=$len; $r++)
			{
			$type = rand(1, 2);
			switch ($type)
				{
					case 0:
					$number = rand(97, 122);//lettere minusc.
					break;
					
					case 1:
					$number = rand(65, 90);//lettere maiusc.
					break;
					
					case 2:
					$number = rand(48, 57);//numeri
					break;
				}
			$text_usr .= chr($number);
			
			
			}
			return $text_usr;
	}
	
			
public function estraiWords($string)
	{
			
	
	
	}


}		// END  OF  CLASS