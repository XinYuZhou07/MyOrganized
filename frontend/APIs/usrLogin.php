<?php
    session_start();
    include "connect_db.php";

    $email = $_POST['email'] ?? null;
    $psw   = $_POST['password'] ?? null;

    if (!$email || !$psw) {
        http_response_code(400);
        exit;
    }

    $stmt = $conn->prepare("SELECT id, psw FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($res->num_rows === 0) {
        http_response_code(401);
        exit;
    }

    $row = $res->fetch_assoc();

    
    if (!password_verify($psw, $row['psw'])) {
        http_response_code(401);
        exit;
    }else{
        $_SESSION['user_id'] = $row['id'];
        http_response_code(200);
        exit;
    }
?>