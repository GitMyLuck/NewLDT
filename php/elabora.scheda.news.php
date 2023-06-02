<?php 
		@session_start();
		$id = (isset ($_POST['news'])) 
				? $id = htmlspecialchars($_POST['news']): $id = "1";
	//  per default viene preso il valore "eventi"
		$pagina = (isset ($_POST['pagina'])) 
				? $pagina = htmlspecialchars($_POST['pagina']): $pagina = "pippo";
	//  chiave di ricerca per default viene preso il valore "tutti"
		$search = (isset ($_POST['search'])) 
				? $search = htmlspecialchars($_POST['search']): $search = "tutti";

		$pagine = (isset ($_GET['pages'])) 
				? $pagine = htmlspecialchars($_GET['pages']): $pagine = "eventi";
		//  passa anche la variabile array $pagine	
		
		
	include "db.inc.php";
		$conn = new FUNCT($pagina);
		$conn->doServer();
		$news = $conn->getSingleNews($id);
		//exit(var_dump($news));
		if ( !$news )
			{
				exit('notizia inesistente...'); 
			}
		else
			{
		//		DATI PASSATI ALLA SESSION
		//		viene passato in sessione, l'intero array che contiene i dati della notizia
		$_SESSION['data'] = serialize($news);
		//		la chiave di ricerca se diversa da "tutti"
		$_SESSION['search'] = $search;
		//		il nome della pagina per identificare la categoria
		$_SESSION['pagina'] = $pagina;
		//		id della notizia
		$_SESSION['id'] = $id;
		
		include "classes/cache.class.php";
		//  usa $id al posto di $search
		$pag = new CACHE($id, "cache_schede", "show.scheda.php");
		$results = $pag->getCache();
		}
?>