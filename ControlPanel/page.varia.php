<?php
			header('Content-type: text/html;charset=utf-8');
			@session_start();
			$sessione = @session_id();
			include "php/db.inc.php";
			include "php/config.inc.php";
			$varia = '';
			$conn = new FUNCT();
			$conn->doServer();
			$post_campi = array();
			array_pop ($_POST);
	foreach ($_POST as $nome_chiave=>$valore_campo)
     {
					//	ECCEZIONE TAGS
					if ($nome_chiave === 'tags')
						{
							///	*** QUESTA E' LA ZONA GIUSTA PER INSERIRE TAGS AUTOMATICI ***
							//vai a funzione che pulisce i tags (funzioni.db.php)
							$temp_valore = $conn->pulisciTags($valore_campo);
							$valore_campo = '';
							$valore_campo = $temp_valore;
						}
					//  controlla se il nodo in questione e' nell elenco
					//  lookUpTable in config.inc.php
					//  se si aggiorna Tabella
					if ( in_array ( $nome_chiave, $lookUpTable ) )
						{
							$id = $_POST['id'];
							$pag = $_POST['sheet'];
							$new_id = mysql_insert_id();
							//trigger_error('  I N T E R R U Z I O N E  ', E_USER_ERROR); 
							$error = aggLookUp($nome_chiave, $valore_campo, $id, $pag, $conn);
				
						}
						
					//aggiustiamo i campi con htmlspecialchars e addslashes
					$post_campi[$nome_chiave] = trim(htmlspecialchars(addslashes($valore_campo)));
     }
					//carica nuova notizia
					$error = $conn->newInsData($post_campi); 
					//exit(var_dump($varia));
					//preleva ultimo id inserito
					$new_id = mysql_insert_id();

					//prelevo real_id della notizia
					$real_id = $post_campi['id'];
					
					//prelevo nome pagina
					$sheet = $post_campi ['sheet'];

					$ag = $conn->aggImg($real_id, $new_id, $sheet);
					
					
					
					
function aggLookUp($node, $value, $id, $sheet, $conn)
	{
			include "php/config.inc.php";
			//  controlla se il nodo in questione e' nell elenco
			//  lookUpTable in config.inc.php
			if ( in_array ( $node, $lookUpTable ) )
						{
						
							//trigger_error('  I N T E R R U Z I O N E  ', E_USER_ERROR); 
							//exit(var_dump($lookUpTable)); 
							$index = (int)$conn->maxIdd($sheet);
							$index++;
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
