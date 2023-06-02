<?php 
//		$pag Array contiene i nomi delle pagine
//		inizia ciclo di assegnazione
$stringa .= 'function doCookies()' . PHP_EOL . '     {' . PHP_EOL;
$l_pages = count($pag);
for ($m = 1; $m <= $l_pages; $m++)
	{
		$nome_var = 'box_' . $pag[$m];
		//$.cookie('box_eventi', JSON.stringify(box_eventi));
		$stringa .= '		$.cookie(\'' . $nome_var . '\',\'\', { expires: -1 });' . PHP_EOL;
		$stringa .= '		var ' . $nome_var . ' = new Array (0,0,0,0,0,0,0,0,0,0,0);' . PHP_EOL;
		$stringa .= '		$.cookie(\'' . $nome_var . '\', JSON.stringify(' . $nome_var .'));' . PHP_EOL;
	}
$stringa .= '     }' . PHP_EOL;
echo $stringa;
 
?>