$(document).ready(function(){
    $.ajaxSetup({ cache: false });
    var waypts = [];

    $('.time-rest').click(function(){

        //alert($(this).val());
        //alert(map_routing);
       // console.log(optimize_routing);
       //console.log(cut_waypoint);
       map = new google.maps.Map(document.getElementById("map-waypoint"), myOptions);
       directionsDisplay.setMap(map);
      /* var trafficLayer = new google.maps.TrafficLayer();
           trafficLayer.setMap(map);*/
   
       calcRoute();
    });

  //  console.log(optimize_routing);
   // console.log(cut_waypoint);

   function calcRoute() {

    start = new google.maps.LatLng(7.005286399999999,100.49978550000003);

    end = new google.maps.LatLng(7.005286399999999,100.49978550000003);

     
    // createMarker(start,1);
    // createMarker(end);
     
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


             
             
                     for (var i = 0; i < route.legs.length; i++)
                     {

                     }

         }
         
     });
      
 }
   function initialize() {
    directionsDisplay = new google.maps.DirectionsRenderer({
        suppressMarkers: true
    });

    var myOptions = {
        zoom: 3,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    }


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


