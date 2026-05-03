<?php
include "connect_db.php";

$id = $_POST["id_evnt"];
$nome = $_POST["nameEvent"];
$luogo = $_POST["placeEvent"];
$dateIn = $_POST["dateEvent"] . " " . $_POST["startTime"] . ":00";
$dateFin = $_POST["dateEvent"] . " " . $_POST["endTime"] . ":00";

$descriz = $_POST["descriz"];


//echo $_POST["dateEvent"];

$query = "UPDATE events ";
$query .= "SET title = '" . $nome . "', descriz = '" . $descriz . "', position = '" . $luogo . "', start = '" . $dateIn . "', end = '" . $dateFin . "' ";
$query .= "WHERE id = " . $id;

if($conn->query($query) === TRUE){
    //echo "Evento modificato con successo";
    header("Location: planner.html");
}else{
    echo "Errore";
}