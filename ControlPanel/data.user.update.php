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
	$id = $_POST['id'];				// carica id trasmesso con il post
	//elimina dai posts id
	array_pop ($_POST);
	//elimina dai posts sheet
	array_pop ($_POST);
				// Array dei valori postati per ogni form diverso sulla pagina.
				foreach ($_POST as $key => $value)
     {
			//aggiustiamo i campi con htmlspecialchars e addslashes
              $postNameArr[] = $key;
     }
				
				//Trova tutti gli identificatori da pubblicare all'interno di $ _POST
				$postIdentifierArr = array();
				
				$conn = new UTENTE($sessione, true);
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
		//  aggiorna  
		$error = $conn->insDataUser($node, $value, $id);
?>
