$(document).ready(function(){
    $.ajaxSetup({ cache: false });
    var waypts = [];
    var directionsService = new google.maps.DirectionsService();
    var map;
    //*** select plce button click */
   
    $('.select-rest-place').click(function(){
       // initialize();
        waypts = [];
        $('.modal-select-place-rest').modal('show')
     
      //console.log(getObjectByValue(cut_waypoint,'rest_place_id',parseInt($(this).val())));
      var place_rest_select=getObjectByValue(cut_waypoint,'rest_place_id',parseInt($(this).val()));
      console.log(place_rest_select);
      
      stop_place_rest = new google.maps.LatLng(place_rest_select.rest_place_lat,place_rest_select.rest_place_lng);
   /*   waypts.push({
        location: stop_place_rest,
        stopover: true
    });*/
      calcRoute(place_rest_select);

    });

    $('.modal-select-place-rest').on('hidden.bs.modal', function (e) {
        ///$(this).removeData();
        //$('#map-waypoint-place-rest').empty();

    });
    $('.modal-select-place-rest').on('show.bs.modal', function (e) {
        initialize();
        ///$(this).removeData();
        //$('#map-waypoint-place-rest').empty();

    });

    var getObjectByValue = function (array, key, value) {
        return array.find(function (object) {
            return object[key] === value;
        });
    };
  //  console.log(optimize_routing);
   // console.log(cut_waypoint);

   function calcRoute(waypoint) {

    start = new google.maps.LatLng(waypoint.cut_start_place_lat,waypoint.cut_start_place_lng);

    end = new google.maps.LatLng(waypoint.rest_place_lat,waypoint.rest_place_lng);

     
    // createMarker(start,1);
    createMarker(start,1,'จุดเรียนรู้สุดท้ายของวัน');
    createMarker(end,2,'ทีพักค้างคืน');
     
     var request = {
         origin: start,
         destination: end,
         waypoints: waypts,
         optimizeWaypoints: true,
         //travelMode: google.maps.DirectionsTravelMode.DRIVING
         travelMode: 'DRIVING'
     };

        directionsService.route(request, function (response, status) {
         if (status == google.maps.DirectionsStatus.OK) {
             directionsDisplay.setDirections(response);
             var route = response.routes[0];
            console.log(route.legs);
             
                     for (var i = 0; i < route.legs.length; i++)
                     {
                        //createMarker(route.legs[i].end_location,i+1,'44');
                     }

         }
         
     });
      
 }
   function initialize() {
    directionsDisplay = new google.maps.DirectionsRenderer({
        suppressMarkers: true
    });

    var myOptions = {
        zoom: 12,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    }
    map = new google.maps.Map(document.getElementById("map-waypoint-place-rest"), myOptions);
    directionsDisplay.setMap(map);

}
function createMarker(latlng,label,title) {
    // console.log(latlng);
 
    numberMarkerImg = {
     url: '<?=base_url()?>/images/map-maker.png',
     size: new google.maps.Size(42, 42),
     scaledSize: new google.maps.Size(42, 42),
     labelOrigin: new google.maps.Point(20,15)
 };
     var marker = new google.maps.Marker({
         position: latlng,
         map: map,
         label: { text: label.toString()},
         title:title,
         icon: numberMarkerImg
     });
 }

});


