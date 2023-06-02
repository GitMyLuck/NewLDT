var max_chunk;
var news = new Array();
var myZone;
var workZone;

function prepareArrows( )
	{
		var arrDown = null;
		var arrUp = null;
		myZone = $(".icona-search").attr("name");
		workZone = '-' + myZone;
		$('.scroll-news').animate({scrollTop: 0}, 600);
		arrUp = $( ".freccia-su" + workZone );
		arrDown = $( ".freccia-giu" + workZone );
				
		//  predisponi il click-event per l'icona Search
		$( ".icona-search" ).unbind();
		$( ".icona-search" ).click( function ()	
								{
									var inputSearch = $(this).prev();
									search = inputSearch.val();
									caricaNews( 0, myZone );
								});
		//  PREDISPONI IL CLICK PER LE FRECCE DI NAVIGAZIONE VERTICALE
		arrDown.unbind();
		arrDown.click( function()
												{
													arrowDownClick( );
												});
		arrUp.unbind();
		arrUp.click( function()
												{
													arrowUpClick( );
												});
		
		
	}
	
function arrowDownClick()
	{
		indice++;
		( indice >= max_chunk ) ? indice = max_chunk : indice;
		$('.scroll-news' + workZone).scrollTo( $("div[name='" + indice + "']"), 800 );
	}

function arrowUpClick()
	{
		indice--;
		( indice <=  1 ) ? indice = 1 : indice;
		$('.scroll-news' + workZone).scrollTo( $("div[name='" + indice + "']"), 800 );
	}
