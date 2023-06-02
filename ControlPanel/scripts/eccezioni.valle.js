

function startecc()
	{
		attivaSelect();
		searchComune();
		searchValle();
	}
	
function searchComune()
	{
		var inputLuogo = $( '#luoghi');
		var luogo = 'loc=' + inputLuogo.val();
		//-------------CHIAMATA AJAX--------------------------//
        $.ajax({
					url: "php/get.comune.php", 
					type: "POST",
					data: luogo,
					dataType: "html",
					success: function(results) { 
											var ris = results.trim();
											$( '#comune_seq' ).val(ris);
													}
				});			//fine $ajax*/
				//-------------CHIAMATA AJAX--------------------------//
	}

	
function searchValle()
	{
		var inputLuogo = $( '#luoghi');
		var luogo = 'loc=' + inputLuogo.val();
		//-------------CHIAMATA AJAX--------------------------//
        $.ajax({
					url: "php/get.valle.php", 
					type: "POST",
					data: luogo,
					dataType: "html",
					success: function(results) { 
											var ris = results.trim();
											$( '#valle_seq' ).val(ris);
													}
				});			//fine $ajax*/
				//-------------CHIAMATA AJAX--------------------------//
	}
	
	
function eccLuoghi(modulo)
	{
			var attr = new Array();
			var text = new Array();
			var uri = "data.update.php";
			var input_obj = modulo.children(0);	//istanzia l'oggetto input immediatamente dopo il form
			attr[0] = input_obj.attr("name");	//preleva da esso l'attributo "name"
			text[0] = input_obj.val();			//e poi il contenuto
			//  attr [0] = luogo
			searchComune();
			searchValle();
			var input_obj_seq = $( "input[id*='_seq']" );
			var numero = input_obj_seq.length;		//  numero di input '*_seq'
			//	prepara array con i dati delle input sequenziali (comune e valle)
			for ( i = 0; i <= ( numero - 1 ); i++)
				{
					input_obj = input_obj_seq.get(i);
					attr[( i + 1 )]  = $(input_obj).attr("name");
					text[( i +1 )] = $(input_obj).val();		
				}
			var len = attr.length;
			for ( i = 0; i <= ( len - 1 ); i++)
				{
					var dati = attr[i] + '=' + text[i] + '&id=' + id_notizia + '&sheet=' + nome_pagina;

					//-------------CHIAMATA AJAX--------------------------//
						$.ajax({
									url: uri, /* pagina di destinazione dei dati */
									type: "POST",
									data: dati,
									dataType: "html",
									success: function() {
																//debugCall(results);
															}
								});			//fine $ajax
					//-------------CHIAMATA AJAX--------------------------//
					
				}		// 	END OF FOR CICLE
			doAlert('hai variato : <b> luogo </b><br />invio dati in corso...', 'salvataggio', 'alert', 3000);
				
	}		//  END  OF  FUNCTION 
	
function attivaSelect()
	{
		$( '#luoghi' ).change( function()
												{
													searchComune();
													searchValle();
												});
	}