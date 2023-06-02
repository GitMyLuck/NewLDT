
<?php 
@session_start();
$sessione = @session_id(); 
?>

<!DOCTYPE html>
<html> 
<head>
<?php
$user = '';						//variabile che rende visibili solo
									//i blocchi per quel tipo di utente
$admin = $_SESSION['admin'] ;		//variabile che esclude i campi per utenti senza credenziali
 
error_reporting(0);
include "php/db.inc.php";
include "php/blocks/head.php";
include "php/secur_policy.php";
include "php/config.inc.php";
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
$img_type = $news->getImagesRegister();	//prelevo il tipo di immagini da
										//gestire 'single' o 'multi'
$uri = $_SERVER['PHP_SELF'];
$nomePagina = $news->doName($uri);		// [$nomePagina] = funzione (main, varia, nuovo)
$conn = new FUNCT();
$conn->doServer();
$notizia = $conn->doNews($index, $sheet);//notizia caricata con il $_GET
$pagine = $conn->doPages();			//preleva dalla tabella `struttura` i nomi delle pagine
$titolo = addslashes($notizia['titolo']);
if (strlen($titolo) > 22)
	{
		$titolo = substr(addslashes($notizia['titolo']), 0, 23) . '...';
	}
$titolo_breve = '#&nbsp;' . $notizia['real_id'] .  '&nbsp;&nbsp;' . $titolo;
$user = $users[$admin];
$user_display = '';

?>
<script type="text/javascript">
			$(document).ready(function()
				{
					dis ( 	<?php echo $index; ?>,
							'<?php echo trim($nomePagina); ?>',
							'<?php echo $sheet; ?>',
							'<?php echo $sessione; ?>',
							'<?php echo $admin; ?>',
							'<?php echo $titolo_breve; ?>',
							'<?php echo $img_type; ?>');
				<?php include 'eccezioni.php'; ?>
							});
</script>
</head>
<body>
<div id="message_box"></div>

<!--		*******LINGUETTE******			-->
<div id="tab_top"><!--	linguette		-->
	
<?php include 'php/pagina/linguette.menu.php'; ?>
	
</div>
<!--		*******FINE LINGUETTE******			-->

<div id="wrap">
<!-- BOX_CP2 (MENU IN ALTO) + (TITOLO)  -->
<div class="box_cp2" id="buttons_top">
<?php include 'php/pagina/varia.barra.menu.php'; ?>
</div> <!-- fine di box_cp2 -->

<div id="titolo_news" ><?php echo '<span>varia : </span>' . $notizia['titolo']; ?></div>


<div id="main_content">		<!-- **** MAIN CONTENT **** --> 

<!--	INCLUDI LA PAGINA SALVATA IN CACHE   -->
<?php 
//echo $dir_cache . 'cache/page' . $user .'varia_' . $sheet . '.php';
include $dir_cache . 'cache/page' . $user .'varia_' . $sheet . '.php';
?>

<!-- FINE BOXES  -->
<center>
<div id="help_window"></div>
</center> 

</div>				<!-- FINE MAIN CONTENT -->
<center> 
<div class="footer_closer" style="color: #AAA;">.</div>
</center> 
</div> <!-- end wrap -->
</body>
</html>