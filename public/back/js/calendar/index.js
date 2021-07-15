let calendarEl = document.querySelector("#kt_calendar_app");

let calendar = new FullCalendar.Calendar(calendarEl, {
    headerToolbar: {
        left: "prev,next today",
        center: "title",
        right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth"
    },
    locale: "fr",
    buttonIcons: false,
    weekNumbers: true,
    navLinks: true, // can click day/week names to navigate views
    editable: true,
    dayMaxEvents: true, // allow "more" link when too many events
})

calendar.render();

