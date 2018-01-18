$(document).ready(function(){
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek, agendaDay'
        },
        defaultView: 'month',
        eventSources: [

            // your event source
            {
                url: '../api/eventFeed.php', // use the `url` property
                color: 'yellow',    // an option!
                textColor: 'black'  // an option!
            }
        ]
    });
});

