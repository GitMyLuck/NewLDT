<?php
//header('Content-type: text/html;charset=utf-8');
// numero del pversionamento del ControlPanel al 04/06/2023
$copy = "2.8.5.2";

//$users = array("", "_adm_", "_sub_", "_prem_", "_gold_", "_silv_", "_base_");
$users = array("", "_adm_", "_sub_");
									// 
$time_black = 600; 		//tempo di permanenza nella black-list [secondi]

$lang = 'it';					//linguaggio usato

$MAX_tentativi = 5;		//Massimo numero di tentativi per il login

$logo = "images/logo.png"; //indirizzo dell'immagine del logo del gestore

$tags = 10;					// numero massimo di tag inseribili per ogni notizia

$dir_cache = "../public/php/";		//$dir_cache = '../public/';

// @ valori : 'multi'  'single'
$img_type = 'multi';		//decide se il box immagini deve essere multiplo o singolo
// @ valori : 'multi'  'single'

// numero massimo di immagini caricabili con versione multi
// se la pagina non e' indicata setta var a una sola immagine
$max_images['eventi'] = 1;

$max_images['news'] = 6;

//estensioni permesse (per includere il pdf {	$allExt = 'jpg, png, pdf'; }
$allExt = 'jpg,png'; 

//									nel processo di upload
$size = 100000000; //massima misura dell'immagine in byte
				 //in questo caso 10Mb..

// tempo di visualizzazione dei messaggi 4000 = 4sec
$timerStamp = 4000;

// variabile che indica al programma a quale pagina associare i contratti utenti users
$pag_utenti = 'strutture';

// array in cui sono elencate le look-up table
// se non indicato la look-up table non verra' creata
//$lookUpTable = array("luoghi", "tipi_strutture", "eventi");		
$lookUpTable = array();