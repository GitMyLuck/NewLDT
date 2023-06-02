

/*************************************************************************************/
/********************* FUNZIONI DEDICATE ALLE IMMAGINI  MULTIPLE*******************************/
/*************************************************************************************/	
function caricaThumb()
	{
		var box = $( '#show_image' );
		box.load('album.foto.php?id=' + id_notizia + '&sheet=' + nome_pagina + '&funct=' + funzione_pagina, 
					//CALLBACK FUNCTION
					function()
					{
						$('.show_spin').css("display", "none");
						// ONLY FOR DEBUG  =>
						//debugCall(results);
											});

	}

/*popola il box #box_image nella pagina main-varia.php per immagini multiple*/
function caricaMultiUpload(type, imgFunction, fileName)	
	{
		var box = $( '.immagini[id$="' + type + '"]' );
		box.load('./upload.multi.image.php?type=' + type + '&filename=' + fileName,
					//CALLBACK FUNCTION
						function() {
									gestBox();
									multiAction(type, imgFunction);
									caricaThumb();
									});
	}

/*popola il box #box_image nella pagina main.php  IMMAGINI MULTIPLE*/
function caricaMultiImg(type)					/*OK FOR*/
	{
		var box = $( '.immagini[id$="' + type + '"]' );
		box.load('./show.multi.image.php?id=' + id_notizia + '&sheet=' + nome_pagina + '&type=' + type + '&funzione_pagina=' + funzione_pagina,
			//CALLBACK FUNCTION
					function() {
								gestBox();
								$('.show_spin').css("display", "none");
								caricaThumb();
								});
	}


function deleteMultiImg(type, fileName)
	{
		var box = $( '.immagini[id$="' + type + '"]' );
		box.load('./delete.multi.image.php?filename=' + fileName + '&sheet=' + nome_pagina);
		
	}

/*popola i box #box_image nelle pagine main-varia.php e main-nuovo.php*/
function caricaMultiImgUpload(type, fileName)				/*OK FOR*/
	{

		var box = $( '.immagini[id$="' + type + '"]' );
		prepareSpin('wait_spin_eli');
		box.load('./attesa.php');
		var Timer = window.setTimeout(caricaImm, 600);
		function caricaImm()
		{
		box.load('./show.multi.image.php?id=' + id_notizia + '&sheet=' + nome_pagina + '&type=' + type + '&filename=' + fileName + '&funzione_pagina=' + funzione_pagina,
				//CALLBACK FUNCTION
					function() {
								gestBox();
								$("#wait_spin").css("display", "none");
								caricaThumb();
								// ONLY FOR DEBUG  =>
								/*$( '.box_cp' ).css("display", "none");
								$( '#main_content' ).css("background", "#ddd");
								$( '#main_content' ).html(results);*///<=
								});
		}
	}

/*			CARICAMENTO IMMAGINE TRAMITE PAGINA upload.process.php	*/
function multiAction(type, imgFunction)	
	{
		$('#button_carica').click(function(){
    var formData = new FormData($('#upload_form')[0]);

	var uri = 'upload.process.php?id=' + id_notizia + '&sheet=' + nome_pagina + '&function=' + imgFunction;
	//alert (uri);
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
									box.load('z-invio.php');
								},
        success: function (data) {
									var box = $( '.immagini[id$="' + type + '"]' );
									box.html("");
									box.html(data);
									//debugCall(data);
								},
        cache: false,
        contentType: false,
        processData: false
    });								//FINE CHIAMATA AJAX
});

}		//END SUBROUTINE

//invia didascalia dopo che la foto e' stata caricata
function spedisciImg(modulo)
	{
		
		var nome = modulo.attr("name");
		//alert (nome);
		
				var uri = "update.didascalia.php";			//cambiare pagina
				var did = modulo.serialize();		//serializzo il contenuto del form
				var dati = did + '&id=' + id_notizia + '&sheet=' + nome_pagina;
				//alert (dati);
				//****************************************************************************************************//
		//alert (dati);
		//doAlert('invio dati in corso...', 'salvataggio', 'alert', 3000);
				//-------------CHIAMATA AJAX--------------------------//
        $.ajax({
			url: uri,
            type: "POST",
            data: dati,
			dataType: "html",
			success: function(results) {
											nomeFile = results.substr(-27, 27);
											timer('img', 2000, nomeFile);
											caricaThumb();
											//debugCall(nomeFile);
										}
				});			//fine $ajax
				//-------------CHIAMATA AJAX--------------------------//*/
		modulo = '';								
}

//		FUNZIONE initCheck( $( 'div') )
//		funzione che serve per porre la foto  di $( 'div' ) come preferita
function initCheck (o)
		{
			//alert ('fatto');
							//azzera altri check-box
							//$( ".check-preferita"  ).removeAttr("checked");
							//$(o).prop("checked", "true");
							var nome = $(o).attr("name");
							var dati = 'nomefile=' + nome + '&id=' + id_notizia + '&sheet=' + nome_pagina;
							$.get('upload.img.preferita.php?' + dati, function(results)
											//CALLBACKFUNCTION
																{
																	caricaThumb();
																	//debugCall(results);
																});	//END LOAD FUNCTION
		}