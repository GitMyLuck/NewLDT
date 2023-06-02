var backup_content;
var colors = new Array();
var id_notizia, funzione_pagina, nome_pagina, sess_pagina, titolo_notizia;			//[funzione_pagina] = funzione della pagina (nuovo, varia, mostra)
var img_function;
var searchVal;					//valore del searchInput		(solo per la pagina main)
var adminGeneral; 				//valore del grado di admininistration
var flagRetry; 
/* funzioni caricate  con l'evento load	*/
function dis(id, funct, sheet, sessione, admin, titolo_, img_f)					/*OK FOR*/
	{
		$(document).ready( function() {
				startIsotope();												//(new.gestioni.js) loading Isotope®
				//gestUpDown();											//(new.gestioni.js) gestisci frecce su e giu
				gestBox();							//(gestioni.box.js) gestisce le aperture e chiusure dei box
				colors  =  ($( '#colori' ).text()).split(",");			//memorizza colori per alert

				//assegna variabili principali
				id_notizia = id;							//numero della news in esame
				funzione_pagina = funct;					//funzione della pagina (nuovo, varia, mostra)
				nome_pagina = sheet;				//nome della pagina in esame (es. ARTICOLI - NEWS - NOTIZIE ecc)
				sess_pagina = sessione;						//nome della sessione in corso...
				adminGeneral = admin;
				titolo_notizia = titolo_					//titolo breve della notizia in esame
				searchVal = $( '#search_index' ).text();		//prendi il testo dell'input search
				img_function = img_f						//variabile che indica il tipo di gestione delle immagini
																// 'multi' o 'single'
				boxStatus = 'closed';
				//fine variabili principali
				riempiMenu();								//popola il menu 
				startIstruzioni();								//inizializza istruzioni		[scripts/gestioni.help.js]
				
				//variabili secondarie
				loadSpins();									//(new.gestioni.js) carica le spins relative ai boxes
				// ELENCO DELLE NOTIZIE - CARICA SOLO NELLA MAIN-PAGE E SOLO SE AUTORIZZATO (admin 1 e sub-admin 2)
				if (  funct == 'mostra'  && admin < 3)
						{
							caricaMenuNotizie('');			//carica il menuNotizie		(fondo pagina)
						}
				caricaImmagine();							//carica immagini nel box_image e box_pdf
				if (img_function == 'multi')				//se img_function = multi allora carica thumbnails
						{
							caricaThumb();
						}
				caricaTags();								//carica il boxTags
				// prelevo valore cookies e lo metto in box_[nome_pagina]
				eval ( 'box_' + nome_pagina + ' = getCookieBox();');
					
				// ciclo apertura box
				startBoxOpening(funct);
				if (funct == 'varia' || funct == 'nuovo' )
					{
						// PREPARA IL PRIMO BOX DELLA PAGINA E APRILO
						var boxes = $( '.box_cp' );
						var boxIniziale = $(boxes).get(0);
						var testata = $(boxIniziale).children('.testata');		//ok 
						var arrow = $(testata).children('.arrow_down');
						abbassa($(arrow));
						if (funct == 'varia')
							{
								$(testata).html(titolo_notizia + "<div id='btn_test' class='freccia arrow_up'></div>");
							}
						else
							{
								$(testata).html("NEW ITEM<div id='btn_test' class='freccia arrow_up'></div>");
								
							}
						
						// PREPARA IL CALENDARIO
						var calendario = $( '.data_picker' );
						calendario.datepicker({
						showOn: "button",
						buttonImage: "./images/calendar.png",
						buttonImageOnly: true,
						duration: "normal",
						dateFormat: "dd/mm/yy"
											});		//end datepicker
						
							}		//end if
						// APRI TUTTI I BOX IN CASO LA PAGINA SIA MAIN-USER o VARIA-USER o NUOVO USER
						
						if ( nome_pagina === "user" || nome_pagina === "settings")
							{
								apriBox();
							}
					
					});		//end ready function
	}




/*************************************************************************************/
/******************* FUNZIONI DEDICATE ALL'IMMAGINE ED AL PDF ************************/
/*************************************************************************************/
function caricaImmagine()
		{
			var class_num = $( '.immagini' ).length;			//numero di box dedicati alle immagini
			for (i = 1; i <= class_num; i++)
				{
					var indice = i - 1;
					var id_t = $( '.immagini' );
					var id_n = $(id_t[indice]).attr("id");		//id dei box appartenenti alla classe 'immagini'
					var id_type = id_n.substr(-3, 3);			//ricava dall'id il type dell'immagine
					var superFunzione = funzione_pagina + '_' + img_function;
					switch(superFunzione)
						{
								case 'mostra_single' :
									caricaImg(id_type);
									break;

								case 'mostra_multi' :
									caricaMultiImg(id_type);
									break;

								case 'varia_single' :
									caricaImgUpload(id_type);
									break;

								case 'varia_multi' :
									caricaMultiImgUpload(id_type);
									break;
									
								case 'nuovo_single' :
									caricaImgUpload(id_type);
									break;

								case 'nuovo_multi' :
									caricaMultiImgUpload(id_type);
									break;
						}
				}
		}
	/*popola il box #box_image nella pagina main-varia.php per immagini singole*/
function caricaUpload(type)				/*OK FOR*/
	{
		var box = $( '.immagini[id$="' + type + '"]' );
		box.load('./upload.multi.image.php?type=' + type,
			// CALLBACK FUNCTION
					function() {
						gestBox();
						action(type);
								});
	}


	/*popola il box #box_image nella pagina main.php*/
function caricaImg(type)					/*OK FOR*/
	{
		var box = $( '.immagini[id$="' + type + '"]' );
		box.load('./show.image.php?id=' + id_notizia + '&sheet=' + nome_pagina + '&type=' + type + '&funzione_pagina=' + funzione_pagina,
				//CALLBACK FUNCTION
					function() {
								gestBox();
								$('.show_spin').css("display", "none");
								});
	}
/**	------------------------------------------- **/
/**		BUON COMPLEANNO SMARTA.....**/
/** ------------------------------------------- **/
/*		    SALUTONI  A  TUTTI  GIOVANNI              */

function deleteImg(type)					/*OK FOR*/
	{
		var box = $( '.immagini[id$="' + type + '"]' );
		box.load('./delete.image.php?id=' + id_notizia + '&sheet=' + nome_pagina + '&type=' + type,
					//CALLBACK Function	
					function(results)
						{
							//debugCall(results);
						});
		
	}


/*popola i box #box_image nelle pagine main-varia.php e main-nuovo.php*/
function caricaImgUpload(type)				/*OK FOR*/
	{
		var box = $( '.immagini[id$="' + type + '"]' );
		box.load('./show.multi.image.php?id=' + id_notizia + '&sheet=' + nome_pagina + '&type=' + type + '&funzione_pagina=' + funzione_pagina, 
				//CALLBACK FUNCTION
					function() {
								gestBox();
								$("#wait_spin").css("display", "none");
								});
	}


function timer(type, time, filename) /*timer richiamato da upload.process.php per ritornare a visualizzare immagine*/									
	{
		if (!time){var time = 8000;}
		var timerMessage = window.setTimeout (mostra, time);
					function mostra() 
						{
							if (img_function == 'multi' && type ==='img')
								{
									//MULTI IMMAGINE
									caricaMultiImgUpload(type, filename);
								}
							else
								{
									caricaImgUpload(type);
								}
						}
	}

/*			CARICAMENTO IMMAGINE	(SOLO PER IMMAGINE SINGOLA)	*/
function action(type)	/*funzione che gestisce upload dell'immagine//OK FOR*/
	{
		$('#button_carica').click(function(){
    var formData = new FormData($('#upload_form')[0]);

	var uri = 'upload.process.php?id=' + id_notizia + '&sheet=' + nome_pagina;
	if (type == 'pdf')
		{
			var uri = 'upload.process.pdf.php?id=' + id_notizia + '&sheet=' + nome_pagina;
		}
    $.ajax({							//CHIAMATA AJAX ASINCRONA PER CARICARE IMMAGINE
        url: uri, 
        type: 'POST',
		data: formData,
		async: false,
        /*Ajax events*/
        beforeSend: function() {
									var box = $( '.immagini[id$="' + type + '"]' );
									box.load('z-invio.php?type=' + type);
								},
        success: function (data) {
									var box = $( '.immagini[id$="' + type + '"]' );
									box.html("");
									box.html(data);
								},
        cache: false,
        contentType: false,
        processData: false
    });								//FINE CHIAMATA AJAX
});
								
								
	}

/*************************************************************************************/
/******************* FUNZIONI DEDICATE AI DATI TIPO TEXT *****************************/
/*************************************************************************************/	
//spedisci moduli separatamente con tasto [INVIA]  PAGINE NORMALI
function spedisci(modulo)
	{
		
		var nome = modulo.attr("name");
		//alert (nome);
		
				var uri = "data.update.php";
				var input_obj = modulo.children(0);	//istanzia l'oggetto input immediatamente dopo il form
				var attr = input_obj.attr("name");	//preleva da esso l'attributo "name"
				//alert (attr);
				var text = input_obj.val();			//e poi il contenuto
				//eccezione campo Google-Maps
				//***************************************************************************************************//
						if (attr == 'embed' )
								{
									var new_text = googleUrl(text);
									var dati = attr + '=' + new_text + '&id=' + id_notizia + '&sheet=' + nome_pagina;
								}
				//eccezione campo luoghi - comuni - valle
				//***************************************************************************************************//
						else if (attr == 'luoghi' )
								{
									//  salta a eccLuoghi (eccezioni.valle.js) per invio di questo campo,
									//  del campo 'comune' e del campo 'valle'
									eccLuoghi(modulo);
									return;
								}
				//eccezione campo
						else 
								{
									var dati = attr + '=' + text + '&id=' + id_notizia + '&sheet=' + nome_pagina;
								}
				//****************************************************************************************************//
		//debugCall(dati);
		//return;
		doMess( 'info','hai variato : <b> ' + attr +'</b><br />invio dati in corso...', 'salvataggio', 5000, 'relThis();');
				//-------------CHIAMATA AJAX--------------------------//
        $.ajax({
			url: uri, /* pagina di destinazione dei dati */
			type: "POST",
			data: dati,
			dataType: "html",
			success: function() {
						//debugCall(results);
						//location.reload();
										}
				});			//fine $ajax
				//-------------CHIAMATA AJAX--------------------------//
		modulo = '';
	
}
	
		
function inviaNotizia()
		{
		var bind = true;
		var cont = true;
		cont = getContent();			// controlla campi input deve essercene almeno uno pieno
										//[scripts/gestioni.bindings.js]
											
		bind = getBindings();		// controlla campi obbligatori [scripts/gestioni.bindings.js]

											
		//alert ( error );
		if ( cont && bind ) 
						{
							var dataUri = 'page.varia.php';
							
							dataModulo = $(".modulo_completo").serialize();
							var embed = '';
							data = dataModulo + embed + '&id=' + id_notizia + '&sheet=' + nome_pagina + '&funzione=save';
							//data = encodeURIComponent(dataTemp);
							sendData(data, dataUri);
							//debugCall(data);
							//alert ('Notizia Pubblicata');
							return;
						}
		else	
						{
							//  almeno un campo compilato ma non uno di quelli obbligatori
							if ( cont && !bind)
								{
									var lenBinds = (bindCells.length) - 1;
									$this_input = $( '#' + bindCells[lenBinds] );
									$this_input_id = $($this_input).attr("id");
									doMess('error','Impossibile pubblicare notizia...<br />' + bindCellsCont[lenBinds] , 'errore', 4000,'focusTo(\'' + $this_input_id + '\');');
									$this_input.addClass("error_input");
									return;
								}
							//	neanche un campo compilato...
							else if ( !cont )
								{
									doMess('error','Impossibile pubblicare notizia...<br />inserire almeno un campo!', 'errore', 4000);
									return;
								}
						}
						
		}
		
		
function sendData(data, dataUri)
		{
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
								flagRetry = true;
								annullaIns(flagRetry);
								//ONLY FOR DEBUG =>
								//debugCall(results);
								//<= END DEBUG
								
							}
						else
							{
								doAlert('dati non inviati...<br /> Si e\' verificato un problema','','',2000);
								setTimeout(function()
										{
												showButtons();
												flagRetry = false;
												annullaIns(flagRetry);
												//ONLY FOR DEBUG =>
												//debugCall(results);
												//<= END DEBUG
										},3000);

							}
					//alert(results);
											},		//end of success function
			error: function() {
					alert ('errore');
								}
			});	
}
	


function annullaIns(flagRetry)
	{
		//alert(sess_pagina);
		if (flagRetry == '' || flagRetry == 'undefined' || flagRetry == undefined)
			{
				flagRetry = false;
			}
			
		if ($( '#btn_annulla' ).css("visibility") === "hidden")
			{
				flagRetry = true;
			}
			
		var message = 'Annullo tutte le modifiche ...';
		if (flagRetry == true)
			{
				message = 'Dati pubblicati <br /> correttamente...';
				id_notizia--;
			}
			
		var urlDest = 'pseudo.main.php?login=' + sess_pagina + '&page=' + id_notizia + '&sheet=' + nome_pagina;
		//doMess('alert', message, 'salvataggio', 4000);
			if (flagRetry == false)			//controlla se stai uscendo oppure annullando
				{
				//caso in cui stiamo uscendo senza confermare
					/*cancella tutti i campi input*/
					$(":input").val("");
					/*elimina immagine, se presente */
					type = 'img';
					$( '#service' ).load('annulla.image.php?login=' + sess_pagina + '&page=' + id_notizia + '&sheet=' + nome_pagina + '&type=' + type,
							//CALLBACK FUNCTION
									function() {
															callBackFun(type);
															// ONLY FOR DEBUG  =>
															/*$( '.box_cp' ).css("display", "none");
															$( '#main_content' ).css("background", "#ddd");
															$( '#main_content' ).html(results);*///<= END DEBUG
														});
					type = 'pdf';
					$( '#service' ).load('annulla.image.php?login=' + sess_pagina + '&page=' + id_notizia + '&sheet=' + nome_pagina + '&type=' + type, function() {callBackFun(type);});
					
				}		//end of if flagretry == false

			else	
				{
						//caso di conferma
						callBackFun('img');
						callBackFun('pdf');
						location.href = urlDest;
				}		//end of else
			
			function callBackFun(type)
				{
					( img_function == 'single' )?caricaImg(type):caricaMultiImg(type);
					tornaIndietro();
				}

			
			function tornaIndietro()
				{
						$( '.box_cp' ).css("display", "none");
						var frase = '<center><h2>Salvataggio in corso...</h2></center>';
						if ( flagRetry == false)
							{	
								frase = '<center><h2>Annullamento in corso...</h2></center>';
								id_notizia --;
							}
						$( '#main_content' ).html( frase);
						urlDest = 'pseudo.main.php?login=' + sess_pagina + '&page=' + id_notizia + '&sheet=' + nome_pagina;
						var timerMessage = window.setTimeout (mostra, 600);
									function mostra() 
										{
											location.href = urlDest;
										}
				}
				
				
	}

function relThis()
	{
			location.reload();
	}
	
function doConferma()
	{
		var oggetto = '';
		switch ( nome_pagina ) {
								case 'strutture':
								oggetto = "struttura";
								break;
								case 'eventi':
								oggetto = "evento";
								break;
								default:
								oggetto = 'notizia';
								}
		var testo = 'Sei proprio sicuro di voler eliminare<br /><b> ' + oggetto + ' n. ' + id_notizia +  ' <font  class="dialog_data">" ' + titolo_notizia + ' "</font></b><br />dalla pagina ' + nome_pagina  + ' ?';
		var dialogText = '<div id="dialog-confirm" title="Elimina' + oggetto + '"><p><span class="ui-icon ui-icon-bianca ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>' + testo + '</p></div>';
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
				"Annulla": function() {
					$( this ).dialog( "close" );
					},
				"Elimina": function(results) {
					var uri = 'delete.news.php?login=' + sess_pagina + '&page=' + id_notizia + '&sheet=' + nome_pagina;
					$( '.box_cp' ).css("display", "none");
					prepareOptSpin('main_content');
					location.href = (uri);
					// ONLY FOR DEBUG  =>
					//debugCall();
					//<= END DEBUG
					$( this ).dialog( "close" );
					}
					}
		});		//fine Dialog
	
	}

//-----------------   APRI-CHIUDI ELENCO NOTIZIE -------------------------------------// 
//------------------------------------------------------------------------------------// 
function caricaMenuNotizie(searchVal)
	{
		
		$( '#menu_notizie' ).attr("width", "350px");
		get_data = '?sheet=' + nome_pagina + '&index=' + id_notizia + '&search=' + searchVal;
		//alert (searchVal);
		uri = 'php/menu.notizie.php' + get_data;
		// CAMBIA INDIRIZZO IN CASO SIA CHIAMATA LA PAGINA  'USER'
		(nome_pagina === 'user')? uri = 'php/menu.user.php' + get_data:uri;
		$( '#menu_notizie' ).load(uri, 
				//CALLBACK FUNCTION
						function()
									{
										gestBoxSearch();
										initSearch();
										$( '#wait_spin_search' ).css("display", "none");
										$( '#search_index' ).val("");
										//alert ( 'searchVal passato : ' + searchVal);
										if ( !searchVal )
											{
												var selectBox = $( '.selected' );
												var offsetScroll = (selectBox[0].offsetTop) - 120;
												$('#menu_notizie').animate({scrollTop: offsetScroll}, 1000);
												return;
											}
										else if (searchVal === 'serdab')			//VAI ALLA DATA ODIERNA
											{
												var selection = vaiAData();
												var offsetScroll = (selection.offsetTop) - 120;
												$('#menu_notizie').animate({scrollTop: offsetScroll}, 1000);
												return;
											}
										else if (searchVal === 'nefer')			//VAI ALL'ULTIMO INDICE
											{
												var selectBox = $( '#last' );
												var offsetScroll = (selectBox[0].offsetTop) - 120;
												$('#menu_notizie').animate({scrollTop: offsetScroll}, 1000);
												return;
											}
											// effettua scroll fino all' evento selezionato
										
										
									});
	}

function vaiAData()
	{
		var todayDate = getTodayDate();
		var selectBox = $( '[name="' + todayDate + '"]' );
		var selection = selectBox[0];
		return selection;

	}
	
function getTodayDate()
	{
		var d = new Date();
		var giorno = d.getDate();
		(giorno <= 9) ? giorno = '0' + giorno : giorno;
		var mese = (d.getMonth() + 1);
		(mese <= 9) ? mese = '0' + mese : mese;
		var todayDate = giorno + '/' + mese + '/' + d.getFullYear();
		return todayDate;
	}



function initSearch()
	{
							/*$( '#search_index' ).change(function()
								{
									searchVal = $('#search_index').val();
									caricaMenuNotizie(searchVal);
									$( this ).unbind("change");
								});*/
							$( '#search_button' ).click(function()
								{
									searchVal = $('#search_index').val();
									caricaMenuNotizie(searchVal);
									searchVal = '';
									$('#menu_notizie').animate({scrollTop: 0}, 1000);
									$( this ).unbind("click");
								});
							$( '#refresh_button' ).click(function()
								{
									caricaMenuNotizie('');
									searchVal = '';
									$( this ).unbind("click");
								});
							/*$( '#date_button' ).click(function()
								{
									caricaMenuNotizie('serdab');
									searchVal = '';
								});*/
							$( '#last_button' ).click(function()
								{
									caricaMenuNotizie('nefer');
									searchVal = '';
									$( this ).unbind("click");
								});

	}

//-----------------  FINE   APRI-CHIUDI ELENCO NOTIZIE -------------------------------// 
//------------------------------------------------------------------------------------// 

		function googleUrl(testo) 
{
	var newTesto = '';
	var lenTesto = testo.length;
	if (lenTesto > 0)
		{
			var parzText = testo.substr(0, 2);
			if (parzText != 'pb')
				{
					// Preleva le variabili passate con il $_GET[''] di GoogleMaps
					var start = (testo.search(/\?/)) + 1;
					var url_text = testo.substring(start, lenTesto);
					var end = url_text.indexOf('"');
					newTesto = testo.substr(start, end);
					//alert (newTesto);
				}
			else
				{
					newTesto = testo;
				}
		}
	else
		{
			newTesto = testo;
		}
	return newTesto;
}

//---------------------------------  STATISTIC FUNCTION  ---------------------------------// 
//------------------------------------------------------------------------------------// 
function showStat()
	{
		$('#service').html("");
		$('#service').load('php/show.dati.statistici.php?sheet=' + nome_pagina,
				//CALLBACK FUNCTION 
				function(results)
					{
						var message = results.trim();
						doDialog(message, '', 'alert');
					
					//debugCall(results);
					});
	
	}



//---------------------------------  STATISTIC FUNCTION  ---------------------------------// 
//------------------------------------------------------------------------------------// 

//---------------------------------  BACK-UP FUNCTION  ---------------------------------// 
//------------------------------------------------------------------------------------// 
// serve sia per il back-uu che per il restore
function backUp(fun, file)
	{
		var nomeFile = '';
		(file == '' || file == 'undefined' || file == undefined)?nomeFile = '':nomeFile = '&file=' + file;
		(fun == 'restore')?doDialog(fun + ' in corso...', '', 'alert', ''):doAlert(fun + ' in corso...', '', 'alert', 16000);
		$('#service').load('php/back_up_db.php?function=' + fun + '&sheet=' + nome_pagina + nomeFile,
				//CALLBACK FUNCTION
				function(results)
					{
						chiudiDialogBox();
						var message = results.trim();
						var eof = message.substr(-6, 6);
						if( eof == '</div>')
							{
								doDialog(message, '', 'alert');
							}else{
								doAlert(message, '', 'alert', 3000);
								location.href = 'pseudo.main.php?login=' + sess_pagina + '&page=' + id_notizia + '&sheet=' + nome_pagina;
							}
						
						//debugCall(results);
					});
		}
/******************  		DELETE BACK-UP  		******************************************/	
function deleteBackup(nome_file)
	{
		doAlert('eliminazione back-up\nin corso...', '', 'alert', 16000);
		$('#service').html("");
		$('#service').load('php/delete.backup.php?sheet=' + nome_pagina + '&file=' + nome_file,
					//CALLBACK FUNCTION 
					function(results)
						{
							chiudiDialogBox();
							var message = results.trim();
							doAlert(message, '', 'alert', 5000);
						//debugCall(results);
						});
		
	}
	
/******************  		SELECT  BACK-UP  		******************************************/	
	
function selectBackUp(o)
	{
		var nome_file = o.attr("name");
		var index = o.attr("id");
		var len_li = ($( 'ul#elenco li' ).length)/2;
			//dopo il click pulisci tutte le eventuali selezioni
			//in maniera che la selezione sia unica
			for (i = 0; i <= len_li; i++)
				{
					$( 'ul#elenco li' ).removeClass("selected_bu");
					$( 'ul#elenco li' ).addClass("elenco_bu");
				}
		// cambia la classe del <li> selezionato
		o.removeClass("elenco_bu");
		o.addClass("selected_bu");
		// elimina la possibilità di selezionare gli altri <li>
		// ed elimina da tutto l'elenco la possibilità del click
		for (i = 0; i <= len_li; i++)
				{
					var li = $( '#dialog-confirm #bu_contents #' + i );
					li.attr('onclick','').unbind('click');
					if (i != index)
						{
					li.removeClass("elenco_bu");
					li.addClass("bu");
						}
				}
		backup_content = $( '#dialog-confirm #bu_contents' ).html();
		chiudiDialogBox();
		doDialogRestore(backup_content, 'RESTORE', 'alert');
		//alert (backup_content);
	}
		
//-------------------------  DEBUG FUNCTION  ---------------------------------// 
//------------------------------------------------------------------------------------// 

function debugCall(results)
	{
		//ONLY FOR DEBUG =>
			$( '.box_cp' ).css("display", "none");
			$( '#main_content' ).css("background", "#555");
			$( '#main_content' ).css("overflow", "scroll");
			$( '#main_content' ).html(results);
		//<= END DEBUG

	}