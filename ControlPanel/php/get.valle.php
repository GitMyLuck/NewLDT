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
			$valle = $conn->row['zona'];
		}
else
		{
			$valle = 'nessuno';
		}

echo $valle;
?>