<?php 
@session_start();
$sessione = @session_id(); 
?>

<!DOCTYPE html> 
<html> 
<head>
<?php
include "php/blocks/head.settings.php";
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
$sheet = 'settings';
$news = new NEWS();
$conn = new FUNCT();
$news->getLogo();
$news->doServer();
$admin = $_SESSION['admin'] ;

?>
<link href="css/settings.css" rel="stylesheet" type="text/css" >
<link rel="stylesheet" media="screen" type="text/css" href="css/colorpicker.css" />
<script type="text/javascript" src="scripts/colorPicker/colorpicker.js"></script>
<script type="text/javascript" src="scripts/settings.js"></script>
<script type="text/javascript">
			$(document).ready(function()
				{
					dis ( 	'<?php echo $index; ?>',				//index
							'mostra',
							'settings',
							'<?php echo $sessione; ?>',
							'<?php echo $admin; ?>',
							'settings...',
							'single');
					startSettings('temp');	
							});
</script>
</head>
<body>
<div id="message_box"></div> 
<!--		*******LINGUETTE******			-->
<div id="tab_top"><!--	linguette		-->
<?php include 'php/pagina/linguette.settings.php'; ?>
</div>
<!--		*******FINE LINGUETTE******			-->

<div id="wrap">
<!-- BOX_CP2 (MENU IN ALTO) + (TITOLO)  -->
<div class="box_cp2" id="buttons_top">
<?php include 'php/pagina/main.barra.menu.settings.php'; ?>
</div> <!-- fine di box_cp2 -->

<div id="main_content" >		<!-- **** MAIN CONTENT **** --> 

<div class="box_cp double box_display" id="box_example"  >
<div class="testata">ANTEPRIMA</div>
<div id="box_content_example">	
	
</div>	<!-- fine #box_content -->
</div>	<!-- fine del box -->

<div class="box_cp double box_tavolozza"   id="box_color">
<div class="testata">TAVOLOZZA COLORI</div>
<div id="box_content">
<div id="box_settings">
</div>	
</div>	<!-- fine #box_content -->
</div>	<!-- fine del box -->



<div class="box_cp double" id="box_function"  style="background-color: #dedede;width: 98%;height:150px;">
<div class="testata">FUNZIONI</div>
<div id="box_content_funzioni">	
	
</div>	<!-- fine #box_content -->
</div>	<!-- fine del box -->
<center>
<div id="help_window">
</div>
</center> 
</div>				<!-- FINE MAIN CONTENT -->
<center>
<div class="footer_closer"  style="color: #aaa;">.</div>
<div class="content_menu"></div>
</center> 
</div> <!-- end wrap -->
<div id="service"></div>
<div id="service2"></div>
</body>
</html>