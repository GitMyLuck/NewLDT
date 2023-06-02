<html> 
<head>
<?php 
include "../php/db.inc.php";
$conf = new CONFIG();
$conf->getTitle();
$titolo = $conf->row['titolo'];
$copy = $conf->row['copy'];
?>
</head>
<body>
<div id="box_valori" class="page_box_settings">
<label>nome programma</label><br /> 
<input id="input_titolo" class="inputs" name="titolo" type="text" value="<?php echo $titolo; ?>" disabled>
<input id="button_titolo" class="buttons" type="button" value="varia" onclick="variaInput(this, $('#input_titolo'));">
<br /> 
<label>versione programma</label><br /> 
<input id="input_versione" class="inputs" name="versione" type="text" value="<?php echo $copy; ?>" disabled>
<input id="button_versione" class="buttons" type="button" value="varia" onclick="variaInput(this, $('#input_versione'));">  
</div>  
<center>  

</center> 
</body>
</html>

