<?php
session_start();
$base = '/Applications/MAMP/htdocs/MyOrganized/APIs/services/';
include($base . 'DBconnect.php');
include($base . 'usrCheck.php');

header("Content-Type: application/json; charset=UTF-8");

$date = isset($_GET['date']) ? trim($_GET['date']) : '';

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
    http_response_code(400);
    echo json_encode(["error" => "Parametro 'date' mancante o non valido (atteso YYYY-MM-DD)."]);
    exit;
}

$idUsr = $_SESSION['user_id'];

$stmt = $conn->prepare("
    SELECT
        id,
        title,
        descriz,
        POSITION AS location,
        START,
        end
    FROM events
    WHERE idUsr = ?
      AND DATE(START) = ?
    ORDER BY START ASC
");

$stmt->bind_param("is", $idUsr, $date);
$stmt->execute();
$result = $stmt->get_result();

$events = [];

while ($row = $result->fetch_assoc()) {
    $startDt  = new DateTime($row['START']);
    $endDt    = new DateTime($row['end']);
    $timeMain = $startDt->format('H:i');

    $diffMin = ($endDt->getTimestamp() - $startDt->getTimestamp()) / 60;

    if ($diffMin >= 60 && $diffMin % 60 === 0) {
        $duration = ($diffMin / 60) . 'h';
    } elseif ($diffMin >= 60) {
        $h = floor($diffMin / 60);
        $m = $diffMin % 60;
        $duration = $h . 'h ' . $m . 'min';
    } else {
        $duration = $diffMin . 'min';
    }

    $events[] = [
        "id"       => (int)$row['id'],
        "title"    => $row['title'],
        "descriz"  => $row['descriz'],
        "location" => $row['location'],
        "timeMain" => $timeMain,
        "duration" => $duration,
        "start"    => $row['START'],
        "end"      => $row['end'],
    ];
}

$stmt->close();

echo json_encode([
    "date"   => $date,
    "count"  => count($events),
    "events" => $events
], JSON_UNESCAPED_UNICODE);
?>