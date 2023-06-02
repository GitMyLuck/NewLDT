<?php 
		$len_menu = count($voci_menu);
		echo '<ul id="menu-alto">' . PHP_EOL;
		for ($i = 0; $i <= ($len_menu - 1); $i++)
			{
				if ( $nomePagina == $voci_menu[$i] )
					{
						echo '<li class="selected">' . $voci_menu[$i] . '</li>' . PHP_EOL;
					}
				else
					{
						echo '<li class="unselected">' . $voci_menu[$i] . '</li>' . PHP_EOL;
					}
			}
		echo '</ul>';
		
?>