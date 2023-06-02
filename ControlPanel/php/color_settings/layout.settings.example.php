<!DOCTYPE html> 
<html> 
<head> 
<?php 
			include "style.variabile.temp.php";
?>
<style type="text/css">
	.general_back_example {
		margin: 3px auto;
		border: 3px dotted #777;
			}
	.arrow_up {
	position: relative;
	top: -32px;
			}
</style>

 </head>
<body class="example"> 
<input  class="buttons"  type="button" value="aggiorna"  style="float: right;margin-right: 15px;position:relative;top: -35px;" onclick="aggExample();"> 
<div class="general_back_example general_back"  id="general_back_example" style="width: 90%;height: 550px;border-radius: 3px;">
<div id="spacer"  style="height: 12px"></div> 
<div id="programma_example"  class="ink_banner" style="float:right;margin-right: 6px;">CONTROL  PANEL</div>
<div id="spacer"  style="height: 42px"></div> 
<!--		ESEMPIO DI LINGUETTE 		-->
<div id="tab_top" >
<div class="tasto_pagina radius activity_back" id="inattivo_example" >selezionato</div>
<div class="tasto_pagina radius" id="attivo_example" >tabs 2</div>
<div class="tasto_pagina radius" id="attivo_example" >tabs 3</div>
</div>

<div id="buttons_top_example" class="box_cp2 activity_back" >
		<div id="content_tastiera_example" class="bar_back">
			<?php 
			//		INCLUDE   	BARRA MENU IN FONDO
			include '../../php/pagina/main.barra.menu.example.php'; ?>
		</div>
</div>
		
<!--		ESEMPIO DI BOX 		-->
<div class="box_cp_example pannelli_back"  style="height: 350px;width: 300px;margin: 15px 30px;">
<div class="testata testate_back ink_testate">TITOLO TESTATA<div id="btn_test" class="freccia arrow_up" ></div></div>
<div id="box_content">
	<div class="label ink_pannelli" >Input attivo</div>
	<input class="text_input inputs_back ink_inputs input_example" id="input-example" type="text"   value="prova" >
	<div class="label ink_pannelli" >Input inattivo</div>
	<input class="text_input inputs_back_dis ink_inputs_dis" id="input-example2" type="text"   value="prova" disabled>
	<hr />
	<div class="label ink_pannelli"  style="float:left;margin-right: 20px;">Pulsante Attivo</div>
	<input id="" class="buttons_example inputs_back ink_inputs" name="" type="button" value="Button" style="float:right;margin-right:30px;width: 80px;">
	<div id="spacer"  style="height:3px;clear:both;"></div>
	<div class="label ink_pannelli" style="float:left;margin-right: 20px;">Pulsante Inattivo</div>
	<input  class="buttons_example inputs_back_dis ink_inputs_dis"  type="button" value="Button" style="float:right;margin-right:30px;" disabled>
	<div id="spacer"  style="clear:both;"></div>
	
</div>
</div>
		
</div>	<!-- fine general_back -->
<div id="color-icon">ANTEPRIMA DEL BOX</div>
</body>
</html>