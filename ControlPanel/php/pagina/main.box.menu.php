<?php 
echo '<div class="box_cp double triple_height" id="box_search_news">';
$tasto_search = '';
$titolo = $notizia['titolo'];
if (strlen($titolo) > 22)
	{
		$titolo = substr($notizia['titolo'], 0, 23) . '...';
	}
$titolo_breve = '#&nbsp;' . $notizia['real_id'] .  '&nbsp;&nbsp;' . $titolo;
//$titolo_breve .= '&nbsp;MENU'; 
echo 	'<div class="testata elenco">' . $titolo_breve;
echo	'	<div id="wait_spin_search" class="show_spin"  ></div>
			<div id="btn_test_search" class="arrow_up"></div></div>';
if ($admin < 3)
			{
				$tasto_search .= '<div id="search_titoli">';
				$tasto_search .= '<div class="search_title">';
				// 		LAST BUTTON
				$tasto_search .= '<input id="last_button" class="last buttons" type="button" value="" title="vai a ultimo" style="width: 40px;" >';
				/*//DATE BUTTON
				$tasto_search .= '<input id="date_button" class="current buttons" type="button" value="" title="vai a oggi" style="width: 40px;" >';*/
				//		REFRESH BUTTON
				$tasto_search .= '<input id="refresh_button" class="refreshing buttons" type="button" value="" title="refresh elenco" style="width: 40px;" >';
				//		SEARCH  INPUT  TEXT
				$tasto_search .= '&nbsp;<input id="search_index" class="text_input" name="" type="text" value="" style="width: 110px;">';
				$tasto_search .= '&nbsp;<input id="search_button" class="searching buttons" name="" type="button" value=""  title="cerca nell\'elenco" style="width: 40px;" ></div></div><br /> ';
			}
echo $tasto_search;

echo	'<div id="menu_notizie">
		</div>
		</div>'; 

?>