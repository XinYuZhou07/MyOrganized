<?php

$dbuser = "root";
$dbpassword = "";
$dbname = "myorganized";
$dbhost = "localhost";
$dbport = 3306;

//creo connessione
$conn = new mysqli($dbhost, $dbuser, $dbpassword, $dbname, $dbport);

//controlla la connessione
/* if($conn->connect_error){
    echo "Connection failed" . $conn->error;
    // die();
}else{
    echo "Connected";
} */

?>