<?php

include("./connect_db.php");

if (isset($_SESSION['user_id'])) {
    $stmt = $mysqli->prepare("SELECT id FROM users WHERE id = " . $_SESSION['user_id']);
    $stmt->execute();
    $res = $stmt->get_result();
} else{
    http_response_code(401);
    exit;
}

if ($res->num_rows === 0) {
    session_destroy();
    http_response_code(401);
    exit;
} else {
    http_response_code(200);
    exit;
}


?>