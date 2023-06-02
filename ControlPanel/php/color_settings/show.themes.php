<?php
// preleva tutte le theme nel db

$temi = $config->getThemes();
//	formato [indice]['general_back']
$lenTemi = (count($temi)-1);
for ($i = 0; $i <= $lenTemi; $i++)
		{
			echo '<div  class="tema_cont"  style="background-color:#' . $temi[$i]['general_back'] . ';"';
			echo ' onclick="applicaTema(\'' . $temi[$i]['type'] .'\');" title="applica tema ' . $temi[$i]['type'] .'" >';
			echo '<div class="box_cont" style="background-color:#' . $temi[$i]['pannelli_back'] . ';color:#';
			echo $temi[$i]['ink_pannelli'] . ';">';
			echo '<div class="test_cont"  style="background-color:#' . $temi[$i]['testate_back'] . ';color:#';
			echo $temi[$i]['ink_testate'] . ';">TEST </div>';
			echo '<center>testi <br /><input class="input_dim" type="text" value="input"  style="height: 13px;';
			echo 'background-color:#' . $temi[$i]['inputs_back'] . ';color:#';
			echo $temi[$i]['ink_inputs'] . ';">';
			echo '<br />testi <br /><input class="input_dim" type="text" value="input" disabled style="height: 13px;';
			echo 'background-color:#' . $temi[$i]['inputs_back_dis'] . ';color:#';
			echo $temi[$i]['ink_inputs_dis'] . ';"></center>';
			echo '</div><div class="titolo_tema" style="color:#';
			echo $temi[$i]['ink_pannelli'] . ';">' . $temi[$i]['type'] . '</div>';
			echo '<div class="barra_cont" style="';
			echo 'background-color:#' . $temi[$i]['bar_back'] . ';color:#';
			echo $temi[$i]['ink_pannelli'] . ';"></div> ';
			echo '</div>';
		}
?>
<!--<div  class="tema_cont" >
		<div class="box_cont">
			<div class="test_cont">TESTATA
			</div>
			<div class="barra_cont"></div> 
		</div>
		<div class="titolo_tema">Nome Tema </div>
</div>-->
