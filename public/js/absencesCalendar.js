(function () {
    "use strict";
    //_____Calendar Events Intialization


    // Calendar Event Source
    var sptCalendarEvents = {
        id: 1,
        events: absences
    };


    //________ FullCalendar
    var containerEl = document.getElementById('external-events');

    var calendarEl = document.getElementById('calendar2');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        defaultView: 'month',
        navLinks: true, // can click day/week names to navigate views
        businessHours: false, // display business hours
        selectable: true,
        selectMirror: true,
        droppable: false, // this allows things to be dropped onto the calendar
        locale: 'fr',
        firstDay: 1,
        buttonText: {
            today: 'Aujourd\'hui',
            month: 'Mois',
            week: 'Semaine',
            day: 'Jour',
            list: 'Liste'
        },




        editable: false,
        dayMaxEvents: true, // allow "more" link when too many events
        eventSources: [sptCalendarEvents],
        eventClick: function (arg) {

            let modal = $('#absence-' + arg.event.id);
            modal.modal('show');


        },

    });
    calendar.render();


})();
