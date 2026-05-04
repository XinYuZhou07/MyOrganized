<?php
include "connect_db.php";

$nome = $_POST["nameEvent"];
$luogo = $_POST["placeEvent"];
$dateIn = $_POST["dateEvent"] . " " . $_POST["startTime"] . ":00";
$dateFin = $_POST["dateEvent"] . " " . $_POST["endTime"] . ":00";

$descriz = $_POST["descriz"];

//TODO: inserire id utente da sessione
$query = "INSERT INTO events (idUsr, title, descriz, POSITION, START, end) VALUES (1, '". $nome ."', '". $descriz ."', '". $luogo ."', '". $dateIn ."', '". $dateFin ."') ";

//echo "Inizio: " . $dateIn;
//echo "Fine: " . $dateFin;

if($conn->query($query) === TRUE){
    //echo "Evento aggiunto con successo";
    http_response_code(200);
    header("Location: planner.html");
}else{
    http_response_code(400);
    echo "Errore";
}