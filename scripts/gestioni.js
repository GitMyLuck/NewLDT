var menuAlto = $( "ul#menu-alto li" );
var menuBasso = $( "ul#menu-mobile li" );
var cookies;
var indice;
var pageHeight = 700;

		//****---  INDEX  ---****\\//
function iniStart( pag, newsId )
	{
		flu = "footer";
		//  setta indice scorrimento notizie
		//  finestra laterale;
		indice = 0;
		
		// controlla se cookie attivati ?
		//	cookie "mycookies", "true"
		// -----------code---------------------
		 var cookieValue = $.cookie("mycookies");
		 if ( !cookieValue )
			{
				//  cookie non attivati mostra policy
				flu = "policy";
			}
		else
			{
				cookies = true;
			}
		//controlla altezza della pagina 
		// se pagina < 420px mostra menu
		// in header
		// -----------code----------------------
		
		// in base al nome della pagina setta i vari menu
		// minimal e normale
		// -----------code-------------------
		pagina = pag;
		//  setta correttamente il menu in base al valore pagina
		// @param global[pagina]
		settaMenu ( );
		
		// attiva il relativo footer determinato dal valore di flu
		//	@param local[flu]
		flusso(  flu );
		
		//	prepara il menu tendina
		var menu = $( ".menu-tendina" );
		var alt = menu.height();
		menu.removeClass( "showed" );
		menu.css( "bottom" , "-" + (alt) + "px");
		
		// se e' presente nella $_GET la variabile news
		// carica direttamente notizia
		//  pagina principale a sinistra
		if ( newsId != '' )
			{
				if ( cookies )
					{
						//gotoNews('#id#', '#pagina#', '#search#');"
						gotoNews ( newsId, newsPage, search );
					}
				else
					{
						caricaNoCookies();
					}
			}
		else
			{
				//  carica il contenuto relativo alla pagina
				//	@param global[pagina]
				// ------------code---------------
				caricaPagina();
						
			}
		
		//  carica il contenuto relativo ad elenco news
		//  colonna a destra
		//	@param global[search]
		// ------------code---------------
		if ( cookies )
			{
				caricaNews( 0, "news" );
			}
		else 
			{
				caricaNoCookies();
			}
		
	}	//  END OF FUNCTION START
/***------------------------ ***/
//****---  EVENTI  ---****\\//	
function iniStartEventi( pag, newsId )
	{
		flu = "footer";
		//  setta indice scorrimento notizie
		//  finestra laterale;
		indice = 0;
		
		pagina = pag;
		//  setta correttamente il menu in base al valore pagina
		// @param global[pagina]
		settaMenu ( );
		
		// attiva il relativo footer determinato dal valore di flu
		//	@param local[flu]
		flusso(  flu );
		
		//	prepara il menu tendina
		var menu = $( ".menu-tendina" );
		var alt = menu.height();
		menu.removeClass( "showed" );
		menu.css( "bottom" , "-" + (alt) + "px");
		
		// se e' presente nella $_GET la variabile news
		// carica direttamente notizia
		//  pagina principale a sinistra
		if ( newsId != '' )
			{
						//gotoNews('#id#', '#pagina#', '#search#');"
						gotoNews ( newsId, newsPage, search );
						caricaNews( 0, "news" );
						return false;
			}
		else
			{
				//  carica il contenuto relativo alla pagina
				//	@param global[pagina]
				// ------------code---------------
				caricaNews( 0, "page" );
			}
		
		//  carica il contenuto relativo ad elenco news
		//  colonna a destra
		//	@param global[search]
		// ------------code---------------
				//caricaNews( 0, "news" );
				caricaFoto ( "news" );
				// CARICA FOTO
				
		
	}	//  END OF FUNCTION START EVENTI




//  funzione che assolve al compito di alzare od abbassare il menu	
function showTendina( o )
	{
		//var menu = $( ".menu-tendina" );
		var alt = o.height();
		//var avHeight = $( 'html, body' ).
		var position = parseInt(o.css( "bottom" ));
		if ( position == 70 )
			{
				// menu alzato quindi abbassa
				o.removeClass( "showed" );
			     o.animate(	{
										bottom: "-" + alt
									}, 1200,  function()		{
													// CALLBACK  Function
													o.css("display", "none");
																});
			}
		else 
			{
				// menu nascosto quindi alzare
				//menu.css( "bottom" , "70px" );
				o.css("display", "block");
				o.animate(	{
										bottom: 70
								}, 600, function()  {
															o.addClass( "showed" );
															});
			}
			
		//alert (position);
	}
	
//  setta selected o unselect le voci menu ( o ) in base al valore di pagina
function settaMenu( )
	{
		var menualto = $( "ul#menu-alto li" );
		var menubasso = $( "ul#menu-mobile li" );
		var tipi = new Array ("alto", "basso");
		var i = 0;
		var typeSel = "";
		while (i <= 1) {
					type = tipi[i];
		( type == "basso" ) ? typeSel = "footer-" : typeSel;
		$.each ( eval( "menu" + type), function()		{
								
								var m = $(this).html();
								$(this).removeClass( typeSel + "selected");
								$(this).unbind();
								if ( m == pagina )
									{
										$(this).removeClass( typeSel + "unselected");
										$(this).addClass( typeSel + "selected");
										$(this).unbind();
									}
								else
									{
										$(this).addClass( typeSel + "unselected");
										$(this).click( function()		{
														pagina = m;
														caricaPagina();
																		});
									}
														});
														
						i++;
							}		//  END OF WHILE CICLE
	}
	
function caricaPagina()
	{
		//return null;
		var ran = Math.random();
		settaMenu();
		// rimuovi classi perticolari per mostrare le news nella
		// main-page
		$( ".main-page" ).removeClass( "no-padding");
		$( ".main-page" ).removeClass( "borders");
		createLoader( $( ".main-page" ) );
		$( ".main-page" ).load( "php/elabora.pagina.php?pagina=" + pagina + "&random=" + ran, function(results)	
													{
														// controlla se la pagina esiste
														var search = '<html';
														var error = results.indexOf(search);
														if ( error != -1 )
															{
																$( ".main-page" ).html("Pagina inesistente..");
															}
			//  cambia indirizzo nella barra degli indirizzi
			window.history.pushState({path:pageUrl},'','index.php');
			
														heightAdj();
													});
									
	}

	
function caricaNews( chunk, zona )
	{
		if ( !zona || zona == "" )
			{
				zona = "news";
			}
		else
			{
				if ( zona == "page" )
					{
						// aggiungi classi perticolari per mostrare le news nella
						// main-page
						$( ".main-"+ zona ).addClass( "no-padding");
						$( ".main-"+ zona ).addClass( "borders");
					}
			
			}
		createLoader( $( ".main-" + zona ) );
		getVars = "?search=" + search + "&pagina=" + newsPage + "&chunk=" + chunk + "&zona=" + zona + "&pages=" + pagine;
		$( ".main-"+ zona ).load( "php/elabora.news.php" + getVars, function( )
													//  callbak
														{
															
															// aggiusta altezza colonna NEWS
															heightAdj();
															prepareArrows();
															// gestioni.arrows.js
														});
					
	}
	


//	funzione che richiama la scheda della notizia
//	e la inserisce nella main-page
	
function gotoNews (id, pag, search )
	{
		var ran = Math.random();
		var uri = "php/elabora.scheda.news.php";
		var passVars = "pagina=" + pag + "&news=" + id + "&search=" + search + "&random=" + ran;
	
		$.ajax({
				url: uri,
				type: "POST",
				data: passVars,
				dataType: "html",
				beforeSend: function ()	{
									$( ".main-page" ).html("");
								},
				success: function(results) {
									res = results.trim();
									$( ".main-page" ).html(res);
									//		Callback 
									pagina = 'news';
									settaMenu();
									// preleva nome immagine per facebook
									var fotoCont = $( '#foto' );
									var img = $( fotoCont ).attr( 'src' );
									//  preleva titolo per metaTag di facebook
									var titCont = $( '#titolo' );
									var titolo = $( titCont ).html();
									//		ATTIVA LE FUNZIONI DEI PULSANTI SCHEDA
									attivaBtnScheda( id, titolo, img );
									// aggiusta altezza colonna NEWS
									heightAdj();
									// gestioni.scheda.js
									$('html, body').animate({scrollTop: 0}, 600);
								},		//fine success
				error: function()		{
									res = "si è verificato un errore";
									$( ".main-page" ).html(res);
								}
				});			//fine $ajax
	}
	
function caricaFoto( zona )
	{
	
	}

//	aggiusta altezza della colonna news	
function heightAdj()
	{
		pageHeight = ( $( '.main-page' ).height() ) - 100;
		$( ".scroll-news-news" ).css( "max-height", pageHeight + "px" );
	}
	
function gotoTags( tag )
	{
		search = tag;
		caricaNews( 0 );
	}
	
function caricaNoCookies()
	{
		$( ".main-news" ).load( "errore.php" );
	}
	
function doSearch()
	{
		var inSearch = $( "#search" );
		search = encodeURIComponent( inSearch.val() );
		caricaNews( 0 );
		inSearch.val("");
		flusso("footer");
		//alert (search);
	}
	
function doTags()
	{
		var o = $( ".cont-tendina" );
		o.load( "php/elabora.tags.php", function()		{
																			//alza tendina;
																			showTendina( o );
																		});
	}
	
function getTag( tag )
	{
		var o = $( ".cont-tendina" );
		search = tag;
		caricaNews( 0 );
		showTendina( o );
	}
	
function createLoader( o )
	{
		var postName = "";
		var name = $( o ).attr( "class" );
		if ( name == "main-news" )
			{
				postName = "_news";
			}
		$( o ).html("");
		var loader = $( "<div>" );
		loader.attr( "id", "circularG" + postName );
		loader.appendTo( o );

		for ( i = 1; i < 9; i++ )
			{
				var subLoader = $( "<div>" );
				subLoader.attr( "id", "circularG_" + i  + postName);
				subLoader.addClass( "circularG" );
				subLoader.appendTo ( $( "#circularG" + postName ));
				
			}
		$( '#circularG' + postName ).fadeIn(300);
	
	}