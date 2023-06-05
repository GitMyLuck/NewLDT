<?php 
class CACHE
{

public $search; // chiave di ricerca
public $data; // data di riferimento
public $path;

const DEFAULT_LIFETIME = 1;

protected $cacheFile = 'b9ee452a17603fd';
protected $values = array();
protected $content;
protected $cache_cont;
protected $file;					// nome della pagina da rendere in cache
protected $connection;
protected $dec;
protected $cache_time;
protected $pagina;				// nome della pagina di news da caricare 


	public function __construct($tag='tutti',$path=null, $filename) 
		{
			
			$this->file = $filename;
			$this->search = $tag;
			if (!empty($path)) {
				 if ( $path == "cache_schede" )
						{
							$this->cacheFile = "6b90bdffa540";
						}
            $this->cacheFile = '../public/php/' . $path . '/' . $this->cacheFile;
        }
		}

		
	public function getCache()			{
			//return $this->cacheFile;
			//return 'from cache.php' . print_r($this->search);
			$res = true;
			//  esegui controllo su [refresh-flag] nel db ( 0 devi fare refresh   1 refresh alla scadenza )
			$res = $res && $this->refreshCache();
			// esegui il controllo sull'esistenza del file in cache
			$res = $res && $this->contrCache();
			// esegui il controllo sulla validita della cache (deve essere di oggi)
			$res = $res && $this->contrData();
			//exit(var_dump($res));
			if ( $res )	
				{
					//  mostra output
					$this->mostraCache($this->search);
				}
			else
				{ 
					// crea pagina
					$this->creaPagina();
					// salvala in cache
					$this->salvaPagina();
					// setta [flag-cache] dopo rinnovo (valore = 1)
					$this->setCacheFlag();
					// mostra output
					$this->mostraCache($this->search);
				}
		
		}
		public function refreshCache()			{
			/*include_once "../lib/db.inc.php";
			$this->connection = new CONNECT();
			$this->connection->doServer();
			$sql = "SELECT `cache` FROM `" . $this->dec_search . "_data` ";
			$results = @mysql_query($sql) or die ('$sql inviato : ' . $sql . '<br />' . mysql_error());
			$flag = mysql_fetch_array($results);
			$this->connection->disconnect();
			return $flag['cache'];*/
			return true;
		}
		
		public function setCacheFlag()			{
			/*include_once "../lib/db.inc.php";
			$this->connection = new CONNECT();
			$this->connection->doServer();
			$sql = "UPDATE `" . $this->dec_search . "_data` ";
			$sql .= "SET `cache` = 1 ";
			$results = @mysql_query($sql) or die ('$sql inviato : ' . $sql . '<br />' .  mysql_error());*/
			}
				
		public function contrCache()			{
		//		funzione che controlla se esiste gia' un file della pagina in cache
				$key = $this->search;
				if (file_exists($this->cacheFile.(md5($key)).'.php')) 
					{
						$this->values[$key]= @include($this->cacheFile.(md5($key)).'.php');
						return $this->values[$key]['v'];
					}
				else
					{
						
										return false;
					}
					
			}
			
		public function contrData()			{
		//		funzione che controlla se il time della cache e' scaduto
				if ($this->values[$this->search]['l']>time())
					{
						return true;
					}
				else
					{
						return false;
					}
			
			}
			
		public function creaPagina()			{
				
				//  apertura buffer output
				ob_start();
				//  preleviamo contenuto pagina
				$pagina = file_get_contents($this->file);
				//  creiamo l'output della pagina (HTML)
				$output_pagina = eval("?>".$pagina);
				//  poniamo il buffer output in $this->content
				$this->content = trim(ob_get_contents());
				// puliamo il buffer
				ob_get_clean();
			}
			
		public function creaData()			{
				// restituisce la data odierna alle 23:59:56
				$timestamp = mktime('23','59','56');
				return $timestamp;
			}
			
		public function salvaPagina()			{
		
				// scadenza alla messanotte di ogni giorno
				//$time = $this->creaData();
				$intervallo = self::DEFAULT_LIFETIME;
				if ( (int)$this->cache_time > 0 )
					{
						$intervallo = $this->cache_time;
					}
				// scadenza ad ogni intervallo 'DEFAULT_LIFETIME' (secondi)
				$time = time() + (int) ($intervallo);
				
				$this->values[$this->search] = array (
            'v' => $this->content,
            'l' => $time		);
        return $this->scriviFile($this->search, $this->values[$this->search]); 
			
			}
			
			
			
		protected function scriviFile($key, $value)			{
        $value['v'] = serialize($value['v']);
        $array = var_export($value,true);
        return (file_put_contents($this->cacheFile.(md5($key)).'.php', "<?php return $array;",LOCK_EX)!==false);

    }
			
			
		public function mostraCache($key)			{
				//  preleva i valori dell'array contenuto nel file cache e mettili nell'array -$values-
				$this->values[$key]= @include($this->cacheFile.(md5($key)).'.php');
				//  se vuoto cancella la chiave
				if (empty($this->values[$key])) 
					{
						unset($this->values[$key]);
						return false;
					}
				if ($this->values[$key]['l']> time()) 
					{
						// se la data memorizzata nel file non e' ancora scaduta mostra pagina
						$this->values[$key]['v']= unserialize($this->values[$key]['v']);
						return eval("?>" . $this->values[$key]['v']);
					}
				else 
					{
						// se la data mem nel file e' scaduta mostra pagina vecchia per il momento
						$this->values[$key]['v']= unserialize($this->values[$key]['v']);
						eval("?>" . $this->values[$key]['v']);
						// rimuovi la chiave ed il file (esso verra' ricreato con una nuova scadenza)
						$this->remove($key);
						return false;
					}
			}

			 /**
     * Remove a key from the cache
     * 
     * @param  string $key
     * @return boolean 
     */
    public function remove($key)			{
        if (empty($key)) {
            return false;
        }
        unset($this->values[$key]);
        return @unlink($this->cacheFile.(md5($key)).'.php');
    }
//------------------------------------------------------------------------------------
 /**
     * Load the key value from the cache
     * 
     * @param  string $key
     * @return mixed|boolean 
     */
    public function load($key) 			{
        if (isset($this->values[$key])) {
            if ($this->values[$key]['l']>time()) {
                return $this->values[$key]['v'];
            } else {
                $this->remove($key);
                return false;
            }
        } 
        $this->values[$key]= @include($this->cacheFile.(md5($key)).'.php');
        if (empty($this->values[$key])) {
            unset($this->values[$key]);
            return false;
        }
        if ($this->values[$key]['l']>time()) {
            $this->values[$key]['v']= unserialize($this->values[$key]['v']);
            return $this->values[$key]['v'];
        } else {
            $this->remove($key);
            return false;
        }
    }

}		// END  OF  CLASS 
?>