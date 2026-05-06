<?php
    session_start();
    include "../services/DBconnect.php";

    $name   = $_POST['name'] ?? null;
    $surname   = $_POST['surname'] ?? null;
    $email = $_POST['email'] ?? null;
    $psw   = $_POST['password'] ?? null;

    if (!$email || !$psw || !$name || !$surname) {
        http_response_code(401);
        exit;
    }

    $psw = password_hash($psw, PASSWORD_DEFAULT);

    $stmt = $conn->prepare("INSERT INTO users (name, surname, email, psw) VALUES(?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $surname, $email, $psw);
    
    if (!$stmt->execute()) {
        http_response_code(500);
        die("Errore execute: " . $stmt->error);
    }

    $_SESSION['user_id'] = $conn->insert_id;
    http_response_code(200);
    header("Location: ../../HTML/home.html");
    exit;
?>