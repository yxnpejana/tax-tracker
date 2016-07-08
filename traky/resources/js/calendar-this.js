$(function () {
    var dir = 'http://192.168.254.4/traky/';

        /* initialize the external events
         -----------------------------------------------------------------*/
        function ini_events(ele) {
          ele.each(function () {

            // create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
            // it doesn't need to have a start or end
            var eventObject = {
              title: $.trim($(this).text()) // use the element's text as the event title
            };

            // store the Event Object in the DOM element so we can get to it later
            $(this).data('eventObject', eventObject);

            // make the event draggable using jQuery UI
            $(this).draggable({
              zIndex: 1070,
              revert: true, // will cause the event to go back to its
              revertDuration: 0  //  original position after the drag
            });

          });
        }
        ini_events($('#external-events div.external-event'));

        /* initialize the calendar
         -----------------------------------------------------------------*/
        //Date for the calendar events (dummy data)
        var date = new Date();
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear();
                
        $('#bir-due-dates').fullCalendar({
          header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
          },
          buttonText: {
            today: 'today',
            month: 'month',
            week: 'week',
            day: 'day'
          },           
          eventSources: [''+dir+'calendar/get_events'],
          fixedWeekCount: false,
          editable: true,
          allDaySlot: true
        });
        

        /* ADDING EVENTS */
        var currColor = "#3c8dbc"; //Red by default
        
        //Color chooser button
        var colorChooser = $("#color-chooser-btn");
        $("#color-chooser > li > a").click(function (e) {
          e.preventDefault();
          //Save color
          currColor = $(this).css("color"); console.log(currColor);
          //Add color effect to button
          $('#add-new-event').css({"background-color": currColor, "border-color": currColor});
          $('#event-color').val(currColor);
        });

      });




//$(document).ready(function() {
//    $('#bir-due-dates').fullCalendar({
//            googleCalendarApiKey: 'AIzaSyA7ibDDB0fTORovv0PbEvo-fqshWUxVd-Y',        
//        events: {
//            googleCalendarId: '9lmtvjdovqnbthne3849bd0efs@group.calendar.google.com'
//        }
//    });
//});