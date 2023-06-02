

function doUserLogin()
	{
			// pulisci campo da vecchia psw
			$( '#usr' ).val("");
			creaParola('usr');
			
	}
	
function doPsw()
	{
		$( '#psw' ).val("");
		creaParola('psw');
	}
			
function creaParola(tipo)
	{
			//-------------CHIAMATA AJAX--------------------------//
        $.ajax({
					url: "php/get.userLogin.php", 
					type: "POST",
					data: "tipo=" + tipo,
					dataType: "html",
					success: function(results) { 
											//debugCall(results);
											var ris = results.trim();
											$( '#' + tipo ).val(ris);
													}
				});			//fine $ajax*/
				//-------------CHIAMATA AJAX--------------------------//
	
	}