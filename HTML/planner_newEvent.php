<?php
session_start();
include "../APIs/services/DBconnect.php";
include "../APIs/services/usrCheck.php";
?>

<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MyOrganized – Nuovo Evento</title>

  <!-- Libraries -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- CSS progetto -->
  <link rel="stylesheet" href="../CSS/fontSettings.css">
  <link rel="stylesheet" href="../CSS/interCSS.css">
  <link rel="stylesheet" href="../CSS/detailedCSS.css">
  <link rel="stylesheet" href="../CSS/planner.css">
  <link rel="stylesheet" href="../CSS/calendario.css">
  <link rel="stylesheet" href="../CSS/newEventPlanner.css">

</head>
<body>

  <!-- Input hidden richiesto da calendario.js -->
  <input type="hidden" id="data_evento_input">

  <!-- NAVBAR -->
  <nav class="navbar-newEvent">
    <div class="navbar-newEvent-L">
      <a class="navbar-newEvent-back" href="./planner.html">
        <i class="bi bi-arrow-left"></i>
      </a>
      <div class="navbar-newEvent-titleBlock">
        <div class="main">Nuovo Evento</div>
        <div class="sub">Planner</div>
      </div>
    </div>
    <a class="navbar-newEvent-brand" href="./homePage.html">MyOrganized</a>
  </nav>

  <!-- PAGINA -->
  <div class="mainView">
    <div class="mainLayout newEvent-layout">

      <!-- COLONNA SINISTRA -->
      <div class="newEvent-leftCol">

        <!-- CALENDARIO -->
        <div class="block planner-calendar-block">
          <div class="metaTag">Calendario</div>
          <div style="display:flex; align-items:center; gap:10px; margin-top:4px;">
            <i class="bi bi-calendar3" style="font-size:26px; color:#555;"></i>
            <div class="cal-month-row">
              <button class="cal-month-btn" id="month-btn" type="button">
                <div class="elementTitle" id="month-label">Novembre 2025</div>
                <i class="bi bi-caret-down-fill cal-caret" id="cal-caret"></i>
              </button>
              <div class="cal-dropdown" id="cal-dropdown">
                <div class="cal-dd-year-row">
                  <button class="cal-dd-year-btn" id="yr-prev" type="button">&#8592;</button>
                  <span class="cal-dd-year-val" id="dd-year-val"></span>
                  <button class="cal-dd-year-btn" id="yr-next" type="button">&#8594;</button>
                </div>
                <div class="cal-dd-months" id="dd-months"></div>
              </div>
            </div>
          </div>
          <hr style="margin: 14px 0; opacity: 0.2;">
          <div class="calendar" id="cal-grid"></div>
        </div>

        <!-- LA TUA GIORNATA -->
        <div class="block newEvent-dayAgenda">
          <div class="newEvent-dayAgenda-header">
            <div class="metaTag" style="font-size:14px;">La tua Giornata</div>
            <div id="agenda-date-label" class="elementSubtitle" style="font-size:16px;">—</div>
          </div>
          <div id="agenda-list" class="newEvent-dayAgenda-list">
            <div class="agenda-empty">
              <i class="bi bi-calendar3"></i>
              <span>Seleziona un giorno.</span>
            </div>
          </div>
        </div>

      </div>

      <!-- COLONNA DESTRA -->
      <div class="newEvent-right">

        <!-- FORM CARD -->
        <div class="block newEvent-formCard">

          <!-- Day header dinamico -->
          <div class="newEvent-dayHeader">
            <div id="form-day-number" class="newEvent-dayNumber">—</div>
            <div class="newEvent-dayMeta">
              <div id="form-day-weekday" class="newEvent-dayWeekday">—</div>
              <div id="form-day-month"   class="newEvent-dayMonth">—</div>
            </div>
          </div>

          <div class="newEvent-formIntro">
            <div class="newEvent-formIntro-small">Crea un Nuovo Evento</div>
            <div class="newEvent-formIntro-bold">Personalizza il tuo Promemoria.</div>
          </div>

          <form action="../APIs/events/new.php" method="post">
            <div class="newEvent-formFields">

              <div class="newEvent-fieldGroup">
                <span class="newEvent-fieldLabel">Titolo</span>
                <input type="text" name="nameEvent" class="newEvent-input" placeholder="Nome Evento">
              </div>

              <div class="newEvent-fieldGroup">
                <span class="newEvent-fieldLabel">Posizione</span>
                <input type="text" name="placeEvent" class="newEvent-input" placeholder="Luogo">
              </div>

              <div class="newEvent-fieldGroup">
                <span class="newEvent-fieldLabel">Timeline</span>
                <div class="newEvent-timeRow">
                  <!-- dateEvent viene aggiornato da JS al click sul calendario -->
                  <input type="hidden" name="dateEvent" id="form-date-input">
                  <div class="timeBlock">
                    <span class="timeLabel">Dalle Ore:</span>
                    <input type="time" name="startTime" id="startTime" class="newEvent-inputTime" value="10:00">
                  </div>
                  <div class="timeBlock">
                    <span class="timeLabel">Alle Ore:</span>
                    <input type="time" name="endTime" id="endTime" class="newEvent-inputTime" value="11:00">
                  </div>
                  <div class="timeDuration">
                    <div id="duration-display" class="timeDuration-main">1h</div>
                    <div class="timeDuration-sub">Durata Totale</div>
                  </div>
                </div>
              </div>

              <div class="newEvent-fieldGroup">
                <span class="newEvent-fieldLabel">Note</span>
                <textarea name="descriz" class="newEvent-input" rows="4" placeholder="Note"></textarea>
              </div>

              <button class="newEvent-addBtn">Aggiungi</button>
            </div>
          </form>

        </div>

        <!-- ASSISTANT CARD -->
        <div class="block newEvent-assistantCard">
          <p class="superTitle">Coming Soon</p>
          <p class="subTitle">Sezione AI</p>
        </div>

      </div>

    </div>
  </div>

  <!-- calendario.js — gestisce rendering griglia e aggiorna data_evento_input -->
  <script src="../JS/calendario.js"></script>
  <script src="../JS/newEventPlanner.js"></script>
</body>
</html>