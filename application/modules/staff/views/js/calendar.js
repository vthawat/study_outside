$(function () {
  $.ajaxSetup({ cache: false });
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
      eventClick: function(calEvent, jsEvent, view)
      {
        // ** load trip detail on modal *** // 
        var trip_detail_url="<?=base_url('staff/calendar_trip_details/"+calEvent.id+"')?>";
        $('.modal-content').load(trip_detail_url,function(){

           $('.modal-trip-detail').modal('show');
          
          });

      } ,
     
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

    $('.modal').on('hidden.bs.modal', function (e) {
      // do something...
       $(this).removeData();
    }) 

});