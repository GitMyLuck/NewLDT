<?php 
//header('Content-type: text/html;charset=utf-8');
class CONFIG extends FUNCT
{
	public $aCampi = array();
	public $aValori = array();
	public $aTemi = array();
		
		
			public function contrUnique($nome)
				{
					$sql  = "SELECT `type` FROM `configuration` ";
					$sql .= "WHERE `type` = '$nome' ";
					$this->sql($sql);
					$num_righe = count($this->row) - 1; 
					return $num_righe;
				
				}
				
			public function nuovaRiga($orig = 'default', $dest = 'temp')
			{
				$error = '';
				$responso = $this->contrUnique($dest);
				if ( $responso != 0 )
						{
						$error .= '<br />' . @date(r) . '<br />nome configurazione già esistente<br />';
						$error .= 'salvataggio non eseguito..<br /> <br /> <br />  <br /> <br /> <br /> <br /> <br /> <br /> <br /> ';
							return 'notsucces';
							return $error;
						}
				//		LAVORARSI IL RESPONSO = 1 (nome gia' esistente)
				//exit(var_dump(' salva riga   :  ' . $responso)); 
				$preleva = $this->prelevaValori($orig);
				$campi = $this->prelevaCampi();
				$lenCampi = count($this->aCampi);
				$sql  = "INSERT INTO  `configuration` (";
				for ($i = 1; $i <= ($lenCampi - 1); $i++)
						{
							if ( $i == ($lenCampi - 1) )
								{
									$sql .= "`" . $this->aCampi[$i] . "`";
								}
							else
								{
									$sql .= "`" . $this->aCampi[$i] . "`, ";
								}
						}
				$sql .= ') VALUES ( ';
				for ($i = 1; $i <= ($lenCampi - 1); $i++)
						{
							if ( $i == 0 )
								{
									$sql .= 'NULL,';
								}
							if ( $i == 1 )
								{
									//		campo `type`		( 'temp', 'default', ecc. )
									$sql .= " '$dest', ";
								}
							else if ( $i == ($lenCampi - 1) )
								{
									$sql .= "'" . $this->aValori[$i] . "'";
								}
							else
								{
									$sql .= "'" . $this->aValori[$i] . "', ";
								}
						}
				$sql .= ');';
				$error = $this->insertSql($sql);
				if ( !$error )
					{
						$error  = $preleva . $campi;
						$error .= '<br />' . @date(r) . '<br />nuova riga inserita<br />';
						$error .= 'nominata "' . $dest . '"<br /><br />Sql inviato: <br />' . $sql . '<br /> <br /> <br />  <br /> <br /> <br /> <br /> <br /> <br /> <br /> ';
						return 'success';
					}
				return $error;
				
			}
		
		public function eliminaRiga($type = 'temp')
			{	
				$sql  = "DELETE FROM `configuration` WHERE `type` = '$type' ";
				$error = $this->insertSql($sql);
				if ( !$error )
					{
						$error = @date(r) . '<br />eliminazione riga " ' . $type . ' "<br /><br />';
					}
				return $error;
			}
			
		public function prelevaCampi()
			{
				$sql  = "SHOW COLUMNS FROM `configuration`";
				$this->insertSql($sql);
				$campi = '';
				$counter = 1;
				while($this->row = @mysql_fetch_array($this->results))
					{
						$this->aCampi[] = $this->row[0];
						$campi .= $counter . ' - ' . $this->row[0] . '<br /> ';
						$counter++;
					}
				$message = @date(r) . '<br />colonne prelevate dalla tabella `configuration` <br />' . $campi . '<br />';
				return $message;
			}
			
		public function prelevaValori($val = 'default')
			{
				$sql  = "SELECT * FROM `configuration` ";
				$sql .= "WHERE `type` = '$val' ";
				$this->insertSql($sql);
				$valori = '';
				while($this->row = @mysql_fetch_array($this->results))
					{
						$this->aValori = $this->row;
					}
				$counter = 1;
				foreach (array_unique($this->aValori) as $dato)
					{
						$valori .= $counter . ' - ' . $dato . '<br />';
						$counter++;
					}
				$message = @date(r) . '<br />valori prelevati dalla riga " ' . $val . ' "<br />' . $valori . '<br />';
				return $message;
				
			}
		
		//		PRELEVA TUTTI I TEMI SALVATI NEL DATABASE
		//		TRANNE ( current,  default,  temp  )
		
		public function getThemes()
			{
				$sql  = "SELECT * FROM `configuration` ";
				$sql .= "WHERE `type` != 'current' ";
				$sql .= "AND `type` != 'default' ";
				$sql .= "AND `type` != 'temp' ";
				$this->insertSql($sql);
				$counter = 0;
				while($this->row = @mysql_fetch_assoc($this->results))
					{
						$this->aTemi[$counter] = $this->row;
						$counter++;
					}
				return $this->aTemi;
			}
			
			
		public function getTitle()
			{
				$sql = "SELECT titolo, copy FROM configuration WHERE id = 1 ";
				$this->sql($sql);
				return $this->row;
				
			}

		public function doTitle($dato)
			{
				$sql = "UPDATE configuration SET titolo = '$dato' ";
				$this->insertSql($sql);
			}
			
		public function doVersione($dato)
			{
				$sql = "UPDATE configuration SET copy = '$dato' ";
				$this->insertSql($sql);
			}
		public function doColors($type)
			{
				$sql = "SELECT * FROM configuration ";
				$sql .= "WHERE `type` = '$type'";
				$this->sql($sql);		// !importante non modificare
				return $this->row;
			}
			
		public function setColor($color, $campo)
			{
				$sql = "UPDATE configuration SET $campo = '$color' ";
				$sql .= "WHERE id = 1";
				$this->insertSql($sql);
			}
			
		public function setNewColor($campo, $color, $type)
			{
				$sql = "UPDATE `configuration` SET $campo = '$color' ";
				$sql .= "WHERE `type` = '$type' ";
				$error = $this->insertSql($sql);
				if ( !$error )
					{
						$error = @date(r) . '<br />inserito nuovo colore: <br />colore  " #' . $color . ' "<br />nel campo  " ' . $campo . ' "<br />tipo " ' . $type . ' "<br /><br />';
					}
				return $error;
			}
			
		public function defaultColor($campo)
			{
				$sql = "SELECT $campo FROM configuration WHERE type = 'default' ";
				$this->sql($sql);
				return $this->row[0];	
			}
			
	public function setPerc($perc)
		{
			$sql = "UPDATE `configuration` SET `change_perc` = $perc ";
			$sql .= "WHERE `type` = 'temp' ";
			$error = $this->insertSql($sql);
			return $error;
		
		}
		
	public function setRadius($radius)
		{
			$sql = "UPDATE `configuration` SET `border_radius` = $radius ";
			$sql .= "WHERE `type` = 'temp' ";
			$error = $this->insertSql($sql);
			return $error;
		
		}
		
	public function getDefaultPerc()
		{
				$campo = 'change_perc';
				$sql = "SELECT $campo FROM configuration WHERE type = 'default' ";
				$this->sql($sql);
				return $this->row[0];	
		}
			
  public function calcola_sfum($change_percentage, $sfum_pannelli)
	{
		
		$colors = array();
		$colore = '';
		$change_percentage = $change_percentage + 0;
		$sfum_colore = substr($sfum_pannelli, 1, 6);			//leva il cancelletto dalla stringa colore
		$colors[0] = hexdec(substr($sfum_colore, 0, 2));
		$colors[1] = hexdec(substr($sfum_colore, 2, 2));
		$colors[2] = hexdec(substr($sfum_colore, 4, 2));
		//$colors = explode(",", $sfum_pannelli);
		//return $colors[1];
			for ($i = 0; $i <= 2; $i++)
				{
					$colors[$i] = $colors[$i] + (floor($colors[$i] * $change_percentage / 100));
						if ($colors[$i] >= 255)
							{
								$colors[$i] = 255;
							}
					$decimal = dechex($colors[$i]);
					if ( $colors[$i] < 10 )
						{
							$decimal = '0' . $decimal;
						}
					
					$colore = $colore . $decimal;
				}
		$colore = '#' . strtoupper($colore);
		return $colore;
	}

	public function salvaIcone($img, $name, $color)
		{
			return 'siamo qua';
			$dir = "../../images/icone/$color";
			if(!file_exists($dir) || !is_dir($dir)) mkdir($dir,777,true);
			$file = $dir."/$name";
			file_put_contents($file,file_get_contents("data://".$img));
			/*if(file_exists($file)) echo "Success";
					else echo $file;
			die();*/
			$old_dir = "../../images/icone/";
			$w_file = array("help-white.png","help-black.png");
			for ($i = 0; $i <= count($w_file) - 1; $i++)
				{
					copy($old_dir . $w_file[$i], $dir . "/" . $w_file[$i]);
				}

			$color = substr($r['color'], 1);
			$css_dir = "../../css/";
			$f = $css_dir . "icone.template.css";
			$contenuto = file_get_contents($f); 
			$contenuto = preg_replace("/color/", $color, $contenuto);
			$dest = $css_dir . "icone.temp.css";
			file_put_contents($dest,$contenuto);
			return $contenuto;
		}
}
?>