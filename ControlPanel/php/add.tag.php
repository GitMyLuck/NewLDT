
<?php
include "db.inc.php";
$conn = new FUNCT();
$conn->doServer();
$tag = ''; 
$sheet = '';
if (isset($_POST['tag']))
	{
		$tag = $_POST['tag'];
	}
if (isset($_POST['page']))
	{
		$sheet = $_POST['page'];
	}
$results = $conn->addTag($tag, $sheet);		//da fare
if (!results)
	{
		echo 'tag gia esistente';
	}
?>
