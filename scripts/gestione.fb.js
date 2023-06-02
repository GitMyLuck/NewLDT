function share(index, categoria)
			{

				//  creare pagina che carica evento nella main-page
	uri = encodeURIComponent("http://www.luccadeltateam.it/eventi.php?news=" + index + "&pagina=" + categoria);
																				//------------------------------------------
				img = encodeURIComponent("img/armax.jpg");
				titolo = encodeURIComponent("Come eravamo");
				window.open ('https://www.facebook.com/sharer/sharer.php?u=' + uri,
				'sharer',
                'toolbar=no, status=no, resizable=no, location=no, width=380,height=300');
				return false;
				//$( '#like_container' ).load('https://www.facebook.com/sharer/sharer.php?u=' + uri);
			}
