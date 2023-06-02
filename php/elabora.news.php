<?php 
		@session_start();
		// le news non cambiano mai al variare della pagina
		// cambiano solo se viene impostato un valore search di
		// ricerca che viene dai tags o dalla barra search
		//  preleva il valore $search dalla stringa GET
		$search = (isset ($_GET['search'])) 
				? $search = htmlspecialchars($_GET['search']): $search = "tutti";
		//  per default viene preso il valore "tutti"
		$pagina = (isset ($_GET['pagina'])) 
				? $pagina = htmlspecialchars($_GET['pagina']): $pagina = "eventi";
		//  per default viene preso il valore "eventi"
		$chunk = (isset ($_GET['chunk'])) 
				? $chunk = htmlspecialchars($_GET['chunk']): $chunk = 0;
		//  per default viene preso il valore 0 ( primo tronco )
		$zona = (isset ($_GET['zona'])) 
				? $zona = htmlspecialchars($_GET['zona']): $zona = "news";
		//  $zona indica se le notizie vengono mostrate in "news-page"  (valore di default "")
		//	o nella main page $zona = "page"
		
		$pagine = (isset ($_GET['pages'])) 
				? $pagine = htmlspecialchars($_GET['pages']): $pagine = "eventi";
		//  passa anche la variabile array $pagine
		
		
		//exit(var_dump($pagine)); 
		include "db.inc.php";
		$conn = new FUNCT($pagine);
		$conn->doServer();
		//$test = $conn->classTest();
		//exit(var_dump($test)); 
		$news = $conn->getNews($search);
		
		$searching = "searching for ...";
		$searched = $search;
		$found = "nessuna notizia trovata";
		$search_key = $search;
			if ($search == "tutti" ) 
				{	
					$searching = "";
					$searched = $pagina;
					$search_key = "";
				}
		$len_news = count($news);
		if ( $len_news > 0 )
			{
					if ( $len_news == 1 )
						{
							$found = "trovata una sola news";
						}
					else
						{
							$found = "trovate " . $len_news . " news";
						}
			}
		$data = array_chunk(($news), 184, true);
		$max_chunk = (count ($data)) - 1; 
		//		viene passato in sessione, l'intero elenco notizie
		$_SESSION['data'] = serialize($data);
		//		il numero di pagina (tronco) interessato
		$_SESSION['chunk'] = $chunk;
		//		il numero di pagine
		$_SESSION['max_chunk'] = $max_chunk;
		//		la chiave di ricerca se diversa da "tutti"
		$_SESSION['search'] = $search_key;
		//		il nome della pagina per identificare la categoria
		$_SESSION['pagina'] = $pagina;
		//		la zona in cui vengono mostrati i risultati
		$_SESSION['zona'] = $zona;
		//exit(var_dump($zona)); 
		$eZona = '-' . $zona;
		include "classes/cache.class.php";
	
?>

<div class="search-results<?php echo $eZona; ?>"  >
		<div class="action-search"><?php echo $searching; ?></div>
		<span class="ricerca"><?php echo $pagina; ?></span>
		<div class="search-response<?php echo $eZona; ?>"><?php echo $found; ?></div>
		<br /><br />
		<div class="icona-aggiorna" title="aggiorna news" onclick="search='tutti';caricaNews(0, '<?php echo $zona; ?>');"></div>
		<div class="freccia-giu<?php echo $eZona; ?>" title="pagina successiva" ></div>
		<div class="freccia-su<?php echo $eZona; ?>" title="pagina precedente" ></div>
		<div class="search-group">
				<input id="searchNews" class="search-group-input" name="searchNews" type="text" value=""> 
				<div class="icona-search" title="cerca" name="<?php echo $zona; ?>" ></div>
		</div>
</div> 
<div class="scroll-news<?php echo $eZona; ?>"><!---->
<?php 
		$pag = new CACHE($search, "cache", "show.news.php");
		$results = $pag->getCache();
?>
</div>
<div class="bottom-search"><!----> 
			<div id="closer" class="freccia-giu<?php echo $eZona; ?>" title="pagina successiva" ></div>
			<div class="freccia-su<?php echo $eZona; ?>" title="pagina precedente" ></div>
			<p>&nbsp; &nbsp; &nbsp; risultati della ricerca </p>
</div>
