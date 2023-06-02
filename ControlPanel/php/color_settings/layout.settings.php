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
<script type="text/javascript">
var name; 
		$(function()
				{
					$( '.box_color' ).ColorPicker({
							color: '#FFFFFF',
							onBeforeShow: function () {
										var back_color = $(this).attr("title");
										name = $(this).attr("id");
										$(this).ColorPickerSetColor(back_color);
													},
							onShow: function (colpkr) {
														$(colpkr).fadeIn(500);
														return false;
														},
							onHide: function (colpkr) {
														$(colpkr).fadeOut(500);
														return false;
														},
							onChange: function (hsb, hex, rgb) {
													$('#' + name).css('background', '#' + hex);
													hex = hex.toUpperCase();
													$( '.box_color' ).attr("title", "#" + hex );
																}
							});		// end of call of color picker

					
				});
</script>
</head>
<body>
<div class="rectangle indice" >
<div class="labelSelector toggle_principali" title=" apri / chiudi ">principali</div>
<div class="labelSelector"  style="margin-right:55px;"></div>
<div id="default_table" class="labelSelector color_table" style="margin-right:15px;" title="seleziona tavolozza">default</div>
<div id="temp_table"class="labelSelector color_table" title="seleziona tavolozza">anteprima</div> 
</div>
<!--	GENERAL BACK-GROUND  -->
<div class="rectangle principali" > 
<div class="labelSelector">colore di sfondo </div>
<div id="background-body" class="box_color"  
	title="<?php echo '#' . $colors['general_back']; ?>" style="background: <?php echo '#' . $colors['general_back']; ?>;" ></div>
<input id="general_back" class="buttons color_button" name="general_back" type="button" value="applica" onclick="applicaColor($('#background-body'), 'update');">
<input id="general_default" class="buttons default_button" name="general_default" type="button" value="default" onclick="applicaColor($('#background-body'), 'default');" >
</div>

<!--	ACTIVITY BACK-GROUND  -->
<div class="rectangle principali" > 
<div class="labelSelector">sfondo dei menu</div>
<div id="background-menu" class="box_color"  
	title="<?php echo '#' . $colors['activity_back']; ?>" style="background: <?php echo '#' . $colors['activity_back']; ?>;"></div>
<input id="activity_back" class="buttons color_button" type="button" value="applica" onclick="applicaColor($('#background-menu'), 'update');">
<input id="general" class="buttons default_button" type="button" value="default" onclick="applicaColor($('#background-menu'), 'default');">
</div>

<!--	INCHIOSTRO  PANNELLI-->
<div class="rectangle principali"> 
<div class="labelSelector">ink contenuti box</div>
<input id="color-all" class="box_color" type="text" size="2" maxlength="2" title="<?php echo '#' . $colors['ink_pannelli']; ?>"   style="background: <?php echo '#' . $colors['ink_pannelli']; ?>;">
<input id="ink_pannelli" class="buttons color_button" type="button" value="applica" onclick="applicaColor($('#color-all'), 'update');">
<input id="general" class="buttons default_button" type="button" value="default" onclick="applicaColor($('#color-all'), 'default');">
</div>

<!--	 COLORE TESTATINE  -->
<div class="rectangle principali" > 
<div class="labelSelector">sfondo testate box</div>
<div id="background-testate" class="box_color"  
	title="<?php echo '#' . $colors['testate_back']; ?>" style="background: <?php echo '#' . $colors['testate_back']; ?>;"></div>
<input id="testate_back" class="buttons color_button" type="button" value="applica" onclick="applicaColor($('#background-testate'), 'update');">
<input id="general" class="buttons default_button" type="button" value="default" onclick="applicaColor($('#background-testate'), 'default');">
</div>

<!--	 INK TESTATINE  -->
<div class="rectangle principali" > 
<div class="labelSelector">ink testate box</div>
<div id="color-testate" class="box_color"  
	title="<?php echo '#' . $colors['ink_testate']; ?>" style="background: <?php echo '#' . $colors['ink_testate']; ?>;"></div>
<input id="ink_testate" class="buttons color_button" type="button" value="applica" onclick="applicaColor($('#color-testate'), 'ink-update');">
<input id="general" class="buttons default_button" type="button" value="default" onclick="applicaColor($('#color-testate'), 'ink-default');">
</div>

<!--	 INK BANNER  -->
<div class="rectangle principali" > 
<div class="labelSelector">ink banner</div>
<div id="color-banner" class="box_color"  
	title="<?php echo '#' . $colors['ink_banner']; ?>" style="background: <?php echo '#' . $colors['ink_banner']; ?>;"></div>
<input id="ink_banner" class="buttons color_button" type="button" value="applica" onclick="applicaColor($('#color-banner'), 'update');">
<input id="general" class="buttons default_button" type="button" value="default" onclick="applicaColor($('#color-banner'), 'default');">
</div>

<!--	PANNELLI COLORE PIU' SCURO BACK-GROUND  -->
<div class="rectangle principali" > 
<div class="labelSelector">sfondo pannelli</div>
<div id="background-pannello" class="box_color"  
	title="<?php echo '#' . $colors['pannelli_back']; ?>" style="background: <?php echo '#' . $colors['pannelli_back']; ?>;"></div>
<input id="pannelli_back" class="buttons color_button" type="button" value="applica" onclick="applicaColor($('#background-pannello'), 'update_background');">
<input id="general" class="buttons default_button" type="button" value="default" onclick="applicaColor($('#background-pannello'), 'default_background');">
</div>

<!--	PANNELLI COLORE PERCEN  -->
<div class="rectangle principali" > 
<div class="labelSelector">sfumat(%) -(max25)</div>
<input id="perc" class="box_percentage" type="text" size="2" maxlength="2" value="<?php echo $colors['change_perc'];?>"  onblur="controlloPerc()"; >
<input id="pannelli_back" class="buttons color_button" type="button" value="applica" onclick="applicaPerc($(this).prev());">
<input id="gen_percentuale" class="buttons default_button" type="button" value="default" onclick="applicaPercDefault();">
</div>
<div class="rectangle indice"  style="position: relative;top:-20px">
<div class="labelSelector toggle_inputs" title=" apri / chiudi ">inputs, textarea, buttons, ecc.</div> 
</div>
<!--	INPUTS BACK-GROUND  -->
<div class="rectangle inputs_"  > 
<div class="labelSelector">sfondo inputs attivi</div>
<div id="background-inputs" class="box_color"  
	title="<?php echo '#' . $colors['inputs_back']; ?>" style="background: <?php echo '#' . $colors['inputs_back']; ?>;"></div>
<input id="inputs_back" class="buttons color_button" type="button" value="applica" onclick="applicaColor($('#background-inputs'), 'update');">
<input id="general" class="buttons default_button" type="button" value="default" onclick="applicaColor($('#background-inputs'), 'default');">
</div>
<!--	INK BACK-GROUND  -->
<div class="rectangle inputs_"  > 
<div class="labelSelector">ink inputs attivi</div>
<div id="color-inputs" class="box_color"  
	title="<?php echo '#' . $colors['ink_inputs']; ?>" style="background: <?php echo '#' . $colors['ink_inputs']; ?>;"></div>
<input id="ink_inputs" class="buttons color_button" type="button" value="applica" onclick="applicaColor($('#color-inputs'), 'update');">
<input id="general" class="buttons default_button" type="button" value="default" onclick="applicaColor($('#color-inputs'), 'default');">
</div>

<!--	BACK-GROUND INPUTS INATTIVI  -->
<div class="rectangle inputs_"  > 
<div class="labelSelector">sfondo inputs inattivi</div>
<div id="background-inputs-dis" class="box_color"  
	title="<?php echo '#' . $colors['inputs_back_dis']; ?>" style="background: <?php echo '#' . $colors['inputs_back_dis']; ?>;"></div>
<input id="inputs_back_dis" class="buttons color_button" type="button" value="applica" onclick="applicaColor($('#background-inputs-dis'), 'update');">
<input id="general" class="buttons default_button" type="button" value="default" onclick="applicaColor($('#background-inputs-dis'), 'default');">
</div>

<!--	INCHIOSTRO  INPUTS INATTIVI   -->
<div class="rectangle inputs_"  > 
<div class="labelSelector">ink inputs inattivi</div>
<div id="color-inputs_dis" class="box_color"  
	title="<?php echo '#' . $colors['ink_inputs_dis']; ?>" style="background: <?php echo '#' . $colors['ink_inputs_dis']; ?>;"></div>
<input id="ink_inputs_dis" class="buttons color_button" type="button" value="applica" onclick="applicaColor($('#color-inputs_dis'), 'update');">
<input id="general" class="buttons default_button" type="button" value="default" onclick="applicaColor($('#color-inputs_dis'), 'default');">
</div>

<div class="rectangle indice"  >
<div class="labelSelector toggle_bar" title=" apri / chiudi ">barra menu</div> 
</div>

<div class="rectangle bar_"  > 
<div class="labelSelector">colore barra menu</div>
<div id="background-bar" class="box_color"  
	title="<?php echo '#' . $colors['bar_back']; ?>" style="background: <?php echo '#' . $colors['bar_back']; ?>;"></div>
<input id="bar_back" class="buttons color_button" type="button" value="applica" onclick="applicaColor($('#background-bar'), 'update');">
<input id="general" class="buttons default_button" type="button" value="default" onclick="applicaColor($('#background-bar'), 'default');">
</div>

<div class="rectangle bar_"  > 
<div class="labelSelector">colore icone barra</div>
<div id="ink-bar" class="box_color"  
	title="<?php echo '#' . $colors['ink_bar']; ?>" style="background: <?php echo '#' . $colors['ink_bar']; ?>;"></div>
<input id="bar_ink" class="buttons color_button" type="button" value="applica" onclick="applicaColor($('#ink-bar'), 'bar-update');">
<input id="general" class="buttons default_button" type="button" value="default" onclick="applicaColor($('#ink-bar'), 'bar-default');">
</div>

<div class="rectangle indice"  > 
<div class="labelSelector toggle_aspetto" title=" apri / chiudi ">aspetto (angoli - ombreggiatura)</div>
</div>
<div class="rectangle aspetto" > 
<div class="labelSelector">angoli (raggio)</div>
<input id="radius" class="box_percentage" type="text" size="2" maxlength="2" value="<?php echo $colors['border_radius']; ?>"  onblur="controlloRadius();">
<input id="pannelli_back" class="buttons color_button" type="button" value="applica" onclick="applicaRadius($(this).prev());">
<input id="gen_percentuale" class="buttons default_button" type="button" value="default" onclick="applicaRadiusDefault();">
</div>

<!--		TEMI SALVATI		-->
<div class="rectangle indice"  >
<div class="labelSelector temi" title=" apri / chiudi ">temi salvati</div>
</div>
<div class="rectangle_t temi_" >
<div class="labelSelector_t contenitore"   style="display:block;">
<?php 
			include "show.themes.php";
?>

</div>
</div>


</body>
</html>

