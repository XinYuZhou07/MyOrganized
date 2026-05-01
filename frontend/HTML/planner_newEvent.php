<?php
include "connect_db.php";
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


  <style>
    /* ── NAVBAR NUOVO EVENTO (dark top bar) ── */
    .navbar-newEvent {
      width: 95%;
      margin: 25px auto 0 auto;
      background: #4a4a4a;
      padding: 16px 24px;
      border-radius: 10px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 10px 25px rgba(0,0,0,0.25);
    }
    .navbar-newEvent-L {
      display: flex;
      align-items: center;
      gap: 14px;
    }
    .navbar-newEvent-back {
      color: white;
      font-size: 22px;
      text-decoration: none;
      opacity: 0.85;
      line-height: 1;
    }
    .navbar-newEvent-titleBlock .main {
      font-size: 20px;
      font-weight: 400;
      color: white;
      line-height: 1.15;
    }
    .navbar-newEvent-titleBlock .sub {
      font-size: 13px;
      font-weight: 200;
      color: rgba(255,255,255,0.55);
      line-height: 1;
    }
    .navbar-newEvent-brand {
      font-size: 22px;
      font-weight: 300;
      color: white;
      text-decoration: none;
    }

    /* ── LAYOUT NUOVO EVENTO ── */
    .newEvent-layout {
      display: grid;
      grid-template-columns: 38% 1fr;
      gap: 2.5%;
      align-items: start;
    }

    /* colonna sinistra */
    .newEvent-leftCol {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    /* ── CALENDARIO ── */
    .planner-calendar-block {
      /* usa .block per shadow/radius/padding */
    }

    .calendar {
      display: grid;
      grid-template-columns: repeat(7, 1fr);
      gap: 6px;
      margin-top: 10px;
      text-align: center;
    }
    .calendar .weekday {
      font-size: 12px;
      font-weight: 600;
      color: #aaa;
      padding: 4px 0;
      letter-spacing: 0.5px;
    }
    .calendar .day {
      font-size: 14px;
      width: 38px;
      height: 38px;
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      cursor: pointer;
      margin: auto;
      color: #333;
      font-weight: 300;
      transition: background 0.15s;
      border: 1px solid #e8e8e8;
    }
    .calendar .day:hover { background: #f5f5f5; }
    .calendar .day.prevMonth { color: #bbb; border-color: #f0f0f0; }
    .calendar .day.today {
      background: #e8720c;
      color: #fff;
      border-color: #e8720c;
      font-weight: 500;
      box-shadow: 0 4px 12px rgba(243,156,18,0.3);
    }
    .calendar .day.selected {
      background: #f5a623;
      color: #fff;
      border-color: #f5a623;
      font-weight: 500;
    }
    .calendar .day.sunday { color: #e0547a; border-color: #fce4ec; }
    .calendar .day.sunday.today,
    .calendar .day.sunday.selected { color: #fff; }

    /* ── LA TUA GIORNATA (agenda box) ── */
    .newEvent-dayAgenda {
      border: 2px solid #333 !important; /* come screenshot */
    }
    .newEvent-dayAgenda-header {
      margin-bottom: 14px;
    }
    .newEvent-dayAgenda-list {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
    .newEvent-agendaItem {
      display: flex;
      gap: 12px;
      padding: 10px 14px;
      border-radius: 6px;
      border: 1px solid #eee;
      background: #fff;
    }
    .newEvent-agendaTime {
      min-width: 38px;
      text-align: left;
    }
    .newEvent-agendaTime .timeMain {
      font-size: 13px;
      font-weight: 600;
      color: #4a4aab;
      display: block;
    }
    .newEvent-agendaTime .timeSub {
      font-size: 10px;
      color: #aaa;
      display: block;
    }
    .newEvent-agendaTitle {
      font-size: 14px;
      font-weight: 500;
      color: #111;
    }
    .newEvent-agendaLocation {
      font-size: 12px;
      color: #999;
      margin-top: 1px;
    }

    /* ── COLONNA DESTRA (form) ── */
    .newEvent-right {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    /* Form card */
    .newEvent-formCard {}

    .newEvent-dayHeader {
      display: flex;
      align-items: baseline;
      gap: 14px;
      margin-bottom: 18px;
    }
    .newEvent-dayNumber {
      font-size: 80px;
      font-weight: 100;
      line-height: 0.9;
      color: #111;
    }
    .newEvent-dayMeta {}
    .newEvent-dayWeekday {
      font-size: 28px;
      font-weight: 300;
      color: #111;
      line-height: 1.1;
    }
    .newEvent-dayMonth {
      font-size: 28px;
      font-weight: 400;
      color: #111;
      line-height: 1.1;
    }

    .newEvent-formIntro {
      margin-bottom: 22px;
    }
    .newEvent-formIntro-small {
      font-size: 13px;
      color: #aaa;
      font-weight: 200;
      margin-bottom: 2px;
    }
    .newEvent-formIntro-bold {
      font-size: 17px;
      font-weight: 500;
      color: #111;
    }

    /* form fields */
    .newEvent-formFields {
      display: flex;
      flex-direction: column;
      gap: 16px;
    }
    .newEvent-fieldGroup {}
    .newEvent-fieldLabel {
      font-size: 12px;
      font-weight: 500;
      color: #888;
      text-transform: uppercase;
      letter-spacing: 0.5px;
      margin-bottom: 6px;
      display: block;
    }
    .newEvent-input {
      width: 100%;
      padding: 13px 16px;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      font-size: 15px;
      color: #111;
      background: #fff;
      outline: none;
      font-family: inherit;
      transition: border-color 0.15s;
    }
    .newEvent-input:focus { border-color: #f5a623; }
    .newEvent-input::placeholder { color: #ccc; }
    textarea.newEvent-input { resize: none; }

    /* riga orari */
    .newEvent-timeRow {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .timeBlock {
      display: flex;
      align-items: center;
      gap: 8px;
      flex: 1;
    }
    .timeLabel {
      font-size: 13px;
      color: #888;
      white-space: nowrap;
    }
    .newEvent-inputTime {
      padding: 11px 12px;
      border: 1px solid #e0e0e0;
      border-radius: 8px;
      font-size: 14px;
      color: #111;
      outline: none;
      width: 100%;
      font-family: inherit;
    }
    .newEvent-inputTime:focus { border-color: #f5a623; }

    .timeDuration {
      background: #f5a623;
      color: #fff;
      border-radius: 8px;
      padding: 10px 18px;
      text-align: center;
      min-width: 88px;
    }
    .timeDuration-main {
      font-size: 20px;
      font-weight: 600;
      line-height: 1;
    }
    .timeDuration-sub {
      font-size: 10px;
      opacity: 0.9;
      margin-top: 3px;
    }

    /* bottone aggiungi */
    .newEvent-addBtn {
      width: 100%;
      padding: 17px;
      background: #f5a623;
      color: #fff;
      border: none;
      border-radius: 10px;
      font-size: 17px;
      font-weight: 500;
      cursor: pointer;
      margin-top: 4px;
      font-family: inherit;
      transition: background 0.15s;
      letter-spacing: 0.3px;
    }
    .newEvent-addBtn:hover { background: #e8720c; }

    /* assistant placeholder card */
    .newEvent-assistantCard {
      padding: 24px 30px;
    }
    .newEvent-assistantCard .superTitle {
      font-size: 42px;
      font-weight: 300;
      margin-bottom: -10px;
      color: #404040;
    }
    .newEvent-assistantCard .subTitle {
      font-size: 24px;
      font-weight: 200;
      color: #878787;
    }
  </style>
</head>
<body>

  <!-- NAVBAR NUOVO EVENTO -->
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

      <!-- COLONNA SINISTRA: calendario + agenda -->
<div class="newEvent-leftCol">

  <!-- CALENDARIO DINAMICO (Sostituito quello statico) -->
  <div class="block planner-calendar-block">

          <div class="metaTag">Calendario</div>

          <div class="cal-header-row">
            <i class="bi bi-calendar3 cal-icon"></i>

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

          <hr class="cal-hr">

          <div class="calendar" id="cal-grid"></div>

        </div>

        <!-- LA TUA GIORNATA -->
         
        <div class="block newEvent-dayAgenda">
          <div class="newEvent-dayAgenda-header">
            <div class="metaTag" style="font-size:14px;">La tua Giornata</div>
            <div class="elementSubtitle" style="font-size:16px;">Venerdì 19 Novembre</div>
          </div>
          <div class="newEvent-dayAgenda-list">

            <div class="newEvent-agendaItem">
              <div class="newEvent-agendaTime">
                <span class="timeMain">10:00</span>
                <span class="timeSub">1.5h</span>
              </div>
              <div class="newEvent-agendaBody">
                <div class="newEvent-agendaTitle">Inter Ikea Laboratory</div>
                <div class="newEvent-agendaLocation">Ikea di Milano Corsico.</div>
              </div>
            </div>

            <div class="newEvent-agendaItem">
              <div class="newEvent-agendaTime">
                <span class="timeMain">10:00</span>
                <span class="timeSub">1.5h</span>
              </div>
              <div class="newEvent-agendaBody">
                <div class="newEvent-agendaTitle">Inter Ikea Laboratory</div>
                <div class="newEvent-agendaLocation">Ikea di Milano Corsico.</div>
              </div>
            </div>

            <div class="newEvent-agendaItem">
              <div class="newEvent-agendaTime">
                <span class="timeMain">10:00</span>
                <span class="timeSub">1.5h</span>
              </div>
              <div class="newEvent-agendaBody">
                <div class="newEvent-agendaTitle">Inter Ikea Laboratory</div>
                <div class="newEvent-agendaLocation">Ikea di Milano Corsico.</div>
              </div>
            </div>

          </div>
        </div>

      </div><!-- fine leftCol -->

      <!-- COLONNA DESTRA: form -->
      <div class="newEvent-right">

        <!-- FORM CARD -->
        <div class="block newEvent-formCard">

        <!-- TODO: RENDERE DINAMICO -->
          <div class="newEvent-dayHeader">
            <div class="newEvent-dayNumber">19</div>
            <div class="newEvent-dayMeta">
              <div class="newEvent-dayWeekday">Lunedì</div>
              <div class="newEvent-dayMonth">Novembre</div>
            </div>
          </div>

          <div class="newEvent-formIntro">
            <div class="newEvent-formIntro-small">Crea un Nuovo Evento</div>
            <div class="newEvent-formIntro-bold">Personalizza il tuo Promemoria.</div>
          </div>

          <form action="addEvent.php" method="post">
            <div class="newEvent-formFields">

              <div class="newEvent-fieldGroup">
                <span class="newEvent-fieldLabel">Titolo</span>
                <input type="text" name="nameEvent" class="newEvent-input " placeholder="Nome Evento ">
              </div>

              <div class="newEvent-fieldGroup">
                <span class="newEvent-fieldLabel">Posizione</span>
                <input type="text" name="placeEvent" class="newEvent-input" placeholder="Luogo" >
              </div>

              <div class="newEvent-fieldGroup">
                <span class="newEvent-fieldLabel">Timeline</span>
                <div class="newEvent-timeRow">
                  <input type="hidden" name="dateEvent" id="data_evento_input" >
                  <div class="timeBlock">
                    <span class="timeLabel">Dalle Ore:</span>
                    <input type="time" name="startTime" class="newEvent-inputTime" value="10:00">
                  </div>
                  <div class="timeBlock">
                    <span class="timeLabel">Alle Ore:</span>
                    <input type="time" name="endTime" class="newEvent-inputTime" value="11:00">
                  </div>
                  <div class="timeDuration">
                    <div class="timeDuration-main">1h</div>
                    <div class="timeDuration-sub">Durata Totale</div>
                  </div>
                </div>
              </div>

              <div class="newEvent-fieldGroup">
                <span class="newEvent-fieldLabel">Note</span>
                <textarea name="descriz" class="newEvent-input newEvent-textarea" rows="4" placeholder="Note"></textarea>
              </div>

              <button class="newEvent-addBtn">Aggiungi</button>

            </div>
          </form>
          
        </div>

        <!-- ASSISTANT CARD -->
        <div class="block newEvent-assistantCard">
          <p class="superTitle">Coming Soon</p>
          <p class="subTitle">Fai che l'AI ti ispiri</p>
        </div>

      </div><!-- fine right -->

    </div>
  </div>

  <script src="../JS/calendario.js"></script>
</body>
</html>
