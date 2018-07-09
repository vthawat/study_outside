$(document).ready(function(){
    $.ajaxSetup({ cache: false });
   
    $('.modal').on('hidden.bs.modal', function (e) {
        // do something...
         $(this).removeData();
      }) 

});