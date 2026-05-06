<?php
session_start();
$base = '/Applications/MAMP/htdocs/MyOrganized/APIs/services/';
include($base . 'DBconnect.php');
include($base . 'usrCheck.php');

$idUsr   = $_SESSION['user_id'];
$nome    = $_POST["nameEvent"]  ?? '';
$luogo   = $_POST["placeEvent"] ?? '';
$descriz = $_POST["descriz"]    ?? '';
$dateIn  = ($_POST["dateEvent"] ?? '') . " " . ($_POST["startTime"] ?? '') . ":00";
$dateFin = ($_POST["dateEvent"] ?? '') . " " . ($_POST["endTime"]   ?? '') . ":00";

$stmt = $conn->prepare(
    "INSERT INTO events (idUsr, title, descriz, POSITION, START, end) VALUES (?, ?, ?, ?, ?, ?)"
);
$stmt->bind_param("isssss", $idUsr, $nome, $descriz, $luogo, $dateIn, $dateFin);

if ($stmt->execute()) {
    header("Location: /MyOrganized/HTML/planner.html");
} else {
    http_response_code(400);
    echo "Errore inserimento: " . $conn->error;
}
?>