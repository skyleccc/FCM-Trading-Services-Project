document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
        themeSystem: 'bootstrap5',
        headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth listMonth'
        },
        buttonText: {
            today: 'Today',
            month: 'Calendar View',
            list: 'List View'
        },
        initialView: 'dayGridMonth',
        timeZone: 'local',
        editable: false,
        selectable: false,
        height: '75vh',
        events: function(fetchInfo, successCallback, failureCallback) {
            $.ajax({
                url: '../../../Models/AdminCalendar/fetch_phases.php',
                dataType: 'json',
                success: function(response) {
                    var events = [];
                    var result = response.data;
                    $.each(result, function(i, item) {
                        events.push({
                            id: result[i].event_id,
                            title: result[i].title,
                            start: result[i].start,
                            end: result[i].end,
                            color: result[i].color,
                            url: result[i].url
                        });
                    });
                    successCallback(events);
                },
                error: function(xhr, status) {
                    alert('Failed to fetch events');
                    failureCallback();
                }
            });
        },
        dayMaxEventRows: true,
        dayMaxEvents: true,
        moreLinkClick: 'popover',
        displayEventTime : false
    });

    calendar.render();

});