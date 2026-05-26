<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start(); // ← manca nel tuo debug!
$_SESSION['user_id'] = 1; // ← metti un ID valido

include "../APIs/services/DBconnect.php";
include "../APIs/usr/feedRSS.php";

// Step 1 - DB ok?
echo "Conn: ";
var_dump($conn);

// Step 2 - Sessione ok?
echo "UserID: " . $_SESSION['user_id'] . "<br>";

// Step 3 - Funzione
$rssElements = feedRSS($conn);

echo "<pre>";
var_dump($rssElements);
echo "</pre>";
?>