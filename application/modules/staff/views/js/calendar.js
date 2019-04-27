$(function () {
    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    
    var date = new Date();
    var d = date.getDate(),
        m = date.getMonth(),
        y = date.getFullYear();
    $('#calendar').fullCalendar({
      lang: 'th',
      timezone: 'Asia/Bangkok',
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
      eventClick: function(calEvent, jsEvent, view) {
        //alert(info);
        console.log(calEvent.end)
                 //  alert('a day has been clicked!');
                  //  var view = $('#calendar').fullCalendar('getView');
        //            alert("The view's title is " + view.title);
                } ,
     // events: trip_events,
     events: {
      url: "<?=base_url('staff/get_calendar_events')?>",
     },  
      loading: function(bool) {
          $('#loading').toggle(bool);
      },
      eventRender: function(event, element) { 
        element.find('.fc-title').append("<br/>" + event.description); 
     } 

      
    })
});