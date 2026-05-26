<?php
    session_start();
    include "../services/DBconnect.php";

    if (isset($_SESSION['user_id'])) {
        //echo "isset";
        $stmt = $conn->prepare("SELECT id FROM users WHERE id = ?");
        $stmt->bind_param("i", $_SESSION['user_id']);
        $stmt->execute();
        $res = $stmt->get_result();
    } else{
        http_response_code(401);
        header("Location: http://localhost/myorganized/HTML/login.html");
        //Il percorso relativo non si può usare -> quando si include questo file negli altri il percorso non funge più
        //header("Location: ../../HTML/login.html");
        die;
    }

    if ($res->num_rows === 0) {
        //echo "destroy";
        session_destroy();
        http_response_code(401);
    } else {
        http_response_code(200);
    }

    if ($row = $res->fetch_assoc()) {
        //echo "fetch";
        http_response_code(200);
    }
?>