

// FUNCTION caricaHelp() 
// scambia il contenuto del box con le istruzioni relative
function caricaHelp(o)
	{
		var parent_div = $(o).parent();		// TESTATA
		var box = parent_div.parent();		// BOX
		var temp_cont = $(box).children();
		var contenitore = temp_cont[1];	// box_content
		var nome_cont = $(contenitore).attr("class");
		//alert (nome_cont);
		$(contenitore).css("padding", "3px 10px");
		var name_box = box.attr("id");	// id  BOX
		var html_parent = ($(contenitore).html()).trim();		// html con inputs
		// salva html in #service
		$( '#service' ).html('');
		$( '#service' ).text(html_parent);
		//var istr = getInstr(name_box);		// preleva istruzioni
		$(contenitore).load("php/show.box.istruzioni.php");
		//manca di passare con il $_GET valori pagina e nome_box
	}
	
	
function caricaInputs(o)
	{
		var parent_div = $(o).parent();		// TESTATA
		var box = parent_div.parent();		// BOX
		var temp_cont = $(box).children();
		var contenitore = temp_cont[1];	//box_content
		$(contenitore).css("padding", "0 0");
		var html_parent = $( '#service' ).text();
		$(contenitore).html(html_parent);
		startIstruzioni();
		$( '#service' ).html('');
	}
	

function startIstruzioni()
	{
		$( '.help_funct' ).click( function()
											{
												var nomeInput = $(this).html();
												var endPos = nomeInput.indexOf("<");
													//  trovata subLabel ?
													if ( endPos > 0)
														{
															var strIstruzioni = nomeInput.substr(0, endPos);
														}
													else
														{
															var strIstruzioni = nomeInput;
														}
													if ( strIstruzioni != 'Dati GoogleMaps')
														{
															//	 visualizza istruzioni normali
															doIstr( strIstruzioni );
														}
													else if ( strIstruzioni == 'Dati GoogleMaps' )
														{
															//	visualizza istruzioni GoogleMaps
															visualizzaGoogleIstr();
														}
													else 
														{
															return;
														}
												
											
											});		//  END  OF  'click' FUNCTION 
		}
	
		
function visualizzaGoogleIstr()
		{
		contatore = 1;
		var dialogText = '<div id="dialog-confirm" title="GoogleMaps ® - Istruzioni"></div>';
		$ ( '#message_box' ).html(dialogText);
		$( '#dialog-confirm' ).load( "show.google.php", mostra());
		var dialogBox = $( '#dialog-confirm' ).dialog({
			//afterOpen: spara(),
			closeButton: true,
			draggable: false,
			resizable: false,
			modal: true,
			general_background: colors[0],
			activity_border: colors[2],
			testata: colors[2],
			inchiostro_pannelli: colors[4],
			overlay_color: "#828282",
			border: "2",
			show: 800,
			hide: 800,
			width: 400,
			height: 300
							});
			//mostra(1);	
					function chiudiDialog()
						{
							$( '#dialog-confirm' ).dialog("close");
							$( '#dialog-confirm' ).html('');
							$ ( '#message_box' ).html('');
						}
		
	}
		