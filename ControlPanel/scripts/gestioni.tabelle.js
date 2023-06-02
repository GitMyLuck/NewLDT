
function gestTabella( )
	{
		// l'indirrizzo deve puntare ad una pagina che crea una <table>
		// con i dati esistenti nella tabella indicata da @global[ nome_pagina ]
		doPage( 'elenco.dati.fissi.php?sheet=' + nome_pagina);
		return;
	}
	
function addValue(tabella, campo)
	{
		if ( $( '#add_value' ).css("display")  == "block" )
			{
				//	se input e' visibile invia dato
				valore = $( '#add_value' ).val();
				dati = "tabella=" + tabella + "&campo=" + campo + "&valore=" + valore + "&funzione=add";
				coreAjax(dati);
				$( '#add_value' ).css("display", "none");
				// refresh della pagina
			}
		else
			{
				//  se input non e' visibile, mostralo
				$( '#add_value' ).css("display", "block");
			}
	
	}
	
function subValue( id, tabella, campo, valore )
	{
		dati = "id=" + id + "&tabella=" + tabella + "&campo=" + campo + "&valore=" + valore + "&funzione=sub";
		coreAjax(dati);
	}
	
function coreAjax(dati)
	{
			//-------------CHIAMATA AJAX--------------------------//
        $.ajax({
					url: "update.dati.fissi.php", 
					type: "POST",
					data: dati,
					dataType: "html",
					success: function(results) { 
												res = results.trim();
												doMess( 'info', res,  '', 5000, 'refPage();');
										}
				});			//fine $ajax*/
				//-------------CHIAMATA AJAX--------------------------//
	
	
	}
	