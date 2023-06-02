<?php 
$id = '';
$tab = '';
$campo = '';
$value = '';
$function = '';

// preleva dati ( id - tabella - campo )
if (isset ($_POST['id']))
	{
		$id = $_POST['id'];
	}
if (isset ($_POST['tabella']))
	{
		$tab = $_POST['tabella'];
	}
if (isset ($_POST['campo']))
	{
		$campo = $_POST['campo'];
	}
if (isset ($_POST['valore']))
	{
		$value = $_POST['valore'];
	}
if (isset ($_POST['funzione']))
	{
		$function = $_POST['funzione'];
	}
	
	if ($tab && $campo && $value && $function)
		{
			include "php/db.inc.php";
			$dati = new TABLE($tab, $campo);
			$dati->doServer();
			if ( $function === 'sub' )
				{
					$error = $dati->delData($id);
					if ( !$error )
						{
							echo ' " ' . $value . ' " rimosso con successo...';
						}
					else
						{
							return $this->errorMessage();
						}
				}
			else if ( $function === 'add' )
				{
					$error = $dati->addData($value);
					if ( !$error )
						{
							echo ' " ' . $value . ' " aggiunto con successo...';
						}
					else
						{
							return $this->errorMessage();
						}
				
				}
			
		}
	else
		{
			echo 'ATTENZIONE Dati non integri...<br />operazione non riuscita.';
		}

	 function errorMessage()
		{
			$testo = 'Errore!<br />si è verificato un errore!';
			return $testo;
		}
		






?>