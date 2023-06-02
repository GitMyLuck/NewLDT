<?php 
echo '<div class="box_cp double triple_height" id="box_search_news">';
$tasto_search = '';
$titolo = 'ELENCO UTENTI';
echo 	'<div class="testata elenco">' . $titolo;
echo	'	<div id="wait_spin_search" class="show_spin"  ></div>
			<div id="btn_test_search" class="arrow_up"></div></div>';
if ($admin < 3)
			{
				$tasto_search .= '<div id="search_titoli">';
				$tasto_search .= '<div class="search_title">';  
				$tasto_search .= '<input id="refresh_button" class="refreshing buttons" type="button" value="" title="refresh elenco" style="width: 40px;" >';
				$tasto_search .= '&nbsp;<input id="search_index" class="text_input" name="" type="text" value="" style="width: 110px;">';
				$tasto_search .= '&nbsp;<input id="search_button" class="searching buttons" name="" type="button" value=""  title="cerca nell\'elenco" style="width: 40px;" ></div></div><br /> ';
			}
echo $tasto_search;

echo	'<div id="menu_notizie">
		</div>
		</div>'; 

?>