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
					
						
					//aggiustiamo i campi con htmlspecialchars e addslashes
					$post_campi[$nome_chiave] = trim(htmlspecialchars(addslashes($valore_campo)));
     }
		
					exit(var_dump($post_campi)); 
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
					

?>
