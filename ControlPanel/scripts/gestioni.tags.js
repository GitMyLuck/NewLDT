max_number = 6;

/*************************************************************************************/
/*********************** FUNZIONI DEDICATE AL BOX TAGS *******************************/
/*************************************************************************************/	
function caricaTags()
	{
				//carica i tag della notizia nel box
				var uri = 'elenco.tags.php?id=' + id_notizia + '&funct=' + funzione_pagina + '&sheet=' + nome_pagina;
				var boxTxt = $("#cont_tags");
				boxTxt.load(uri);		//no callback function
				//alert ('gestioni tags');
	}

function gestTags()
	{
		doPage( 'elenco.tags.fissi.php?sheet=' + nome_pagina);
		return;
			
	}

function clickAddTag(tag)
	{
		var tags = new Array();
		var temp = new Array();
		var singoloTag;
		var elencoTags = $("#risultato li");
		var lenTags = (elencoTags.length) - 1;
			//raggruppa tag struttura in un array
				for (t = 0; t <= lenTags; t++)
			{
				singoloTag = elencoTags[t].textContent;
				temp = tags.push(singoloTag);
			}
				// controlla se tag che viene inserito esiste gia'
				var search = tags.indexOf(tag);
				// crea variabile che controlla se e' stato raggiunto il numero massimo
				counter = tags.length;
				if (search == -1 && counter < max_number)
					{
						// aggiungi nuovo tag
						temp = tags.push(tag);
						// riducilo in stringa
						tagString = (tags.join(",")) + ",";
						var dati = 'tags=' + tagString + '&id=' + id_notizia + '&sheet=' + nome_pagina;
						// function doMess( type, text, subTitolo, time, callback )
						doMess('alert', '<b>Tag : "' + tag + '"</b> <br />aggiunto con successo...', 'salvataggio', 2000, '');
						//invialo
						sendTag(dati);

					}		//end if controllo doppione
				else if (search > -1)
					{
						doAlert('tag già esistente !', 'messaggio', 'alert', 2000);
					}
				else if (counter >= max_number)
					{
						doAlert('numero max raggiunto !', 'messaggio', 'alert', 2000);
					}

	}

function clickDelTag(tag)
	{	
		var tags = new Array();
		var temp = new Array();
		var singoloTag;
		var elencoTags = $("#risultato li");
		var lenTags = (elencoTags.length) - 1;
			//raggruppa tag struttura in un array
				for (t = 0; t <= lenTags; t++)
			{
				singoloTag = elencoTags[t].textContent;
				temp = tags.push(singoloTag);
			}
		var searchVal = tags.indexOf(tag);
		tags.splice(searchVal,1);
		tagString = (tags.join(",")) + ",";
		var dati = 'tags=' + tagString + '&id=' + id_notizia + '&sheet=' + nome_pagina;
		doAlert('<b>Tag : "' + tag + '"</b> <br />eliminato con successo...', 'salvataggio', 'alert', 2000);
		//invialo
		sendTag(dati);
		//alert (tagString);


	}


function sendTag(dati)
		{
		
			//-------------CHIAMATA AJAX--------------------------//
        $.ajax({
					url: "data.update.php", 
					type: "POST",
					data: dati,
					dataType: "html",
					success: function() { 
												var uri = 'elenco.tags.php?id=' + id_notizia + '&funct=' + funzione_pagina + '&sheet=' + nome_pagina;
												var boxTxt = $("#cont_tags");
												boxTxt.load(uri);
										}
				});			//fine $ajax*/
				//-------------CHIAMATA AJAX--------------------------//


		}
		
function clickSubTag(tag)
		{
				 $.ajax({
					url: "php/delete.tag.php", 
					type: "POST",
					data: 'tag=' + tag + '&page=' + nome_pagina,
					dataType: "html",
					success: function(results) { 
												$( '#dialog-confirm' ).load( 'elenco.tags.fissi.php?sheet=' + nome_pagina );
												alert( ' " ' + tag + ' " eliminato\n   con successo\n   dal database') ;
														}
						});			//fine $ajax*/
				
		}		////  END  OF  FUNCTION 
		
function spedisciTag(modulo)
		{
			var nome = modulo.attr("name");
			var input_obj = modulo.children(0);	//istanzia l'oggetto input immediatamente dopo il form
			var text = input_obj.val();			//e poi il contenuto
			var dati = 'tag=' + text + '&page=' + nome_pagina;
			$.ajax({
					url: "php/add.tag.php", 
					type: "POST",
					data: dati,
					dataType: "html",
					success: function(results) {
												doMess( 'alert', text + ' " inserito\n   con successo\n   nel database', '', 5000, 'refPage();') ;
												//refPage();
														}
						});			//fine $ajax*/
		
		}
