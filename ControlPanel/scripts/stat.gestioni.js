function startStat(mese, anno)
	{	
						//mese impostato per il caricamento iniziale
						//sincronizzato con la data attuale
						
						$( '#hid_mese' ).val(mese);
						$( '#hid_anno' ).val(anno);
						$( '#menu_mesi' ).load( 'php/stat.mesi.php?mese=' + mese + '&anno=' + anno);
						$( '#box_view' ).html("&nbsp; &nbsp; &nbsp; elaborando...");
						caricaStatistica(mese, anno);
	}


function loadProgress()
	{
		//COLORI PER LE PROGRESS BAR
		var colors = new Array("EB8218", "55AAE6", "FF80C0", "00FF80", "8AAAFF", "FF9B51", "FFDD00", "E61BE6", "F9F9F9", "009700", "FF0B54", "00DD5E", "00DFDF", "4B9A88", "CA5757", "FFB506", "DB6D00" , "D0FBD0" );
		
		//Numero di campi della tabella di cui rappresentare la progressBar
		var progNum = $( '.progress' ).length;
		
		//Preleva dal div #max_value il valore piu' alto fra i campi
		//per gestire la scala di rappresenrtazione della progressBar attraverso
		//la option [max]
		var max_value = $( '#max_value' ).html();
		
		for (i = 0; i <= progNum; i++)
			{
				//Preleva il valore del singolo campo[i] per questa progressBar
				var valoreVisite = parseInt($( '#progressbar' + i).attr("name"));
				//alert(valoreVisite);
				$( "#progressbar" + i ).progressbar({
											max: max_value,
											value: valoreVisite,
											//background: 'url(images/bg2.png) repeat-x #' + colors[i]
											background: '#' + colors[i]
										});
			
			
			}
	
	}
	
function callStat(o)
	{
		var contenuto = o.html();
		if (contenuto != 'totali')
			{
				var mese = (o.html()).substr(0, 3);
				var anno = (o.html()).substr(-4, 4);
				$( '#hid_mese' ).val(mese);
				$( '#hid_anno' ).val(anno);
				$( '#menu_mesi' ).load( 'php/stat.mesi.php?mese=' + mese + '&anno=' + anno);
				$( '#box_view' ).html("&nbsp; &nbsp; &nbsp; elaborando...");
				caricaStatistica(mese, anno);
			}
		else
			{
				$( '#menu_mesi' ).load( 'php/stat.mesi.php');
				$( '#box_view' ).html("&nbsp; &nbsp; &nbsp; elaborando...");
				caricaStatistica(mese, anno, 'normal');
			}
	}

function callStatBtn(ordine)
			{
				uri = 'php/stat.mesi.php';
				var mese = $( '#hid_mese' ).val();
				var anno = $( '#hid_anno' ).val();
				if (mese && anno)
					{
						uri = uri + '?mese=' + mese + '&anno=' + anno;
					}
				$( '#menu_mesi' ).load( uri );
				$( '#box_view' ).html("&nbsp; &nbsp; &nbsp; elaborando...");
				caricaStatistica(mese, anno, ordine);
			}
	
function caricaStatistica(mese, anno, visual)
	{
		
		if (mese && anno)
		{
		var visualFunct = '&visual=normal';
		if(visual)
			{
				visualFunct = '&visual=' + visual;
			}
		uri = 'barre.statistiche.php?mese=' + mese + '&anno=' + anno + visualFunct + ' .contenitore_progress';
		$( '#box_view' ).load(uri, 			
		function()
					{
								setTimeout(loadP, 300);
									function loadP()
										{
											//funzione contenuta in stat.gestioni.php
											loadProgress();
											$( '.contenitore_progress' ).fadeIn(800);
										}
					});
		}		
		else
		{
		$( '#hid_mese' ).val("");
		$( '#hid_anno' ).val("");
		var visualFunct = '?visual=normal';
		if(visual)
			{
				visualFunct = '?visual=' + visual;
			}
		uri = 'barre.statistiche.php' + visualFunct + ' .contenitore_progress';
		$( '#box_view' ).load(uri,
		function()
					{
								setTimeout(loadP, 300);
									function loadP()
										{
											//funzione contenuta in stat.gestioni.php
											loadProgress();
											$( '.contenitore_progress' ).fadeIn(800);
										}
					});
		}
	
	}

/*----------------------- F I N E   S E Z I O N E    S T A T I S T I C H E -----------------------*/