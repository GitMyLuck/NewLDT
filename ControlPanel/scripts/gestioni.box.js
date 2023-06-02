
var defaultWidth = 336;		
//altezza di default dei box, usato per aprirli e chiuderli.
var finalWidth = 32;			
//altezza minima di default dei box.
var boxStatus;			
//stato dei box ('opened' = tutti aperti - 'closed' = tutti chiusi)
var altezzaMenu;		
//altezza del menu calcolato in automatico in base alle voci in esso contenute

function apriBox()
	// funzione che espande tutti i box del pannello
	{
		var boxCp, testata, nomeBox, o;
		var numBox = $('.box_cp').length;
			if (boxStatus === 'opened')
			{
				
				for (index = 0; index <= (numBox-1); index++)
					{
						
						o = $( '.freccia' )[index];
						$(o).removeClass("arrow_up");
						boxCp = $('.box_cp').get(index);
						lowerize($(boxCp));
						$(o).addClass("arrow_down");
					}
				$('html, body').animate({scrollTop: 200}, 600);
				boxStatus = 'closed';
			}
			else
			{
				for (index = 0; index <= (numBox-1); index++)
					{
						o = $( '.freccia' )[index];
						$(o).removeClass("arrow_down");
						boxCp = $('.box_cp').get(index);
						alterize($(boxCp));
						$(o).addClass("arrow_up");
					}
				$('html, body').animate({scrollTop: 2000}, 600);
				boxStatus = 'opened';
			}

	}

//	 apre i box della pagina secondo il contenuto di 
//	del cookie dedicato
function startBoxOpening(funct)
	{
		var boxCp, testata, nomeBox, o;
		var numBox = $('.box_cp').length;
		var counter = 1;
				for (index = 1; index <= numBox; index++)
					{
						var indice = index;
						var indiceFreccia = index;
						if ( funct == 'varia' || funct == 'nuovo')
							{
								indice --;
								indiceFreccia --;
							}
						if ( funct == 'mostra' )
							{
								indiceFreccia --;
							}
						var singleBoxStatus = eval ('box_' + nome_pagina + '[' + index + ']');
						if (  singleBoxStatus != 'undefined' && singleBoxStatus == '1' )
							{
								o = $( '.freccia' )[indiceFreccia];
								$(o).removeClass("arrow_down");
								boxCp = $('.box_cp').get(indice);
								alterize($(boxCp));
								$(o).addClass("arrow_up");
								counter++;
							}
							
					} 	// END OF -FOR CICLE-
					
			if ( counter < ( ( numBox / 2 ) + 1 ) )
				{
					boxStatus = 'closed';
				}
			else
				{
					boxStatus = 'opened';
				}
					
	}
	
function getCookieBox()
	{
		//storedArray = JSON.parse($.cookie('array'));
		var storedArray = JSON.parse($.cookie('box_' + nome_pagina));
		return storedArray;
	}


	
function gestBox()
	{
		$( '#main_content' ).click (function()
			{
				chiudiMenu();
			});
		$( '.first' ).focus(function()
			{
				var Box = $(this).parent();
				var bigBox = $(Box).parent();
				var nome = $(bigBox).attr("class");
				var testata = $(bigBox).children('.testata');		//ok 
				var arrow = $(testata).children('.freccia');
				var altBox = parseInt($(bigBox).css("height"));
				if (altBox < defaultWidth)
						{
							abbassa($(arrow));
						}
				else
						{
							$(this).focus();
						}
				return;
				
			});
			
		$( '.text_input' ).focus(function()
			{
				var Box = $(this).parent();
				var bigBox = $(Box).parent();
				var nome = $(bigBox).attr("class");
				var testata = $(bigBox).children('.testata');		//ok 
				var arrow = $(testata).children('.freccia');
				var altBox = parseInt($(bigBox).css("height"));
				if (altBox < defaultWidth)
						{
							abbassa($(arrow));
						}
				else
						{
							$(this).focus();
						}
				return;
				
			});
			
		$( '.help' ).click(function()
			{
				abbassaHelp($(this));
			});
			
		$( '.close' ).click(function()
			{
				abbassaHelp($(this));
			});
			
		$( '#btn_test.freccia.arrow_left' ).click(function()			//restringi box in larghezza
				{
					allarga($(this));
				});

		$( '#btn_test.freccia.arrow_down' ).click(function()			//aumenta box in altezza
				{
					abbassa($(this));	
				});
				
		$( '#btn_test.freccia.arrow_up' ).click(function()			
		//restringi box in altezza
				{
					abbassa($(this));	
				});
		
	}
	

	
	function gestBoxSearch()
	{
		//---------		ARROW-UP PER BOX ELENCO TITOLI       -------------------------// 

		$( '#btn_test_search.arrow_up' ).click(function()			//restringi box in altezza
				{
					abbassaSearch($(this));
				});
	}

function allarga(o)
	{
					var parent_div = $(o).parent();
					var box = parent_div.parent();
					var larBox = parseInt($(box).css("width"));
					var classeBoxTemp = $(box).attr("class");
					var classBox = classeBoxTemp.substr(7, 6);			//estrapolata la classe
					classBox == "double" ? defaultWidth : defaultWidth = 520;
					classBox == "double"? finalWidth = 170 : finalWidth = 260;
					if (larBox < defaultWidth)
						{
							$(o).removeClass("arrow_right");
							largerize( $(box) );
							$(o).addClass("arrow_left");
						}
					else
						{
							$(o).removeClass("arrow_left");
							stringi( $(box) );
							$(o).addClass("arrow_right");
						}
	}

function abbassa(o)
	{
					var parent_div = $(o).parent();
					var box = parent_div.parent();
					var altBox = parseInt($(box).css("height"));
					if (altBox < defaultWidth)
						{
							$(o).removeClass("arrow_down");
							alterize( $(box) );
							$(o).addClass("arrow_up");
						}
					else
						{
							$(o).removeClass("arrow_up");
							lowerize( $(box) );
							$(o).addClass("arrow_down");
						}
	}

function abbassaHelp(o)
	{
					var parent_div = $(o).parent();
					var freccia = $(o).siblings();
					var box = parent_div.parent();
					var altBox = parseInt($(box).css("height"));
					var help = false;
					if ( $(o).attr("class")  == "help" )
						{
							help = true;
							//alert ('vero');
						}
					if (altBox < defaultWidth && help)
						{
							$(freccia).removeClass("arrow_down");
							$(o).removeClass("help");
							caricaHelp($(o));
							alterize( $(box) );
							$(o).addClass("close");
							$(freccia).addClass("arrow_up");
						}
					else if (altBox > finalWidth && !help)
						{
							$(freccia).removeClass("arrow_up");
							$(o).removeClass("close");
							caricaInputs($(o));
							lowerize( $(box) );
							$(o).addClass("help");
							$(freccia).addClass("arrow_down");
						}
	}
	
	
function abbassaSearch(o)
	{
					var parent_div = $(o).parent();
					var box = parent_div.parent();
					var altBox = parseInt($(box).css("height"));
					defaultWidth = 400;
					finalWidth = 88;
					if (altBox < defaultWidth)
						{
							$(o).removeClass("arrow_down");
							alterize( $(box) );
							$(o).addClass("arrow_up");
							//  ripristina valori di default
							defaultWidth = 340;
							finalWidth = 32;
						}
					else
						{
							$(o).removeClass("arrow_up");
							lowerize( $(box) );
							$(o).addClass("arrow_down");
							//  ripristina valori di default
							defaultWidth = 340;
							finalWidth = 32;
						}
	}

function alterize(o)
	{
		var nomeCp = $ ( o ).attr("id");		//show_image
		var dWidth = defaultWidth + 5;
		// dati conosciuti [nome_pagina], [nome_box]
		nome_box = $( o ).attr("name");
		// aggiorna variabile box_[nome_pagina]
		eval ( 'box_' + nome_pagina + '[' + nome_box + '] = 1');
		//aggiorna relativo cookie
		eval ( '$.cookie(\'box_' + nome_pagina + '\', JSON.stringify(box_' + nome_pagina + '));' );
		
		if ( nomeCp == 'show_image' )
			{
				dWidth = 400;
			}
		else if (nomeCp == 'menu')
			{
				dWidth = altezzaMenu;
			}
		else if (nomeCp == 'box_example')
			{
				dWidth = 700;
			}
		else if (nomeCp == 'box_color')
			{
				dWidth = 700;
			}
		else if (nomeCp == 'box_function')
			{
				dWidth = 150;
			}
		
		$( o ).animate({height: dWidth + "px" }, 300, function()
			{
				launchIso(); 
			});		// end of callback-function
	}

function lowerize(o)
	{
		nome_box = $( o ).attr("name");
		// aggiorna variabile box_[nome_pagina]
		eval ( 'box_' + nome_pagina + '[' + nome_box + '] = 0');
		//aggiorna relativo cookie
		eval ( '$.cookie(\'box_' + nome_pagina + '\', JSON.stringify(box_' + nome_pagina + '));' );
		$( o ).animate({height: finalWidth + "px" }, 300, function()
			{
				launchIso(); 
				//$('html, body').animate({scrollTop: 200}, 1000);
									
			});		// end of callback-function
	}


function largerize(o)
	{
		
		$( o ).animate({width: defaultWidth + "px" }, 300, function()
			{
				launchIso(); 
									
			});		// end of callback-function
	}

function stringi(o)
	{
		$( o ).animate({width: finalWidth + "px" }, 300, function()
			{
					launchIso();
			});
	}


function apriMenu()
			{
				var box = $( '.content_menu' );
				var altBox = parseInt($(box).css("height"));
				var dWidth = altezzaMenu;
					finalWidth = 25;
				if (altBox < dWidth)
					{
						alterize( $(box) );
						//$('html, body').animate({scrollTop: 2000}, 1000);
					}
				else
					{
						lowerize( $(box) );
					}

			}
			
function chiudiMenu()
		{
			var box = $( '.content_menu' );
			var altBox = parseInt($(box).css("height"));
			var dWidth = altezzaMenu;
			finalWidth = 25;
			if (altBox > 25)
					{
						lowerize( $(box) );
					}
			else
					{
						return false;
					}
		}

function riempiMenu()
			{
				//  ATTENZIONE 	il primo valore degli Array() non e' utilizzato serve solo per
				//						per far partire la conta da 1
				var vociMenu = new Array ("", "statistiche", "gestione utenti", "back-up " + nome_pagina, "restore " + nome_pagina, "gestione tags " + nome_pagina, "settings...");
				var vociTitle = new Array ("", "guarda statistiche", "", "esegui back-up", "ripristina back-up", "aggiungi tag", "impostazioni");
				var vociMenuAtt = new Array ("", "0", "1", "1", "1", "1", "0");
				var fun = new Array ("", "showStat()", "users()", "backUp(\"back-up\")", "backUp(\"restore\")", "gestTabella()", "settings()");
				var lenMenu = (vociMenu.length) - 1;
				//alert(lenMenu);
				altezzaMenu = lenMenu * 50;
				var box = $( '.content_menu' );
			
				$(box).append("<div class='elenco_voci'>");
				for ( i = 1; i <= lenMenu; i++)
					{
						if (vociMenuAtt[i] === "1")
							{
								$( '.elenco_voci' ).append("<div id='voce" + i +"' class='voce_menu' title='" + vociTitle[i] + "' onclick='" + fun[i] + "' >" + vociMenu[i] + "<hr></div>");
								//$( '#voce' + i ).click( function(){alert(fun[i]);});
							}
						else
							{
								$( '.elenco_voci' ).append("<div id='voce" + i +"' class='disab'>" + vociMenu[i] + "<hr></div>");
							}
					}	//end FOR CICLE CREAZIONE VOCI MENU
				
			}	// end FUNCTION

function retVoid()
	{
		return false;
	}
	
function users()
	{
		//alert (id_notizia);
		location.href = 'pseudo.main-user.php?login=' + sess_pagina + '&page=1&sheet=' + nome_pagina;
	
	}
	
//------------------------------------------------------// 
			/*		I S O T O P E  ®		*/

function launchIso()
			{
				var $container = $('#main_content');
				var class_obj = '.box_cp';
				$container.isotope({
				itemSelector : class_obj,
				masonry : {
								columnWidth : 10
							},
				masonryHorizontal : {
								rowHeight: 0
									}
				});
				
			}