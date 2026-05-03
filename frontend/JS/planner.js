
    const MONTHS_IT   = ['Gennaio','Febbraio','Marzo','Aprile','Maggio','Giugno',
                         'Luglio','Agosto','Settembre','Ottobre','Novembre','Dicembre'];
    const WEEKDAYS_IT = ['Domenica','Lunedì','Martedì','Mercoledì','Giovedì','Venerdì','Sabato'];

    const eventsList   = document.getElementById('planner-events-list');
    const dayNumberEl  = document.getElementById('planner-day-number');
    const dayWeekdayEl = document.getElementById('planner-day-weekday');
    const dayMonthEl   = document.getElementById('planner-day-month');
    const newEventBtn  = document.getElementById('new-event-btn');

    // ── Aggiorna header giorno 
    function updateDayHeader(y, m, d) {
        const jsDate = new Date(y, m, d);
        dayNumberEl.textContent  = d;
        dayWeekdayEl.textContent = WEEKDAYS_IT[jsDate.getDay()];
        dayMonthEl.textContent   = MONTHS_IT[m];
        newEventBtn.href = `./planner_newEvent.php?date=${toIso(y, m, d)}`;
    }

    function toIso(y, m, d) {
        return `${y}-${String(m+1).padStart(2,'0')}-${String(d).padStart(2,'0')}`;
    }

    // ── Fetch eventi 
    function loadEvents(y, m, d) {
        eventsList.innerHTML = `
            <div class="ec-empty">
                <div class="ec-empty-icon"><i class="bi bi-arrow-repeat spin"></i></div>
                <div class="ec-empty-text">Caricamento eventi…</div>
            </div>`;

        fetch(`get_events.php?date=${toIso(y, m, d)}`)
            .then(r => r.json())
            .then(data => renderEvents(data.events))
            .catch(() => {
                eventsList.innerHTML = `
                    <div class="ec-empty">
                        <div class="ec-empty-icon"><i class="bi bi-exclamation-circle"></i></div>
                        <div class="ec-empty-text">Impossibile caricare gli eventi.</div>
                    </div>`;
            });
    }

    // ── Renderizza card eventi 
    function renderEvents(events) {
        eventsList.innerHTML = '';

        if (!events || events.length === 0) {
            eventsList.innerHTML = `
                <div class="ec-empty">
                    <div class="ec-empty-icon"><i class="bi bi-calendar-x"></i></div>
                    <div class="ec-empty-text">Nessun evento per questo giorno.</div>
                </div>`;
            return;
        }

        events.forEach(ev => {
            const now       = new Date();
            const start     = new Date(ev.start);
            const end       = new Date(ev.end);
            const isOngoing = now >= start && now <= end;

            const card = document.createElement('div');
            card.className = 'planner-event' + (isOngoing ? ' planner-event--ongoing' : '');
            card.dataset.id = ev.id;

            card.innerHTML = `
                <div class="planner-event-time">
                    <div class="planner-event-time-main">${ev.timeMain}</div>
                    <div class="planner-event-time-sub">${ev.duration}</div>
                </div>
                <div class="planner-event-separator"></div>
                <div class="planner-event-body">
                    <div class="planner-event-title">
                        ${esc(ev.title)}
                        ${isOngoing ? '<span class="planner-event-badge">In corso</span>' : ''}
                    </div>
                    ${ev.location ? `<div class="planner-event-location"><i class="bi bi-geo-alt"></i> ${esc(ev.location)}</div>` : ''}
                    ${ev.descriz  ? `<div class="planner-event-desc">${esc(ev.descriz)}</div>` : ''}
                </div>`;

            eventsList.appendChild(card);
        });
    }

    function esc(str) {
        return String(str)
            .replace(/&/g,'&amp;').replace(/</g,'&lt;')
            .replace(/>/g,'&gt;').replace(/"/g,'&quot;');
    }

    // ── Hook: intercetta il click sui giorni dopo ogni renderCalendar() ───────
    // calendario.js chiama renderCalendar() alla fine — lo avvolgiamo
    // per agganciare i nostri listener ogni volta che la griglia viene ridisegnata.
    const _origRender = renderCalendar;
    renderCalendar = function() {
        _origRender();
        document.querySelectorAll('#cal-grid .day:not(.prevMonth)').forEach(el => {
            el.addEventListener('click', () => {
                updateDayHeader(selected.y, selected.m, selected.d);
                loadEvents(selected.y, selected.m, selected.d);
            });
        });
    };

    // Ri-renderizza con il nostro hook attivo
    renderCalendar();

    // Carica subito gli eventi di oggi
    const t = new Date();
    updateDayHeader(t.getFullYear(), t.getMonth(), t.getDate());
    loadEvents(t.getFullYear(), t.getMonth(), t.getDate());