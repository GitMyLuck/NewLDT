var client_width;			//largezza a disposizione per i box
var opts; 					//option per la spin
function hideButtons()
	{
		//NASCONDE I PULSANTI ANNULLA E CONFERMA, IN CASO
		//LA NOTIZIA SIA PUBBLICATA CORRETTAMENTE
		$( '.menu_button' ).css("visibility", "hidden");
	
	}

function showButtons()
	{
		//NASCONDE I PULSANTI ANNULLA E CONFERMA, IN CASO
		//LA NOTIZIA SIA PUBBLICATA CORRETTAMENTE
		$( '.menu_button' ).css("visibility", "visible");
	
	}
function splitText(text)
	{
		//CONTROLLA E RIPULISCE L'INSERIMENTO DEI TAGS
		//eliminare spazio finale con trim
		var min = new Array();
		var str = text.trim();
		min = str.split(" ");
		var parole = min.length;
				if (parole >= 11)
					{
						return false;
					}
				else
					{
						return true;
					}
	
	}
//GESTIONE DELLE DUE FRECCE DI NAVIGAZIONE VERTICALE
function gestUpDown()
	{
		var  alt = $(window).height();
		if ( alt < 700) {
				$(window).scroll(function() {
				if ($(this).scrollTop() > 200) {
					$('.go_up').fadeIn(200);
					$('.go_down').fadeOut(200);
				} else {
					$('.go_up').fadeOut(200);
					$('.go_down').fadeIn(200);
				}
				});
				$('.go_up').click(function(event) {
				event.preventDefault();
				$('html, body').animate({scrollTop: 120}, 600);
				});
				
				$('.go_up').attr("title", "vai al menu");
				$('.go_down').attr("title", "vai a fine pagina");
				
				$('.go_down').click(function(event) {
				event.preventDefault();
				$('html, body').animate({scrollTop: 800}, 1200);
				});
				}
	
	}

					
//ALERT	
function doAlert( testo, title, icon, time, al_width, al_height, close, fun )
	{
		if ( time == '' || time == 'undefined'|| time == undefined ) { time = 5000; }
		if ( title == '' || title == 'undefined' || title == undefined ) { title = 'avviso'; }
		if ( al_width == '' || al_width == 'undefined'|| al_width == undefined ) { al_width = 230; }
		if ( al_height == '' || al_height == 'undefined'|| al_height == undefined) {al_height = 120;}
		if ( close == '' || close == 'undefined'|| close == undefined ) { close = false; }
		if ( fun == '' || fun == 'undefined'|| fun == undefined ) { fun = ''; }
		
		if ( ( icon == '' || icon == 'undefined'|| icon == undefined ) && icon != false) 
			{
				icon = 'alert'; 
			}
		var icon_text = '<span class="ui-icon ui-icon-bianca ui-icon-' + icon + '" style="float:left; margin:0 7px 20px 0;"></span>';
		//	se icon settato a false leva icona dalla finestra di dialogo
		if ( icon == false )
			{
				icon_text = '';
			}
		var dialogText = '<div id="dialog-confirm" title="' + title + ' - Control Panel"><p>' + icon_text + testo + '</p></div>';
		
		$ ( '#message_box' ).html(dialogText);
		$( '#dialog-confirm' ).dialog({
			closeButton: close,
			open: function() {
					setTimeout(chiudiDialog, time);
							},
			width: al_width,
			height: al_height,
			draggable: false,
			resizable: false,
			modal: true,
			general_background: colors[0],
			activity_border: colors[2],
			testata: colors[2],
			inchiostro_pannelli: colors[4],
			overlay_color: "#686868",
			border: "2",
			show: 800,
			hide: 800
							});
							
					function chiudiDialog()
						{
							$( '#dialog-confirm' ).dialog("close");
							$ ( '#message_box' ).html('');
							//  FUNZIONE DI CALLBACK ALLA CHIUSURA
								if ( fun )
									{
										eval (fun);
									}

						}
		
	}

	
	
function doDialog(testo, title, icon, button, callback)
	{
		if (title == '' || title == 'undefined') {title = 'avviso';}
		if (icon == '' || icon == 'undefined') {icon = 'alert';}
		var dialogText = '<div id="dialog-confirm" title="' + title + ' - Control Panel"><p><span class="ui-icon ui-icon-bianca ui-icon-' + icon + '" style="float:left; margin:0 7px 20px 0;"></span>' + testo + '</p></div>';
		
		$ ( '#message_box' ).html(dialogText);
		var dialogBox = $( '#dialog-confirm' ).dialog({
			closeButton: true,
			draggable: false,
			resizable: false,
			modal: true,
			general_background: colors[0],
			activity_border: colors[2],
			testata: colors[2],
			inchiostro_pannelli: colors[4],
			overlay_color: "#686868",
			border: "2",
			show: 800,
			hide: 800
							});
						
					function chiudiDialog()
						{
							$( '#dialog-confirm' ).dialog("close");
							$ ( '#message_box' ).html('');
						}
		
	}

function doDialogRestore(testo, title, icon)
	{
		if (title == '' || title == 'undefined') {title = 'avviso';}
		if (icon == '' || icon == 'undefined') {icon = 'alert';}
		var dialogText = '<div id="dialog-confirm" title="' + title + ' - Control Panel"><p><span class="ui-icon ui-icon-bianca ui-icon-' + icon + '" style="float:left; margin:0 7px 20px 0;"></span>' + testo + '</p></div>';
		
		$ ( '#message_box' ).html(dialogText);
		var dialogBox = $( '#dialog-confirm' ).dialog({
			closeButton: true,
			draggable: false,
			resizable: false,
			modal: true,
			buttons: {
						"Annulla": function()
										{
												chiudiDialogBox();
										},
						"Elimina": function()
										{
												var nome_file = $( '#dialog-confirm .selected_bu').attr("name");
												chiudiDialogBox();
												deleteBackup(nome_file);
										},
						"Restore": function()
										{
												var nome_file = $( '#dialog-confirm .selected_bu').attr("name");
												chiudiDialogBox();
												backUp('restore', nome_file);
										}
					},		// END BUTTONS
						
			general_background: colors[0],
			activity_border: colors[2],
			testata: colors[2],
			inchiostro_pannelli: colors[4],
			overlay_color: "#686868",
			border: "2",
			show: 800,
			hide: 800
							});
		
	}

function chiudiDialogBox()
						{
							$( '#dialog-confirm' ).dialog("close");
							$ ( '#message_box' ).html('');
						}
			
//CENTRATURA IMMAGINE
function anteprima()
	{
		var alt = $( '#foto' ).height();				//altezza immagine
		var largh = $( '#foto' ).width();			//larghezza immagine
		var alt_cont = $( '#box_img' ).height();		//altezza contenitore
		var largh_cont = $( '#box_img' ).width();	//larghezza contenitore
		$( '#image' ).css("height", alt + "px");
		$( '#image' ).css("max-width", largh + "px");
		$( '#image' ).css("margin-left", "auto");
		//alert(largh + '\n' + alt);
	}

function creaOverlay()
	{
		var overlay = $("<div>");
		overlay.attr("id", "overlay");
		overlay.addClass("alert_overlay");
		overlay.appendTo( "body");
	}
	
function destroyOverlay()
	{
		$( '#overlay' ).remove();
	}
	
	
function caricaGuest(sFunction)
	{
		$(".waiting_guest").css("display", "block");
		var boxTxt = $("#box_view");
		boxTxt.load('show.guest.php?function=' + sFunction, function() {
						$(".waiting_guest").fadeOut(800);
							});
	}
	
function ordingData(sFunction)
	{
	var boxTxt = $("#box_view");
	$(".waiting_guest").css("top", "20px");
	$(".waiting_guest").css("display", "block");
	boxTxt.load('show.guest.php?function=' + sFunction, function() {
						$(".waiting_guest").css("display", "none");	
							});
										
	}
// funzioni dei check-box [seleziona] e [deseleziona]		
function seleziona(n)
	{
		//alert (n);
		var num_selettori = $ ( "[type='checkbox']" ).length;
					for (i = 1; i <= num_selettori; i++)
						{
							if (n != i)
								{
									$( '#spunta_'+i ).prop("checked", false);
									$( '#riga_' + i).removeClass("highlight_row");
									//$( '#' + i).css("background", "");
								}
						}
					$( '#spunta_'+ n ).prop("checked", true);
					$( '#riga_' + n).addClass("highlight_row");
					$( '#desel' ).removeAttr("disabled");
					$( '#elim' ).removeAttr("disabled");
					var id = $( '#spunta_'+ n ).val();
					$( '#id_post' ).val(id);// carica indice in input hidden [guest-book.php]
					//alert (n);
					
	
	}
	
function deseleziona()
		{
			var num_selettori = $ ( "[type='checkbox']" ).length;
					for (i = 1; i <= num_selettori; i++)
						{
									$( '#spunta_'+ i ).prop("checked", false);
									$( '#riga_' + i).removeClass("highlight_row");
						}
					$( '#desel' ).attr("disabled", true);
					$( '#elim' ).attr("disabled", true);
					
		}
		

function loadSpins()
	{
		var show_s = $( '.show_spin' );
		var spins = show_s.length;
		for (i = 0; i <= (spins - 1); i++)
			{
				divName = $(show_s[i]).attr("id");
				prepareSpin(divName);
			}

	}
		
function prepareSpin(divName)
	{
		var temp_colors = $( '#colori' ).text();
		var colors = temp_colors.split(",");
		opts = {
							lines: 13, // The number of lines to draw
							length: 12, // The length of each line
							width: 6, // The line thickness
							radius: 18, // The radius of the inner circle
							corners: 1, // Corner roundness (0..1)
							rotate: 0, // The rotation offset
							direction: 1, // 1: clockwise, -1: counterclockwise
							color: colors[4], // colore prelevato dai predefiniti (inchiostro_pannelli)
							speed: 1, // Rounds per second
							trail: 50, // Afterglow percentage
							shadow: true, // Whether to render a shadow
							hwaccel: true, // Whether to use hardware acceleration
							className: 'spinner', // The CSS class to assign to the spinner
							zIndex: 100, // The z-index (defaults to 2000000000)
							//top: 'auto', // Top position relative to parent in px
							left: 'auto' // Left position relative to parent in px
							};
			var target = document.getElementById(divName);
			var spinner = new Spinner(opts).spin(target);
	}

function prepareOptSpin(divName)
	{
		var temp_colors = $( '#colori' ).text();
		var colors = temp_colors.split(",");
		opts = {
							lines: 13, // The number of lines to draw
							length: 12, // The length of each line
							width: 6, // The line thickness
							radius: 18, // The radius of the inner circle
							corners: 1, // Corner roundness (0..1)
							rotate: 0, // The rotation offset
							direction: 1, // 1: clockwise, -1: counterclockwise
							color: colors[4], // colore prelevato dai predefiniti (inchiostro_pannelli)
							speed: 1, // Rounds per second
							trail: 50, // Afterglow percentage
							shadow: true, // Whether to render a shadow
							hwaccel: true, // Whether to use hardware acceleration
							className: 'spinner', // The CSS class to assign to the spinner
							zIndex: 100, // The z-index (defaults to 2000000000)
							top: 120, // Top position relative to parent in px
							left: 'auto' // Left position relative to parent in px
							};
		var target = document.getElementById(divName);
		var spinner = new Spinner(opts).spin(target);
	}

function startIsotope()
	{

		
		 $.Isotope.prototype._getCenteredMasonryColumns = function() {
    this.width = this.element.width();
    
    var parentWidth = this.element.parent().width();
    
                  // i.e. options.masonry && options.masonry.columnWidth
    var colW = this.options.masonry && this.options.masonry.columnWidth ||
                  // or use the size of the first item
                  this.$filteredAtoms.outerWidth(true) ||
                  // if there's no items, use size of container
                  parentWidth;
    
    var cols = Math.floor( parentWidth / colW );
    cols = Math.max( cols, 1 );

    // i.e. this.masonry.cols = ....
    this.masonry.cols = cols;
    // i.e. this.masonry.columnWidth = ...
    this.masonry.columnWidth = colW;
	
  };
  
  $.Isotope.prototype._masonryReset = function() {
    // layout-specific props
    this.masonry = {};
    // FIXME shouldn't have to call this again
    this._getCenteredMasonryColumns();
    var i = this.masonry.cols;	
    this.masonry.colYs = [];
    while (i--) {
      this.masonry.colYs.push( 0 );
    }
  };

  $.Isotope.prototype._masonryResizeChanged = function() {
    var prevColCount = this.masonry.cols;
    // get updated colCount
    this._getCenteredMasonryColumns();
	
    return ( this.masonry.cols !== prevColCount );
  };
  
  $.Isotope.prototype._masonryGetContainerSize = function() {
    var unusedCols = 0,
        i = this.masonry.cols;
    // count unused columns
    while ( --i ) {
      if ( this.masonry.colYs[i] !== 0 ) {
        break;
      }
      unusedCols++;
    }

    return {
          height : Math.max.apply( Math, this.masonry.colYs ),
          // fit container to columns that have been used;
          width : (this.masonry.cols - unusedCols) * this.masonry.columnWidth
        };
  };

		var $container = $('#main_content');
		var class_obj = '.box_cp';
		launchIso();
		

		
		$( '#btn_test.close' ).click(function()
				{
					var parent_div = $(this).parent();
					var box = parent_div.parent();
					$(box).fadeOut(200);
					launchIso();
					
				});

			

		function launchIso()
			{
				
				$container.isotope({
				itemSelector : class_obj,
				masonry : {
								columnWidth : 10
							},
				masonryHorizontal : {
								rowHeight: 0
									}
				});
				//if (o){$(o).scrollView();}
			}
			

		// vai infondo alla pagina
		$.fn.scrollView = function () {
					return this.each(function () {
					//preleva attributi ed esegui callback
					var all = Math.floor($( '#main_content' ).height());
					var top = Math.floor($(this).offset().top);
					top = top + all;
					$('html, body').animate({
							scrollTop: top
											},1000);
													});
		}


		
}		

