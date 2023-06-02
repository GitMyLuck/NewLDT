<?php
 
	$conf = new CONFIG();
	$conf->doServer();
	$colors = $conf->doColors('current');
	// se non esiste ancora tabella (primo accesso)
	// include la pagina colori.default.php
	if ($colors)
		{
			$general_background = '#' . $conf->row['general_back'];	
			//  sfondo dell'applicazione
			$activity_background = '#' . $conf->row['activity_back'];	
			//  sfondo dei menu e della pulsantiera
			$testate_background = '#' . $conf->row['testate_back'];		//  colore testate box
			$sfum_pannelli = '#' . $conf->row['pannelli_back'];			
			//  colore finale sfumatura pannelli
			$change_percentage = $conf->row['change_perc'];		
			//  percentuale di differenza fra i colori
			//  della sfumatura pannelli
			$inputs_background = '#' . $conf->row['inputs_back'];					//  sfondo inputs e textarea
			$inputs_background_dis = '#' . $conf->row['inputs_back_dis'];		//  sfondo inputs disabilitati
			$inchiostro_pannelli = '#' . $conf->row['ink_pannelli'];					//  colore caratteri pannelli
			$inchiostro_testate = '#' . $conf->row['ink_testate'];						//  colore caratteri testate
			$banner_inchiostro = '#' . $conf->row['ink_banner'];				//  colore cartteri banner (titolo)
			$inputs_inchiostro = '#' . $conf->row['ink_inputs'];						//  colore caratteri inputs
			$inputs_inchiostro_dis = '#' . $conf->row['ink_inputs_dis'];	//  colore caratt. inputs disabilitati
			$menu_back = '#' . $conf->row['bar_back'];						// colore della barra menu
		}
	else
		{
			include "colori.default.php";
		}

	$colore = $conf->calcola_sfum($change_percentage, $sfum_pannelli);
	echo  PHP_EOL . '<style type="text/css">' . PHP_EOL;
	// sezione SFONDO BODY
	
	echo 'body, .bodyhome {
			background-color: ' . $general_background . ';
				}' . PHP_EOL;
	// sezione PULSANTIERA E MENU IN ALTO
	echo '#inattivo, #buttons_top {
			background-color: ' . $activity_background . ';
					}' . PHP_EOL;
	// sezione INCHIOSTRO PANNELLO
	echo '.box_cp, .unselected, a:link, a:visited, td, label, .tastiera, .sottotirolo_istr  {	
			color: ' . $inchiostro_pannelli . ';
					}' . PHP_EOL;
	// sezione TESTATINE PANNELLI
	echo '.testata, .content_title_alert {
			background-color: ' . $testate_background . ';
					}' . PHP_EOL;
			//inchiostro TESTATINE PANNELLI	
	echo '.testata, #test_istr {
			color: ' . $inchiostro_testate . ';
					}' . PHP_EOL;
					
			//sfondo bordo inferiore pannelli uguale a testatine
	echo '.box_cp, #buttons_top {
			border-bottom: 4px solid ' . $testate_background . ';
					}' . PHP_EOL;
			//bordi inputs, bottoni e text area
	echo '.buttons {
			background: ' . $inputs_background . ';
			color: ' . $inputs_inchiostro . ';
			border: 1px solid ' . $testate_background . ';
					}' . PHP_EOL;
					
	echo '.buttons:disabled, input:disabled, select:disabled, .selected  {
					border: 0px;
					color: ' . $inputs_inchiostro_dis . ';
					background: ' . $inputs_background_dis . '; 
					}' . PHP_EOL;
	echo 'input, textarea, select {
					border: 0px;
					background: ' . $inputs_background . ';
					color: ' . $inputs_inchiostro . ';
					}' . PHP_EOL;
	// sezione BANNER
	
	echo '#programma, #versoft, #titolo_appl {
			color : ' . $banner_inchiostro . ';
					}'  . PHP_EOL;
					
	// sfondo della barra del menu
	
	echo '#content_tastiera, .content_menu {
			background-color: ' .$menu_back . ';
				}' . PHP_EOL;
				
	// sezione SFUMATURA PANNELLI
	echo '.box_cp, #box_login, .al_win, .help_win {
	background-color:' . $colore . ';
background-image: -webkit-gradient(linear, left top, left bottom, from(' . $colore . '), to(' . $sfum_pannelli . '));
background-image: -webkit-linear-gradient(top, ' . $colore . ', ' . $sfum_pannelli . ');
background-image: -moz-linear-gradient(top, ' . $colore . ', ' . $sfum_pannelli . ');
background-image: -o-linear-gradient(top, ' . $colore . ', ' . $sfum_pannelli . ');
background-image: -ms-linear-gradient(top, ' . $colore . ', ' . $sfum_pannelli . ');
background-image: linear-gradient(top, ' . $colore . ', ' . $sfum_pannelli . ');
filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,StartColorStr=\'' . $colore . '\', EndColorStr=\'' . $sfum_pannelli . '\');
					}' . PHP_EOL;
	//sezione ui-jquery (vengono sostituite le classi jquery di default)
					
	echo '</style>' . PHP_EOL;

		$fix_colors[0] = $general_background;
		$fix_colors[1] = $activity_background;
		$fix_colors[2] = $testate_background;
		$fix_colors[3] = $inchiostro_testate;
		$fix_colors[4] = $inchiostro_pannelli;
		$color_string = implode(",", $fix_colors);
echo '<div id="colori" > ' . $color_string . '</div>'  . PHP_EOL;
//<div id="_" che contiene i colori per altre applicazioni


?>