<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">

<link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="images/favicon.ico">
<!--			CSS SHEETS		-->
<link href="css/layout_cp.css" rel="stylesheet" type="text/css" >
<link href="css/lightbox.css" rel="stylesheet" type="text/css" >
<link href="css/layout_pannello.css" rel="stylesheet" type="text/css" >
<link href="css/pulsanti.barra.menu.css" rel="stylesheet" type="text/css" >
<link href="css/icone.css" rel="stylesheet" type="text/css" >
<link href="css/album_foto.css" rel="stylesheet" type="text/css" >
<!--		CONTROLLARE REALE UTILIZZO		-->
<link href="css/dialogs_layout.css" rel="stylesheet" type="text/css" >
<!--		CONTROLLARE REALE UTILIZZO		-->
<link href="css/radius/border.radius.css" rel="stylesheet" type="text/css" >
<link href="css/appendici/appendici.alert.css" rel="stylesheet" type="text/css" >
<link href="css/smoothness/jquery-ui-1.10.3.customCiccio.css" rel="stylesheet">
<link href="css/spin/spin_layout.css" rel="stylesheet" type="text/css" >
<link href="css/istruzioni.css" rel="stylesheet" type="text/css" >
<!--			SCRIPTS	JAVASCRIPT				-->
<script type="text/javascript" src="scripts/jquery-2.0.2.js"></script>
<script type="text/javascript" src="scripts/jquery.cookie.js"></script>
<script type="text/javascript" src="scripts/lightbox.js"></script>
<script type="text/javascript" src="scripts/gestioni.js"></script>
<script type="text/javascript" src="scripts/new.gestioni.js"></script>
<script type="text/javascript" src="scripts/gestioni.box.js"></script>
<script type="text/javascript" src="scripts/gestioni.help.js"></script>
<script type="text/javascript" src="scripts/gestioni.immagini.js"></script>
<script type="text/javascript" src="scripts/gestioni.binding.js"></script>
<script type="text/javascript" src="scripts/js/jquery-ui-1.10.3.custom.ciccio.js"></script>
<script type="text/javascript" src="scripts/spin/spin.js"></script>
<script type="text/javascript" src="scripts/spin/jquery.spin.js"></script>
<script type="text/javascript" src="scripts/gestioni.tags.js"></script>
<script type="text/javascript" src="scripts/gestioni.settings.js"></script>
<script type="text/javascript" src="scripts/jquery.isotope.js"></script>
<script type="text/javascript" src="scripts/google.istr.js"></script>
<script type="text/javascript" src="scripts/key.gen.js"></script>
<script type="text/javascript" src="scripts/alert.genesis.js"></script>
<script type="text/javascript" src="scripts/gestioni.tabelle.js"></script>
<?php
$title = 'SUPER_CP';
$server = $_SERVER['SERVER_ADDR'];
	if ($server == '127.0.0.1')
			{
				$title = 'LOCAL SUPER_CP';
			}
echo '<title>' . $title . '</title>';

require_once "../ControlPanel/php/config.inc.php"; 
include $dir_cache . "cache/layout.settings.php";
?>