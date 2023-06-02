
var bindCells = new Array();
var bindCellsControl = new Array();
var bindCellsCont = new Array();
//		FUNZIONE CHE CONTROLLA IL CONTENUTO DEI CAMPI OBBLIGATORI
//		PRIMA DI EFFETTUARE IL SALVATAGGIO   (stack 'scripts/gestioni.js' -> inviaNotizia() )
function getBindings()
	{
		var label;
		// variabile boolean di confronto
		var error = true;
		// prelevo tutti gli elementi appartenenti alla classe
		// bind_input	
		var binds = $( '.bind_input' );
		var numBind = ( $( '.bind_input' ).length ) - 1;
		// prelevo tutte le label di questi elementi
		var labelBinds = $( '.binding ' );
		//	svuoto gli array per nuovo confronto...
		bindCells = [];
		bindCellsControl = [];
		bindCellsCont = [];
		for ( i = 0; i <= numBind; i++ )
			{
				$( binds[i] ).removeClass("error_input");
				var valore = $( binds[i] ).val();
				//  esegui controllo su input per vedere se e' vuoto...
				var confronto = valore != "";
				error = error && confronto;
				// se esiste esegui controllo supplettivo indicato in 'rel'
				var sControl = ($( binds[i] ).attr("rel")).split( "/" );
				if ( sControl )
					{
						var newControl =  ( eval(sControl[0] + '(\'' + valore + '\');') ) ;
					}
				error = error && newControl;
				if (  !confronto )
					{
						bindCells[i] = $( binds[i] ).attr("id");
						label = '<font style="text-decoration:underline;font-size:1.2em;color:#fd8331;">' +  (($( labelBinds[i] ). text()).substr(3))+ '</font>';
						bindCellsCont[i] =  label + ' <br />è un campo obbligatorio!';
					}
				else if ( !newControl )
					{
						bindCells[i] = $( binds[i] ).attr("id");
						label = '<font style="text-decoration:underline;font-size:1.2em;color:#fd8331;">' +  (($( labelBinds[i] ). text()).substr(3)) + '</font>';
						bindCellsCont[i] = 'Il campo ' + label + ' <br />' + sControl[1];
					}
			}	//END FOR CICLE
		return error;
	//	bindCellsCont[n] = val	contenuto text dell' input		es: 'Titolo dell' evento', ecc.
	//  bindCells[n] = id			nome dell' input
		
	}

//	FUNZIONE DI CALLBACK ALL'USCITA DALLA FUNZIONE
//  CHE DA' IL 'focus' ALL' INPUT NON COMPILATO 
function focusTo( name )
	{
		$( "#" + name ).focus();
	}

//	FUNZIONI DI CONTROLLO SUPPLEMENTARE SUI CAMPI OBBLIGATORI
//	--------------------------------------------------------------------------------------
function is_numeric(dato)
	{
		return false;
	}
//	FUNZIONE CHE CONTROLLA CHE VENGA INSERITO ALMENO
//	UN DATO NELL'INSIEME DEGLI INPUT...	
function getContent()
	{
		// variabile boolean di confronto
		var error = true;
		// prelevo tutti gli elementi appartenenti alla classe
		// text_input	
		var binds = $( '.text_input' );
		var numBind = ( $( binds ).length ) - 1;

		//	svuoto gli array per nuovo confronto...
		bindCells = [];
		for ( i = 0; i <= numBind; i++ )
			{
				
				var confronto = $( binds[i] ).val() != "";
					if (confronto)
						{
							error = true;
							return error;
						}
				error = error && confronto;
				
			}	//END FOR CICLE
		return error;
	}