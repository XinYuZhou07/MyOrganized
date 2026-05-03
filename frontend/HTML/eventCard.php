<?php
/**
 * eventCard.php — MyOrganized
 * Snippet riutilizzabile: include questa pagina ovunque vuoi mostrare
 * gli eventi del giorno corrente.
 *
 * Utilizzo:
 *   <?php include 'eventCard.php'; ?>
 *
 * Richiede che connect_db.php sia già stato incluso oppure che $conn
 * sia già disponibile. Se non lo è, viene incluso automaticamente.
 */

// Includi la connessione al DB se non è già stata fatta
if (!isset($conn)) {
    require_once 'connect_db.php';
}

// Data odierna
$oggi = date('Y-m-d');

// Query: tutti gli eventi dell'utente loggato per oggi
// Assumiamo che la sessione sia avviata e che $_SESSION['idUsr'] esista
$idUsr = isset($_SESSION['idUsr']) ? (int)$_SESSION['idUsr'] : 1; // fallback a 1 in dev

$stmt = $conn->prepare(
    "SELECT title, descriz, position, start, end
     FROM events
     WHERE idUsr = ?
       AND DATE(start) = ?
     ORDER BY start ASC"
);
$stmt->bind_param("is", $idUsr, $oggi);
$stmt->execute();
$result = $stmt->get_result();
$events = $result->fetch_all(MYSQLI_ASSOC);
$stmt->close();

// ────────────────────────────────────────────────────────────
//  HELPER: calcola durata tra due datetime in formato leggibile
// ────────────────────────────────────────────────────────────
function formatDuration(string $start, string $end): string {
    $s = new DateTime($start);
    $e = new DateTime($end);
    if ($e <= $s) return '';
    $diff = $s->diff($e);
    $h = $diff->h + ($diff->days * 24);
    $m = $diff->i;
    if ($h > 0 && $m > 0) return "{$h}h {$m}m";
    if ($h > 0)            return "{$h}h";
    return "{$m}m";
}

// ────────────────────────────────────────────────────────────
//  HELPER: determina se un evento è "in corso" adesso
// ────────────────────────────────────────────────────────────
function isOngoing(string $start, string $end): bool {
    $now  = new DateTime();
    $s    = new DateTime($start);
    $e    = new DateTime($end);
    return ($now >= $s && $now <= $e);
}

// ────────────────────────────────────────────────────────────
//  HELPER: percentuale di avanzamento (per la barra arancio)
// ────────────────────────────────────────────────────────────
function progressPercent(string $start, string $end): int {
    $now      = new DateTime();
    $s        = new DateTime($start);
    $e        = new DateTime($end);
    $total    = $e->getTimestamp() - $s->getTimestamp();
    $elapsed  = $now->getTimestamp() - $s->getTimestamp();
    if ($total <= 0) return 0;
    return min(100, max(0, (int)(($elapsed / $total) * 100)));
}
?>

<!-- ════════════════════════════════════════
     LISTA EVENTI DEL GIORNO  (eventCard.php)
     ════════════════════════════════════════ -->
<?php if (empty($events)): ?>

    <div class="ec-empty">
        <div class="ec-empty-icon"><i class="bi bi-calendar-check"></i></div>
        <div class="ec-empty-text">Nessun evento per oggi.</div>
    </div>

<?php else: ?>

    <div style="display:flex; flex-direction:column; gap:18px;">
    <?php foreach ($events as $ev):
        $timeStart   = date('H:i', strtotime($ev['start']));
        $duration    = formatDuration($ev['start'], $ev['end']);
        $ongoing     = isOngoing($ev['start'], $ev['end']);
        $progress    = $ongoing ? progressPercent($ev['start'], $ev['end']) : 0;
        $title       = htmlspecialchars($ev['title'] ?? '');
        $descriz     = htmlspecialchars($ev['descriz'] ?? '');
        $position    = htmlspecialchars($ev['position'] ?? '');
    ?>

        <div class="eventCard<?= $ongoing ? ' eventCard--ongoing' : '' ?>">

            <!-- Riga orario + durata -->
            <div class="eventDuration">
                <?= $timeStart ?>
                <?php if ($duration): ?>
                    • <span style="font-weight:500"><?= $duration ?></span>
                <?php endif; ?>
                <?php if ($ongoing): ?>
                    <span class="ec-badge-live">In corso</span>
                <?php endif; ?>
            </div>

            <!-- Titolo -->
            <div class="eventTitle"><?= $title ?></div>

            <!-- Sottotitolo (descrizione o posizione) -->
            <?php if ($position): ?>
                <div class="eventSubtitle"><?= $position ?></div>
            <?php elseif ($descriz): ?>
                <div class="eventSubtitle"><?= $descriz ?></div>
            <?php endif; ?>

            <!-- Barra progresso (solo se evento in corso) -->
            <?php if ($ongoing): ?>
                <div class="ec-progress-track">
                    <div class="ec-progress-fill" style="width:<?= $progress ?>%"></div>
                </div>
            <?php endif; ?>

        </div>

    <?php endforeach; ?>
    </div>

<?php endif; ?>
