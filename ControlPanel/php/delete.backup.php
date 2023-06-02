<?php 
header('Content-type: text/html;charset=utf-8');
include 'db.inc.php';
$nome_file = '';
$sheet = exist('sheet');
$nome_file = exist('file');
$back_dir = '../mysqlBackups/';
$backup = new BCK($sheet, $back_dir);			//ISTANZA DELLA CLASSE BCK
$backup->doServer();

			//prepara variabili
			$temp = array();
			$temp = explode("-", $nome_file);
			
			$dirname[1]  = $back_dir . 'immagini_' . $sheet . '-imm-backup-';
			$dirname[1] .= $temp[3] . '-' . substr($temp[4], 0, 12) . '/';
			$dirname[0]  = $back_dir . 'immagini_' . $sheet . '-imm-backup-';
			$dirname[0] .= $temp[3] . '-' . substr($temp[4], 0, 12) . '/thumb/';
			$results = true;
			for ($i = 0; $i <= (count($dirname)-1); $i ++)
				{
			//elimina i file dalla directory $root (cartella immagini)
			$results = $results && $backup->removeFilesFromDir($dirname[$i]);
			//elimina root (cartella immagini originale)
			$results = $results && @rmdir($dirname[$i]);
				}
			//elimina il file di back-up
			$results = $results && deleteFile($back_dir.$nome_file);
			//scrivi risultato
			if ($results)
				{
					echo 'Eliminazione eseguita correttamente';
				}else{
					echo 'Eliminazione non effettuata...<br />si sono verificati dei problemi';
				}
				
			//elimina file
			function deleteFile($dirname)
				{
					if(is_file($dirname))
						{
							@unlink($dirname);
							return true;	
						}
					return false;	
				}
			
			function deleteDir($dirname)
				{
					if(is_file($dirname))
						{
							rmdir($dirname);
							return true;	
						}
					return false;	
				}
			
				
/*****************INTERNAL SIMPLE DATA COMPUTING******************/	
function exist($var)
			{
				if (isset ($_GET[$var]))
					{
						$var_temp = $_GET[$var];
						return $var_temp;
					}
				else
					{
						$var_temp = '';
						return $var_temp;
					}
		}




?>
