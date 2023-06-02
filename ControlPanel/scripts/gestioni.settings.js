var hlDiv;
var bgDiv;
var mainDir = 'php/color_settings/';
var o;
/*** SETTING   SECTION ***/
function   settings()
	{
		location.href = 'pseudo.main-settings.php?login=' + sess_pagina + '&page=1&sheet=' + nome_pagina;
	}
	
function startSettings(colorTable)
	{
		var sel, nextSel, nameDiv;
		$( '#box_settings' ).load( mainDir + "layout.settings.php?tavolozza=" + colorTable,function()
										{
											$( '.color_table' ).removeClass("selected_table");
											$( '#' + colorTable + '_table' ).addClass("selected_table");
											aggExample();
											aggFunzioni ();
											$('html, body').animate({scrollTop: 100}, 600);
											//		ATTIVA  RISALTO  DIV  
											$( '.labelSelector' ).mouseover(function()
																	{
																		sel = $( this ).next();
																		nextSel = $( sel ).next();
																		nameDiv = $( nextSel ).attr("id");
																		hlDiv = nameDiv;
																		bgDiv = $( '.' + nameDiv ).css("background");
																		$( '.' + nameDiv ).css(	"background", "#73dfda");
																	});
											$( '.labelSelector' ).mouseout(function()
																	{
																		
																		$( '.' + hlDiv ).css(	"background", bgDiv);
																		hlDiv = null;
																		bgDiv = null;
																	});
																	
											//		FUNZIONI SCOMPARSA LINGUETTE
											$( '.toggle_principali' ).click(function() 
																	{
																		$( ".principali" ).slideToggle( "slow" );
																	});
																	
											$( '.toggle_inputs' ).click(function() 
																	{
																		$( ".inputs_" ).slideToggle( "slow" );
																	});
																	
											$( '.toggle_bar' ).click(function() 
																	{
																		$( ".bar_" ).slideToggle( "slow" );
																	});
											$( '.toggle_aspetto' ).click(function() 
																	{
																		$( ".aspetto" ).slideToggle( "slow" );
																	});
																	
											$( '.temi' ).click(function() 
																	{
																		$( ".temi_" ).slideToggle( "slow" );
																	});
											
																	
											$( '.color_table' ).click(function() 
																	{
																		var table = ($( this ).attr( "id" )).split("_");
																		startSettings(table[0])
																	});
										});
	
	}

function aggExample()
	{
		$( '#box_content_example' ).load( mainDir + "layout.settings.example.php",function () 
					{
						var servCont = $( "#service" ).text();
						
						if ( servCont )
							{
								//alert (servCont);
								var setting = servCont.split(",");
								var ob = setting[0];
								$( "." + ob ).css(setting[2], setting[1]);
								// AGGIORNA  TABELLA TEMP STILE IN LINEA
								data = 'data=' + servCont;
								$.ajax({
											url: mainDir + "set.temp.color.php", 
											type: "POST",
											data: data,
											dataType: "html",
											success: function(results) 
														{
															$( "#service" ).text("");
															res = results.trim();
															if ( res )
																{
																	//$( '#res' ).html(res);
																	doMess('alert', res, '');
																}
														}		//fine success
											});			//fine $ajax
							}
							//		chiamare stile in linea da file...
						//		["general_back", "#836c83", "background"];
						//	  	[      setting[0]	    setting[1]		setting[2]
					});
	
	}
	
	
function aggFunzioni ()
	{
			$( '#box_content_funzioni' ).load( mainDir + "layout.settings.function.php");
			
	}
function applicaColor( o, action )
	{
		color = '000000';
		var tipo;
		var cTipo;
		var Div;
		//		SOLO COLORE
		if (action === 'update')
			{
				applyColor( o );
				return;
			}
		else if (action === 'default')
			{
				cTipo = $( o ).next();
				tipo = $( cTipo ).attr("id");
				$( '#service2' ).load(mainDir + "get.default.color.php?color-type=" + tipo,function(res) 
								{
										// colore risultato da chiamata AJAX
										color = "#" + (res.trim());
										pick = $( o ).attr("id");
										tipo = pick.split("-");
										cTipo = $( o ).next();
										Div = $( cTipo).attr("id") ;
										$( '#service').text("");
										$( '#service').text(Div + "," + color + "," + tipo[0]);
										$( '#' + pick ).css("background", color);
										aggExample();
										return;
								});
			}
		//		ICONE FRECCE
		else if (action === 'ink-update')
			{
				var color = $( o ).attr('title');
				tipo = "main";		//	seleziona il tipo di icone da cambiare (main  -  bar - alert)
				changeColorIcon(color, tipo);
				applyColor( o );
				return;
			}
		else if (action === 'ink-default')
			{
				var color = '#F9B234';
				tipo = "main";		//	seleziona il tipo di icone da cambiare ( main  -  bar - alert )
				changeColorIcon(color, tipo);
				applyColorDefault( o );
				return;
			}
			//		ICONE BARRA MENU...
			else if (action === 'bar-update')
			{
				var color = $( o ).attr('title');
				tipo = "bar";		//	seleziona il tipo di icone da cambiare (main  -  bar)
				changeColorIcon(color, tipo);
				aggExample();
				return;
			}
			//		APPENDICI ALERT
			else if (action === 'update_background')
			{
				var color = $( o ).attr('title');
				tipo = "alert";		//	seleziona il tipo di icone da cambiare (main  -  bar)
				changeColorIcon(color, tipo);
				applyColor( o );
				return;
			}
			else if (action === 'default_background')
			{
				var color = '#A3A3A3';
				tipo = "alert";		//	seleziona il tipo di icone da cambiare (main  -  bar)
				changeColorIcon(color, tipo);
				applyColorDefault( o );
				return;
			}
			
	}
function applyColorDefault ( o )
	{
				cTipo = $( o ).next();
				tipo = $( cTipo ).attr("id");
				$( '#service2' ).load(mainDir + "get.default.color.php?color-type=" + tipo,function(res) 
								{
										// colore risultato da chiamata AJAX
										color = "#" + (res.trim());
										pick = $( o ).attr("id");
										tipo = pick.split("-");
										cTipo = $( o ).next();
										Div = $( cTipo).attr("id") ;
										$( '#service').text("");
										$( '#service').text(Div + "," + color + "," + tipo[0]);
										$( '#' + pick ).css("background", color);
										aggExample();
										return;
								});
	}
	
function  applyColor( o )
	{
		if (o)
			{
				var color = $( o ).css('background-color');
		
				if (color.substr(0, 3) === 'rgb')
					{
						hexColor = color.rgbToHex();
						color = "#" + hexColor;
					}
				tipo = ($( o ).attr("id")).split("-");
				cTipo = $( o ).next();
				Div = $( cTipo).attr("id") ;	
				$( '#service').text("");
				$( '#service').text(Div + "," + color + "," + tipo[0]);
				o.attr("title", color);
				aggExample();
			}
	}
	
function applicaPerc( o )
	{
		var perc = $( o ).val();
		//alert (perc);
		$.ajax({
					url: mainDir + "apply.perc.php", 
					/* pagina di destinazione dei dati */
					type: "POST",
					data: "perc=" + perc,
					dataType: "html",
					success: function(results) 
										{
											res = results.trim();
											aggExample();
											if (res)
												{
													alert (res);
												}
										}		//fine success
				});			//fine $ajax
	
	}
	
function applicaPercDefault()
	{
		$.ajax({
					url: mainDir + "get.default.perc.php", 
					/* pagina di destinazione dei dati */
					type: "POST",
					data: "perc=default",
					dataType: "html",
					success: function(results) 
										{
											res = results.trim();
											$( '#perc' ).val(res);
											aggExample();
										}		//fine success
				});			//fine $ajax
	
	}
	/***	FUNZIONI BORDER RADIUS		**/
	/***	--------------------------------		**/
function applicaRadius( o )
		{
		var radius = $( o ).val();
		
		$.ajax({
					url: mainDir + "apply.radius.php", 
					/* pagina di destinazione dei dati */
					type: "POST",
					data: "radius=" + radius,
					dataType: "html",
					success: function(results) 
										{
											res = results.trim();
											aggExample();
											if (res)
												{
													$( '#res' ).html(res);
												}
										}		//fine success
				});			//fine $ajax
		
		}
		
function applicaRadiusDefault( )
		{
		var radius = 3;
		
		$.ajax({
					url: mainDir + "apply.radius.php", 
					/* pagina di destinazione dei dati */
					type: "POST",
					data: "radius=" + radius,
					dataType: "html",
					success: function(results) 
										{
											res = results.trim();
											$( '#radius' ).val(radius);
											aggExample();
											if (res)
												{
													$( '#res' ).html(res);
												}
										}		//fine success
				});			//fine $ajax
		
		}
		
function ripristinaSettings()
		{
			$.ajax({
					url: mainDir + "function.ripristina.php", 
					type: "POST",
					data: "",
					dataType: "html",
					success: function(results) 
										{
											aggExample();
											res = results.trim();
											doMess('alert', res, 'Ripristina Configurazione');
										}		//fine success
				});			//fine $ajax
		
		}
		
function salvaSettings( o )
		{
			inputNome = $( o).prev();
			nome = inputNome.val();
			if ( nome )
				{
					$.ajax({
							url: mainDir + "function.salva.php", 
							type: "POST",
							data: "nome=" + nome,
							dataType: "html",
							success: function(results) 
										{
											aggExample();
											res = results.trim();
											testo = '';
											if ( res == 'success' )
												{
													testo = 'configurazione salvata con successo..';
												}
											else
												{
													testo = 'configurazione già esistente...<br />Nessuna nuova configurazione salvata.';
												}
											doMessAlert(testo, 'Salvataggio Configurazione');
										}		//fine success
							});			//fine $ajax
				}
			else
				{
					$( '#res' ).html("inserire il nome della nuova configurazione...");
					$( '#name_conf' ).focus();
				}
		}

function applicaSettings()
		{
			$.ajax({
					url: mainDir + "function.applica.php", 
					type: "POST",
					data: "",
					dataType: "html",
					success: function(results) 
										{
											aggExample();
											res = results.trim();
											//$( '#res' ).html(res);
											doMess( 'alert', res, 'tema applicato');
										}		//fine success
				});			//fine $ajax
		
		}

function applicaTema( tema )
		{
			$.ajax({
					url: mainDir + "function.carica.tema.php", 
					type: "POST",
					data: "tema=" + tema,
					dataType: "html",
					success: function(results) 
										{
											aggExample();
											startSettings( tema );
											res = results.trim();
											doMessAlert( res, 'tema applicato');
											//$( '#res' ).html(res);
										}		//fine success
				});			//fine $ajax
		}
		
function pulisciLavagna()
		{
			$( '#res' ).html("");
		}
		
String.prototype.rgbToHex = function() {
				var rgbArray = new Array();
				var lenColor = this.length - 1;
				var subColor = this.substring(4, lenColor);
				rgbArray = subColor.split(",");
				var counter = 0;
				var hexColor = '';
				rgbArray.forEach(function() {
					var n = parseInt(rgbArray[counter]);
					hex = n.toString(16);
					if(hex.length==1) 
						{
							hex='0'+hex;
						}					/*aggiunge lo zero davanti se è un numero con una cifra sola*/
					hexColor = hexColor + (hex.toUpperCase());
					counter++;
							}); 
			return hexColor;
}


function changeColorIcon( color, tipo )
	{
		$.post("./php/color_settings/apply.icon.color.php",{ action: "get_all", tipo: tipo },function(s) 
						{
							s=s.trim();
							var images = $.parseJSON(s);
							$.each(images, function( index, element ) 
								{
									change( images[index], color, tipo );
								});
						});
	}
	
	
function change( src, color, tipo ) 
{
	var dir = "./images/icone/F9B234/";
	if ( tipo == "bar" )
		{
			dir = "./images/icone_barra/FFFFFF/";
		}
	else if ( tipo == "alert" )
		{
			dir = "./images/appendici/FFFFFF/";
		}
    var myImg = new Image();
    myImg.src = dir+src;
    myImg.onload = function() 
		{
        var canvas = document.createElement("canvas");
        var ctx = canvas.getContext("2d");
        ctx.drawImage(myImg,0,0);
        var imgd = ctx.getImageData(0, 0, myImg.width, myImg.height);
        canvas.height = myImg.height;
        canvas.width = myImg.width;
        var new_color = HexToRGB( color );
        // console.log(imgd)
        for (i = 0; i <imgd.data.length; i += 4) {
            imgd.data[i]   = new_color.R;
            imgd.data[i+1] = new_color.G;
            imgd.data[i+2] = new_color.B;
        }
        ctx.putImageData(imgd, 0, 0);
        var newImage=new Image()
        newImage.src=canvas.toDataURL("image/png");
        $(newImage).css("margin","5px");
        $(newImage).attr('data-title',src);
       
        save( newImage.src,src, color, tipo );
	  //creaCss( color );
    };
	
}

function save( src, filename, cname, tipo) {
    $.post("./php/color_settings/apply.icon.color.php", { action: "save", file: src, name: filename, color: cname, tipo: tipo });
}

	
function HexToRGB(Hex)
{
    var Long = parseInt(Hex.replace(/^#/, ""), 16);
    return {
        R: (Long >>> 16) & 0xff,
        G: (Long >>> 8) & 0xff,
        B: Long & 0xff
    };
}

