<?php

    header('Content-Type: application/json');
    session_start();
    include "../services/DBconnect.php";

    $filter = $_GET["filter"];
    
    if(isset($filter)){
        $stmt = $conn->prepare("SELECT
        routines.id AS id,
        tags.descriz AS metatag,
        routines.name AS title,
        routines.descriz AS subtitle,
        routines.price AS price,
        
        (
        SELECT COUNT(*)
            FROM usrRoutines
            WHERE usrRoutines.idRoutine = routines.id
        ) AS soldQta,
        
        (
        SELECT COUNT(*)
            FROM proposals
            WHERE proposals.idRoutine = routines.id
        ) AS proposalsQta

        FROM routines
        INNER JOIN tags ON routines.idTag = tags.id
        WHERE tags.id = ?;");

        $stmt->bind_param("i", $filter);

    }else{
        $stmt = $conn->prepare("SELECT
        routines.id AS id,
        tags.descriz AS metatag,
        routines.name AS title,
        routines.descriz AS subtitle,
        routines.price AS price,
        
        (
        SELECT COUNT(*)
            FROM usrRoutines
            WHERE usrRoutines.idRoutine = routines.id
        ) AS soldQta,
        
        (
        SELECT COUNT(*)
            FROM proposals
            WHERE proposals.idRoutine = routines.id
        ) AS proposalsQta

        FROM routines
        INNER JOIN tags ON routines.idTag = tags.id;");
    }

    $stmt->execute();
    $res = $stmt->get_result();

    $tagsInfos = [];
    while ($row = $res->fetch_assoc()) {
        $tagsInfos[] = [
            'id' => $row['id'],
            'metatag' => $row['metatag'],
            'title' => $row['title'],
            'subtitle' => $row['subtitle'],
            'price' => $row['price'],
            'soldQta' => $row['soldQta'],
            'proposalsQta' => $row['proposalsQta']
        ];
    }

    $wayOut = [
        'routines' => $tagsInfos
    ];

    http_response_code(200);
    echo json_encode($wayOut);

?>