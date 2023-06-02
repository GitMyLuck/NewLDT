/******SETTINGS FUNCTIONS************/
/************************************/
var o;


var colors = new Array();
function startSettings2(section)
	{
		colors  =  ($( '#colori' ).text()).split(",");	//memorizza colori per alert
		//(section)?section:section = '#program_settings';	
		o = $( '#layout_settings' );
		pagina(o);
	}
	
function pagina(o)
	{
		var verifica = $(o).prop("class");
		if (verifica === "unselected")
			{
				var titolo = $(o).attr("id");
				var titolo_box = titolo.toUpperCase();
				var old_menu = $( '.selected' );
				old_menu.removeClass("selected");
				old_menu.addClass("unselected");
				$(o).removeClass("unselected");
				$(o).addClass("selected");
				$( '#title_box' ).html(titolo_box);
				$( '#box_settings' ).load( './impostazioni/' + titolo + '.php',
							function()
										{
											$( '#box_settings' ).fadeIn(1200);
										});
			}
		else
			{
				return false;
			}
	
	}
	
function variaInput(o, input_o)
	{
		$(input_o).removeAttr("disabled");
		$(o).val("invia");
		$(o).click(function()
								{
	//crea la variabile post da inviare a save.config.data
	//input_name e' formata dal nome dell'input text
	//input_value, dal suo contenuto
	var input_name = $(input_o).attr("name");
	var input_value = $(input_o).val();
	var input_data = input_name + '=' + input_value;		//aggiungere variabile
	$.ajax({
				url: "impostazioni/save.config.data.php", 
				/* pagina di destinazione dei dati */
				type: "POST",
				data: input_data,
				dataType: "html",
				success: function() {
					doAlert('Invio dati in corso...', '', '', 2000);
					$(o).unbind("click");
					$(o).val("varia");
					$(input_o).attr("disabled", "true");
								}		//fine success
				});			//fine $ajax
				
				
					});		//fine click function
	}
	
	
function applica(o, t, action)
	{
		color = '000000';
		if (action === 'update')
			{
				var rgbArray = new Array();
				var color = $(o).css('backgroundColor');
		
				if (color.substr(0, 3) === 'rgb')
					{
						hexColor = color.rgbToHex();
						color = hexColor;
					}
			}
			
		var campo = $(t).attr("id");
		var input_data = 'color=' + color + '&campo=' + campo + '&action=' + action;
			//alert (input_data);
		//aggiungere variabile contenente i dati serializzati per trasm $POST
	$.ajax({
				url: "php/set.colors.php", 
				/* pagina di destinazione dei dati */
				type: "POST",
				data: input_data,
				dataType: "html",
				beforeSend: function() {
					doAlert('Invio dati in corso...', '', '', 2000);
									},		//end beforeSend		
				success: function(results) {
							debugCall(results);
							//location.reload();
								}		//fine success
				});			//fine $ajax*/
				
		//alert (hexColor);
	}
