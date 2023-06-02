
<?php 
@session_start();
$sessione = @session_id(); 
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html> 
<head>
<?php
include 'php/blocks/head.php';
include "php/db.inc.php";
include "php/secur_policy.php";
$secur = new SECUR();
$news = new NEWS();
$goAway = $secur->doRecognize($_GET['login'], $_GET['page'], $_GET['sheet']);
if (!$goAway)
	{
		header("location: index.php");
	}
$conn = new FUNCT();
$conn->doServer();
/*************************************************************************************/
/**********************			ZONA  DEBUG   		**********************************/
/*************************************************************************************/
$page_costr = new MAINPAGE('strutture');
$page_main = $page_costr->buildPage(1,'','2');
//$news->doCachePageMainUser($page_main, 'strutture', 'pinco');
exit ($page_mains);

?>

</head>
<body>
</body>
</html>