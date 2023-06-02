var metas = new Array( "title", "description", "image" );

function attivaBtnScheda( idNews, titolo, img )
	{
					// aggiungi metaTag per facebook
					//addMetaFB(idNews, titolo, img);
					 
					//  TAGS
					if( $( "#parole-chiave" ).css("display") == "block"  ) 
						{
							$( "#parole-chiave"  ).click( function ()
																{
																	openButtons($( ".cont-tags" ), $(this));
																});
																
							$( ".tag-scheda" ).click( function ()
																{
																	gotoTags( ($(this).html()) );
																});
						}
					//\\	TAGS
					
					//	LINK
					//		$("div[id^='pinko']"); //div con id che inizia per [pinko]..
					if ( $( "div[id^='link']" ).css("display") == "block" )
						{
							$( "div[id^='link']" ).click ( function ()
																{
																	goLink( $(this) );
																});
						}
					//\\	LINK
					
					//		PDF
					if ( $( "#pdf-go" ).css("display") == "block" )
						{
							$( "#pdf-go" ).click ( function ()
														{
															loadPDF( $(this) );
														});
						}
					//\\	PDF
					
					//		E-MAIL
					if ( $( "#mail" ).css("display") == "block" )
						{
							$( "#mail" ).click( function ()
														{
															inviaMail( $(this) );
														});
						}
					//\\	E-MAIL
					
					//	MAPPA GOOGLE®
					if( $( "#mappa-go" ).css("display") == "block"  ) 
										{
											// codice da eseguire se il div esiste
											//		crea il div contenitore
											mappa = encodeURIComponent( $( ".cont-map" ).html() );
											
											$.ajax(
														{
															url: "php/button.maps.php",	
															// pagina che carica la mappa [index]
															type: "POST",
															data: "mappa=" + mappa,
															dataType: "html",
															success:  function(results) {
																						//debugCall(results);
																						res = results.trim();
																						$( ".cont-map" ).html(results);
																						}
														});
										
					$( "#mappa-go" ).click ( function ()
																{
																	openButtons($( ".cont-map" ), $(this));
																});
					
									}
					//\\	MAPPA GOOGLE®
					
					//	VIDEO
					if( $( "#video" ).css("display") == "block"  ) 
										{
											// codice da eseguire se il div esiste
											$( "#video"  ).click( function ()
																					{
																						doVideo($(this));
																					});
										}
					//\\	VIDE0

	}
	
	
//		E-MAIL
function inviaMail( o )
	{
		// prelevo indirizzo e-mail
		var child = o.children();
		var email = $( child[1] ).html();
		window.location = 'mailto:' + email;

	}
	
//		LINKS		
function goLink( o )
	{
		// prelevo il link
		var child = o.children();
		var link = $( child[1] ).html();
		var radice = link.substr( 0, 3 );
		if ( radice == "www" )
			{
				var nuovoLink = "http://" + link;
				link = nuovoLink;
			}
		window.open( link,'_blank');
	}

//		PDF
function loadPDF( o )
	{
		// prelevo il link
		var child = o.children();
		var link = $( child[1] ).html();
		//  sostituire 'eventi' con la pagina notizie del momento
		var nuovoLink = "public/php/" + link;
		window.open( nuovoLink,'_blank');
	}
	
//		VIDEO		
function doVideo( o )
	{
		var valore = o.attr("name");
		var videoEmbed = valore.split( "?");
		var indVideo = videoEmbed[1].substr(-11);
		var offset = $( '#super_cont' ).width();
		var cont_scheda = $( '#super_cont' ).html();
		// salva html in pos temporanea
		$( '#service' ).html(cont_scheda);
		// crea pulsante
		var text_html = '<div  style="background-color: #000;"><div id="exit-btn" class="exit" onclick="returnToNormal();">X</div><iframe width="100%" height="300" src="https://www.youtube.com/embed/' + indVideo + '" frameborder="0" allowfullscreen></iframe></div>';
		// sostituisci con mappa
		$( '#super_cont' ).html( text_html);
		
	}
	
// chiudi il video e torna al contenuto precedente
function returnToNormal()
	{
		var cont_scheda = $( '#service' ).html();
		$( '#super_cont' ).html( cont_scheda);
	}

//		FUNZIONI CHE RIGUARDANO LA CONDIVISIONE SU FACEBOOK
function addMetaFB( idNews, title, image )
	{
		var head = document.getElementsByTagName('head')[0];
		var lenM = metas.length;
		var content;
		for ( i = 0; i <= ( lenM - 1 ); i++)
			{
				switch(metas[i]) {
											case "title":
											content = title;
											break;
											case "image":
											content = image;
											break;
											default:
											content = "prova";
									} 
				$( head ).append('<meta id="meta-' + metas[i] + '" content="' + content + '" property="og:' + metas[i] + '" />' );
			}
	}
	
//<meta property="og:image"         content="http://www.your-domain.com/path/image.jpg" />
function removeMetaFB(  )
	{
		var lenM = metas.length;
		for ( i = 0; i <= ( lenM - 1 ); i++)
			{
				$('meta[id="meta-' + metas[i] + '"]').remove();
			}
	}	
	

//		FUNZIONI DI APERTURA/CHIUSURA PULSANTI SCHEDA SINGOLA NEWS

function openButtons( c, o )
	{
			var altezza = o.outerHeight();
			if (altezza < 68)
				{
					alterize( c, o);
				}
			else
				{
					lowerize( c, o );
				}
			
	}	//  END  OF  FUNCTION 

function alterize( c, o )
	{
		var diff = 50;
		var button = $ ( o );
		var tagsContainer = $( c );
		(tagsContainer.attr("class") == 'cont-map' ) ? diff = 220 : diff;
		var offsetFine = $( '.fine_button' ).offset();
		var hButton = button.outerHeight();
		var offsetTags = tagsContainer.offset();
		var topFine = parseInt(offsetFine.top);
		var topTags = parseInt(offsetTags.top);
		var new_height = diff + (topFine - topTags);
		( new_height <= 0 ) ? new_height = 10 : new_height;
		$( button ).css( "height", new_height + "px");
	}
	
function lowerize( c, o )
	{
		$( o ).css( "height", "10px");
	}
	
	