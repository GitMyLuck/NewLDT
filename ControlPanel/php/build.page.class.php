<?php 
//header('Content-type: text/html;charset=utf-8');
include 'new.build.page.main.php';
class BUILD extends FUNCT
{
	
var $pagina;
var $num_boxes;
var $box = array();
var $functions = array();
		 // costruttore
        public function __construct($pagina) 
			{
				//zona in cui possiamo effettuare dei controlli
				//o delle lavorazioni sugli attributi passati,
				//prima di renderli pubblici per la classe
                $this->pagina = $pagina;
			}


		public function contaBox()
			{
				$sql  = "SELECT * FROM `0_boxes`, `0_struttura`";
				$sql .= "WHERE 0_boxes.num_pagina = 0_struttura.id ";
				$sql .= "AND 0_struttura.name_pagina = '$this->pagina' ";
				$sql .= "ORDER BY num_box ASC";
				$this->insertSql($sql);
				$this->num_boxes = (@mysql_num_rows($this->results) - 1);
				
				$counter = 1;
					while($this->row = @mysql_fetch_array($this->results))
							{
								
								$this->box[$this->pagina][$counter] = array ( 	
								
'id_box' => $this->row['id_box'],
'title_box' => $this->row['title_box'],
'num_box' => $this->row['num_box'],
'width_box' => $this->row['width_box'],
'height_box' => $this->row['height_box'],
'type_box' => $this->row['type_box'],
'inflate_box' => $this->row['inflate_box'],
'display_box' => $this->row['display_box'],
'help_box' => $this->row['help_box']);
								$counter++;
							}
					return $this->box;
				
			}
			
		public function contaFunct()
			{
					$sql  = "SELECT `id` FROM `0_functions` ";
					$sql .= "WHERE `0_functions`.`pagina_funct` = '$this->pagina' ";
					$this->insertSql($sql);
					//		CONTA  LE  RIGHE
					$funzioni = @mysql_num_rows($this->results);
					return $funzioni;
			}
			
		public function aggBox($num)
			{
				$num = (int)$num;
				$sql  = "UPDATE `0_struttura` ";
				$sql .= "SET `tot_box` = $num ";
				$sql .= "WHERE `name_pagina` = '$this->pagina' ";
				$this->insertSql($sql);
			
			}
			
		public function aggFunct($num)
			{
				$num = (int)$num;
				$sql  = "UPDATE `0_struttura` ";
				$sql .= "SET `tot_funct` = $num ";
				$sql .= "WHERE `name_pagina` = '$this->pagina' ";
				$this->insertSql($sql);
			
			}
			
/*		CONTROLLA CHE NON SIANO STATI AGGIUNTI DEI BOX A QUESTA PAGINA */
		public function isBox($pagina)
			{
				//return $pagina;
				$sql  = "SELECT * FROM `0_struttura` ";
				$sql .= "WHERE `name_pagina` = '$pagina' ";
				$this->sql($sql);
				return $this->row['tot_box'];
			
			}
	
/*		CONTROLLA CHE NON SIANO STATI AGGIUNTI DELLE FUNZIONI A QUESTA PAGINA */
	
		public function isFunct($pagina)
			{
				$sql  = "SELECT * FROM `0_struttura` ";
				$sql .= "WHERE `name_pagina` = '$pagina' ";
				$this->sql($sql);
				return $this->row['tot_funct'];
			}
			
			
		public function getFunctions($box_id)
			{
					//$this->functions = NULL;
					$temp = array();
					$ricerca = intval($box_id);
					$sql = "SELECT * FROM 0_functions
							WHERE funct_num_box = $ricerca AND pagina_funct = '$this->pagina' ";
							//WHERE funct_num_box = $ricerca AND pagina_funct = '$this->pagina' ";
					$this->insertSql($sql);
					$counter = 1;
					while($this->row = @mysql_fetch_assoc($this->results))
							{
								
								$temp[$ricerca][$counter] = array ( 
								'id_funct' => $this->row['id_funct'],
								'label_funct' => $this->row['label_funct'],
								'sub_label_funct' => $this->row['sub_label_funct'],
								'type_funct' => $this->row['type_funct'],
								'title_funct' => $this->row['title_funct'],
								'size_funct' => $this->row['size_funct'],
								'select_val_funct' => $this->row['select_val_funct'],
								'visible_funct' => $this->row['visible_funct'],
								'height_funct' => $this->row['height_funct'],
								'help' => $this->row['help'],
								'binding' => $this->row['binding']);
								$counter++;
							}
					
							return $temp;
			}

/****
		Preleva i campi necessari alla creazione delle tabelle
		@param		string		$this->pagina	nome della pagina che corrisponde anche  
														al nome della tabella che verra' creata
		@return		array		$temp			Array contenente elenco dei campi
		@stack		index.php	#125
*****/
		public function prelevaCampi()
			{
				$temp = array();
				$sql = "SELECT id_funct FROM `0_functions`";
				$sql .= "WHERE pagina_funct = '$this->pagina' ";
				$this->insertSql($sql);
				$counter = 0;
					while($this->row = @mysql_fetch_array($this->results))
							{
								
								$temp[$counter] = $this->row['id_funct'];
								$counter++;
							}
				return $temp;
			}
}
?>