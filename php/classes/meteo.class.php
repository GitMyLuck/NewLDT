<?php

	class METEO
{

var $url = 'https://www.arialtopasciomontecarlo.it/meteolive/meteo.htm';
var $es = "<META RAW MET DATA Nessun fenomeno, 22:30,26/12/15,tmp 2.1,hum 95,dew 1.4,wav 0.0,wgt 0.0,dir ENE  003 �,bar 1034.0,rdy 0.0,rmt 7.0,ryr 366.0,rhr 0.0>";
var $winDir;

	public function caricaDatiMeteo()
		{
			$metaData = file_get_contents($this->url);
			//$metaData = $this->es;
			$inizio = (stripos($metaData, "DATA" ) + 5);
			$fine = stripos($metaData, ">");
			$part_meta = (substr($metaData, 0, $fine));
			//exit(var_dump($part_meta)); 
			$meteo = substr($part_meta, $inizio);
			$meteoData = explode(",", $meteo);
			$newData = array();
			foreach ( $meteoData as $key => $dato )
				{
					//  FENOMENI
					if ( $key == 0 )
						{
							$newData[] = $dato;
						}
					// ora di aggiornamento
					if ( $key == 1 )
						{
							$newData[] = "aggiornamento ore  " . trim($dato);
						}
					//	data aggiornamento
					if ( $key == 2 )
						{
							$newData[] = "del " . $dato;
						}
					//	taglia carattere speciale dir
					if ( $key == 8 )
						{
							$dir = substr($dato, 0, 12);
							$newData[] = $this->get_data($dir);
						}	
					if ( $key > 2 && $key != 8)
						{
							$newData[] = $this->get_data($dato);
						}
				}
			return $newData;
		}
		
		
	public function get_data($par) 
			{
		//preleva i primi tre caratteri
		$dato = substr($par,0,3);
		
		$um = ' °C';	//temperatura
		// ryr = pioggia totale dal 01/01/2015
		$tipologia = "temperatura :  ";
		//	umidità
		if ($dato == 'hum'){$um = ' %';$tipologia = "umidità :  ";}	//umidità
		//  punto di rugiada
		if ($dato == 'dew'){$tipologia = "punto di rugiada :  ";}//  punto di rugiada
		//velodità vento (wav - vel media   wgt - vel attuale)	
		
		//	pressione atmosferica
		if ($dato == 'bar'){$um = ' mbar';$tipologia = "press. atmosferica :  ";}	//	pressione atmosferica
		
		// pioggia caduta
		if ($dato == 'rdy' || $dato == 'rmt' || $dato == 'ryr' || $dato == 'rhr'){$um = ' mm';}
		switch ($dato)
				{
					case 'rdy':
						$tipologia = "pioggia caduta ( oggi ) : ";
						break;
					case 'rmt':
						$tipologia = "pioggia caduta ( mese ) : ";
						break;
					case 'ryr':
						$tipologia = "pioggia caduta ( anno ) : ";
						break;
					case 'rhr':
						$tipologia = "pioggia caduta ( ieri ) : ";
						break;
				}
				
			
		//		DIREZIONE DEL VENTO
		if ($dato == 'dir') 	
			{
				$ang = $this->prelevaDir($par);
				$um = '°';
				$tipologia = "provenienza del vento : ";
			}
			
		$full = $tipologia . (substr($par, 4));

		// 		VELOCITA  DEL VENTO
		if ($dato == 'wav' || $dato == 'wgt')
		
					{
						$tipologia = "velocità media :  ";
						if ( $dato == 'wgt' )
							{
								$tipologia = "velocità attuale :  ";
							}
						$vel = $this->windSpeed($par);
						$um = ' Km/h';
						//trigger_error('  I N T E R R U Z I O N E  ', E_USER_ERROR); 
						$full = $tipologia . $vel;
					}
					
												
		$full = (trim($full)).$um;
		return $full;
				}


		function WindSpeed($full)
			{
				$full = trim($full);
				$wind = explode(" ", $full);
				$kts = floatval($wind[1]);
				$vel = round (($kts * 1.852),2);
				return $vel;
				
			}
			
		function prelevaDir($full)
			{
				$full = trim($full);
				$lungh = strlen($full);
				$pre = stripos($full, ' ');
				$myDato = array();
				$myDato = explode(" ", $full);
				$newMyDato = array();
				foreach ($myDato as $dato)
					{
						if ( $dato != '' )
							{
								$newMyDato[] = $dato;
							}
					}
				//exit(var_dump($newMyDato)); 
				
				$ang = $newMyDato[2] + 0;
				$s = floor($ang / 5);
				$difetto = $s * 5;
				$diff = $ang - $difetto;
					if ( $diff >= 3 )
							{
								$results = ( $s + 1 ) * 5;
							}
					else
							{
								$results = $s * 5;
							}
					if ( $results == 360 )
						{
							$results = 0;
						}
				$this->winDir = $results;
			}
}		//// END  OF  CLASS 

?>
	