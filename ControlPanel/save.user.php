<?php 
header('Content-type: text/html;charset=utf-8');
			@session_start();
			$sessione = @session_id();
			include "php/db.inc.php";
			include "php/config.inc.php";
			$varia = '';
			$utenti = new UTENTE($sessione, true);
			$decrypt = new DECR();
			$conn = new FUNCT();
			$word = new WORD();
			$conn->doServer();
			$post_campi = array();
			$id = $_POST['id'];		// carica id trasmesso con il post
			$sheet = $_POST['sheet'];	// carica sheet trasmesso con il post 
				//elimina dai posts id e sheet
				array_pop ($_POST);
				array_pop ($_POST);
			
			foreach ($_POST as $nome_chiave=>$valore_campo)
			{
				// ECCEZIONE USERNAME
				if ($nome_chiave === 'usr')
						{
							$temp_valore = $decrypt->shift64enc($valore_campo);
							$valore_campo = '';
							$valore_campo = $temp_valore;
						}
				// ECCEZIONE PASSWORD
				if ($nome_chiave === 'psw')
						{
							$temp_valore = $decrypt->shift64enc($valore_campo);
							$valore_campo = '';
							$valore_campo = $temp_valore;
						}
				//aggiustiamo i campi con htmlspecialchars e addslashes
				$post_campi[$nome_chiave] = trim(htmlspecialchars(addslashes($valore_campo)));
			}
				//assegna token
				$token = $word->doToken();
				//aggiungilo all'array $post_campi;
				$post_campi['token'] = $token;

				$error = $utenti->saveUtente($post_campi);
				return $error;
			//var_dump($post_campi);
			
			
?>