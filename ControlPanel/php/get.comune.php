<?php 
include "db.inc.php";
$conn = new FUNCT();
$conn->doServer();
$loc = '';
if ( isset ( $_POST['loc'] ) )
	{
		$loc = $_POST['loc'];
	}
if ( $loc )
		{
			$sql = "SELECT * FROM `luoghi` WHERE `id` = $loc ";
			$conn->sql($sql);
			$comune = $conn->row['comune'];
		}
else
		{
			$comune = 'nessuno';
		}
echo $comune;
	
?>