<?php

function feedRSS ($conn){
    $idUsr = $_SESSION['user_id'];

    $stmt = $conn->prepare("SELECT rssURL FROM feedRSS WHERE usrID = ?");
    $stmt->bind_param("i", $idUsr);
    $stmt->execute();
    $res = $stmt->get_result();

    $rssElements = [];
    while ($row = $res->fetch_assoc()) {
        $feedURL = $row['rssURL'];

        // Sopprimi i warning di simplexml e gestisci l'errore
        $rss = @simplexml_load_file($feedURL);

        if ($rss === false) {
            // Feed non raggiungibile o XML non valido
            $rssElements[] = [
                'owner' => null,
                'title' => null,
                'link'  => null,
                'error' => "Feed non caricabile: $feedURL"
            ];
            continue;
        }

        if (!isset($rss->channel->item[0])) {
            // Feed valido ma senza articoli
            $rssElements[] = [
                'owner' => htmlspecialchars((string)$rss->channel->title),
                'title' => null,
                'link'  => null,
                'error' => 'Nessun articolo nel feed'
            ];
            continue;
        }

        $article = $rss->channel->item[0];
        $rssElements[] = [
            'owner' => htmlspecialchars((string)$rss->channel->title),
            'title' => htmlspecialchars((string)$article->title),
            'link'  => htmlspecialchars((string)$article->link),
        ];
    }

    return $rssElements;
}

?>