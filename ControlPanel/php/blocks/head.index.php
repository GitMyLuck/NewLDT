<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link href='http://fonts.googleapis.com/css?family=Michroma' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300' rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="images/favicon.ico">
<link href="css/layout_cp.css" rel="stylesheet" type="text/css" >
<link href="css/layout_pannello.css" rel="stylesheet" type="text/css" >
<link href="css/spin/spin_layout.css" rel="stylesheet" type="text/css" >
<script type="text/javascript" src="scripts/new.gestioni.js"></script>
<script type="text/javascript" src="scripts/jquery-2.0.2.js"></script>
<script type="text/javascript" src="scripts/jquery.cookie.js"></script>
<script type="text/javascript" src="scripts/gestioni.index.js"></script>
<script type="text/javascript" src="scripts/spin/spin.js"></script>
<script type="text/javascript" src="scripts/spin/jquery.spin.js"></script>
<?php 
$title = 'SUPER_CP';
$server = $_SERVER['SERVER_ADDR'];
	if ($server == '127.0.0.1')
			{
				$title = 'LOCAL SUPER_CP';
			}
echo '<title>' . $title . '</title>';
?>
