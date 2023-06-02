<?php
	include "../db.inc.php";
	$conf = new CONFIG();
	$conf->doServer();
	$colors = $conf->doColors('temp');
	$color_string = '';
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
			$border_radius = $conf->row['border_radius'];					//  angolo di arrotondamento angoli
			$ink_bar = '#' . $conf->row['ink_bar'];							// colore icone barra
		}
	else
		{
			include "colori.default.php";
		}

	$colore = $conf->calcola_sfum($change_percentage, $sfum_pannelli);
	//exit(var_dump($colore) . '<br />' . var_dump($sfum_pannelli)); 
	echo  PHP_EOL . '<style type="text/css">' . PHP_EOL;
	// sezione SFONDO BODY
	
	echo '.general_back	{
			background-color: ' . $general_background . ';
				}' . PHP_EOL;
	// sezione PULSANTIERA E MENU IN ALTO
	echo '.activity_back, #inattivo_example {
			background-color: ' . $activity_background . ';
					}' . PHP_EOL;
	echo '.radius	{
					-moz-border-top-left-radius:  ' . $border_radius . 'px;
					-webkit-border-top-left-radius:  ' . $border_radius . 'px;
					border-top-left-radius:  ' . $border_radius . 'px;
					-moz-border-top-right-radius:  ' . $border_radius . 'px;
					-webkit-border-top-right-radius:  ' . $border_radius . 'px;
					border-top-right-radius:  ' . $border_radius . 'px;
			}' . PHP_EOL;
	echo '#inattivo_example {
						float: left;
						height: 32px;
						margin:0 2px;
						color: #fff;
						font-size: 1.3em;
						cursor: default;
						}' . PHP_EOL;
	echo '#attivo_example {
						float: left;
						position: relative;
						top: 6px;
						height: 20px;
						margin:0 2px;
						color: #fff;
						background-color: rgba(0,0,0,.1);
						font-weight: bold;
						border-top: 1px solid #c2bbaa;
						}' . PHP_EOL;	
	echo '#attivo_example:hover {
						background-color: rgba(255,255,255,0.5);
						color: #eda633;
						max-height: 19px;
						cursor: pointer;
						}' . PHP_EOL;
	// sezione INCHIOSTRO PANNELLO
	echo '.ink_pannelli, .sottotirolo_istr {	
			color: ' . $inchiostro_pannelli . ';
					}' . PHP_EOL;
	// sezione TESTATINE PANNELLI
	echo '.testate_back, .content_title_alert {
			background-color: ' . $testate_background . ';
					}' . PHP_EOL;
			//inchiostro TESTATINE PANNELLI	
	echo '.ink_testate, #test_istr {
			color: ' . $inchiostro_testate . ';
					}' . PHP_EOL;
			//colore della freccia nelle TESTATINE PANNELLI
			//creata cartella in 'images/icone/' numero colore
			// controlla prima se esiste la cartella con le immagini
			$src = '../../images/icone/' . $conf->row['ink_testate'] . '/arrow-up.png';
			if ( file_exists($src))
				{
					$src = 'images/icone/' . $conf->row['ink_testate'] . '/arrow-up.png';
				}
			else
				{
					$src = 'images/icone/F9B234/arrow-up.png';
				}
				
	echo		'.arrow_up {
					background-image: url(\'' . $src . '\');
					}' . PHP_EOL;
				
					
			//sfondo bordo inferiore pannelli uguale a testatine
	echo '.box_cp_example, #buttons_top_example, .testate_back {
			border-bottom: 4px solid ' . $testate_background . ';
					}' . PHP_EOL;
					
	echo '#buttons_top_example {
							width: 100%;
							height: 10px;
							font-size: 12px;
								}' . PHP_EOL;
								
			//bordi inputs, bottoni e text area
	echo '.buttons_example, inputs_back {
			background: ' . $inputs_background . ';
			color: ' . $inputs_inchiostro . ';
			border: 1px solid ' . $testate_background . ';
			cursor: pointer;
			height: 30px;
			opacity: 0.4;
					}' . PHP_EOL;
					
	echo '.buttons_example:hover {
	opacity:1;
							}' . PHP_EOL;
					
	
	echo '.box_cp_example {				
						float:left;
						width: 160px;
						height: 32px;
						padding: 5px 5px;
						overflow: hidden;
						position: relative;
						margin: 5px;
	
						-moz-box-shadow: 0 0 2px 0 rgba(0,0,0,.2);
						-webkit-box-shadow: 0 0 2px 0 rgba(0,0,0,.2);
						box-shadow: 0 0 2px 0 rgba(0,0,0,.2);
		
						-moz-border-radius: ' . $border_radius . 'px;
						-webkit-border-radius: ' . $border_radius . 'px;
						border-radius: ' . $border_radius . 'px;
					}' . PHP_EOL;
					
	echo '.buttons:disabled, input:disabled  {
					border: 0px;
					color: ' . $inputs_inchiostro_dis . ';
					background: ' . $inputs_background_dis . '; 
					}' . PHP_EOL;
	
	echo '.buttons_example:disabled {
					cursor: default;
					opacity: 0.5;
						}' . PHP_EOL;
	echo '.input_example{			/* al posto di  -input, textarea, select - */
					border: 0px;
					background: ' . $inputs_background . ';
					color: ' . $inputs_inchiostro . ';
					}' . PHP_EOL;
	// angoli di inputs e buttons
	echo '.input_example, .buttons_example, #input-example2, .buttons_example:disabled {
					-moz-border-radius: ' . $border_radius . 'px;
					-webkit-border-radius: ' . $border_radius . 'px;
					border-radius: ' . $border_radius . 'px;
				}' . PHP_EOL;
	//  	tastiera in fondo pagina
	echo '#content_tastiera_example {
									position: relative;
									top: 410px;
									height: 50px;
									width: 100%;
									background-color: ' . $menu_back . ';
								}' . PHP_EOL;
								
	echo '.tastiera_example {
									position: relative;
									top: -18px;
									display: inline-block;
									margin-left: 5px;
								}' . PHP_EOL;
	$icon_color = strtoupper(substr($ink_bar, 1));
	$src = '../../images/icone_barra/' . $icon_color . '/add.png';
			if ( file_exists($src))
				{
					$src = 'images/icone_barra/' . $icon_color . '/';
				}
			else
				{
					$src = 'images/icone_barra/FFFFFF/';
				}	
				
	echo '.add_ex {
					background: transparent url("' . $src . 'add.png") no-repeat scroll center center;
					}' . PHP_EOL;
	echo '.edit_ex {
					background: transparent url("' . $src . 'modify.png") no-repeat scroll center center;
					}' . PHP_EOL;
	echo '.delete_ex {
					background: transparent url("' . $src . 'cestino.png") no-repeat scroll center center;
					}' . PHP_EOL;
	echo '.maximize_ex {
					background: transparent url("' . $src . 'max.png") no-repeat scroll center center;
					}' . PHP_EOL;
	echo '.out_ex {
					background: transparent url("' . $src . 'exit.png") no-repeat scroll center center;
					}' . PHP_EOL;
	
	// sezione BANNER
	
	echo '.ink_banner, #programma_example, #versoft, #titolo_appl {
			color : ' . $banner_inchiostro . ';
					}'  . PHP_EOL;
					
					
	// sezione SFUMATURA PANNELLI
	echo ' .pannelli_back, #help_window {
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
$color_string = 'general_back-' . $general_background . ',';
$color_string .= 'activity_back-' . $activity_background . ',';
$color_string .= 'ink_pannelli-' . $activity_background . ',';	
$color_string .= 'testate_back-' . $activity_background . ',';
$color_string .= 'ink_testate-' . $inchiostro_testate . ',';
echo '<div id="colori_schema"  style="visibility:hidden"> ' . $color_string . '</div>'  . PHP_EOL;
//<div id="_" che contiene i colori per altre applicazioni


?>