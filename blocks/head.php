
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<meta name="description" content="Sito Ufficiale del Gruppo Aeromodellistico Lucca Delta Team.">
<meta name="keywords" content="aliante, aeromodello, gruppo, traino aliante, acrobazia, f3a, f31b, f4j, f4c, riproduzioni, jet, turbina, rc, team, volo, termica">
<meta name="robots" content="index">
<meta name="revisit-after" content="5 days">
<meta name="author" content="Giovanni Avallone ® 2015"> 
<meta http-equiv="imagetoolbar" content="no" />
<link rel="stylesheet" href="css/text-styles.css" type="text/css"  media="screen" />
<link rel="stylesheet" href="css/main-layout.css" type="text/css"  media="screen" />
<link rel="stylesheet" href="css/pulsanti-styles.css" type="text/css"  media="screen" />
<link rel="stylesheet" href="css/main-device-screen-width.css" type="text/css"  media="screen" />
<link rel="stylesheet" href="css/main-device-screen-height.css" type="text/css"  media="screen" />
<link rel="stylesheet" href="css/scheda.single.news.css" type="text/css"  media="screen" />
<link rel="stylesheet" href="css/boxes-model.css" type="text/css"  media="screen" />
<link rel="stylesheet" href="css/loader.css" type="text/css"  media="screen" />
<link href="css/form_photos.css" rel="stylesheet" type="text/css" media="screen">
<link rel="shortcut icon" href="img/favicon.ico">
<script type="text/javascript" src="scripts/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="scripts/jquery.scrollTo.min.js"></script>
<script type="text/javascript" src="scripts/active.footer.js"></script>
<script type="text/javascript" src="scripts/jquery.cookie.js"></script>
<script type="text/javascript" src="scripts/gestioni.js"></script>
<script type="text/javascript" src="scripts/gestioni.arrows.js"></script>


<?php
$uri = $_SERVER['PHP_SELF'];
//taglia la stringa contenente la directory
$pos = (strrpos($uri, "/")) + 1;
$nomePagina = substr($uri, $pos);
//taglia l'estensione del nome pagina
$pos = (strrpos($nomePagina, "."));
$nomePagina = substr($nomePagina, 0, $pos);
//se la pagina si chiama index, allora cambia in 'home_page'
if ($nomePagina == 'index')
 {
  $nomePagina = 'home';
 }
$id = (isset ($_GET['news'])) 
				? $id = htmlspecialchars($_GET['news']): $id = NULL;
$server = $_SERVER['SERVER_NAME'];
if ( $server == "127.0.0.1" )
			{
				$server = "http://" . $server . "/NewLDT/";
			}
else 
			{
				$server = $server . "/";
			}
include "php/config.ini.php";
include "php/db.inc.php";
$conn = new FUNCT();
$conn->doServer();
$pagine = $conn->getPages(); 
// mettiamo l'elenco delle pagine in un array nominativo ("pag1", "pag2", "pagn")
$pags = '';
foreach ($pagine as $pagArray)
	{
		$pags .= "'" . $pagArray . "'";
		$pags .= ",";
	}
$pags = substr($pags, 0, -1);

?>

<script type="text/javascript">
		var pagina = '<?php echo $nomePagina; ?>';
		var newsId = '<?php echo $id; ?>'
		var search = 'tutti';
		var newsPage = 'eventi';
		var pagine = new Array( <?php echo $pags; ?>);
		var pageUrl = '<?php echo $server; ?>';
		$(function(){
			iniStart( pagina, newsId );
						});
	
</script> 
<?php 
			echo "<title>" . $nomePagina . " - LDT </title>";
			echo PHP_EOL . PHP_EOL;
			echo "</head>";
?>