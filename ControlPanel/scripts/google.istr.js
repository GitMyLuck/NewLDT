var testi = new Array( 		"", 
								"Collegarsi al sito di GoogleMaps cliccando sul link;<br /><br /><a href='https://www.google.it/maps/' target='_blank'>https://www.google.it/maps/</a><br /><br /> dovrebbe apparire la pagina come in figura", 
								"Scegli dal menu a tendina una località", 
								"Nell'esempio qui a fianco abbiamo scelto Imperia", 
								"Ora clicca sull'icona delle imposrtazioni, in basso a destra...", 
								"Appare un menu con diverse opzioni,seleziona <br /><b>condividi o incorpora mappa</b>...",
								"seleziona la scheda <b>incorpora mappa</b>...",
								"Come indicato in figura appare una dicitura,<br />clicca e seleziona tutto (Ctrl+a)(pressione prolungata se si tratta di smartphone o tablet)...",
								"Copia tutto il testo selezionato quindi...",
								"Nella sezione <b>varia</b> cerca la  casella 'Dati GoogleMaps', incollaci il testo che avevi copiato e premi il tasto [invia]...<br /><br />Adesso la mappa è memorizzata, nel corpo del sito apparirà centrata sul luogo che hai scelto.<br /> Buon Lavoro."
								
								
								);
var max = 9;
var dir = 'IstruzioniGoogle/GoogleNew';
var ext = '.jpg';
var contatore;

		function mostra()
			{
				//aspetta un secondo
				var timer = setTimeout(prosegui, 1000);
					function prosegui()
						{
							
							var link_img = $("#link"); 
							var image = $("#img");
							var text_space = $("#GoogleText");
							link_img.attr("href", dir + contatore + ext);
							link_img.attr("title", testi[contatore]);
							image.attr("src", dir + contatore + ext);
							text_space.html(testi[contatore]);
							if ( contatore == 1)
								{
									$("#prec").css("display", "none");
								}
							else if (contatore == max)
								{
									$("#succ").css("display", "none");
								} 
							else	
								{
									$("#prec").css("display", "block");
									$("#succ").css("display", "block");
								}
						}
			}
			
		function successivo()
			{
				contatore ++;
				mostra();
			
			}
			
		function precedente()
			{
				contatore --;
				mostra();
			}
			