<?php 
@session_start();
$sessione = @session_id();
?>
<!DOCTYPE html> 
<html> 
<head>
<?php 
include "php/blocks/head.index.php";				//  ex head.index.php
include "php/db.inc.php";
//trigger_error('  I N T E R R U Z I O N E  ', E_USER_ERROR); 
$news = new NEWS();
$news->getLogo();
?>
<script type="text/javascript">
	
	$(document).ready( function()
			{
				prepareSpin('wait');
				$( '#login' ).click( function ()
					{
						enterLogin();
					 });
					 
				doCookies();
			});

</script>
<style type="text/css">
	html {
			color: #fff !important;
		}
</style>
</head>
<?php 
//		************	  layout    normale    *****************
if (!isset ($_POST['login'])):
//  CERCA MESSAGGIO PASSATO CON IL GET
$message = 'Benvenuto !';
if (isset( $_GET['error_message']))
	{
		$message = $_GET['error_message'];
	}
	?>
<body>
<div id="content" >
<form name="modulo" action="index.php" method="post">
<div id="cont_login">
<center><div id="titolo_appl" >&nbsp;</div></center>
<center><div id="wait"></div></center>
<center> 
	<div id="box_login"  style="display: block;">
		<br> 
		Login: <br><br> 
		<input  type="text" class="text_input" name="user" size="18" value="">&nbsp; &nbsp; username<br>
		<input  type="password" class="text_input" name="psw" size="18" value=""  maxlength="28" >&nbsp; &nbsp; password<br>
		<input id="login" class="buttons" style="position:relative; top:15px;" name="login" type="submit" value="login" >
	</div>
</center> 
</div>
<center>
<div id="errore"  style="font-size: 1.6em;color:#f9b234;"><?php echo $message; ?></div>
<div id="note_index">Effettua il LOGIN</div>
<div id="micronote_index" ></div>
<!--<input id="" class="buttons" name="" type="button" value="debug" onclick="deleteTables();"> -->
</center>
</form>
<?php else:
//		************	  layout    dopo aver inserito username e password    *****************
?>

<body onload="run('error');">

<div id="message_box"></div>
<?php
include "php/secur_policy.php";
$secur = new SECUR();
$tabelle = new TABELLE();
require_once "php/config.inc.php";		
$conn = new FUNCT();
// CONNETTI DATABASE
$conn->doServer();
// PRELEVA PAGINE PER QUESTO PANNELLO DI CONTROLLO
$pagine = array();
$allPages = $conn->doPages();
// PRELEVA MAX NUM DI TENTATIVI
$conn->Max_tentativi = $MAX_tentativi;
//ESEGUI LOGIN	
$conn->doLogin($_POST['user'], $_POST['psw']);
if ($conn->login == 1)
	{
	// PRELEVA USERS PER QUESTO PANNELLO DI CONTROLLO
	$utenti = $users;		//(da config.inc.php)
	$admin = (int)$conn->admin; 
	//  	RIELABORA $PAGINE IN BASE ALLE CREDENZIALI DI ACCESSO
	//  escluso superUser
	if ( $admin != 1 )
		{
			$idUtente = $conn->idUtente;
			$page = $conn->getPageUser($idUtente);
			foreach ($allPages as $datum)
				{
					if ( $datum == $page )
						{
							$pagine[1] = $datum;
						}
				}
		}
	else
		{
			$pagine = $allPages;
		}
	//		-----  FINE RIELABORAZIONE $PAGINE ----

	// SALVA NELLA SESSIONE LE CREDENZIALI
	$_SESSION['admin'] = $admin;
	$_SESSION['no_str'] = (int)$conn->id_str;
	$_SESSION['token_utente'] = $conn->token;
	$_SESSION['page'] = $page;
	//  se non esiste crea cartella cache che conterra le pagine ed il display setting
			if(!is_dir($dir_cache . 'cache/'))
				{
				@mkdir($dir_cache . 'cache/');
				}
	// salva nella cache file con impostazioni colori
	$style = $news->doCacheStyle(); 
	
	// controlla se ci sono le tabelle_base
	$results = $conn->isTabelleBase();
	// se non esitono , allora creale
	if ($results === 'false')
		{
			$tabelle->creaTabelleBase();
		}
	
	//	 crea adesso il necessario per le pagine del Control Panel
	$tabs = count($pagine);
	for ($i=1; $i<=$tabs; $i++)			
		{
			
			//controlla se ci sono cartelle per le
			//immagini se no le crea
			if(!is_dir($dir_cache . 'immagini_'.$pagine[$i].'/'))
				{
				@mkdir($dir_cache . 'immagini_'.$pagine[$i].'/');
				@mkdir($dir_cache . 'immagini_'.$pagine[$i].'/thumb/');
				}
			//crea cartella per i pdf
			if(!is_dir($dir_cache . 'pdf_'.$pagine[$i].'/'))
				{
				@mkdir($dir_cache . 'pdf_'.$pagine[$i].'/');
				}
			$campi = new BUILD($pagine[$i]);
			$control = true;
			//  variabile bool di controllo 
			//  se $control = true  -> sovrascrive i file
			//  se $control = false -> non sovrascrive i file
			// CONTROLLA CHE I BOX NON SIANO GIA'
			// STATI CREATI
			$results = (int)($campi->isBox($pagine[$i]));
			if ($results != 0)
				{
					$control = false;
				}
			//exit(var_dump($control)); 
			// CONTROLLA CHE IL NUMERO DI BOX SIA QUELLO
			// ALTRIMENTI RICOSTRUISCI LE PAGINE
			$campi->contaBox();
			$boxes = ($campi->num_boxes) + 1;
			if ($boxes !== $results)
				{
					$control = true;
				}
			//exit(var_dump($control)); 
			// CONTROLLA CHE IL NUMERO DI FUNZIONI SIA QUELLO
			// ALTRIMENTI RICOSTRUISCI LE PAGINE
			// POI AGGIORNA LA RELATIVA TABELLA
			$fun = $campi->contaFunct(); //numero funzioni predisposte
			$results = (int)$campi->isFunct($pagine[$i]); //funzioni nelle pagine attuali
			if ($fun !== $results)
				{
					$control = true;
				}
			//exit(var_dump($control)); 
			// CONTROLLA SE ESISTONO TABELLE PER QUESTA PAGINA
			$results = $conn->isTabella($pagine[$i]);
			if (!$results) //se non esiste tabella creala
				{
			$campi_nuovi = $campi->prelevaCampi();
			//array_shift($campi_nuovi); //elimina primo valore null
			$tabelle->creaTabella($pagine[$i], $campi_nuovi);
				}
			else if ($results && $control)
				{
					//  aggiungi nuovi campi alla tabella già esistente
					$res = $tabelle->aggTabella($pagine[$i]);
				}
			// COSTRUISCI PAGINE PRINCIPALI E SALVALE NELLA CACHE
			$build = buildPages($dir_cache, $pagine[$i], $news, $utenti, $control);
			
	}
		//	REGISTRAZIONE UTENTE (success)
		//	@param		string		$sessione
		$utente = new UTENTE($sessione, true);
		$testo = $utente->registraUtente();
		if ($testo)
		{
			// CONTROLLA CREDENZIALI $admin per utenti_user
			$index = 1;
			$secur->creaCode($index, $pagine[1]);
			//		NO AMMINISTRATORE O USER DI PRIMO LIVELLO
			if (((int)$conn->admin) > 2)
					{
						$code_struttura = ((int)$conn->id_str);
						$temp_id = $conn->doId($code_struttura);
						$id = $temp_id['real_id'];
						$secur->creaCode($id, 'strutture');
					}
			$load = "location: main.php?login=" . $secur->sec_sess;
			$load .="&page=" . $secur->sec_news . "&sheet=" . $secur->sec_sheet;
			//***********RIPRISTINARE  DOPO DEBUG **************
			header($load); //punta al proseguimento
			//header("location: index.php?error_message=SERVIZIO MOMENTANEAMENTE<br />SOSPESO.");
		}	//END IF REGISTRA UTENTE
			else		// IF  NOT  REGISTRA  UTENTE
		{
					$error_message = $utente->login_error;
					
		}	// END  IF  NOT  LOGIN
	}		// END  IF  LOGIN
else		// IF  NOT  LOGIN
	{
					$error_message = $conn->login_error;
	}		// END  IF  NOT  LOGIN

?>
<div id="content"  style="position:relative;top:-24px;">
<div id="cont_login">
<?php

//echo ($build); 
?>
<center><div id="titolo_appl" >LOGIN &nbsp; &nbsp; ERRATO</div></center>
<center><div id="wait"></div></center>
<center>
<div id="box_login"  style="display:none;">
<br /> <br /> <br />
</div>
</center> 
</div>
<center>
<div id="errore" class="welcome"></div>
<div id="note_index">&nbsp;</div>
<div id="micronote_index"></div>
</center>
<script type="text/javascript">
	showMessage('<?php echo $error_message;?>');
</script>
<?php endif;?>
</div>
</body>
</html>
<?php 
function buildPages($dir, $pag, $news, $utenti, $control)
	{
		// CONTROLLA CHE NON ESISTA GIA' IL FILE CACHE CHE
			// FORMA LE PAGINE (page_[nome_pagina].php - pagina main)
			//				   (page_varia_[nome_pagina].php pagina varia)
			//				   (page_nuovo_[nome_pagina].php pagina nuovo)
			//COSTRUZIONE DELLE PAGINE/A
			$page_costr = new NEWPAGE($pag);
			// COSTRUZIONE PAGINE PRINCIPALI
			$type_pagina = array("", "", "varia_", "nuovo_");
			// il ciclo viene basato sulla lunghezza dell'array globale $utenti
			for ($u = 1; $u <= (count($utenti) - 1); $u++)
				{
					// CICLO PAGINE PRINCIPALI
					for ($i = 1; $i <= 3; $i++)
						{
							// controlla esistenza pagina solo MODE::'normal'
							$file_root = $dir . 'cache/page'. $utenti[$u] . $type_pagina[$i] . $pag . '.php';
							//exit(var_dump($file_root)); 
							
							if ($control || !is_file($dir . 'cache/page'. $utenti[$u] . $type_pagina[$i] . $pag . '.php'))
							//if(1==1)
								{ 
									
									// CREA PAGINA
									$page_main = $page_costr->buildPage($i, $u);
									$page_main = html_entity_decode($page_main);
									// SALVA IL FILE
									// @param		string		$page_main		contenuto della pagina
									// @param		array		$file_root		nome ed indirizzo
									$r = $news->doCachePage($page_main, $file_root);
								}
						}	// END FOR CICLE CREA PAGINE PRINCIPALI
					}	//  END  FOR  CICLE UTENTI
			
			return true;
	}
?>