<?php
//header('Content-type: text/html;charset=utf-8');
require_once "config.inc.php";
class NEWS extends FUNCT
{

	var $pag = array();
// Funzione di caricamento nella cache del file che contiene i colori per il pannello
	public function doCacheStyle()
	{
		global $dir_cache;
		$nameFile = $dir_cache . 'cache/layout.settings.php';
		ob_start();
		include "color_settings/style.variabile.php";
		// Scriviamo il contenuto del buffer nel file di cache
		$file = fopen($nameFile, 'w');
		fwrite($file, ob_get_contents());
		fclose($file);
		// Chiudiamo il buffer
		ob_end_flush();
		// Controlla se il file è stato creato correttamente
		if (is_file($nameFile))
			{	
				return true;
			}
		else
			{
				return false;
			}
		
	}
	
// Funzione di caricamento nella cache del file che contiene i colori per il pannello
	public function doCacheStyleNow()
	{
		global $dir_cache;
		ob_start();
		include "style.variabile.php";
		// Scriviamo il contenuto del buffer nel file di cache
		$file = fopen('cache/layout.settings.php', 'w');
		fwrite($file, ob_get_contents());
		fclose($file);
		// Chiudiamo il buffer
		ob_end_flush();
	}
	
/***	crea file per pagine principali ('nome_pagina', 'varia_pagina', 'nuova_pagina')
		@param		string		$page_main		contenuto pagina da creare HTML
		@param		string		$file_root		percorso completo e nome del file da creare
		@return		bool		$file				false in caso di insuccesso
		@stack						'index.php'
*****/
	public function doCachePage($page_main, $file_root)
	{
					$file = fopen($file_root, 'w');
					# CONVERTE IN FORMATO UTF-8
					fwrite($file, pack("CCC",0xef,0xbb,0xbf)); 
					fwrite($file, $page_main);
					fclose($file);

	}

	
	

// Funzione che preleva il nome della funzione dal nome pagina ([main], [main-varia], [main-nuovo])
// per costruire i box con i campi di testo
		public function doName($name)
		{
			//taglia la stringa contenente la directory
			$pos = (strrpos($name, "/")) + 1;
			$nomePagina = substr($name, $pos);
			//taglia l'estensione del nome pagina
			$pos = (strrpos($nomePagina, "."));
			$nomePagina = substr($nomePagina, 0, $pos);

			if ($nomePagina != 'main')
				{
					//calcolare solo se non e' main
					$len = (strlen($nomePagina))-1;
					$pos = (strrpos($nomePagina, "-")) + 1;
					$nomePagina = (substr($nomePagina, $pos, $len));
					return $nomePagina;
				}
			else
				{
					return $nomePagina;
				}


		}


/*			***** CARICA LOGO NELLE PAGINE *****				*/
		public function getLogo()								//OK FOR
		{
			global $copy;
			$title = strtoupper ('CONTROL  PANEL');
			echo '<div id="logo"><img src="./images/logo.png" title="logo" ></div>' . PHP_EOL;
			echo '<div id="programma"  style="position:relative;top:-26px;">'.$title. '  (Ver. ' . $copy . ') </div>' . PHP_EOL;

		}
		
		public function getImagesRegister()
			{
				global $img_type;
				return $img_type;

			}
		public function doTime($time)					//OK FOR
			{
	$giorno = array('00','01','02','03','04','05','06','07','08','09');
	$mese = array('ll', 'GEN', 'FEB', 'MAR', 'APR', 'MAG', 'GIU', 'LUG', 'AGO', 'SET', 'OTT', 'NOV', 'DIC');
			$stringa = '';
			$g = idate('d', $time);
			if ($g < 10) {$day = $giorno[$g];}
			else {$day = $g;}
			$m = $mese[idate('m', $time)];
			$h =  idate('H', $time);
			if ($h < 10) {$hour = $giorno[$h];}
			else {$hour = $h;}
			$mi =  idate('i', $time);
			if ($mi < 10) {$min = $giorno[$mi];}
			else {$min = $mi;}
			$s =  idate('s', $time);
			if ($s < 10) {$sec = $giorno[$s];}
			else {$sec = $s;}
			$stringa .= $day; // calcola giorno
			$stringa .= '.' . strtolower($m);
			$stringa .= '.' . idate('Y', $time);
			//$stringa .= '<br>&nbsp; &nbsp;  ' . $hour . ' : ';
			//$stringa .= $min . ' : ' . $sec;
			//$this->data = $stringa;
			return $stringa;
			}
			
public function doTimeBrev($time)				//OK FOR
			{
	$giorno = array('00','01','02','03','04','05','06','07','08','09');
	$mese = array('ll','01','02','03','04','05','06','07','08','09', '10', '11', '12');
			$stringa = '';
			$g = idate('d', $time);
			if ($g < 10) {$day = $giorno[$g];}
			else {$day = $g;}
			$m = $mese[idate('m', $time)];
			$h =  idate('H', $time);
			if ($h < 10) {$hour = $giorno[$h];}
			else {$hour = $h;}
			$mi =  idate('i', $time);
			if ($mi < 10) {$min = $giorno[$mi];}
			else {$min = $mi;}
			$s =  idate('s', $time);
			if ($s < 10) {$sec = $giorno[$s];}
			else {$sec = $s;}
			$stringa .= '&nbsp; &nbsp; ' . $day; // calcola giorno
			$stringa .= '.' . $m;
			$stringa .= '.' . idate('y', $time);
			$stringa .= '<br>' . $hour . ' : ';
			$stringa .= $min . ' : ' . $sec;
			//$this->data = $stringa;
			return $stringa;
			}
			
/*	***** FUNZIONE CHE ELIMINA FILE DEPOSITO CONTENENTE VECCHIA IMMAGINE		*****		*/

function desFile($file)					//OK FOR
{
//exit ($file);				//OK TESTATO 22/06/2014
@unlink($file);
}

/*	***** FUNZIONE CHE TAGLIA TESTO E CREA ANCHOR		*****		*/	

public function cutText($testo)
		{
			// stringa testo parziale
		$part_news = (substr($testo, 0, 15));
		$find_pos = strrpos($part_news, " ");
		$part_news = substr($testo, 0 , $find_pos); //taglia ad ultimo spazio
		return $part_news;
		}
			
}
?>