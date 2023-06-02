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
$utente = new UTENTE($sessione, true);
$news = new NEWS();
$conn = new FUNCT();
$conn->doServer();
$max_id = ((int)$conn->maxId('0_utenti')) + 1;
$news->getLogo();
//	PRELEVA UTENTI
$search = 'null';
$admin = $_SESSION['admin'] ;
$stato = '';
//trigger_error('  I N T E R R U Z I O N E  ', E_USER_ERROR); 

?>
<script type="text/javascript" src="scripts/gestioni.user.js"></script>
<script type="text/javascript">
			$(document).ready(function()
				{
					dis ( 	'<?php echo $max_id; ?>',				//index
							'nuovo',
							'user',
							'<?php echo $sessione; ?>',
							'<?php echo $admin; ?>',
							'',
							'single');
							});
</script>
</head>
<body>
<div id="message_box"></div>
<div class="go_up"  style="display:none;" ></div>
<div class="go_down"  style="display:none;" ></div> 
<!--		*******LINGUETTE******			-->
<div id="tab_top"><!--	linguette		-->
<?php include "php/pagina/linguette.user.php"; ?>
</div>
<!--		*******FINE LINGUETTE******			-->

<div id="wrap">
<!-- BOX_CP2 (MENU IN BASSO) -->
<div class="box_cp2" id="buttons_top">
<?php include "php/pagina/nuovo.barra.menu.user.php"; ?>
</div> <!-- fine di box_cp2 -->

<div id="titolo_news"   style="top:10px;" >NUOVO UTENTE</div>
<div id="main_content" style="top:10px;">		<!-- **** MAIN CONTENT **** --> 


<form class="modulo_completo">
<div class="box_cp double" id="box_titolo">
<div class="testata">DATI UTENTE<div id="btn_test" class="freccia arrow_down"></div></div>
<div id="box_content">

<div class="label" >Nome</div>
<input class="text_input" id="nome_utente" type="text" name="nome_utente" title="nome dell'utente" value=""  >
<br />	
<div class="label" >Nick-Name</div>
<input class="text_input" id="nick_name" type="text" name="nick_name" title="nick-name utente" value="" >
<br />
<div class="label" >E-Mail</div>
<input class="text_input" id="e_mail" type="text" name="e_mail" title="indirizzo e-mail utente" value=""  >
<br />	

</div>		<!--	fine #box_content	-->
</div><!-- fine del box -->
</form>

<form class="modulo_completo">
<div class="box_cp double" id="box_contratto">
<div class="testata">CREDENZIALI<div id="btn_test" class="freccia arrow_down"></div></div>
<div id="box_content">
<div class="label" >Privilegi</div>	
<select class="select_input" id="credenziali" name="credenziali" title="privilegi per questo utente">
<?php
	$option_value = 2;
	$options = array();
	$valori = ',administrator, sub-administrator';
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

<div class="label" >Pagina collegata<font  style="font-size:0.6em;">(scegli)</font></div>	
<select class="select_input super" id="id_struttura" name="nome_pagina" title="seleziona la pagina" > 
			<?php
		
		$valori = array();
		
		$valori = $conn->getValues();						
		$max_id = count($valori);
		//echo ' <option>&nbsp;</option>';
		for ($i = 1; $i <= $max_id; $i++)
			{
				echo ' <option value="' . $valori[$i]['pagina'] . '" > ' . $valori[$i]['pagina'] . '</option>';
			}	
			?>
	</select>

<div class="label" >Data scadenza</div>	
<input class="text_input data_picker" id="payment_str" type="text" name="payment_str" title="data scadenza contratto" value="" readonly  style="top:-10px;">
</div>	<!-- fine #box_content -->
</div>	<!-- fine del box -->
</form>


<form class="modulo_completo">
<div class="box_cp double" id="box_dati_accesso">
<div class="testata">CHIAVI DI ACCESSO<div id="btn_test" class="freccia arrow_down"></div></div>
<div id="box_content">
<div class="label help_funct" >Username</div>	
<input class="text_input" id="usr" type="text" name="usr" title="username" value=""  >
<br /> 
<br /> 
<center>
<input id="crea_user" class="buttons" type="button" value="crea USERNAME sicuro"  onclick="doUserLogin();">
</center>
<br /> 
<div class="label help_funct" >Password</div>
<input class="text_input" id="psw" type="text" name="psw" title="password" value=""  >
<br /><br /> 
<center>
<input id="crea_pass" class="buttons" type="button" value="crea PASSWORD sicura"  onclick="doPsw();">
</center>	

</div>		<!--	fine #box_content	-->
</div><!-- fine del box -->
</form>	
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