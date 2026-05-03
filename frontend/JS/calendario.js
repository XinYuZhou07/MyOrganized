// calendario.js – MyOrganized

const MONTHS = [
  'Gennaio', 'Febbraio', 'Marzo', 'Aprile', 'Maggio', 'Giugno',
  'Luglio', 'Agosto', 'Settembre', 'Ottobre', 'Novembre', 'Dicembre'
];

const WD = ['LUN', 'MAR', 'MER', 'GIO', 'VEN', 'SAB', 'DOM'];

const today = new Date();

let formattedDate;
let initialYear, initialMonth, initialDay;

if (window.calendarConfig) {
  console.log("Dentro if: then");
  initialYear   = window.calendarConfig.y;
  initialMonth  = window.calendarConfig.m;
  initialDay    = window.calendarConfig.d;
} else {
  console.log("Dentro if: else");
  initialYear   = today.getFullYear();
  initialMonth  = today.getMonth();
  initialDay    = today.getDate();
}

let cur = {
  y: initialYear,
  m: initialMonth
};

let selected = {
  y: initialYear,
  m: initialMonth,
  d: initialDay  
};

formattedDate = getSelectedDate();
document.getElementById("data_evento_input").value = formattedDate;

let ddOpen = false;

const monthLabel = document.getElementById('month-label');
const monthBtn = document.getElementById('month-btn');
const dropdown = document.getElementById('cal-dropdown');
const caret = document.getElementById('cal-caret');
const yearValue = document.getElementById('dd-year-val');
const monthsContainer = document.getElementById('dd-months');
const yearPrev = document.getElementById('yr-prev');
const yearNext = document.getElementById('yr-next');
const grid = document.getElementById('cal-grid');

function buildDropdown() {
  yearValue.textContent = cur.y;
  monthsContainer.innerHTML = '';

  MONTHS.forEach((name, index) => {
    const monthItem = document.createElement('div');

    monthItem.className = 'cal-dd-item';

    if (index === cur.m) {
      monthItem.classList.add('active');
    }

    monthItem.textContent = `${String(index + 1).padStart(2, '0')} – ${name}`;

    monthItem.addEventListener('click', function (event) {
      event.stopPropagation();

      cur.m = index;

      closeDropdown();
      renderCalendar();
    });

    monthsContainer.appendChild(monthItem);
  });
}

function openDropdown() {
  ddOpen = true;

  buildDropdown();

  dropdown.classList.add('open');
  caret.classList.add('open');
}

function closeDropdown() {
  ddOpen = false;

  dropdown.classList.remove('open');
  caret.classList.remove('open');
}

monthBtn.addEventListener('click', function (event) {
  event.stopPropagation();

  if (ddOpen) {
    closeDropdown();
  } else {
    openDropdown();
  }
});

yearPrev.addEventListener('click', function (event) {
  event.stopPropagation();

  cur.y--;

  buildDropdown();
  renderCalendar();
});

yearNext.addEventListener('click', function (event) {
  event.stopPropagation();

  cur.y++;

  buildDropdown();
  renderCalendar();
});

document.addEventListener('click', function () {
  if (ddOpen) {
    closeDropdown();
  }
});

function renderCalendar() {
  monthLabel.textContent = `${MONTHS[cur.m]} ${cur.y}`;

  grid.innerHTML = '';

  WD.forEach(function (dayName) {
    const weekday = document.createElement('div');

    weekday.className = 'weekday';
    weekday.textContent = dayName;

    grid.appendChild(weekday);
  });

  let startDay = new Date(cur.y, cur.m, 1).getDay();

  startDay = startDay === 0 ? 6 : startDay - 1;

  const daysInMonth = new Date(cur.y, cur.m + 1, 0).getDate();
  const prevMonthDays = new Date(cur.y, cur.m, 0).getDate();

  for (let i = startDay - 1; i >= 0; i--) {
    const day = document.createElement('div');

    day.className = 'day prevMonth';
    day.textContent = prevMonthDays - i;

    grid.appendChild(day);
  }

  for (let dayNumber = 1; dayNumber <= daysInMonth; dayNumber++) {
    const day = document.createElement('div');

    day.className = 'day';
    day.textContent = dayNumber;

    const dayOfWeek = new Date(cur.y, cur.m, dayNumber).getDay();

    if (dayOfWeek === 0) {
      day.classList.add('sunday');
    }

    const isToday =
      dayNumber === today.getDate() &&
      cur.m === today.getMonth() &&
      cur.y === today.getFullYear();

    const isSelected =
      selected &&
      dayNumber === selected.d &&
      cur.m === selected.m &&
      cur.y === selected.y;

    if (isToday) {
      day.classList.add('today');
    }

    if (isSelected) {
      day.classList.add('selected');
    }

    day.addEventListener('click', function () {
      selected = {
        d: dayNumber,
        m: cur.m,
        y: cur.y
      };

      //Per riempire il form in 'newEvent.php'
      formattedDate = getSelectedDate();
      document.getElementById("data_evento_input").value = formattedDate;
      

      renderCalendar();
    });

    grid.appendChild(day);
  }
}

function getSelectedDate() {
    if (!selected) return null;
    
    const year = selected.y;
    const month = String(selected.m + 1).padStart(2, '0'); //+1 perché Gennaio = 0
    const day = String(selected.d).padStart(2, '0');
    
    return `${year}-${month}-${day}`;
}

renderCalendar();