<?php
(isset( $_POST['origin'] )) ? $origin = $_POST['origin'] : $origin = null;
		//echo $origin;
		// if origin = cookie  eccetera
		if ( $origin == 'cookie' )
			{
				$expire = @time()+60*60*24*30;
				setcookie("mycookies", "true", $expire, '/');
				// poi si cambia per farlo tornare indietro alla pagina giusta
				$origin = "footer";
			}
		
?>
<script type="text/javascript">
		var origine = "<?php echo $origin; ?>";
		if ( origine = "cookie" )
			{
				caricaNews( 0 );
				flusso (  "footer" );
			}
</script>