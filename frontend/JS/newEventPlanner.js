
  const MONTHS_IT   = ['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno',
                       'Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'];
  const WEEKDAYS_IT = ['Domenica','Lunedì','Martedì','Mercoledì','Giovedì','Venerdì','Sabato'];

  const formDayNumber  = document.getElementById('form-day-number');
  const formDayWeekday = document.getElementById('form-day-weekday');
  const formDayMonth   = document.getElementById('form-day-month');
  const formDateInput  = document.getElementById('form-date-input');
  const agendaDateLabel = document.getElementById('agenda-date-label');
  const agendaList     = document.getElementById('agenda-list');

  function toIso(y, m, d) {
    return `${y}-${String(m+1).padStart(2,'0')}-${String(d).padStart(2,'0')}`;
  }

  // ── Aggiorna day header e hidden input del form ───────────────────────────
  function updateFormHeader(y, m, d) {
    const jsDate = new Date(y, m, d);
    formDayNumber.textContent  = d;
    formDayWeekday.textContent = WEEKDAYS_IT[jsDate.getDay()];
    formDayMonth.textContent   = MONTHS_IT[m];
    formDateInput.value        = toIso(y, m, d);

    const gg = WEEKDAYS_IT[jsDate.getDay()];
    agendaDateLabel.textContent = `${gg} ${d} ${MONTHS_IT[m]}`;
  }

  // ── Carica eventi del giorno nell'agenda ──────────────────────────────────
  function loadAgenda(y, m, d) {
    agendaList.innerHTML = `
      <div class="agenda-empty">
        <i class="bi bi-arrow-repeat" style="animation:spin 0.9s linear infinite;display:inline-block;font-size:24px;"></i>
        <span>Caricamento…</span>
      </div>`;

    fetch(`get_events.php?date=${toIso(y, m, d)}`)
      .then(r => r.json())
      .then(data => renderAgenda(data.events))
      .catch(() => {
        agendaList.innerHTML = `
          <div class="agenda-empty">
            <i class="bi bi-exclamation-circle"></i>
            <span>Errore caricamento.</span>
          </div>`;
      });
  }

  function renderAgenda(events) {
    agendaList.innerHTML = '';
    if (!events || events.length === 0) {
      agendaList.innerHTML = `
        <div class="agenda-empty">
          <i class="bi bi-calendar-x"></i>
          <span>Nessun evento in questa giornata.</span>
        </div>`;
      return;
    }
    events.forEach(ev => {
      const item = document.createElement('div');
      item.className = 'newEvent-agendaItem';
      item.innerHTML = `
        <div class="newEvent-agendaTime">
          <span class="timeMain">${ev.timeMain}</span>
          <span class="timeSub">${ev.duration}</span>
        </div>
        <div class="newEvent-agendaBody">
          <div class="newEvent-agendaTitle">${esc(ev.title)}</div>
          ${ev.location ? `<div class="newEvent-agendaLocation">${esc(ev.location)}</div>` : ''}
        </div>`;
      agendaList.appendChild(item);
    });
  }

  function esc(str) {
    return String(str)
      .replace(/&/g,'&amp;').replace(/</g,'&lt;')
      .replace(/>/g,'&gt;').replace(/"/g,'&quot;');
  }

  // ── Calcolo durata dinamico ───────────────────────────────────────────────
  const startTimeInput    = document.getElementById('startTime');
  const endTimeInput      = document.getElementById('endTime');
  const durationDisplay   = document.getElementById('duration-display');

  function updateDuration() {
    const [sh, sm] = startTimeInput.value.split(':').map(Number);
    const [eh, em] = endTimeInput.value.split(':').map(Number);
    const diffMin  = (eh * 60 + em) - (sh * 60 + sm);
    if (diffMin <= 0) { durationDisplay.textContent = '—'; return; }
    const h = Math.floor(diffMin / 60);
    const m = diffMin % 60;
    durationDisplay.textContent = h > 0 ? (m > 0 ? `${h}h ${m}m` : `${h}h`) : `${m}m`;
  }

  startTimeInput.addEventListener('change', updateDuration);
  endTimeInput.addEventListener('change', updateDuration);

  // ── Hook su calendario.js ─────────────────────────────────────────────────
  // Avvolgiamo renderCalendar per agganciare il click su ogni giorno
  const _origRender = renderCalendar;
  renderCalendar = function() {
    _origRender();
    document.querySelectorAll('#cal-grid .day:not(.prevMonth)').forEach(el => {
      el.addEventListener('click', () => {
        // `selected` è la variabile globale di calendario.js
        updateFormHeader(selected.y, selected.m, selected.d);
        loadAgenda(selected.y, selected.m, selected.d);
      });
    });
  };

  // Primo render con hook attivo
  renderCalendar();

  // Inizializza con il giorno già selezionato da calendario.js (oggi di default)
  updateFormHeader(selected.y, selected.m, selected.d);
  loadAgenda(selected.y, selected.m, selected.d);

  // Animazione spinner
  const style = document.createElement('style');
  style.textContent = '@keyframes spin { to { transform: rotate(360deg); } }';
  document.head.appendChild(style);