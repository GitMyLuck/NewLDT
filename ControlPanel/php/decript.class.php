<?php 
//header('Content-type: text/html;charset=utf-8');
class DECR extends CONNECT
{
public $result;

public function shift64enc($string)
	{
		$temp = '';
		$temp_2 = '';
		$temp_3 = '';
				// da chiaro a base 64
		$temp = base64_encode($string);
				
		// shift di 3
		$valore = 3; 
		for ($i=0; $i<strlen($temp); $i++) 
				{
					$carattere = $temp[$i];
					$xor = ord($temp[$i]) + $valore;
					$car = chr($xor);
					$temp_2 .= $car;
				}
			$this->result = base64_encode($temp_2);
			return $this->result;
	}
	
	public function shift64dec($string)
		{
				$temp = '';
				$temp_2 = '';
				$temp_3 = '';
				// da chiaro a base 64
				$temp = base64_decode($string);
				
				// shift di 3
				$valore = 3; 
				for ($i=0; $i<strlen($temp); $i++) 
					{
						$carattere = $temp[$i];
						$xor = ord($temp[$i]) - $valore;
						$car = chr($xor);
						$temp_2 .= $car;
					}
				$this->result = base64_decode($temp_2);
				return $this->result;
		
		}

}
?>