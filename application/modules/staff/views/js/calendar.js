$(function () {
    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var trip_events=<?php print $trip_event?>;
    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
    $('#calendar').fullCalendar({
      lang: 'th',
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
      },
      buttonText: {
        today: 'วันนี้',
        month: 'เดือน',
        week: 'สัปดาห์',
        day: 'วัน'
      },
      eventClick: function(info) {
        //alert(info);
        console.log(info.id)
                 //  alert('a day has been clicked!');
                  //  var view = $('#calendar').fullCalendar('getView');
        //            alert("The view's title is " + view.title);
                } ,
      events: trip_events,
      eventRender: function(event, element) { 
        element.find('.fc-title').append("<br/>" + event.description); 
     } 

      
    })
});