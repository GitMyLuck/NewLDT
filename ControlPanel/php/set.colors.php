<?php
@session_start();
$sessione = @session_id(); 		// preleva sessione 
include "db.inc.php";
$color = $_POST['color'];		//ricevi la stringa corrispondente al colore
$campo = $_POST['campo'];		//ricevi il campo in cui salvarla nel database
$action = $_POST['action'];		//azione da fare update o reset to default
$news = new NEWS();
$config = new CONFIG();
$config->doServer();

if ($action == 'update')
	{
$config->setColor($color, $campo);		//esegui upload nel database
	}
else
	{
$default_value = $config->defaultColor($campo);			//rimetti il valore di default
$default_color = $default_value[$campo];
$config->setColor($default_color, $campo);		//esegui upload nel database
	}
$news->doCacheStyleNow();					//cambia il valore del settaggio nel file ../cache/file.php

?>
