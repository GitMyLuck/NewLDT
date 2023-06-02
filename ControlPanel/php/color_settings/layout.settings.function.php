<html> 
<head>
<?php
$colorTable = '';
if (isset ($_GET['tavolozza']))
	{
		$colorTable = $_GET['tavolozza'];
	}
include "../db.inc.php";
$config = new CONFIG();
$config->doServer();
$colors = $config->doColors($colorTable);
?>
</head>
<body>
<div class="rectangle opzioni_"   style="display:block">
<div class="labelSelector" title=" opzioni "  style="width:50px;">applica tema</div>
<!--	BUTTON RIPRISTINA		-->  
<input id="ripristina-btn" class="buttons opt left" name="ripristina-btn" type="button" value="ripristina"  onclick="ripristinaSettings();">
<!--	BUTTON APPLICA		--> 
<input id="applica-btn" class="buttons opt right" name="applica-btn" type="button" value="applica" onclick="applicaSettings();" >
<div id="spacer"  style="height: 12px;width:100%;clear:both;"></div>
</div>
<div class="rectangle opzioni_" style="display:block">
<div class="labelSelector" title=" opzioni "  style="width:50px;">salva</div>
<!--	BUTTON SALVA CONFIG		--> 
<input class="text_input" id="name_conf" name="name_conf" value="" type="text"  style="margin-left:15px;margin-top: 3px;float:left;width: 106px;" >
<input id="pulisci-btn" class="buttons opt right" name="pulisci-btn" type="button" value="salva config."  onclick="salvaSettings($(this));">
</div>


</body>
</html>