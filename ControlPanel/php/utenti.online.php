<?php
# inizializzazione della sessione
@session_start();
# creazione dell'identificatore di sessione
$sessione = @session_id();
# CREARE UNA CLASSE CHIAMATA UTENTI();
# memorizzazione in variabile del momento di connessione
$time = @time();
# definizione dell'intervallo di tempo valido per l'utente connesso
$intervallo = $time-300;

# mi collego al database 
/*@require "db.inc.php";
$conn2 = new FUNCT();
$conn2->doServer();*/

# confronto tra identificatore di sessione e dati in tabella
$sql_confronto="SELECT * FROM utenti_on_line WHERE sessione='$sessione'";
$res_confronto=@mysql_query($sql_confronto) or die(mysql_error());

# se l'identificatore non è presente viene creato un nuovo record
if(@mysql_num_rows($res_confronto)==0){
                $sql_inserimento="INSERT INTO utenti_on_line(sessione, timestamp)VALUES('$sessione', '$time')";
                $res_inserimento=@mysql_query($sql_inserimento) or die(mysql_error());
        }
else {
        # se l'identificatore è già presente viene aggiornato il 
                # valore relativo al momento di connessione
         $sql_aggiornamento="UPDATE utenti_on_line SET timestamp='$time' WHERE sessione = '$sessione'";
        $res_aggiornamento=@mysql_query($sql_aggiornamento) or die(mysql_error());
        }

# estrazione dei record presenti in tabella per il conteggio 
$sql_conteggio="SELECT id FROM utenti_on_line";
$res_conteggio=@mysql_query($sql_conteggio) or die(mysql_error());
$conteggio=@mysql_num_rows($res_conteggio);

# stampa a video del conteggio
echo "Utenti online: " . $conteggio; 
 
# cancellazione dei record obsoleti 
$sql_cancellazione="DELETE FROM utenti_on_line WHERE timestamp<$intervallo";
$res_cancellazione=@mysql_query($sql_cancellazione) or die(mysql_error());

# chiusura della connessione 
@mysql_close();
?>
