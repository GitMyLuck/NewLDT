<?php 

include "php/secur_policy.php";
$secur = new SECUR();
$sheet = $_GET['sheet'];			//pagina
$index = $_GET['page'];			//indice notizia
$secur->creaCode($index, $sheet); 
$load = 'location: main-user.php?login=' . $secur->sec_sess;
$load .='&page=' . $secur->sec_news . '&sheet=' . $secur->sec_sheet;

header($load); 
?>