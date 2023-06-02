<?php 
		@session_start();
		//		DATI RICEVUTI  DALLA SESSION
		//		viene passato in sessione, l'intero array che contiene i dati della notizia
		$news = unserialize( $_SESSION['data'] );
		//		la chiave di ricerca
		$search = $_SESSION['search'];
		//		il nome della pagina per identificare la categoria
		$pagina = $_SESSION['pagina'];
		//		id della notizia
		$id = $_SESSION['id'];
		
		
		$page_content = '';
		include "classes/template.class.php";
		$template = new TEMPLATE();
		$template->load("scheda." . $pagina . ".html");
		
		include "classes/elabora.testi.scheda.class.php";
		$scheda = new NEWTEXT($news, $template);
		//exit(var_dump($news[0]['embed'])); 
		$template->replace("id", $id);
		$template->replace("categoria", $pagina);
		
		//  TITOLO
		$titolo = $scheda->tText( $news[0]['titolo'], $search );
		$template->replace("titolo", $titolo);
		
		// IMMAGINE
		//\\	elabora immagine
		//$template->replace("foto", 'public/php/immagini_' . $pagina . '/' . $news[0]['foto']);
		$template->replace("foto", 'public/php/' . $news[0]['foto']);					
// DATA EVENTO  OPTIONAL
		$scheda->getOption('data_evento');
		
// GRUPPO  OPTIONAL
		$scheda->getOption('gruppo');
		
// LOCALITA'  OPTIONAL
		$scheda->getOption('localita');
		
// TELEFONO OPTIONAL
		$scheda->getOption('telefono');
		
// DATA EVENTO 
		$data_evento = $news[0]['data_evento'];
		//  se non c'e' data evento
		if ( $data_evento == '' )
			{
				// preleva la data di pubblicazione della notizia
				$data_evento = $news[0]['data'];
			}
		$template->replace ('data_evento', $data_evento);
		
//	 RECUPERA I TAGS DELLA NOTIZIA
		$scheda->getTags();
		
//	 MAPPA DI GOOGLE
		$scheda->getMap();
			
//		VIDEO
		$scheda->getOption('video');
		
//		LINK_1
		$scheda->getOption('link_1');
		
//		LINK_2
		$scheda->getOption('link_2');

//		PDF
		$scheda->getOptionPDF('pdf');
		
//		INFO-MAIL	
		$scheda->getOption('info_mail');
		
//		SOTTOTITOLO
		$scheda->getOption('sottotitolo');
		
// 		TESTO
		$testo = $scheda->tText( $news[0]['testo'], $search );
		$template->replace("testo", $testo);
		
		//  mostriamo l'output
		$page_content .= $template->publish();
		echo $page_content;


?>