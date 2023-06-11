
function prepareSpin(divName)
	{
		var temp_colors = $( '#colori' ).text();
		var colors = temp_colors.split(",");
		var opts = {
							lines: 13, 			// The number of lines to draw
							length: 20, 			// The length of each line
							width: 10, 			// The line thickness
							radius: 30, 			// The radius of the inner circle
							corners: 1, 			// Corner roundness (0..1)
							rotate: 0,				// The rotation offset
							direction: 1, 		// 1: clockwise, -1: counterclockwise
							color: '#ffffff',
							speed: 1, 			// Rounds per second
							trail: 60, 				// Afterglow percentage
							shadow: true, 		// Whether to render a shadow
							hwaccel: false, 		// Whether to use hardware acceleration
							className: 'spinner', // The CSS class to assign to the spinner
							zIndex: 2e9, 		// The z-index (defaults to 2000000000)
							top: 'auto', 		// Top position relative to parent in px
							left: 'auto' 			// Left position relative to parent in px
							};
			var target = document.getElementById(divName);
			var spinner = new Spinner(opts).spin(target);
	
	
	}

	function doCookies()
     {
		var box_array = new Array (0,0,0,0,0,0,0,0,0,0,0);
		$.cookie('box_eventi', JSON.stringify(box_array));

		$.cookie('box_news', JSON.stringify(box_array));
		
		$.cookie('box_archivio', JSON.stringify(box_array));
		
		$.cookie('box_user', JSON.stringify(box_array));
		
		$.cookie('box_localweb', JSON.stringify(box_array));
		
		$.cookie('box_settings', JSON.stringify(box_array));
		
	}
	
	
function enterLogin()
	{
		$( '#box_login' ).hide("slow");
		$( '#titolo_appl' ).html("CONTROLLO &nbsp; &nbsp; LOGIN");
		$( '#titolo_appl' ).show("slow");
		$( '#wait' ).show("slow");
		setTimeout(hideLogin, 5000);
			function hideLogin()
				{
					$( '#titolo_appl' ).hide("slow");
					$( '#wait' ).hide("slow");
					$( '#error_message' ).html("");
				}
	
	
	}
	
	
function showError()		
	{
		$("#error_message").show("slow");
		$("#wait").show("slow");
	}
							
function hideError()		
	{
		$("#error_message").hide("slow");
		$("#wait").hide("slow");
		location.href = "index.php";
	}
	
function run(esito)			
	{
		if (esito =='error')
			{
				showError();
				l=setTimeout(hideError, 5000);
			}
	}
	
function showMessage(msg)
	{
		$("#errore").html(msg);
	}
	
function deleteTables()
	{
		var uri = "php/debug.tables.php";
		//-------------CHIAMATA AJAX--------------------------//
        $.ajax({
			url: uri, /* pagina di destinazione dei dati */
			type: "POST",
			data: "debug=yes",
			dataType: "html",
			success: function() {
						//debugCall(results);
						//location.reload();
						alert ('fatto!');
										}
				});			//fine $ajax
				//-------------CHIAMATA AJAX--------------------------//
	
	}
