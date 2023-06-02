<?php 
class ADRS
{

	public $root;
	public $cp_root;
	
	public function getServerRoot()
		{
			$this->root = 'http://' . $_SERVER['SERVER_NAME'] . '/';
			return $this->root;
		}
		
	public function getCPRoot()
		{
			$cp_dir = array();
			$dir = substr($_SERVER['PHP_SELF'],1);
			$temp_dir = explode( "/", $dir);
			while ($temp_dir[1] == 'ControlPanel')
				{
					$cp_dir[] = array_shift($temp_dir);
				}
			$cp_dir[] = 'ControlPanel';
			$this->getServerRoot();
			$this->cp_root = $this->root . (implode( "/", $cp_dir)) . '/';
			return $this->cp_root;
		}

			public function create_relative_path($inSourcePath, $inRefPath)
{
    //  taglia le stringhe agli slash...
			$s_parts            = explode('/', $inSourcePath);
			$r_parts            = explode('/', $inRefPath);
    
    // cancella gli elementi non uguali dagli array
    while ($s_parts[0] === $r_parts[0])
    {
        array_shift($s_parts);
        array_shift($r_parts);
    }
    
    // aggiungi la wild-card ".." per ogni elemento identico
    while ($s_parts[0])
    {
        array_unshift($r_parts, '..');
        array_shift($s_parts);
    }
    
    return implode('/', $r_parts);
}

//----------------------------------------------------------
// Esempio:

//		Data la directory $sp, genera la directory relativa di $rp.
//		$sp deve essere assegnata usando S_SERVER['PHP_SELF']
//		Guarda gli esempi

//----------------------------------------------------------
# $sp = '/WebServer/Documents/MyBigProject/php/project_script.php';
# $rp = '/WebServer/Documents/MyLibraries/lib_script.php';

// inserisci in runTime
#  $rel_path = create_relative_path($sp, $rp);

// risultato
# '../../../MyLibraries/lib_script.php'

// puo' essere anche usato cosi...
# include_once(create_relative_path($_SERVER['PHP_SELF'], $rp)); 











}		// END  OF  CLASS 
?>