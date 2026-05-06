<?php
    header('Content-Type: application/json');
    session_start();
    include "../services/usrCheck.php";

    if(http_response_code() === 401) {
        exit;
    }
    include "../services/DBconnect.php";
    

    $stmt = $conn->prepare("Select * from users where id = " . $_SESSION['user_id']);
    $stmt->execute();
    $res = $stmt->get_result();

    if($res->num_rows === 0){
        http_response_code(401);
        exit;
    }

    $usrInfos = $res->fetch_assoc();

    $wayOut = [
        'email' => $usrInfos['email'],
        'name' => $usrInfos['name'],
        'surname' => $usrInfos['surname']
    ];

    http_response_code(200);
    echo json_encode($wayOut);


?>