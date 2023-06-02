

function	addButton( pulsante )
	{
		var tast = $( ".tastiera" );
		var dynamic = $( ".dynamic" );
		var content = $( "#footer-content" );
		var tastWidth = parseInt( tast.css("width") );
		var dynWidth = parseInt( dynamic.css("left") );
		var dynMargin = parseInt( dynamic.css("margin-left") );
		var contMargin = parseInt( content.css("margin-right") );
		var scarto = parseInt( dynWidth + 52 );
		var l = dynamic.css("left", scarto + "px");
		var m = dynamic.css("margin-left", "-" + scarto + "px");
		var c = content.css("margin-right", ( contMargin + 52 ) + "px");
		var t = tast.css( "width", ( tastWidth + 48 ) + "px");
		 var win = $("<div>");
		win.addClass("footer-btn");
		win.addClass( pulsante );
		win.attr( "id", pulsante );
		win.attr("title", pulsante );
		win.appendTo( ".tastiera");
	}



function removeBtn( pulsante )
	{
		var tast = $( ".tastiera" );
		var dynamic = $( ".dynamic" );
		var content = $( "#footer-content" );
		var tastWidth = parseInt( tast.css("width") );
		var dynWidth = parseInt( dynamic.css("left") );
		var dynMargin = parseInt( dynamic.css("margin-left") );
		var contMargin = parseInt( content.css("margin-right") );
		var scarto = parseInt( dynWidth - 52 );
		dynamic.css("left", scarto + "px");
		dynamic.css("margin-left", "-" + scarto + "px");
		content.css("margin-right", ( contMargin - 52 ) + "px");
		tast.css( "width", ( tastWidth - 48 ) + "px");
		var win = $( '.footer-btn' );
		$.each ( win, function()		{
												var name = $( this ).attr("id");
												if ( name == pulsante )
													{
														$( this ).remove();
													}
											});
	}
	
function	addButtons ( pulsanti )
	{
		// se larghezza screen < 650 aggiungi
		// ad Array pulsanti la voce "menu"
		var larg = $( window ).width();
		if ( larg <= 650 )
			{
				pulsanti.push( "menu" );
			}
		lenBtn = pulsanti.length;
		//alert ( pulsanti );
		for ( i = 0; i <= ( lenBtn - 1 );	i++ )
			{
					addButton( pulsanti[i] );
			}
	}
	
function removeAllBtn( )
	{
		var resiButtons = new Array ();
		var btn = $( '.footer-btn' );
		$.each ( btn, function()		{
												var name = $( this ).attr("id");
												resiButtons.push( name );
												$( this ).remove();
												
											});
		var tast = $( ".tastiera" );
		var dynamic = $( ".dynamic" );
		var content = $( "#footer-content" );
		dynamic.css("left", "10px");
		dynamic.css("margin-left", "-10px");
		content.css("margin-right", "10px");
		tast.css( "width", "2px");
		return resiButtons;
	}

function fnButtons( pulsanti, callBack )
	{
		var btn = $( '.footer-btn' );
		$.each ( btn, function()		{
												var dest = $(this).attr("id");
												//  comportamento diverso per "menu" e "ok"
												if ( dest != "menu" && dest != "ok" && dest != "tags" )
													{
														$(this).click( function() 	{
																				showFooter( dest, callBack );
																				}); 		// end of click button
													}
												else if ( dest == "menu" )
												// se voce == menu assegna diversa callBack
													{
														$(this).click( function() 	{
																				var o = $( ".menu-tendina" );
																							showTendina( o );
																							// gestioni
																				});		// end of click button
													}
															//  OK  ricerca
												else if ( dest == "ok" && callBack == "search" )
													{
														$(this).unbind();
														$(this).click( function() 	{
																							doSearch();
																							//gestioni
																				});		// end of click button
													}
												else if ( dest == "tags" )
													{
														$(this).unbind();
														$(this).click( function() 	{
																							doTags();
																							//gestioni
																				});		// end of click button
													}
												else
													{
														$(this).click( function() 	{
																				showFooter( dest, callBack );
																				}); 		// end of click button
													}
												
											});
		
	}
	
function showFooter( dest, callBack )
	{
		var content = $( "#footer-content" );
		if ( dest == "indietro")
			{
		( callBack == "cookie" || callBack == "search" || callBack == "tags" )  ? callBack = "footer": callBack
				dest = callBack;
			}
		uri = "php/footer_pages/" + dest + ".php";
		$.ajax({
				url: uri,
				type: "POST",
				data: "origin=" + callBack,
				dataType: "html",
				success: function( results ) {
									var oldBtn = resultBtn( dest );
									res = results.trim();
									content.html( res );
													},		//fine success
				error: function(results)		{
									
									res = 'Si è verificato un errore';
									content.html(res + " --->" + results);
								}
				});			//fine $ajax
	
	}
	
function resultBtn( dest )
	{
			switch( dest ) 		{
											
											case "credits" :
											var oldBtn = removeAllBtn();
											var actBtn = new Array ( "indietro" );
											addButtons( actBtn );
											fnButtons( actBtn, "footer" );		//  FOOTER COS'E' ???
											return oldBtn;
											break;
											
											case "policy" :
											var oldBtn = removeAllBtn();
											var actBtn = new Array ( "ok", "indietro" );
											addButtons( actBtn );
											fnButtons( actBtn, "cookie" );	
											return oldBtn;
											break;
											
											case "footer" :
											var oldBtn = removeAllBtn();
											var actBtn = new Array ( "search", "tags", "credits", "policy" );
											addButtons( actBtn );
											fnButtons( actBtn, dest );
											break;
											
											case "search" :
											var oldBtn = removeAllBtn();
											var actBtn = new Array ( "ok", "indietro" );
											addButtons( actBtn );
											fnButtons( actBtn, dest );
											break;
											
											case "tags" :
											var oldBtn = removeAllBtn();
											var actBtn = new Array ( "indietro" );
											addButtons( actBtn );
											fnButtons( actBtn, dest );
											break;
											
											case "indietro" :
											var oldBtn = removeAllBtn();
											addButtons( oldBtn );
											fnButtons( oldBtn, dest );
											break;
											
											default :
											// default code
											break;
											
										}
	}
	
function flusso( sezione )
	{
		showFooter( sezione );
	}

	
