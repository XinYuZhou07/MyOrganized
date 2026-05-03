<?php
// get_events.php — MyOrganized
// Restituisce gli eventi di un dato giorno come JSON
// Chiamata: get_events.php?date=YYYY-MM-DD

include "connect_db.php";

header("Content-Type: application/json; charset=UTF-8");

// ── Sicurezza: valida il parametro date ──────────────────────────────────────
$date = isset($_GET['date']) ? trim($_GET['date']) : '';

if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
    http_response_code(400);
    echo json_encode(["error" => "Parametro 'date' mancante o non valido (atteso YYYY-MM-DD)."]);
    exit;
}

// ── Query: tutti gli eventi dell'utente per quella data ──────────────────────
// TODO: sostituire 1 con l'id utente dalla sessione ($_SESSION['idUsr'])
$idUsr = 1;

$stmt = $conn->prepare("
    SELECT
        id,
        title,
        descriz,
        POSITION  AS location,
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

// ── Formatta ogni evento ─────────────────────────────────────────────────────
$events = [];

while ($row = $result->fetch_assoc()) {

    // Orario inizio → "HH:MM"
    $startDt  = new DateTime($row['START']);
    $endDt    = new DateTime($row['end']);
    $timeMain = $startDt->format('H:i');

    // Durata in ore (es. 1.5h, 45min)
    $diffSec  = $endDt->getTimestamp() - $startDt->getTimestamp();
    $diffMin  = $diffSec / 60;

    if ($diffMin >= 60 && $diffMin % 60 === 0) {
        // Ore intere
        $duration = ($diffMin / 60) . 'h';
    } elseif ($diffMin >= 60) {
        // Ore + minuti
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

// ── Output ────────────────────────────────────────────────────────────────────
echo json_encode([
    "date"   => $date,
    "count"  => count($events),
    "events" => $events
], JSON_UNESCAPED_UNICODE);
?>
