<?php 

class TEMPLATE {

   public $template;
   
   public function __construct() 
				{
					//include_once "../lib/error.directive.php";
				}

   public function load($filepath) {
		$filepath = '../templates/' . $filepath;
		$this->template = file_get_contents($filepath);

   }

   public function replace($var, $content) {

      $this->template = str_replace("#$var#", $content, $this->template);

   }

   public function publish() {
   
			return $this->template;
	}

}

?>