
<?php 
@session_start();
$sessione = @session_id(); 
?>

<!DOCTYPE html> 
<html> 
<head>
<?php
include 'php/blocks/head.php';
include 'php/config.inc.php';
include 'php/db.inc.php';
include 'php/secur_policy.php';
$secur = new SECUR();
$goAway = $secur->doRecognize($_GET['login'], $_GET['page'], $_GET['sheet']);
if (!$goAway)
	{
		header('location: index.php');
	}
$index = $secur->index;
$sheet = $secur->pagina; //pagina selezionata
$utenti = new UTENTE($sessione, true);
$news = new NEWS();
$decrypt = new DECR();
$conn = new FUNCT();
$news->getLogo();
$news->doServer();
//	PRELEVA UTENTI
$search = 'null';
$utente = $utenti->prelevaUtenti($index, $search);
$id_utente = $utente['id'];
$admin = $_SESSION['admin'] ;
$stato = '';
$usn = $decrypt->shift64dec($utente['user']);
$psw = $decrypt->shift64dec($utente['password']);
//echo $admin;
?>
<script type="text/javascript" src="scripts/gestioni.user.js"></script>
<script type="text/javascript">
			var id_utente = <?php echo $id_utente; ?>;
			$(document).ready(function()
				{
																		
					
					dis ( 	'<?php echo $index; ?>',				//index
							'varia',
							'user',
							'<?php echo $sessione; ?>',
							'<?php echo $admin; ?>',
							'<?php echo $utente['nome']; ?>',
							'single');
							});
</script>
</head>
<body>
<div id="message_box"></div> 
<!--		*******LINGUETTE******			-->
<div id="tab_top"><!--	linguette		-->
<?php include 'php/pagina/linguette.user.php'; ?>
</div>
<!--		*******FINE LINGUETTE******			-->

<div id="wrap">
<!-- BOX_CP2 (MENU IN ALTO) + (TITOLO)  -->
<div class="box_cp2" id="buttons_top">
<?php include 'php/pagina/varia.barra.menu.user.php'; ?>
</div> <!-- fine di box_cp2 -->
<div id="titolo_news" ><?php echo '<span>varia : </span>' . $utente['nome']; ?></div>
<div id="main_content" >		<!-- **** MAIN CONTENT **** --> 

<div class="box_cp double" id="box_titolo">
<div class="testata">DATI UTENTE<div id="btn_test" class="freccia arrow_down"></div></div>
<div id="box_content">	
<div class="label" >Nome</div>
<form name="nome" class="form_input" >	
<input class="text_input first" id="nome_utente" type="text" name="nome_utente" title="nome dell'utente" value="<?php echo $utente["nome"] ?>" >
<input class="buttons varia" type="button" value="invia"  onclick="spedisciUser($(this).parent(), id_utente);"></form>
	
<div class="label" >Nick-Name</div>
<form name="nick" class="form_input" >	
<input class="text_input" id="nick_name" type="text" name="nick_name" title="nick-name utente" value="<?php echo $utente['nick_name'] ?>" >
<input class="buttons varia" type="button" value="invia"  onclick="spedisciUser($(this).parent(), id_utente);"></form>

<div class="label" >E-Mail</div>
<form name="e-mail" class="form_input" >
<input class="text_input" id="e_mail" type="text" name="e_mail" title="indirizzo e-mail utente" value="<?php echo $utente['indirizzo-mail']; ?>" >
<input class="buttons varia" type="button" value="invia"  onclick="spedisciUser($(this).parent(), id_utente);"></form>
</div>	<!-- fine #box_content -->
</div>	<!-- fine del box -->

<div class="box_cp double" id="box_contratto">
<div class="testata">CREDENZIALI<div id="btn_test" class="freccia arrow_down"></div></div>
<div id="box_content">
<div class="label" >Privilegi</div>
<form name="privilegi" class="form_input" >	
<select class="select_input" id="credenziali" name="credenziali" title="privilegi per questo utente"  style="width: 70%;">
<?php
	$option_value = $utente['admin'];
	$options = array();
	$valori = ',administrator, sub-administrator';
	//  DEFAULT
	//$valori = ',administrator, sub-administrator, premium-user, gold-user, silver-user, base-user';
	
	$options = explode(",", $valori);
	$stop = (count($options))-1;
	for ($i = 2; $i <= $stop; $i++)
		{
			if ($i == $option_value)
					{
						echo '<option value="' . $i . '" selected >' . $options[$i] . '</option>';
					}else{
						echo '<option value="' . $i . '">' . $options[$i] . '</option>';
							}	//  END IF
					}	//  END FOR CICLE
?>	</select>
<input class="buttons varia" type="button" value="invia"  onclick="spedisciUser($(this).parent(), id_utente);"></form>

<div class="label" >Pagina collegata<font  style="font-size:0.6em;">(scegli)</font></div>
<form name="struttura" class="form_input" >	
<select class="select_input super" id="id_struttura" name="nome_pagina" title="seleziona la pagina" style="width: 70%;"> 
			<?php
		$option_index = $utente['pagina'];
		$valori = array();
		//$valori = $conn->getValori($tabella);
		$valori = $conn->getValues();						
		$max_id = count($valori);
		//echo ' <option>&nbsp;</option>';
		for ($i = 1; $i <= $max_id; $i++)
			{
													
			if ( $valori[$i]['pagina'] == $option_index )
					{
						echo ' <option value="' . $valori[$i]['pagina'] . '" selected > ' . $valori[$i]['pagina'] . '</option>';
					}
			else
					{
						echo ' <option value="' . $valori[$i]['pagina'] . '" > ' . $valori[$i]['pagina'] . '</option>';
					}
			}	
				?>
	</select>
<input class="buttons varia" type="button" value="invia"  onclick="spedisciUser($(this).parent(), id_utente);"></form>

 
<div class="label" >Data scadenza</div>
<form name="data_scadenza" class="form_input" >	
<input class="text_input data_picker" id="payment_str" type="text" name="payment_str" title="data scadenza contratto" value="<?php echo $utente["data_scad"] ?>" readonly  style="top:-10px;">
<input class="buttons varia" type="button" value="invia"  onclick="spedisciUser($(this).parent());"></form>
</div>	<!-- fine #box_content -->
</div>	<!-- fine del box -->

<div class="box_cp double" id="box_titolo">
<div class="testata">CHIAVI DI ACCESSO<div id="btn_test" class="freccia arrow_down"></div></div>	
<div id="box_content">
<div class="label help_funct" >Username</div>
<form name="username" class="form_input" >	
<input class="text_input first" id="usr" type="text" name="usr" title="username" value="<?php echo $usn ?>" >
<input class="buttons varia" type="button" value="invia"  onclick="spedisciUser($(this).parent(), id_utente);"></form>
<br /> 
<center>
<input id="crea_user" class="buttons" type="button" value="crea USERNAME sicuro"  onclick="doUserLogin();">
<br />
</center>
<div class="label help_funct" >Password</div>
<form id="password" name="password" class="form_input" >
<input class="text_input" id="psw" type="text" name="psw" title="password" value="<?php echo $psw ?>" >
<input id="cambia_pass" class="buttons varia" type="button" value="invia"  onclick="spedisciUser($(this).parent(), id_utente);"></form>
<br /> 
<center>
<input id="crea_pass" class="buttons" type="button" value="crea PASSWORD sicura"  onclick="doPsw();">
</center>
</div> <!-- fine #box_content -->
</div>	<!-- fine del box -->
<center>
<!-- BOX ISTRUZIONI -->
<div id="help_window"  ></div>
<!-- BOX ISTRUZIONI -->
</center>
</div>				<!-- FINE MAIN CONTENT -->
<center>
<div class="footer_closer"  style="color: #aaa;">.</div>
<div class="content_menu"></div>
</center> 
</div> <!-- end wrap -->
<div id="service"></div>
</body>
</html>