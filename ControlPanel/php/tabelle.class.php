<?php 
//header('Content-type: text/html;charset=utf-8');
class TABELLE extends FUNCT
{

		public function aggTabella($tabella)
			{
				$presenti = 		array();
				$nuovi_campi = 	array();
				$ris = 					array();
				$campi = new BUILD($tabella);
				$nuovi_campi = $campi->prelevaCampi();
				$sql = " SHOW COLUMNS FROM `" . $tabella . "` ";
				$this->insertSql($sql);
				$counter = 0;
				while($this->row = @mysql_fetch_array($this->results))
							{
								
								$presenti[$counter] = $this->row[0];
								$counter++;
							}
				$ris = array_unique(array_diff((array)$nuovi_campi,(array)$presenti));
				
				$len_ris = count($ris);
				//return $ris;
				for ($i = 0; $i <= 30; $i++)
					{
							if ($ris[$i])
								{
							$sql  = "ALTER TABLE  `" . $tabella . "` ";
							$sql .= "ADD  `" . $ris[$i] . "` TEXT NOT NULL";
							$this->insertSql($sql);
								}
						
					}
				return true;
				//return $this->row;
			}
			
			
		/*--------------CREAZIONE TABELLE---------------------------*/
		public function creaTabella($table, $campi)
			{
				$campi_fissi = array("testo", "data_evento", "titolo", "tags");
				$nuovi_campi = array_unique(array_merge((array)$campi_fissi,(array)$campi));
				//var_dump ( $nuovi_campi );
				//echo count( $nuovi_campi );
				//crea tabella testi
				$sql_inizio = "CREATE TABLE IF NOT EXISTS `" . $table . "` ( 
						`id` int(11) NOT NULL AUTO_INCREMENT,
						`time_evento` int(11) NOT NULL,
						`data` int(11) NOT NULL,
						`real_id` int(11) NOT NULL,
						`visite` int(11) NOT NULL DEFAULT 0,";
				
				$sql_fine = "PRIMARY KEY (`id`) 
						) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ";
				$counter = 0;
				while ($counter <= 25)
					{
						if ($nuovi_campi[$counter] != '')
							{
								$sql_mid .= '`' . $nuovi_campi[$counter] . '` text NOT NULL,';
							}
						$counter++;
					}
				$sql = $sql_inizio . $sql_mid . $sql_fine;
				$this->insertSql($sql);
				//return $sql;
				//crea tabella contenente indirizzi immagine
				$sql = "CREATE TABLE IF NOT EXISTS `img_" . $table . "` ( 
						`id` int(11) NOT NULL AUTO_INCREMENT, 
						`filename` varchar(200) NOT NULL,
						`ext` varchar(6) NOT NULL,
						`id_notizia` int(11) NOT NULL,
						`id_not_real` int(11) NOT NULL DEFAULT '0',
						`img_default` int(11) NOT NULL,
						`didascalia` varchar(200) NOT NULL,
						 `img_width` int(6) NOT NULL DEFAULT '0',
						`img_height` int(6) NOT NULL DEFAULT '0',
						PRIMARY KEY (`id`) 
						) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ";
				$this->insertSql($sql);

				//crea tabella contenente indirizzi eventuali file PDF
				$sql = "CREATE TABLE IF NOT EXISTS `pdf_" . $table . "` ( 
						`id` int(11) NOT NULL AUTO_INCREMENT, 
						`filename` varchar(200) NOT NULL,
						`ext` varchar(6) NOT NULL,
						`id_notizia` int(11) NOT NULL,
						`id_not_real` int(3) NOT NULL DEFAULT '0',
						`img_default` int(11) NOT NULL,
						PRIMARY KEY (`id`) 
						) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ";
				$this->insertSql($sql);

				//crea tabella contenente i tag per il tipo di notizia
				$sql = "CREATE TABLE IF NOT EXISTS `tags_" . $table . "` ( 
						`id` int(11) NOT NULL AUTO_INCREMENT, 
						`single_tag` varchar(30) DEFAULT NULL,
						PRIMARY KEY (`id`) 
						) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ";
				$this->insertSql($sql);
				
			}

			public function creaTabelleBase()
			{
				//crea tabella menu
				$sql = "CREATE TABLE IF NOT EXISTS `0_menu` (
							`id` int(11) NOT NULL AUTO_INCREMENT,
							`voce_menu` varchar(20) DEFAULT NULL,
							`funzione_menu` varchar(20) DEFAULT NULL COMMENT 'inserire funzione senza parentesi tonde',
							`title_menu` varchar(40) DEFAULT NULL,
							`attivo_menu` int(2) NOT NULL DEFAULT '1',
							`admin_menu` int(2) DEFAULT NULL COMMENT '1 = admin, sub-admin 0=super-admin',
							PRIMARY KEY (`id`)
							) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;";
				$this->insertSql($sql);
				
				//crea tabella backup
				$sql = "CREATE TABLE IF NOT EXISTS `backup` (
						`id` int(11) NOT NULL AUTO_INCREMENT,
						`file` text,
						`data` int(11) DEFAULT NULL,
						PRIMARY KEY (`id`)
						) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
				$this->insertSql($sql);

				//crea tabella raccolta dati
				$sql = "CREATE TABLE IF NOT EXISTS `raccolta_dati` (
						`id` int(11) NOT NULL AUTO_INCREMENT,
						`news_load` int(11) DEFAULT '0',
						`news_del` int(11) DEFAULT '0',
						`img_load` int(11) DEFAULT '0',
						`img_del` int(11) DEFAULT '0',
						PRIMARY KEY (`id`)
						) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1";
				$this->insertSql($sql);
				
				//crea tabella accessi
				$sql = "CREATE TABLE IF NOT EXISTS `accessi` (
						`id` int(11) NOT NULL AUTO_INCREMENT,
						`data` int(11) DEFAULT NULL,
						`tentativi` int(11) NOT NULL DEFAULT '0',
						`ip_access` varchar(16) DEFAULT NULL,
						`agent_access` text DEFAULT NULL,
						`session_access` varchar(26) DEFAULT NULL,
						PRIMARY KEY (`id`)
						) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ";
				$this->insertSql($sql);
				
				//crea tabella black-list
				$sql = "CREATE TABLE IF NOT EXISTS `black_list` (
						`id` int(11) NOT NULL AUTO_INCREMENT,
						`ip_black` varchar(16) DEFAULT NULL,
						`agent_black` text,
						`time_black` int(11) DEFAULT NULL,
						PRIMARY KEY (`id`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
				$this->insertSql($sql);
				
				//crea tabella utenti_on_line
				$sql = "CREATE TABLE IF NOT EXISTS `utenti_on_line` (
						`id` int(11) NOT NULL AUTO_INCREMENT,
						`sessione` varchar(50) NOT NULL,
						`ip_utente` varchar(16) NOT NULL,
						`tentativi` int(1) NOT NULL DEFAULT '0',
						`timestamp` int(11) DEFAULT '0',
						`token_utente` VARCHAR(46) NOT NULL,
						PRIMARY KEY (`id`)
						) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
				$this->insertSql($sql);
				
				//crea la tabella configuration
				$sql = "CREATE TABLE IF NOT EXISTS `configuration` (
						`id` int(11) NOT NULL AUTO_INCREMENT,
						`type` text NOT NULL,
						`titolo` text NOT NULL,
						`copy` text NOT NULL,
						`general_back` text NOT NULL,
						`activity_back` text NOT NULL,
						`pannelli_back` text NOT NULL,
						`testate_back` text NOT NULL,
						`inputs_back` text NOT NULL,
						`inputs_back_dis` text NOT NULL,
						`change_perc` int(3) DEFAULT '0',
						`ink_pannelli` text NOT NULL,
						`ink_testate` text NOT NULL,
						`ink_banner` text NOT NULL,
						`ink_inputs` text NOT NULL,
						`ink_inputs_dis` text NOT NULL,
						PRIMARY KEY (`id`)
						) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ";
				$this->insertSql($sql);
				
				$sql = "INSERT INTO `configuration` (`id`, `type`, `titolo`, `copy`, `general_back`, `activity_back`, `pannelli_back`, `testate_back`, `inputs_back`, `inputs_back_dis`, `change_perc`, `ink_pannelli`, `ink_testate`, `ink_banner`, `ink_inputs`, `ink_inputs_dis`) 
					VALUES
					(1, 'current', 'control panel ', '2.8.0.1', 'AAA', '898989', 'A3A3A3', '828282', '5A6169', '737c86', 25, 'FFFFFF', 'F9B234', '898989', 'FFFFFF', 'BBBBBB'),
					(2, 'default', 'control panel', NULL, '696F7F', '7B8092', '9CA0AD', 'A9D7C6', '285586', '1D3D61', 25, 'FFFFFF', 'F9B234', 'ECD393', 'FFFFFF', 'BBBBBB'),
					(3, 'mareTaggia', 'control panel', '', 'D6EFFF', '8FB9D9', '7BA7C9', '84C7EB', '297699', 'DEDEDE', 25, 'FFFFFF', '000000', '898989', 'FFFFFF', 'BBBBBB') ";
				$this->insertSql($sql);


				$sql = "INSERT INTO `raccolta_dati` (
						news_load, news_del, img_load, img_del)
						VALUES (0,0,0,0) ";
				$this->insertSql($sql);
				
				//nota il carattere ` si fa Alt+96
			}		//  END  OF  FUNCTION creaTabelleBase()
			
		public function eliminaTabelle($table)
			{
					
					$sql = "DROP TABLE `" . $table . "`; 
								DROP TABLE `img_" . $table . "`;
								DROP TABLE `pdf_" . $table . "`;
								DROP TABLE `tags_" . $table ."`; ";
					$this->insertSql($sql);
					return;
			}

}		// END  OF  CLASS 
?>