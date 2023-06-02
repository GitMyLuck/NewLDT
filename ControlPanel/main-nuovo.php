
<?php 
@session_start();
$sessione = @session_id(); 
?>

<!DOCTYPE html> 
<html> 
<head>
<?php
include "php/blocks/head.php";
if(!isset($_GET['login']) || $_GET['login'] != $sessione || !isset($_GET['page']))
	{
		header("location: index.php");
	}
include "php/db.inc.php";
include "php/config.inc.php";
$sheet = $_GET['sheet']; //pagina selezionata
$news = new NEWS();
$news->getLogo();
$img_type = $news->getImagesRegister();	//prelevo il tipo di immagini da
										//gestire 'single' o 'multi'
$admin = $_SESSION['admin'];
$uri = $_SERVER['PHP_SELF'];
$nomePagina = $news->doName($uri);		// [$nomePagina] = funzione (main, varia, nuovo)
$conn = new FUNCT();
$conn->doServer();
$pagine = $conn->doPages();			//preleva dalla tabella `struttura` i nomi delle pagine
$num_notizie = $conn->contaNews($sheet);		//numero di notizie nel database
$index = $num_notizie + 1;
$conn->showData($sheet, 'null');		//recupera i titoloi degli eventi
$date_eventi = $conn->date;				//sono memorizzati in array
$user = $users[$admin];			///  include pagina giusta per questo tipo di utente
//$campi = $news->doCampi('');		//preleva costanti costr box 1
?>
<script type="text/javascript">
			$(document).ready(function()
				{
					dis ( 	<?php echo $index; ?>,
							'<?php echo $nomePagina; ?>',
							'<?php echo $sheet; ?>',
							'<?php echo $sessione; ?>',
							'<?php echo $admin; ?>',
							'',
							'<?php echo $img_type; ?>');
					<?php include 'eccezioni.php'; ?>
				});
</script>
</head>
<body>
<div id="message_box"></div>
<div class="go_up"  style="display:none;" ></div>
<div class="go_down"  style="display:none;" ></div> 

<!--		*******LINGUETTE******			-->
<div id="tab_top"><!--	linguette		-->
	
<?php include 'php/pagina/linguette.menu.php'; ?>
	
</div>
<!--		*******FINE LINGUETTE******			-->

<div id="wrap">
<!-- BOX_CP2 (MENU IN BASSO)  -->
<div class="box_cp2" id="buttons_top">
<?php include 'php/pagina/nuovo.barra.menu.php'; ?>
</div> <!-- fine di box_cp2 -->
<div id="titolo_news" >&nbsp;</div>

<div id="main_content">		<!-- **** MAIN CONTENT **** --> 


<!--	INCLUDI LA PAGINA SALVATA IN CACHE   -->
<?php 
include $dir_cache . 'cache/page' . $user . 'nuovo_' . $sheet . '.php';
?>
<center>
<div id="help_window"></div>
</center> 
</div>				<!-- FINE MAIN CONTENT -->
<center> 
<div class="footer_closer" style="color: #AAA;">.</div>
</center> 
<div id="service"></div>
</div> <!-- end wrap -->
</body>
</html>