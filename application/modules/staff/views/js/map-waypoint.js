$(function () {
    
    var waypts = [];
    $('.place-selected').click(function()
        {
            if($(this).is(":checked"))
            {
            //alert("add"+$(this).val());
               // createMarker(stop);
               var str=$(this).val();
               var start_location=str.split(',');

                    stop = new google.maps.LatLng(start_location[0],start_location[1])
                    waypts.push({
                        location: stop,
                        stopover: true,
                   //     title:start_location[2],
                    });
                   // console.log(start_location[0]);
            }
            
            else alert("remove");
            initialize()

    });



var directionsService = new google.maps.DirectionsService();
var map;
//var locationSelected=

function initialize() {
    directionsDisplay = new google.maps.DirectionsRenderer({
        suppressMarkers: true
    });

    var myOptions = {
        zoom: 3,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    }

    map = new google.maps.Map(document.getElementById("map-waypoint"), myOptions);
    directionsDisplay.setMap(map);
    calcRoute();
}

function calcRoute() {

   start = new google.maps.LatLng(7.004969,100.4990518);
   //end ='<?=$trips->end_location?>';
   end = new google.maps.LatLng(7.004969,100.4990518);
   // start='<?=$trips->start_location?>';
    //end ='<?=$trips->start_location?>';
    
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
            var summaryPanel = document.getElementById('directions-panel');
            $('#directions-panel').empty();
						for (var i = 0; i < route.legs.length; i++) {
							console.log(route.legs[i]);
             // createMarker(route.legs[i].start_location,i);
              createMarker(route.legs[i].end_location,i+1,route.legs[i].end_address);
              // display segment
              var routeSegment = i + 1;
              summaryPanel.innerHTML += '<b>เส้นทางช่วงที่: ' + routeSegment +
                  '</b><br>';
             summaryPanel.innerHTML += route.legs[i].start_address + '<i class="fa fa-fw fa-angle-double-right"></i>';
              summaryPanel.innerHTML += route.legs[i].end_address + '<br>';
              summaryPanel.innerHTML += route.legs[i].duration.text + ' ระยะทาง ';
              summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';

					}

        }
    });
     
}

function createMarker(latlng,mlabel,title) {
    
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        label: { text: 'L'+mlabel },
        title:title,
    });
}

initialize();

});