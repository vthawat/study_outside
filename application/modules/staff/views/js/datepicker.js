$(document).ready(function(){

    $('.input-daterange').datepicker({
        language:'th',
        autoclose: true,
        format: "dd/mm/yyyy",
    }).on('changeDate', function(e) {
        
        var start_date=$('.start_date').datepicker("getDate");
        if(isNaN($('.end_date').datepicker("getDate") )) $('.end_date').datepicker("setDate",start_date);
        var end_date=$('.end_date').datepicker("getDate");
        var days=(end_date-start_date)/(1000 * 60 * 60 * 24);
         //console.log(days+1);
         $('#trip-duration').val(days+1);
    });

    


});