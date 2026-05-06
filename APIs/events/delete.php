<?php
$base = '/Applications/MAMP/htdocs/MyOrganized/APIs/services/';
include($base . 'DBconnect.php');
include($base . 'usrCheck.php');

$id = $_POST["id_evnt"];

$query = "DELETE FROM events WHERE id = " . $id;

if($conn->query($query) === TRUE){
    //die ("Evento eliminato con successo");
    http_response_code(200);
    header("Location: planner.html");
}else{
    http_response_code(400);
    echo "Errore";
}