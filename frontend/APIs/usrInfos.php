<?php
    session_start();
    include "usrCheck.php";
    include "connect_db.php";


    $stmt = $conn->prepare("Select * from users where id = " . $_SESSION['user_id']);
    $stmt->execute();
    $res = $stmt->get_result();

    if($res->num_rows === 0){
        http_response_code(401);
        exit;
    }

    $usrInfos = $res->fetch_assoc();

    $stmt2 = $conn->prepare("Select * from routines Inner Join usrstoroutines on usrstoroutines.`idRoutine` = routines.id where usrstoroutines.`idUsr` = " . $_SESSION['user_id']);
    $stmt2->execute();
    $res2 = $stmt2->get_result();
    $routines = [];
    while($row = $res2->fetch_assoc()){
        $routines[] = $row;
    }

    $wayOut = [
        'email' => $usrInfos['email'],
        'name' => $usrInfos['name'],
        'surname' => $usrInfos['email'],
        'routines' => $routines
    ];

    http_response_code(200);
    echo json_encode($wayOut);


?>