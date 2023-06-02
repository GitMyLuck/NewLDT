<?php

		//  preleva il valore $pagina dalla stringa GET
		$pagina = (isset ($_GET['pagina'])) ? $pagina = $_GET['pagina'] : $pagina = "errore";
		// redirect alla pagina indicata
		$errore = header ( "location: ../" . $pagina . ".php" );
		echo $errore;
		
?>