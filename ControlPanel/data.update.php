<?php
			// PAGINA CHE PERMETTE DI INVIARE IN AUTOMATICO AL DATA-BASE QUALSIASI
			// INPUT SIA PRESENTE, BASTERA' AGGIUNGERE INPUT ALL'ELENCO $postNameArr() e
			//NELLA SEZIONE DELLO SWITCH...
			header('Content-type: text/html;charset=utf-8');
			@session_start();
			$sessione = @session_id();
			include "php/db.inc.php";
			
	$postIdentifierArr = array();
	$postNameArr = array();
	$id = $_POST['id'];		// carica id trasmesso con il post
	$sheet = $_POST['sheet'];	// carica sheet trasmesso con il post 
	//elimina dai posts id e sheet
	array_pop ($_POST);
	array_pop ($_POST);				
				// Array dei valori postati per ogni form diverso sulla pagina.
				foreach ($_POST as $key => $value)
     {
			//aggiustiamo i campi con htmlspecialchars e addslashes
              $postNameArr[] = $key;
     }
				
				//Trova tutti gli identificatori da pubblicare all'interno di $ _POST
				$postIdentifierArr = array();
				
				$conn = new FUNCT();
				$conn->doServer();
			 
		 foreach ($postNameArr as $postName)
		 {
			 if (array_key_exists($postName, $_POST))
			 {
				
				$postIdentifierArr[] = $postName;		
				//elenca nell'array $postIdentifierArr le varie chiavi $_POST
			 }
		 }

		 // Only one form should be submitted at a time so we should have one
		 // post identifier.  The die statements here are pretty harsh you may consider
		 // a warning rather than this. 
		 if (count($postIdentifierArr) != 1)
		 {
			 count($postIdentifierArr) < 1 or
				 die("\$_POST contiene più di un identificatore: " .
					implode("-", $postIdentifierArr));

			 // We have not died yet so we must have less than one.
			 die("\$_POST contiene un identificatore sconosciuto.<br /> <br /> " .
					var_dump ($postNameArr));
		 }
			//exit ( $postIdentifierArr[0] );
		$temp = array();
		//preleva valore dal campo
		$value = trim(htmlspecialchars(addslashes($_POST[$postIdentifierArr[0]])));
		$node = $postIdentifierArr[0];
			if ($node == 'tags')
				{
					//vai a funzione che pulisce i tags (funzioni.db.php)
					$temp_value = $conn->pulisciTags($value);
					$value = '';
					$value = $temp_value;
						
				}
		//exit(var_dump($_POST)); 
		//  aggiorna  
		$error = $conn->insData($node, $value, $id, $sheet);
		//exit(var_dump($error)); 
		//  aggiorna tabella di look-up
		$error = aggLookUp($node, $value, $id, $sheet, $conn);
		
		
		
function aggLookUp($node, $value, $id, $sheet, $conn)
	{
			include "php/config.inc.php";
			//  controlla se il nodo in questione e' nell elenco
			//  lookUpTable in config.inc.php
			if ( in_array ( $node, $lookUpTable ) )
						{
						
							//trigger_error('  I N T E R R U Z I O N E  ', E_USER_ERROR); 
							//exit(var_dump($lookUpTable)); 
							$index = (int)$conn->estraiId($sheet, $id);
							$tabella = $sheet . '_' . $node;
							$campo1 = $sheet . '_id';
							$campo2 = $node .'_id';
							// cancella vecchio dato per rendere unico il collegamento struttura - luogo
							$sql  = "DELETE FROM `" . $tabella . "` WHERE `" . $campo1 . "` = $index";
							$conn->insertSql($sql);
							// inserisci dato nuovo
							$sql  = "INSERT INTO `" . $tabella . "` ";
							$sql .= "(`" . $campo1 . "`, `" . $campo2 . "`) ";
							$sql .= "VALUES ($index, $value)";
							$conn->insertSql($sql);
							
						}
					else
						{
							echo 'campo non contemplato';
						}
			
	}
?>
