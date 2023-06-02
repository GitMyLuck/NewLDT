<?php
//header('Content-type: text/html;charset=utf-8');
class FUNCT extends CONNECT
{
		//attributi
		public $results;
		public $row = array();
		public $pagina;
		public $id;
		public $funct;
		public $pagine = array();
	
	
		public function __construct($pages = null) 
			{
			// o si passa e poi si alebora array direttamente qua
			// nel formato  es.: news,eventi,archivio,
				if ( isset ($pages))
					{
						$str = array();
						$str = explode( ",", $pages );
						foreach( $str as $dato )
							{
								if ( $dato )
									{
										$this->pagine[] = $dato;
									}
							}
						
					}
			}		//  END  OF  CONSTRUCTOR
			
		public function classTest()
			{
					
					return $this->pagine;
			}
/****
		Esegue query SQL su stringa $sql
		@param		string		$sql		Stringa SQL per la query
		@return		array		$this->row	Array contenente risultato query
*****/

		public function sql($sql)
			{
				$this->results = @mysql_query($sql) or die
				('$sql inviato : ' . $sql . '<br />' . mysql_error());
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
				$this->disconnect();
			}
			
		//\\  preleva tutte le pagine presenti nel database
		public function getPages()
			{
				$result = array();
				$sql = "SELECT `name_pagina` FROM `0_struttura` ";
				$result = @mysql_query($sql);
				while ($row = mysql_fetch_array ($result))
					{
							$pages[] = $row['name_pagina'];
					}
				return $pages;
			}
			
		//\\  preleva tutte le notizie scaturite dalla ricerca con la chiave '$search' 
		public function getNews($search)
			{
				$tempNews = array();
				$news = array();
				$counter = 1;
				foreach ( $this->pagine as $pagina )
					{
						$sql  = "SELECT * FROM `" . $pagina . "` ";
						if ( $search != "tutti" )
							{
								$sql .= " WHERE `tags` LIKE '%$search%' ";
								$sql .= " OR `titolo` LIKE '%$search%' ";
								$sql .= " OR `testo` LIKE '%$search%' ";
							}
						//$sql .= "ORDER BY `data` DESC ";
						$this->insertSql($sql);
						while ($result = mysql_fetch_assoc($this->results))
								{
									//\\ preleva immagine
									$filename = $this->doImage($result['id'], "img", $pagina);
									//\\  aggiungi immagine ad array
									$result['foto'] = $filename;
									$result['categoria'] = $pagina;
									$tempNews[$counter] = $result;
									$counter++;
								}
						
					}		//  END  OF  FOREACH
					
				//  qui bisogna inserire function che ordina le notizie per data 
				//	lavorando su array
				
				function array_sort_by_column(&$arr, $col, $dir = SORT_DESC) 
						{
							$sort_col = array();
							foreach ($arr as $key=> $row) 
									{
											$sort_col[$key] = $row[$col];
									}

							array_multisort($sort_col, $dir, $arr);
						}

				array_sort_by_column($tempNews, 'time_evento');
				return $tempNews;
			}
			
			
		//\\     preleva la singola notizia con id = '$id'
		public function getSingleNews ($id)
			{
				$news = array();
				$sql  = "SELECT * FROM `" . $this->pagine[0] . "` ";
				$sql .= "WHERE `id` = $id ";
				
				$this->insertSql($sql);
				while ($result = mysql_fetch_assoc($this->results))
						{
							//\\ preleva immagine
							$filename = $this->doImage($id, "img", $this->pagine[0]);
							//\\  aggiungi immagine ad array
							if ( $filename )
								{
									$result['foto'] = $filename;
								}
							//\\ preleva pdf
							$type = 'pdf';
							$filename = $this->doImage($id, $type, $this->pagine[0]);
							//\\  aggiungi pdf ad array
							if ( $filename )
								{
									$result['pdf'] = $filename;
								}
							$news[] = $result;
						}
				return $news;
				
			}
			
		public function doImage($id, $type = "img", $pagina)			
			{
				//\\  preleva immagine di uno specifico id
							/// carica solo immagine di default
				$sql = "SELECT * FROM `" . $type . "_" . $pagina . "` WHERE id_not_real='$id' ";
				if ( $type == "img" )
					{
						$sql .= "AND `img_default` = 1 ";
										//  ----------------------  //
					}
				$ris = @mysql_query($sql);
				$row = mysql_fetch_array($ris, MYSQL_ASSOC);
				if (!$row && $type != 'pdf' )
					{
						//  se la foto per questo $id e' inestitente
						//	restituisci 'sostituta'
						$filename = 'sostituta';
						return $filename;
					}
				$imageCart = 'immagini';
				( $type == 'pdf' ) ? $imageCart = $type : $imageCart;
				//	 se il filename e' stato trovato ritornalo
				if ( $row['filename'] )
					{
						$filename = $imageCart . '_' . $pagina . '/' . $row['filename'] . '.' . $row['ext'];
					}
				else
				// altrimenti ritorna null
					{
						$filename = NULL;
					}
				return $filename;
			}

	public function prelevaTags($pagine)
		{
					$super_temp = '';
					$superTags = array();
					$tags = array();
					//  ripati l'operazione per tutte le pagine
					foreach ( $pagine as $pagina )
						{
							$sql  = "SELECT `tags` ";
							$sql .= " FROM `$pagina`";
							$this->insertSql($sql);
							while (list($result) = mysql_fetch_array($this->results)) 
								{
									if ($result != '' && $result != ',')
										{
											$super_temp .= $result;
										}
								}
						}		// END OF EACH PAGINE
					$tags = explode(',', $super_temp);
					$superTags = implode(',', $tags);
					$tags = array_reverse((array_unique($tags)));
					$superTags = array_reverse($tags);
					$tags = array_pop($superTags);
					return $superTags;
			}
		

}
?>