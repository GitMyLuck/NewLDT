

function spedisciUser(modulo, index)
	{
		
		var nome = modulo.attr("name");
		//alert (nome);
		
				var uri = "data.user.update.php";
				var input_obj = modulo.children(0);	//	istanzia l'oggetto input immediatamente dopo il form
				var attr = input_obj.attr("name");		//	preleva da esso l'attributo "name"
				//alert (attr);
				var text = input_obj.val();					//	e poi il contenuto
				//  CAMPI OBBLIGATORI
				if (attr === 'usr' || attr === 'psw')
					{
						//alert ('campo protetto');
						if ( input_obj.val() == '')
							{
								doAlert('ATTENZIONE ! <br />Campo obbligatorio', '', 'alert', 3000);
								return;
							}
					}
				var dati = attr + '=' + text + '&id=' + id_notizia + '&sheet=' + nome_pagina;
				//alert(dati);
				

		doAlert('hai variato : <b> ' + attr +'</b><br />invio dati in corso...', 'salvataggio', 'alert', 3000);
				//-------------CHIAMATA AJAX--------------------------//
        $.ajax({
			url: uri, /* pagina di destinazione dei dati */
			type: "POST",
			data: dati,
			dataType: "html",
			success: function() {
						//debugCall(results);
						location.reload();
										}
				});			//fine $ajax
				//-------------CHIAMATA AJAX--------------------------//
		modulo = '';
	
}

function salvaUser(index)
	{
		var dataM = $( '.text_input' )[0];
		var dataModulo = $(dataM).val();		//preleva il valore del primo text input della pagina
		//alert (dataModulo);
		var dataText;						//per essere sicuri che la pagina esista
		if (dataModulo) 
						{
							var dataUri = 'save.user.php';
							
							dataModulo = $(".modulo_completo").serialize(); // mettere spazio finale a tags
							var embed = '';
							data = dataModulo + embed + '&id=' + id_notizia + '&sheet=' + nome_pagina + '&funzione=save';
							//data = encodeURIComponent(dataTemp);
							sendDataUser(data, dataUri);
							//debugCall(data);
							return;
						}
		else	
						{
							//visualizzaIstr( "errors/error_1.txt" );
							doAlert('Impossibile caricare Utente<br />Manca il nome...', 'errore', 'circle-close', 3000);
							id = id_notizia - 1;
							location.href = 'main-nuovo-user.php?login=' + sess_pagina + '&page=' + id + '&sheet=' + nome_pagina;
							return;
						}
						
		}

		
function sendDataUser(data, dataUri)
		{
			//showAlert( 3,'info', 5000);					// invio dati in corso
			doAlert('invio dati in corso...', 'salvataggio', 'alert', 5000);
			$.ajax({
						url: dataUri, /* pagina di destinazione dei dati*/
						type: "POST",
						data: data,
						dataType: "html",
						success: function(results) {
						//alert (results);
						
						if (!(results.trim()))
							{
								hideButtons();		//new.gestioni.js
								doAlert('dati inviati...','','',2000);
								//ONLY FOR DEBUG =>
								//debugCall(results);
								//<= END DEBUG
								
							}
						else
							{
								doAlert('dati non inviati...<br /> Si e\' verificato un problema','','',2000);
								setTimeout(function()
										{
												//showButtons();
												//ONLY FOR DEBUG =>
												debugCall(results);
												//<= END DEBUG
										},300000);

							}
					//alert(results);
											},		//end of success function
			error: function() {
					alert ('errore');
								}
			});	
}

function doConfermaUser(index, sessione)
	{
		var testo = 'Sei proprio sicuro di voler eliminare<br />utente ' + id_notizia + '</b> dal DataBase  ?';
		var dialogText = '<div id="dialog-confirm" title="Elimina Utente"><p><span class="ui-icon ui-icon-bianca ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>' + testo + '</p></div>';
		$ ( '#message_box' ).html(dialogText);
		$( "#dialog-confirm" ).dialog({
			draggable: false,
			resizable: false,
			modal: true,
			general_background: colors[0],
			activity_border: colors[2],
			testata: colors[2],
			inchiostro_pannelli: colors[4],
			overlay_color: colors[0],
			border: "2",
			show: 400,
			buttons: {
				"Annulla": function() 
											{
												$( this ).dialog( "close" );
											},
				"Elimina": function() 
														{
															//prepareOptSpin('main_content');
															eliminaUser(index, sessione);
															$( this ).dialog( "close" );
															setTimeout(function()
																						{
																							location.reload();
																						}, 1000);
															// ONLY FOR DEBUG  =>
															//<= END DEBUG
														}
					}
		});		//fine Dialog
	
	}

	
function eliminaUser(index, sessione)
	{
		//-------------CHIAMATA AJAX--------------------------//
        $.ajax({
			url: 'delete.user.php?',
			type: "POST",
			data: 'login=' + sessione + '&page=' + index,
			dataType: "html",
			success: function() {
						//debugCall(results);
						//location.reload();
										}
				});			//fine $ajax
				//-------------CHIAMATA AJAX--------------------------//
	}
	
	
function showAlert(text_str, type, time)
	{
		passVar = '?text=' + text_str + '&type=' + type;
		$( '#help_window').load( "php/show.alert.php" + passVar, 
			function()
					{
						var main = $ ( '#main_content' );
						var mainWidth = parseInt(main.outerWidth());
						var helpWidth = mainWidth - 50;
						var margin = parseInt((mainWidth - helpWidth) / 2);
						helpWidth = helpWidth - 20;
						creaOverlay();		//new.gestioni.js
						$( '#overlay' ).click(function()
											{
												chiudiIstr();
											});
						$( '#help_window' ).click(function()
											{
												chiudiIstr();
											});
						$('#help_window').css("z-index", "200");
						$('#help_window').css("width", helpWidth + "px");
						$('#help_window').css("margin-left", margin + "px");
						$('#help_window').slideDown("slow" );
						
					});
			chiudi = setTimeout(function()
													{
														chiudiIstr();
													}, time);
	
	
	}
	
	