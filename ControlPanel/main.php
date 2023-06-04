
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
$login = '';
$page = '';
$sheet = '';
(isset ($_GET['login'])) ? $login = $_GET['login'] : $login;   
(isset ($_GET['page'])) ? $page = $_GET['page'] : $page;
(isset ($_GET['sheet'])) ? $sheet = $_GET['sheet'] : $sheet;   
$goAway = $secur->doRecognize($login, $page, $sheet);
$index = $secur->index;
$sheet = $secur->pagina; //pagina selezionata 
if (!$goAway || !$index)
	{
		header("location: index.php");
	} 
$news = new NEWS();
$news->getLogo();
$img_type = $news->getImagesRegister();	
//prelevo il tipo di immagini da
//gestire 'single' o 'multi'
$uri = $_SERVER['PHP_SELF'];
$nomePagina = $news->doName($uri);		// [$nomePagina] = funzione (main, varia, nuovo)
$conn = new FUNCT();
$conn->doServer();
$pagine = $conn->doPages();			
//preleva dalla tabella `struttura` i nomi delle pagine
// serve per rappresentare le linguette
$user_display = '';						//tipo di menu in base all'utente (da sviluppare)
$admin = $_SESSION['admin'] ;///variabile che esclude i campi per utenti senza credenziali 
$user = $users[$admin];			///  include pagina giusta per questo tipo di utente
$page = $_SESSION['page'];		/// pagina predisposta per questo utente

if ( $page )
	{
		$pagine = null;
		$pagine[1] = $page;
	}
	
$notizia = $conn->doNews($index, $sheet);//notizia caricata con il $_GET
$num_notizie = $conn->contaNews($sheet);//numero di notizie nel database 
if ($index > ($num_notizie+1))
{ $index = $num_notizie; }
//blocca il tasto varia se non ci sono notizie
$stato = '';
if ($num_notizie < 1) { $stato = 'disabled'; }
?>
<script type="text/javascript">
			$(document).ready(function()
				{
					dis ( 	<?php echo $index; ?>,
							'mostra',
							'<?php echo $sheet; ?>',
							'<?php echo $sessione; ?>',
							'<?php echo $admin; ?>',
							'<?php echo addslashes($notizia['titolo']); ?>',
							'<?php echo $img_type; ?>');
							});
</script>
</head>
<body >
<div id="message_box"></div>
<div class="go_up"  style="display:none;" ></div>
<div class="go_down"  style="display:none;" ></div> 
<!--		*******LINGUETTE******			-->
<div id="tab_top"><!--	linguette		-->
<?php include "php/pagina/linguette.menu.php"; ?>
</div>
<!--		*******FINE LINGUETTE******			-->

<div id="wrap">
<!-- BOX_CP2 (MENU IN ALTO) + (TITOLO)  -->
<div class="box_cp2" id="buttons_top">
<?php include 'php/pagina/main.barra.menu.php'; ?>
</div> <!-- fine di box_cp2 -->

<div id="titolo_news" ><?php echo $notizia['titolo']; ?></div>
<div id="main_content">		<!-- **** MAIN CONTENT **** -->
 
<!-- BOX TITOLO NEWS + RICERCA (NAVIGAZIONE FRA LE NEWS)  -->
<?php 
if ($admin < 3)			// SOLO PER super-user e sub-administrator
	{
		include 'php/pagina/main' . $user_display . '.box.menu.php';
	}
?>
<!-- FINE BOX TITOLO NEWS  -->
<form id="modulo_completo_main" name="modulo_completo_main">
<!--	INCLUDI LA PAGINA SALVATA IN CACHE   -->
<?php 

include $dir_cache . 'cache/page'. $user . $sheet . '.php'; 
?>
</form>

</div>				<!-- FINE MAIN CONTENT -->


<div class="footer_closer"  style="color: #AAA;">.</div>
<div id="menu" class="content_menu"></div> 
</div> <!-- end wrap -->
<div id="service"></div>
</body>
</html>