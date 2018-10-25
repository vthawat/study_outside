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
                        stopover: true
                    });
                   // console.log(start_location[0]);
            }
            
            else alert("remove");
            initialize()

    });


var directionDisplay;
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

   
/*
    stop = new google.maps.LatLng(7.736021279864532,100.04406638328624)
    waypts.push({
        location: stop,
        stopover: true
    });
 
   // createMarker(stop);
    stop = new google.maps.LatLng(7.617915862574645,100.0817907773071)
    waypts.push({
        location: stop,
        stopover: true
    });
 
    //  createMarker(stop);
    stop = new google.maps.LatLng(8.453622240015882,98.52849285875243)
    waypts.push({
        location: stop,
        stopover: true
    });
  //  createMarker(stop);
        stop = new google.maps.LatLng(7.246390973037559,100.54027799799803)
    waypts.push({
        location: stop,
        stopover: true
    });
        stop = new google.maps.LatLng(7.106774065331006,100.63284421354979)
    waypts.push({
        location: stop,
        stopover: true
    });

*/


//var start_address = "<?=$trips->start_location?>";
//var end_address = "<?=$trips->end_location?>";
//var start;
//var start_latitude=converStringToCoordinates(start_address);
//console.log(start_latitude);
//var end_latitude=converStringToCoordinates(end_address);


//console.log(latitude);
//start = new google.maps.LatLng(7.106774065331006,100.63284421354979);
//var geo_start = new google.maps.Geocoder();
/*
geo_start.geocode( { 'address': start_address}, function(results, status) {

    if (status == google.maps.GeocoderStatus.OK) {
    //var latitude = results[0].geometry.location.lat();
    //var longitude = results[0].geometry.location.lng();
    start_coordinate=results[0].geometry.location;
 
    } 
});

*/
//console.log(start_coordinate);

//start=start[0].geometry.location;
   // end = new google.maps.LatLng(7.736021279864532,100.04406638328624);
   // start='<?=$trips->start_location?>';
   start = new google.maps.LatLng(7.004969,100.4990518);
   end ='<?=$trips->end_location?>';
    
    createMarker(start,1);
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
						for (var i = 0; i < route.legs.length; i++) {
						//	console.log(route.legs[i].end_location);
             // createMarker(route.legs[i].start_location,i);
              createMarker(route.legs[i].end_location,i+2);
					}

        }
    });
     
}

function createMarker(latlng,mlabel) {
    
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
       // label: { text: 'P'+mlabel },
    });
}

initialize();

});