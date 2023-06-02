<?php

class SECUR
{
		var $log;
		var $index;
		var $pagina;
		public function doRecognize($login, $page, $sheet)
			{
				@session_start();
				$sessione = @session_id(); 
				
				//traduci login
				$g = (int)date("d", @time());				//cambiamento giornaliero
				//$g = (int)date("i", @time());				//cambiamento ogni minuto
				$temp_login = base64_decode($login);
				$len_login = strlen($temp_login);
				$diff = $len_login - $g;
				$login_complex = substr($temp_login, $g, $diff);

				if ($sessione === $login_complex)
					{
						$this->log = base64_decode($login);
						//traduci index
						$temp_index = base64_decode($page);
						$len_index = (strlen($temp_index)-40);
						$this->index = substr($temp_index, ($len_index * (-1)), $len_index);
						$this->pagina = base64_decode($sheet);
						return true;
					}
				/*else if ($sessione === $login)
					{
						//traduci dati normali
						$this->index = $page;
						$this->pagina = $sheet;
						return true;

					}*/
				else
					{
						return false;			
					}
				
			}

		private function doCode($index)
			{
				$temp_code = array("milk", "pippo", "terra", "carloerba", "choopy", "libro", "sandalo", "cosmo", "retina", "penna", "cantante", "serrano", "macropico", "sedato", "infelice", "pacchos", "tosaerba", "cantina", "pipa", "week", "patrocinio", "wvarazze", "ventidue", "litio", "spettro", "caramella", "fornace", "mantello", "bisio", "fuoco", "erba", "5stelle", "trentadue", "martello", "drakkar", "sanguisuga", "accendino", "fornello", "tafta", "oscar", "banjo", "hotel", "auto", "carrello", "mercato", "gondola", "fornello", "dedalo", "ottica", "quarantanove", "dollaro", "penna", "tastiera", "tigre", "opera", "domiciliazione", "canterbury", "mandrake", "gessofila", "santommaso", "pera", "afragola");
				return $temp_code[$index];

			}

		
		var $sec_sess;
		var $sec_news;
		var $sec_sheet;
		public function creaCode($index, $sheet)
			{

				//preleva data
				$g = (int)date("d", @time());
				//$g = (int)date("i", @time());				//cambiamento ogni minuto
				//preleva code
				$code = $this->doCode($g);
				//preleva sessione
				$sess = $this->doSessione();

				$this->sec_news = base64_encode(sha1($code) . $index);		//crea num notizia

				$this->sec_sess = base64_encode(substr((sha1($code)), 0, $g) . $sess);  //crea Login

				$this->sec_sheet = base64_encode ($sheet);
			}

		private function doSessione()
			{
				@session_start();
				$sessione = @session_id(); 
				return $sessione;
			}

}
?>