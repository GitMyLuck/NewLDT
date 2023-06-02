<!DOCTYPE html> 
<html>
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

<script type="text/javascript">
		var pagina = 'home';
		var newsId = ''
		var search = 'tutti';
		var newsPage = 'eventi';
		var pagine = new Array( "home");
		var pageUrl = 'http://www.luccadeltateam.it";';
		$(function(){
			iniStart( pagina, newsId );
						});
	
</script> 
<body>


<div class="banner">
	<div class="main-banner">
		<div class="logo-banner" >
			<a href="index.php"  ><img src="img/LogoLDT3.png" width="200" /></a>
		</div>
		<div class="titolo-banner">aeromodellisti</div>
	</div>		<!-- fine main-banner 		-->
</div>		<!-- fine banner 		-->
<div class="menu-banner">
<?php 
			include "blocks/menu.php";
?>
<img class="img-banner" src="img/banner/2.gif" width="150" />
</div>		<!--  fine menu	-->
<div id="service"></div>	
<div class="main">
	<div class="main-content pad">
	
		<div class="main-page">
				<!--  PAGINA	-->
		</div>
		
		<div class="main-news" style="display:none">
				<!--	ELENCO NEWS		-->
		</div>
	</div>		<!-- fine main-content	-->
</div>		<!--  	fine main	-->

<?php 
			include "blocks/footer.php";
?>

</body>
</html>

