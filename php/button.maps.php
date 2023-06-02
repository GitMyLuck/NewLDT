<?php

$mappa = $_POST['mappa'];
$mappa_tmp = explode( "?", $mappa);
//exit(var_dump($mappa_tmp[0])); 
if ( substr($mappa_tmp[0], 0, 2) === 'pb' )
	{
		// CARICAMENTO GIUSTO
//echo ($mappa);
echo '<iframe class="map-view" width="100%" height="230" src="https://www.google.com/maps/embed?' . $mappa . '" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><div class="fine_button"  style="visibility: hidden;">&nbsp;</div>';
	}
else
	{
		$mappa = strrpos($mappa_tmp[1], '"');
		$mappa_tmp = explode('"', $mappa_tmp[1]);
//echo $mappa_tmp[0];
echo '<iframe class="map-view" width="100%" height="230" src="https://www.google.com/maps/embed?' . $mappa_tmp[0] . '" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe><div class="fine_button"  style="visibility: hidden;">&nbsp;</div>';
		//echo $mappa_tmp[1];
	
	}
	
function reverse_strrchr($haystack, $needle)
{
    $pos = strrpos($haystack, $needle);
    if($pos === false) {
        return $haystack;
    }
    return substr($haystack, 0, $pos);
}

	
?>