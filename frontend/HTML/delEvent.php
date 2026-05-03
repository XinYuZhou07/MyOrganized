<?php
include "connect_db.php";

$id = $_POST["id_evnt"];

$query = "DELETE FROM events WHERE id = " . $id;

if($conn->query($query) === TRUE){
    die ("Evento eliminato con successo");
    //header("Location: planner.html");
}else{
    echo "Errore";
}