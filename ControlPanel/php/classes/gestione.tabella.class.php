<?php 
class TABLE extends FUNCT
{
	var $tabella;
	var $campo;
	var $id;
	var $res = array();
	
		public function __construct($tabella, $campo)
			{
				$this->tabella = $tabella;
				$this->campo = $campo;
			}
			
		public function addData($value)
			{
				$sql = "INSERT INTO `$this->tabella` ";
				$sql .= " (`$this->campo`) VALUES ('$value')";
				$this->insertSql($sql);
					
			}
			
		public function delData($id)
			{
				$sql  = "DELETE FROM `$this->tabella` ";
				$sql .= "WHERE `id` = $id ";
				$this->insertSql($sql);
			}
			
		public function creaElenco()
			{
				$sql  = "SELECT `id`,`$this->campo` FROM ";
				$sql .= " `$this->tabella` ";
				$sql .= " ORDER BY `$this->campo` ASC ";
				$this->insertSql($sql);
				while($this->row = @mysql_fetch_assoc($this->results))
					{
						$this->res[] = array( 'id' => $this->row['id'], 'dato' => $this->row[$this->campo]);
					}
				return $this->res;
			}
		

}		// END  OF  CLASS 
?>