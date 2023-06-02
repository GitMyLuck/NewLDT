
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
<meta name="keywords" content="aliante, aeromodello, gruppo, traino aliante, acrobazia, f3a, f31b, f4j, f4c, riproduzioni, jet, turbina, rc, team, volo, termica">
<meta name="robots" content="index">
<meta name="revisit-after" content="5 days">
<meta name="author" content="Giovanni Avallone ® 2015"> 
<meta http-equiv="imagetoolbar" content="no" />
<?php 
			include "php/db.inc.php";
			//  prelevo valore  id notizia
			$id = (isset ($_GET['news'])) 
				? $id = htmlspecialchars($_GET['news']): $id = NULL;
			//  per default viene preso il valore "eventi"
			$pagina = (isset ($_GET['pagina'])) 
				? $pagina = htmlspecialchars($_GET['pagina']): $pagina = "eventi";
			$search = (isset ($_GET['search'])) 
				? $search = htmlspecialchars($_GET['search']): $search = "tutti";
			$conn = new FUNCT($pagina);
			$conn->doServer();
			if ( $id )
				{
					//preleva singola news
					$news = $conn->getSingleNews($id);
					$descrizione = transDescrizione( $news[0]['testo'], $search);
					echo '
<meta property="og:url" content="http://www.luccadeltateam.it/eventi.php?news=' . $id . '&pagina=' . $pagina . '&search=" />
<meta property="og:type" content="article" />
<meta property="og:title" content="' . $news[0]['titolo'] . '" />
<meta property="og:description" content="' . $descrizione . '" />
<meta property="og:image"   content="http://www.luccadeltateam.it/public/php/immagini_' . $pagina . '/' . $news[0]['foto'] . '" />';
					echo '
<meta name="title" content="LUCCA DELTA TEAM  &#9679; ' . $news[0]['titolo'] . '" />
<meta name="description" content="' . $descrizione . '" />
<link rel="image_src" href="http://www.luccadeltateam.it/public/php/immagini_' . $pagina . '/'  . $news[0]['foto'] . '" />';
				}
			else
				{
					//  prepara una pagina alternativa
					// per la condivisione su facebook
					// essa verra' anche usata per il tasto
					//  'f' in fondo alla pagina
					
					
				}
include "php/config.ini.php";				
			//exit(var_dump($news)); 
?>
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
<script type="text/javascript" src="scripts/gestioni.scheda.js"></script>
<script type="text/javascript" src="scripts/gestione.fb.js"></script>
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
	
	// nome del server-host
		$server = $_SERVER['SERVER_NAME'];
		if ( $server == "127.0.0.1" )
			{
				$server = "http://" . $server . "/NewLDT/";
			}
else 
			{
				$server = $server . "/";
			}

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
		var newsPage = '<?php echo $pagina; ?>';
		var pageUrl = 'http://<?php echo $server; ?>';
		var pagine = new Array( <?php echo $pags; ?>);
		$(function(){
			iniStartEventi( pagina, newsId );
						});
	
</script> 
<?php 
			echo "<title>" . $nomePagina . " - LDT ®</title>";
			echo PHP_EOL . PHP_EOL;
			echo "</head>";
			echo PHP_EOL . PHP_EOL;
			
			function transDescrizione($testo, $search)
				{
					//$nuovo_testo = str_replace("\n", "<br />", $testo);
					$part_news = (substr($testo, 0, 120));
					$find_pos = strrpos($part_news, " ");
					$part_news = substr($testo, 0 , $find_pos);
					$part_news .= ' ...';	//puntini
					$nuovo_testo = $part_news;
					$pattern = $search;
					$replacement = "<span class='found'>" . $search . "</span>";
					$nuovo_testo = str_ireplace( $pattern, $replacement, $nuovo_testo);
					return $nuovo_testo;
				
				}
?>