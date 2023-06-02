<!DOCTYPE html> 
<html> 
<head> 
<link href="css/IstruzioniGoogle.css" rel="stylesheet" type="text/css" >
<script type="text/javascript">
var contatore;
		$(document).ready( function()
											{
//		attiva pulsanti											
	$( '#prec' ).click( function ()
			{
				precedente();
			});
																					
	$( '#succ' ).click( function ()
			{
				successivo();
			});
	
											});
</script>
</head>
<body>
<div class="istruzioni_Google">
					<div id="immagine"> 
							<a id="link" class="image-link" rel="lightbox">
									<img id="img"  width="100%" />
							</a>
					</div>
					<div id="GoogleText"></div>
</div>
					<div id="separatore" style="clear:both;height: 15px;"></div> 
<div class="frecce_">
					<div id="prec" class="arrows"  title="precedente"></div> 
					<div id="succ" class="arrows" title="prossimo"></div> 
</div> 

</body>
</html>




