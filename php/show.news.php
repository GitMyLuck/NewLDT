<?php 
		@session_start();
		$data = unserialize( $_SESSION['data'] );
		$chunk = $_SESSION['chunk'];
		$max_chunk = $_SESSION['max_chunk'];
		$search_key = $_SESSION['search'];
		//$pagina = $_SESSION['pagina'];
		$zonaShow = $_SESSION['zona'];
		$filePost = "";
		($zonaShow == 'page') ? $filePost = ".main.page" : $filePost;
		$ezona = '-' . $zonaShow;
		
		include "classes/template.class.php";
		$template = new TEMPLATE();
		$chunks = count ( $data );
		$page_content = "";
		$index = 1;
		
		//		CHUNK  PARTS
		foreach ( $data as $key => $value ) 
			{
				if ( $key == $chunk )
					{
						//	INTERNAL GROUP OF CHUNKES
						foreach ( $value as $subKey => $subValue ) 
							{
								$scheda = $template->load("box.news" . $filePost . ".html");
								//		numero della notizia in base all'ordine di rappresentazione
								$template->replace("id_not", $index);
								//		id della notizia
								$template->replace("id", $value[$subKey]['id']);
								//    pagina/categoria della notizia ( eventi, news, ecc )
								$template->replace("pagina", $value[$subKey]['categoria']);
								//	zona in cui viene caricato
								$template->replace("zona", $ezona);
								//  testo della ricerca
								$template->replace("search", $search_key);
								$titolo = transTitolo( $value[$subKey]['titolo'], $search_key );
								$template->replace("titolo", $titolo);
						
								//\\	elabora data
								$data_evento = transData( $value[$subKey]['data_evento'] );
								$template->replace("anno", $data_evento[2]);
								$template->replace("giorno", $data_evento[0]);
								$template->replace("mese", $data_evento[1]);
						
								//\\   elabora testo
								$testo = transTesto($value[$subKey]['testo'], $search_key);
								$template->replace("testo", $testo);
						
								//\\	elabora immagine
								$template->replace("immagine", 
								'public/php/' . $value[$subKey]['foto']);
				
								$page_content .= $template->publish();
								$index++;
							}		/// END OF INTERNAL GROUPS
					}		///  END OF SELECTED CHUNK
				
			}
				$index--;
				$page_content .= "<div class='void'>...</div>";
				$page_content .= "<div id='max'>" . $index . "</div>";
				echo $page_content;
				
				
				function transData($data_evento)
				{
					$mese = array('ll', 'GEN', 'FEBB', 'MAR', 'APR', 'MAG', 'GIU', 'LUG', 'AGO', 'SET', 'OTT', 'NOV', 'DIC');
					$array_data = explode( "/" , $data_evento );
					$array_data[1] = $mese[(int)$array_data[1]];
					return $array_data;
				}
				
			function transTesto($testo, $search)
				{
					$nuovo_testo = str_replace("\n", "<br />", $testo);
					$part_news = (substr($nuovo_testo, 0, 120));
					$find_pos = strrpos($part_news, " ");
					$part_news = substr($nuovo_testo, 0 , $find_pos);
					$part_news .= ' ...';	//puntini
					$nuovo_testo = $part_news;
					$pattern = $search;
					$replacement = "<span class='found'>" . $search . "</span>";
					$nuovo_testo = str_ireplace( $pattern, $replacement, $nuovo_testo);
					return $nuovo_testo;
				
				}
				
			function transTitolo($titolo, $search)
				{
					$pattern = $search;
					$replacement = "<span class='found'>" . $search . "</span>";
					$nuovo_titolo = str_ireplace( $pattern, $replacement, $titolo);
					//exit(var_dump($replacement)); 
					return $nuovo_titolo;
				}
?>
