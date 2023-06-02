<style type="text/css">
		.add, .sub	{
			font-size: 2.6em;
			font-weight: bold;
			min-height: 44px;
			min-width: 44px;
			padding: 0 0 6px 0;
				}
		.tasto	{
			text-align: center;
				}
		#add_value	{
			display: none;
			min-height: 44px;
			font-size: 1.6em;
				}
		.finale	{
			background: #aad0d0;
				}
</style>
<?php 
$sheet = 'eventi';
(isset ($_GET['sheet'])) ? $sheet = $_GET['sheet'] : $sheet;
$tabella = 'tags';
$tab = $tabella . '_' . $sheet;
$campo = 'single_tag';
$function = 'varia';
include "php/db.inc.php";
$dati = new TABLE($tab, $campo);
$dati->doServer();
$res = $dati->creaElenco();
//exit(var_dump($result)); 
?>
<center>
<table width="80%" border="1" cellspacing="2" cellpadding="2">
  <tr>
    <th scope="col"><?php echo $tabella; ?></th>
    <th scope="col" width="20%">azione</th>
  </tr>
<?php 
		$len_res = (count($res) - 1);
		for ($i = 0; $i <= $len_res; $i++)
			{	
				echo '<tr id="' . $res[$i]['id'] . '">';
				echo '<td class="elemento">' . $res[$i]['dato'] . '</td>';
				echo '<td class="tasto">';
				//  invia con l'input id - nome tabella - nome campo
				echo '<input id="' . $res[$i]['id'] . '" class="buttons sub" name="" type="button" value="-" onclick="subValue(($(this).attr(\'id\')), \'' . $tab . '\', \'' . $campo . '\', \'' . $res[$i]['dato'] . '\');">';
				echo '</td>';
				echo '</tr>';
			}
		//exit(var_dump($len_res)); 

?>
  
	<tr id="riga_finale">
		<td class="input_new finale">
			<input id="add_value" class="inputs" name="" type="text" value="">
		</td>
		<td class="tasto finale">
			<input id="" class="buttons add" name="" type="button" value="+" 
			onclick="addValue('<?php echo $tab; ?>', '<?php echo $campo; ?>');">
		</td>
	</tr>
</table>
</center>