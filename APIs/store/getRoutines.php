<?php

    //header('Content-Type: application/json');
    session_start();
    //include "../services/DBconnect.php";

    function getRoutines($conn){
        $keyword = (isset($_GET["keyword"]) && $_GET["keyword"] !== '') ? $_GET["keyword"] : null;
        $filter  = (isset($_GET["filter"]) && $_GET["filter"] !== '') ? $_GET["filter"] : null;
        
        if($filter!== null && $keyword !== null){
            //echo "both";
            $stmt = $conn->prepare("SELECT
            routines.id AS id,
            tags.descriz AS metatag,
            routines.name AS title,
            routines.descriz AS subtitle,
            routines.price AS price,
            routines.imgSrc AS img,
            
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
            WHERE tags.id = ? and routines.name LIKE ?;");
            $keyword = "%" . $keyword . "%";
            $stmt->bind_param("is", $filter, $keyword);

        }else if($filter !== null){
            //echo "filt";
            $stmt = $conn->prepare("SELECT
            routines.id AS id,
            tags.descriz AS metatag,
            routines.name AS title,
            routines.descriz AS subtitle,
            routines.price AS price,
            routines.imgSrc AS img,
            
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

        }else if($keyword!== null){
            //echo "keyw";
            $stmt = $conn->prepare("SELECT
            routines.id AS id,
            tags.descriz AS metatag,
            routines.name AS title,
            routines.descriz AS subtitle,
            routines.price AS price,
            routines.imgSrc AS img,
            
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
            WHERE routines.name LIKE ?;");

            $keyword = "%" . $keyword . "%";
            $stmt->bind_param("s", $keyword);

        }else {
            //echo "giusto";
            $stmt = $conn->prepare("SELECT
            routines.id AS id,
            tags.descriz AS metatag,
            routines.name AS title,
            routines.descriz AS subtitle,
            routines.price AS price,
            routines.imgSrc AS img,
            
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
                'proposalsQta' => $row['proposalsQta'],
                'img' => $row['img']
            ];
        }

        

        $wayOut = [
            'routines' => $tagsInfos
        ];

        http_response_code(200);
        //echo json_encode($wayOut);
        return $wayOut;

    }

    
    

?>