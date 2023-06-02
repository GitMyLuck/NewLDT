<?php

	class ESTRAI
	{
const TESTO = 'MET DATA Meteo non collegato, 11:00,13/11/15,tmp 6.1,hum 76,dew 2.2,wav 5.2,wgt 3.2,dir SSE 165 °,bar 1009.0,rdy 0.0,rmt 73.0,ryr 238.0,rhr 0.0>';
var $err = 1;
var $dati;
var $v;
var $comp;
var $collegamento;
var $url = 'http://www.arialtopascio.it/meteolive/meteo.htm';
var $contenuti;
var $fenomeni;
var $oraAgg;
var $dataAgg;
var $temperatura;
var $umidita;
var $velMedia;
var $velocita;		
var $direzione;
var $pressione;
var $pioggiaDay;
var $pioggiaMounth;
var $pioggiaYear;

		
		public function acc () {	// preleva dati dalla fonte html
		//error_reporting(0);
		$vs = $this->url; // accesso alle proprieta'
		 if (($v = file_get_contents($vs)) != null) 
		 
				{$v = file_get_contents($vs);
				$this->collegamento = 'Collegamento OK.';}
		else 
				{$v = self::TESTO;
				$this->collegamento = 'Nessun Collegamento con la base dati';
				$this->send();}
				
		$meta = (stripos($v, '>')-2);
		$dati = substr($v,10,$meta);	//taglia al primo carattare [>]
		return $dati;}
	

	
		public function Meteosat () 
		
		{//MSG3_HRV_2013.02160-830_Italia.JPG
		//Formato record
		$data=date ("Y.md0");
$ip = $_SERVER['PHP_SELF']; // /LUCCA DELTA TEAM/pista.php
$ip = $_SERVER['SERVER_ADDR']; // 127.0.0.1
$ip = $_SERVER['SERVER_SOFTWARE']; //Apache/2.2.3 (Win32) PHP/5.2.0
$ip = $_SERVER['SCRIPT_FILENAME']; //C:/Users/Administrator/Desktop/luccadeltateam.it/pista.php
$ip = $_SERVER['REQUEST_URI'];// /LUCCA%20DELTA%20TEAM/pista.php 	
$ip = $_SERVER['REQUEST_URI'];
$ip = $_SERVER['HTTP_ACCEPT'];
//echo '<div id="xxx-" style="font-size:300%;">'; 	
//echo $ip.'<br> ';
//echo '</div>';
}

		public function sniffDevice() {
		
		// settiamo a zero la variabile mobile_browser 

$mobile_browser = '0';
 
//  controlliamo se l'user agent corrisponde a un dispositivo mobile
  
 if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android)/i', strtolower($_SERVER['HTTP_USER_AGENT']))) {
     $mobile_browser++;
 }
 
// controlliamo HTTP_ACCEPT corrisponde alla tecnologia WAP per telefonini
  
 if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0)
 or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE'])))) {
     $mobile_browser++;
 }    
 
// estraiamo i primi 4 caratteri da USER_AGENT e creiamo un array con tutti i header mobile
  
 $mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));
 $mobile_agents = array(
     'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
     'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
     'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
     'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
     'newt','noki','oper','palm','pana','pant','phil','play','port','prox',
     'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
     'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
     'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
     'wapr','webc','winw','winw','xda ','xda-');
 
// se corrisponde a mobile aumentiamo la nostra variabile di 1 
 
 if (in_array($mobile_ua,$mobile_agents)) {
     $mobile_browser++;
 }
  
 if (strpos(strtolower($_SERVER['ALL_HTTP']),'OperaMini') > 0) {
     $mobile_browser++;
 }
  
 if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'windows') > 0) {
     $mobile_browser = 0;
 }
 
// quindi se mobile_browser è inferiore di 0 vuol dire che un dispositivo mobile
  
 if ($mobile_browser > 0) {
 
// reindirizzamento per mobile
 
//header('Location: http://www.tuosito.it/mobile/'); 
//echo 'Questo e\' un telefono';
}
 else {
 
// altrimenti restiamo dove siamo
 
//echo 'Questo e\' un computer';
 
}   
		
		
		}
		
		
		public function carDati() {
		$dati = $this->acc(); // richiamo la funzione e metto in [$dati] risultato
		return $dati;
		//	Estrai Fenomeni	e taglia stringa  //
		//$this->Meteosat();		//per il momento sospeso...
		$this->sniffDevice();
		$dat = array();
		$counter = 0;
		$len = (strlen($dati)-1);
		while ($counter <= 13) 
		{
				if ($counter == 0) {
						$pre = (strpos($dati, 'DATA')+4);
									}
				else				{
						$pre = strpos($dati, ',');
									}
		$dat[$counter] = substr($dati, 0, $pre);
		$dati = substr($dati, ($pre + 1), ($len-($pre + 1)));
		//echo $counter.' &nbsp; &nbsp; &nbsp; '.$dat[$counter].'<br> ';
		$counter++;
		$pre = 0;						
		}
		$this->assegna($dat);	//assegna variabili alle proprieta'
		}
		
		
		public function assegna($dat) 
		
		   {
				$this->fenomeni = $dat[1];	//fenomeni
				$this->oraAgg = $dat[2];	//ora ultimo aggiornamento
				$this->dataAgg = $dat[3];	//data ultimo aggiornamento
				$this->temperatura = $this->get_data($dat[4]);
				$this->umidita = $this->get_data($dat[5]);
				$this->velMedia = $this->get_data($dat[7]);
				$this->velocita = $this->get_data($dat[8]);
				$this->direzione = $this->get_data($dat[9]);
				$this->pressione = $this->get_data($dat[10]);
			}
		
		
		
		public function get_data($par) 
			{
		
		$dato = substr($par,0,3);
		$um = ' °C';	//temperatura
		if ($dato == 'hum'){$um = ' %';}	//umidità
		if ($dato == 'wav' || $dato == 'wgt'){$um = ' KTS';}	//velodità vento (wav - vel media   wgt - vel attuale)
		if ($dato == 'bar'){$um = ' mbar';}	//pressione
		if ($dato == 'dir'){$um = '';}	//direzione vento
		if ($dato == 'rdy' || $dato == 'rmt' || $dato == 'ryr'){$um = ' mm';}
		$full = substr($par, 4, 15);
		// ECCEZIONE RICALCOLO VELOCITA' VENTO DA KTS A KM/H
		if ($dato == 'wav' || $dato == 'wgt')
		
					{$kts = $full + 0;
					$full = round(($kts * 1.852),2);
					$um = ' Km/h';}
												
		$full = (trim($full)).$um;
		//echo $full.'<br><br> <br>  ';

		
		if ($dato == 'dir') {
				$full = trim($full);
				$lungh = strlen($full);
				$pre = stripos($full, ' ');
				$parziale = substr($full, $pre, 10);
				$post = (stripos($parziale, '°'));
				$risultato = substr($parziale, 0, $post);
				$ang = $risultato + 0;
				$this->comp = $ang;
		
								}
		return $full;
				}
								
		
		public function send () {
	$erroreNum = $this->err;
			if($erroreNum <= 1) { 
	$testo_email = "il sito non si connette con l'origine dati
	caro Ciccio buzzo, sono cazzi !!";  
      
    $header = "MIME-Version: 1.0rn";    
    $header .= "Content-type: text/html; charset=iso-8859-1rn";    
     
    $oggetto = "Errore nel sito";  
    $destinatario = "giovanni.avallone@hotmail.com";  
    @mail($destinatario, $oggetto, $testo_email, $header); 
								}
								
	$erroreNum++;
	$this->err = $erroreNum;
}
}
?>