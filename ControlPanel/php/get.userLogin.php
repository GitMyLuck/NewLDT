<?php
$type = '';
if (isset ($_POST['tipo']))
	{
		$type = $_POST['tipo'];
	}
include "db.inc.php";
$userLogin = new WORD();
$userLogin->doServer();
$userName = $userLogin->doUser($type);
echo $userName;
?>