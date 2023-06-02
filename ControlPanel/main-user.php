<?php 
@session_start();
$sessione = @session_id(); 
?>

<!DOCTYPE html> 
<html> 
<head>
<?php
include "php/blocks/head.php";
include "php/config.inc.php";
include "php/db.inc.php";
include "php/secur_policy.php";
$secur = new SECUR();
$goAway = $secur->doRecognize($_GET['login'], $_GET['page'], $_GET['sheet']);
if (!$goAway)
	{
		header("location: index.php");
	}
$index = $secur->index;
$sheet = $secur->pagina; //pagina selezionata
$sheet = 'user';
$utenti = new UTENTE($sessione, true);
$news = new NEWS();
$decrypt = new DECR();
$conn = new FUNCT();
$news->getLogo();
$news->doServer();
//	PRELEVA UTENTI
$search = 'null';
$utente = $utenti->prelevaUtenti($index, $search); 
$admin = $_SESSION['admin'];
$stato = '';
$usn = $decrypt->shift64dec($utente["user"]);
$psw = $decrypt->shift64dec($utente["password"]);
//trigger_error('  I N T E R R U Z I O N E  ', E_USER_ERROR); 
?>
<script type="text/javascript" src="scripts/gestioni.user.js"></script>
<script type="text/javascript">
			$(document).ready(function()
				{
					dis ( 	'<?php echo $index; ?>',				//index
							'mostra',
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
<?php include 'php/pagina/main.barra.menu.user.php'; ?>
</div> <!-- fine di box_cp2 -->

<div id="titolo_news" ><?php echo $utente['nome']; ?></div>
<div id="main_content" >		<!-- **** MAIN CONTENT **** --> 


<!-- BOX TITOLO NEWS + RICERCA (NAVIGAZIONE FRA LE NEWS)  -->
<?php 
include 'php/pagina/main.box.menu.user.php';
?>
<!-- FINE BOX TITOLO NEWS  -->


<form id="modulo_completo_main" name="modulo_completo_main">
<!--	INCLUDI LA PAGINA SALVATA IN CACHE   -->
<div class="box_cp double" id="box_titolo">
<div class="testata">DATI UTENTE<div id="btn_test" class="freccia arrow_down"></div></div>
<div id="box_content">	
<div class="label" >Nome</div>
<input class="text_input" id="nome_utente" type="text" name="nome_utente" title="nome dell'utente" value="<?php echo $utente["nome"] ?>" disabled >
<br />	
<div class="label" >Nick-Name</div>
<input class="text_input" id="nick_name" type="text" name="nick_name" title="nick-name utente" value="<?php echo $utente["nick_name"] ?>" disabled >
<br />
<div class="label" >E-Mail</div>
<input class="text_input" id="e_mail" type="text" name="e_mail" title="indirizzo e-mail utente" value="<?php echo $utente['indirizzo-mail']; ?>" disabled >
<br />	
</div>	<!-- fine #box_content -->
</div>	<!-- fine del box -->


<div class="box_cp double" id="box_contratto">
<div class="testata">CREDENZIALI<div id="btn_test" class="freccia arrow_down"></div></div>
<div id="box_content">
<div class="label" >Privilegi</div>
<select class="select_input" id="credenziali" name="credenziali" title="privilegi per questo utente" disabled>
<?php
	$option_value = $utente['admin'];
	$options = array();
	
	$valori = ',administrator, sub-administrator';
	//  DEFAULT
	//$valori = ',administrator, sub-administrator, premium-user, gold-user, silver-user, base-user';
	
	$options = explode(",", $valori);
	$stop = (count($options))-1;
	for ($i = 0; $i <= $stop; $i++)
		{
			if ($i == $option_value)
					{
						echo '<option value="' . $options[$i] . '" selected >' . $options[$i] . '</option>';
					}else{
						echo '<option value="' . $options[$i] . '">' . $options[$i] . '</option>';
							}	//  END IF
					}	//  END FOR CICLE
?>	</select>
<br />
<div class="label" >Pagina Collegata<font  style="font-size:0.6em;">(scegli)</font></div>
<select class="select_input super  first" id="id_struttura" name="id_struttura" title="seleziona la pagina" disabled>
<?php 
			$option_index = $utente['pagina'];
			
			if ( $option_index )
				{
					$option = $option_index;
					echo '<option selected>' . $option . '</option>';
				}
			else
				{
					echo '<option selected>nessuna pagina</option>';
				}
?>
	</select>
<div class="label" >Data scadenza</div>
<input class="text_input" id="payment_str" type="text" name="payment_str" title="data scadenza contratto" value="<?php echo $utente["data_scad"] ?>" disabled>
</div>	<!-- fine #box_content -->
</div>	<!-- fine del box -->

<div class="box_cp double" id="box_dati_accesso">
<div class="testata">CHIAVI DI ACCESSO<div id="btn_test" class="freccia arrow_down"></div></div>
<div id="box_content">
<div class="label" >Username</div>
<input class="text_input" id="username" type="text" name="username" title="username" value="<?php echo $usn ?>" disabled >
<br />
<div class="label" >Password</div>
<input class="text_input" id="password" type="text" name="password" title="password" value="<?php echo $psw ?>" disabled >
<br /><br />	

</div>
</div>	<!-- fine del box -->


</div>				<!-- FINE MAIN CONTENT -->
<center>
<div class="footer_closer"  style="color: #aaa;">.</div>
<div class="content_menu"></div>
</center> 
</div> <!-- end wrap -->
<div id="service"></div>
</body>
</html>