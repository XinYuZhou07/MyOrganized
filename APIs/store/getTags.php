<?php
    
    //header('Content-Type: application/json');
    session_start();

    //include "../services/DBconnect.php";

    function getTags($conn){
        $stmt = $conn->prepare("SELECT id, descriz FROM tags");
        $stmt->execute();
        $res = $stmt->get_result();

        $tagsInfos = [];
        while ($row = $res->fetch_assoc()) {
            $tagsInfos[] = [
                'id' => $row['id'],
                'descriz' => $row['descriz'],
            ];
        }

        $wayOut = [
            'tags' => $tagsInfos
        ];

        http_response_code(200);
        return $wayOut;
        //echo json_encode($wayOut);
    }

    

?>