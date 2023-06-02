
var win;
var newAlert =  new function()
	{
			this.type = 'alert';							//	tipo di messaggio	-default-
			this.subTitolo = 'messaggio';	//	sottotitolo del messaggio	-default-
			this.text = 'testo di default';			//	testo del messaggio	-default-
			this.time = 20000000;							//	tempo di visualizzazione
			this.callback = 'closeAlert();';					//  callback function
			this.uri = "show.alert.php";				//  PAGINA CARICATA di default
			this.passVar = '?text=' + encodeURIComponent( this.text ) + '&type=' + this.type + '&sottotitolo=' + encodeURIComponent( this.subTitolo);
			this.create = function()
				{
					win = $("<div>");
					win.addClass("al_win");
					win.appendTo( "body");
				}
				
			this.show = function () 
				{
					
					//	serializza variabili $_GET
					win.addClass( 'mess_' + this.type );
					win.load( "php/"+ this.uri + this.passVar,function()
					{
						helpWidth = 300;
						createAlertOverlay();	
						$( '#alert-overlay' ).click(function()
											{
												newAlert.closeAl();
											});

						win.slideDown("slow" );
						altMess = $( '.mess_text' ).height();
						if ( altMess > 200 )
							{
								$( '.mess_text' ).addClass('vert-scroll');
							}
					});
				}		//END OF SHOW FUNCTION
				
			this.temporized = function()
				{
						this.create();
						this.show();
						callFunction = this.callback;
( callFunction !== 'closeAlert();' ) ? callFunction = this.callback + 'closeAlert();':callFunction;
						setTimeout( callFunction, this.time ) ;
				}		//END OF TEMPORIZED FUNCTION
				
			this.closeAl = function ()
				{
					win.slideUp("slow");
					setTimeout( closeAll, 1000 ) ;
						function closeAll()
							{
								win.html( "");
								destAlertOverlay();		//new.gestioni.js
								// controlla se esiste funzione di callback
								if ( this.callback !== 'closeAlert();')
									{
										// se esiste eseguila alla chiusura dell' alert
										eval( this.callback );
									}
							}
				}		//END OF CLOSE FUNCTION
			
			}		//  END OF ALERT Function
			
//		-----------------------------------------------------------		//
//		-----------------------------------------------------------		//

		var newPage =  new function()
	{
			this.type = 'page';							//	tipo di messaggio	-default-
			this.subTitolo = 'messaggio';	//	sottotitolo del messaggio	-default-
			this.text = 'testo di default';			//	testo del messaggio	-default-
			this.time = 20000000;							//	tempo di visualizzazione
			this.callback = 'closePage();';					//  callback function
			this.uri = "show.alert.php";				//  PAGINA CARICATA di default
			this.passVar = '?text=' + encodeURIComponent( this.text ) + '&type=' + this.type + '&sottotitolo=' + encodeURIComponent( this.subTitolo);
			this.createPage = function()
				{
					winPage = $("<div>");
					winPage.addClass("help_win");
					winPage.appendTo( "body");
				}
				
			this.showPage = function () 
				{
					
					//	serializza variabili $_GET
					winPage.addClass( 'mess_' + this.type );
					winPage.load( "php/"+ this.uri + this.passVar,function()
					{
						var main = $ ( '#main_content' );
						var mainWidth = parseInt(main.outerWidth());
						var helpWidth = mainWidth - 40;
						var margin = parseInt((mainWidth - helpWidth) / 2);
						createPageOverlay();	
						$( '#help-overlay' ).click(function()
											{
												newPage.closePage();
											});

						winPage.css("width", helpWidth + "px" );
						winPage.css("margin-left", margin + "px" );
						winPage.slideDown("slow" );
						altMess = $( '.mess_text' ).height();
						if ( altMess > 200 )
							{
								$( '.mess_text' ).addClass('vert-scroll');
							}
					});
				}		//END OF SHOW-PAGE FUNCTION
			this.temporized = function()
				{
						this.create();
						this.show();
						callFunction = this.callback;
( callFunction !== 'closePage();' ) ? callFunction = this.callback + 'closePage();':callFunction;
						setTimeout( callFunction, this.time ) ;
				}		//END OF TEMPORIZED FUNCTION
				
			this.refreshPage = function()
				{
					winPage.html("");
					winPage.load( "php/"+ this.uri + this.passVar, function()
						{
							altMess = $( '.mess_text' ).height();
							if ( altMess > 200 )
									{
										$( '.mess_text' ).css( "height", "290px");
										$( '.mess_text' ).addClass('vert-scroll');
									}
						});
				}
				
			this.closePage = function ()
				{
					winPage.slideUp("slow");
					setTimeout( closeAll, 1000 ) ;
						function closeAll()
							{
								winPage.html( "");
								destPageOverlay();
								// controlla se esiste funzione di callback
								if ( this.callback !== 'closePage();')
									{
										// se esiste eseguila alla chiusura dell' alert
										eval( this.callback );
									}
							}
				}		//END OF CLOSE FUNCTION
			
			}		//END OF NEWPAGE FUNCTION
			
//		-----------------------------------------------------------		//
//		-----------------------------------------------------------		//

	function createAlertOverlay()
				{
					var alertOverlay = $("<div>");
					alertOverlay.attr("id", "alert-overlay");
					alertOverlay.addClass("alert_overlay");
					alertOverlay.appendTo( "body");
				}
				
	function createPageOverlay()
				{
					var helpOverlay = $("<div>");
					helpOverlay.attr("id", "help-overlay");
					helpOverlay.addClass("help_overlay");
					helpOverlay.appendTo( "body");
				}
				
				
	function destAlertOverlay()
			{
				$( '#alert-overlay' ).remove();
			}
			
	function destPageOverlay()
			{
				$( '#help-overlay' ).remove();
			}
	
	function doMess( type, text, subTitolo, time, callback )
		{
			newAlert.type = type;
			newAlert.text = text;
			if ( subTitolo )
				{
					newAlert.subTitolo = subTitolo;
				}
			newAlert.passVar = '?text=' + encodeURIComponent( newAlert.text ) + '&type=' + newAlert.type + '&sottotitolo=' + encodeURIComponent( newAlert.subTitolo);
			// se esiste temporizzazione
			if ( time && !callback )
				{
					newAlert.time = time;
					newAlert.temporized();
					return;
				}
			else if ( time && callback )
				{
					newAlert.callback = callback;
					newAlert.time = time;
					newAlert.temporized();
					return;
				}
					newAlert.create();
					newAlert.show();
		}
	
	function doIstr( label )
		{
			newAlert.type = 'istr';
			res = label.split( "</font>" );
			if ( res[1] )
				{
					label = res[1];
				}
			newAlert.passVar = '?istr=' + encodeURIComponent(label) + '&pagina=' + nome_pagina;
			newAlert.uri = "show.istruzioni.php";
			newAlert.show();
		}
		
	function doPage( uri )
		{
			newPage.passVar = '?text=&type=page&sottotitolo=' + encodeURIComponent( uri );
			newPage.createPage();
			newPage.showPage();
		}
		
	function refPage ()
		{
			newPage.refreshPage();
		}
		
	//		FUNZIONI DI CHIUSURA
	function closeAlert()
		{
			newAlert.closeAl();
		}
		
	function closePage()
		{
			newPage.closePage();
		}
		