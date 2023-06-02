<?php 
		include "db.inc.php";
		$conn = new FUNCT();
		$conn->doServer();
		$conn->delTables();
		$conn->resetStr();
		echo 'debug';



?>