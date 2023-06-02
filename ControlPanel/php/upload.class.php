<?php

/**
 * Upload
 *   
 * @author Maurizio Tarchini
 * @version 1.1
 * @access public
 * revised Giovanni Avallone for MultiFoto
 */
abstract class Upload
{
		public $error = array();
		public $opt;
		public $filename;
		public $img_y;
		public $img_x;
		protected $image;
		protected $extension;
		protected $name;
		protected $file;
		protected $uploadAbort;
		protected $val_max;
		protected $number;
    
        /**
         * Upload::__construct()
         * 
         * @param mixed $options
         * @return void
         * @since 1.0
         */
        public function __construct($options = array(), $sheet)
        {
			include 'config.inc.php';
			(isset ($max_images[$sheet])) ? $this->val_max = intval($max_images[$sheet]) : $this->val_max = 1;
			
				$defaults = array(  'uploadDir' => '',
                                'allowedExtensions' => false,
                                'name' => 'upload_name',
												'number' => $this->val_max,
												'imageFunction' => 'change',
                                'maxSize' => false);
                                
				$this->opt = array_merge((array)$defaults,(array)$options);
				$this->file = $_FILES[$this->opt['name']];
				$this->number = $this->opt['number'];
				$this->getExtension();
				$this->getSafeName();
				$this->uploadAbort = FALSE;
				$this->uploadProcess();
            
        }
        
        /**
         * Upload::onSuccess()
         * Esegue le operazioni nel caso in cui
         * il processo di upload é andato a buon fine
         * 
         * @since 1.0
         * @abstract 
         */
        protected abstract function onSuccess();
        
        /**
         * Upload::onAbort()
         * Esegue le operazioni nel caso in cui
         * il processo é stato interrotto da un errore
         * 
         * @since 1.0
         * @abstract
         */
        protected abstract function onAbort();
        
        /**
         * Upload::getExtension()
         * Rileva e normalizza l'estensione del file caricato
         * 
         * @since 1.0
         * @return void
         */
        protected function getExtension()
        {
            $part = explode('.',$this->file['name']);
            $this->extension = end($part);
            $this->extension = strtolower($this->extension);
        }
        
        /**
         * Upload::getSafeName()
         * Normalizza il nome del file caricato con una
         * stringa casuale
         * 
         * @since 1.0
         * @return void
         */
        protected function getSafeName()
        {
			$now = @time();
			$giorno = date("d", $now);
			$mese = date("m", $now);
			$anno = date("y", $now);
			$ora = date("H", $now);
			$minuto = date("i", $now);
			$data = $anno . $mese . $giorno . $ora . $minuto . '-';
            $this->filename =$data . (strtoupper(substr(sha1(microtime()),0, 12)));
        }
        
        /**
         * Upload::allowedExtension()
         * Verifica che l'estensione del file sia autorizzata
         * 
         * @since 1.0
         * @return void
         */
        protected function allowedExtension()
        {
            if($this->opt['allowedExtensions'])
            {
                $ext = explode(',', $this->opt['allowedExtensions']);
            
                if(!in_array($this->extension, $ext))
                {
                    $this->uploadAbort = TRUE;
                    $this->error[] = 'Estensione .' . $this->extension . ' non ammessa';
                }
            }
        }
          
		/**
         * Upload::allowedMaxNumbers()
         * Verifica che l'immagine 'n' caricata
		 * non sia superiore a 9
         * 
         * @since 1.0
         * @return void
         */
        protected function allowedMaxNumbers()
        {
            if($this->opt['number'])
            {
				
                if($this->number >= $this->val_max)
                {
                    $this->uploadAbort = TRUE;
                    $this->error[] = 'Superato il limite massimo di immagini. ( ' . $this->val_max . ' )' ;
                }
            }
        }
        
        /**
         * Upload::allowedSize()
         * Verifica che la dimensione del file non
         * superi la dimensione autorizzata
         * 
         * @since 1.0
         * @return void
         */
        protected function allowedSize()
        {
            if($this->opt['maxSize'])
            {
                $size = filesize($this->file['tmp_name']);
                if($size > $this->opt['maxSize'])
                {
                    $this->uploadAbort = TRUE;
					$max = round(($this->opt['maxSize']/1048576), 2); 
                    $this->error[] = 'L\'immagine supera la dimensione massima consentita (' . $max . ' Mbytes)';
                }
            } 
        }
        
        /**
         * Upload::isUploadedFile()
         * Verifica che il file sia stato caricato
         * tramite protocollo HTTP POST
         * 
         * @since 1.0
         * @return void
         */
        protected function isUploadedFile()
        {
            if(!is_uploaded_file($this->file['tmp_name']))
            {
                $this->uploadAbort = TRUE;
                $this->error[] = 'Il file è stato caricato in modo improprio';
            }
        }
      
			
        /**
         * Upload::parseError()
         * Verifica la presenza di errori nel 
         * processo di upload
         * 
         * @since 1.0
         * @return void
         */
        protected function parseError()
        {
            switch($this->file['error'])
            {
                case UPLOAD_ERR_INI_SIZE:
                $this->error[] = 'L\'immagine supera la dimensione massima consentita.';
                $this->uploadAbort = TRUE;
                break;

                case UPLOAD_ERR_PARTIAL:
                $this->error[] = 'Il file è stato caricato parzialmente';
                $this->uploadAbort = TRUE;
                break;

                case UPLOAD_ERR_NO_FILE:
                $this->error[] = 'Il file non è stato caricato';
                $this->uploadAbort = TRUE;
                break;

                case UPLOAD_ERR_NO_TMP_DIR:
                $this->error[] = 'La cartella temporanea non è stata trovata';
                $this->uploadAbort = TRUE;
                break;

                case UPLOAD_ERR_CANT_WRITE:
                $this->error[] = 'Non è stato possibile scrivere nel filesystem';
                $this->uploadAbort = TRUE;
                break;
                
                case UPLOAD_ERR_EXTENSION:
                $this->error[] = 'Il processo è stato fermato da un\'estensione di PHP';
                $this->uploadAbort = TRUE;
            }  
        }
        
        /**
         * Upload::uploadProcess()
         * Esegue tutti i metodi di controllo e procede
         * al upload vero e proprio
         * 
         * @since 1.0
         * @return void
         */
        protected function uploadProcess()
        {
			//non viene effettuato il controllo se la funzione e' 'change'
			if ($this->opt['imageFunction'] !== 'change')
				{
						$this->allowedMaxNumbers();
				}
			$this->allowedExtension();
        $this->allowedSize();
        $this->isUploadedFile();
        $this->parseError();
            
            if(!$this->uploadAbort)
            {
                if(@move_uploaded_file($this->file['tmp_name'], $this->opt['uploadDir'] . $this->filename . '.' . $this->extension))
                {
                    $this->error[] = 'File caricato correttamente'; 
                }
                else
                {
                    $this->error[] = 'Non è stato possibile spostare il file dalla cartella temporanea a quella di destinazione';
					echo $this->file['tmp_name'].'<br> '.$this->opt['uploadDir'] .'<br>'.$this->filename;
                    $this->uploadAbort = TRUE;
                }
            }
            
            if($this->uploadAbort)
            {
                $this->onAbort();
            }
            else
            {
                $this->onSuccess();
            }

        }
}

?>