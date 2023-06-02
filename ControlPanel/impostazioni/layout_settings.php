<html> 
<head>
<?php 
include "../php/db.inc.php";
$config = new CONFIG();
$config->doServer();
$colors = $config->doColors('current');
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
																}
							});		// end of call of color picker

					
				});
</script>
</head>
<body>

<!--	GENERAL BACK-GROUND  -->
<div class="rectangle"  style="position: relative;top:-20px"> 
<div class="labelSelector">colore di sfondo </div>
<div id="background-body" class="box_color"  
	title="<?php echo '#' . $colors['general_back']; ?>" style="background: <?php echo '#' . $colors['general_back']; ?>;" ></div>
<input id="general_back" class="buttons color_button" name="general_back" type="button" value="applica" onclick="applicaColor($('#background-body'), 'update');">
<input id="general_default" class="buttons default_button" name="general_default" type="button" value="default" onclick="applicaColor($('#background-body'), 'default');">
</div>

<!--	ACTIVITY BACK-GROUND  -->
<div class="rectangle"  style="position: relative;top:-20px"> 
<div class="labelSelector">sfondo dei menu</div>
<div id="background-menu" class="box_color"  
	title="<?php echo '#' . $colors['activity_back']; ?>" style="background: <?php echo '#' . $colors['activity_back']; ?>;"></div>
<input id="activity_back" class="buttons color_button" type="button" value="applica" onclick="applicaColor($('#background-menu'), 'update');">
<input id="general" class="buttons default_button" type="button" value="default" onclick="applicaColor($('#background-menu'), 'default');">
</div>

<!--	INCHIOSTRO  PANNELLI-->
<div class="rectangle"  style="position: relative;top:-20px"> 
<div class="labelSelector">inchiostro contenuti</div>
<input id="color-all" class="box_color" type="text" size="2" maxlength="2" title="<?php echo '#' . $colors['ink_pannelli']; ?>"   style="background: <?php echo '#' . $colors['ink_pannelli']; ?>;">
<input id="ink_pannelli" class="buttons color_button" type="button" value="applica" onclick="applicaColor($('#color-all'), 'update');">
<input id="general" class="buttons default_button" type="button" value="default" onclick="applicaColor($('#color-all'), 'default');">
</div>

<!--	 COLORE TESTATINE  -->
<div class="rectangle"  style="position: relative;top:-20px"> 
<div class="labelSelector">sfondo testate box</div>
<div id="background-testate" class="box_color"  
	title="<?php echo '#' . $colors['testate_back']; ?>" style="background: <?php echo '#' . $colors['testate_back']; ?>;"></div>
<input id="testate_back" class="buttons color_button" type="button" value="applica" onclick="applicaColor($('#background-testate'), 'update');">
<input id="general" class="buttons default_button" type="button" value="default" onclick="applicaColor($('#background-testate'), 'default');">
</div>

<!--	 COLORE TESTATINE  -->
<div class="rectangle"  style="position: relative;top:-20px"> 
<div class="labelSelector">ink testate box</div>
<div id="color-testate" class="box_color"  
	title="<?php echo '#' . $colors['ink_testate']; ?>" style="background: <?php echo '#' . $colors['ink_testate']; ?>;"></div>
<input id="ink_testate" class="buttons color_button" type="button" value="applica" onclick="applicaColor($('#color-testate'), 'update');">
<input id="general" class="buttons default_button" type="button" value="default" onclick="applicaColor($('#color-testate'), 'default');">
</div>

<!--	PANNELLI COLORE PIU' SCURO BACK-GROUND  -->
<div class="rectangle"  style="position: relative;top:-20px"> 
<div class="labelSelector">sfondo pannelli</div>
<div id="background-pannello" class="box_color"  
	title="<?php echo '#' . $colors['pannelli_back']; ?>" style="background: <?php echo '#' . $colors['pannelli_back']; ?>;"></div>
<input id="pannelli_back" class="buttons color_button" type="button" value="applica" onclick="applicaColor($('#background-pannello'), 'update');">
<input id="general" class="buttons default_button" type="button" value="default" onclick="applica($('#background-pannello'), 'default');">
</div>

<!--	PANNELLI COLORE PERCEN  -->
<div class="rectangle"  style="position: relative;top:-20px"> 
<div class="labelSelector">sfumatura</div>
<input id="perc" class="" type="text" size="2" maxlength="2" value="<?php echo $colors['change_perc'];?>"  style="float: right;text-align: right;margin-top:3px;" onblur="controlloPerc()"; >
<input id="percentuale" class="buttons color_button" type="button" value="applica" onclick="applicaPerc($('#perc'));">
<input id="gen_percentuale" class="buttons default_button" type="button" value="default" onclick="applicaPercDefault();">
</div>

<!--	PANNELLI COLORE PERCENTUALE  -->
<div class="rectangle"  style="position: relative;top:-20px"> 
<div class="labelSelector">sfumatura</div>
<input id="perc" class="" type="text" size="2" maxlength="2" value="<?php echo $colors['change_perc'];?>"  style="float: right;text-align: right;margin-top:3px;" onblur="controlloPerc()"; >
<input id="percentuale" class="buttons color_button" type="button" value="applica" onclick="applicaPerc($('#perc'));">
<input id="gen_percentuale" class="buttons default_button" type="button" value="default" onclick="applicaPercDefault();">
</div>

<!--	 COLORE TESTATINE  -->
<div class="rectangle"  style="position: relative;top:-20px"> 
<div class="labelSelector">sfondo testatine</div>
<div id="color4" class="box_color"  
	title="<?php echo '#' . $colors['testate_back']; ?>" style="background: <?php echo '#' . $colors['testate_back']; ?>;"></div>
<input id="testate_back" class="buttons color_button" type="button" value="applica" onclick="applica($('#color4'), $(this), 'update');">
<input id="general" class="buttons default_button" type="button" value="default" onclick="applica($('#color4'), $('#testate_back'), 'default');">
</div>

<!--	 COLORE SFONDO INPUT_ATTIVI  -->
<div class="rectangle"  style="position: relative;top:-20px"> 
<div class="labelSelector">sfondo input attivi</div>
<div id="color5" class="box_color"  
	title="<?php echo '#' . $colors['inputs_back']; ?>" style="background: <?php echo '#' . $colors['inputs_back']; ?>;"></div>
<input id="inputs_back" class="buttons color_button" type="button" value="applica" onclick="applica($('#color5'), $(this), 'update');">
<input id="general" class="buttons default_button" type="button" value="default" onclick="applica($('#color5'), $('#inputs_back'), 'default');">
</div>

</body>
</html>

