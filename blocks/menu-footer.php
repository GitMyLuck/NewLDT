<?php 
		include "php/config.ini.php";
		$len_menu = count($voci_menu);
		echo '<ul id="menu-mobile">' . PHP_EOL;
		for ($i = 0; $i <= ($len_menu - 1); $i++)
			{
				if ( $nomePagina == $voci_menu[$i] )
					{
						echo '<li class="footer-selected">' . $voci_menu[$i] . '</li>' . PHP_EOL;
					}
				else
					{
						echo '<li class="footer-unselected">' . $voci_menu[$i] . '</li>' . PHP_EOL;
					}
			}
		echo '</ul>';
		
?>