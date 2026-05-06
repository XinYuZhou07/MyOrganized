<?php
    session_start();
    include "../services/DBconnect.php";

    if (isset($_SESSION['user_id'])) {
        $stmt = $conn->prepare("SELECT id FROM users WHERE id = " . $_SESSION['user_id']);
        $stmt->execute();
        $res = $stmt->get_result();
    } else{
        http_response_code(401);
    }

    if ($res->num_rows === 0) {
        session_destroy();
        http_response_code(401);
    } else {
        http_response_code(200);
    }
?>