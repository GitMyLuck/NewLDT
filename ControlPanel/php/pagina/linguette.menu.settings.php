<?php
$admin = $_SESSION['admin'];

 
	// USATO NEL CASO IN CUI SI VOGLIA AGGIUNGERE UN'ALTRA PAGINA
	
	// GESTIONE SPECIALE LINGUETTA PAGINA GUEST-BOOK
	
	$temp = '<a href="guest-book.php?login=' . $sessione . '&page=1&sheet=guest-book&function=data"> 
	<div class="tasto_pagina" id="attivo" title="vai a mail">guest-book</div></a>';
	
		if ($sheet == 'guest-book')
			{
				$temp = '<div class="tasto_pagina" id="inattivo">guest-book</div>';
			}
	echo $temp;
	if ($admin == 1)
		{
	// GESTIONE SPECIALE LINGUETTA PAGINA STATISTICHE
	$temp = '<a href="statistiche.php?login=' . $sessione . '&page=1&sheet=statistiche&function=data"> 
	<div class="tasto_pagina" id="attivo" title="vai a mail">statistiche</div></a>';
	
		if ($sheet == 'statistiche')
			{
				$temp = '<div class="tasto_pagina" id="inattivo">statistiche</div>';
			}
	echo $temp;
		}


?>