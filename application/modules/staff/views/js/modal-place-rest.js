$(document).ready(function(){
    $.ajaxSetup({ cache: false });
   
   // on hideden place rest detail
    $('.modal-place-rest-details').on('hidden.bs.modal', function (e) {
        // do something...
      //   $(this).removeData();
      }) 

// on shown place rest detail
      $('.modal-place-rest-details').on('shown.bs.modal', function (e) {
        // do something...
        $(function () {
            var center = place_location;
            $('#gm-map')
              .gmap3({
                center: center,
                zoom: 6,
                mapTypeId : google.maps.MapTypeId.ROADMAP
              })
              .marker(function (map) {
                return {
                  position: map.getCenter(),
                  icon: 'http://maps.google.com/mapfiles/marker_green.png'
                };
              })
              .circle({
                center: center,
                radius : 100,
                fillColor : "#FFAF9F",
                strokeColor : "#FF512F"
              })
              .fit();
          });    
      }) 

});