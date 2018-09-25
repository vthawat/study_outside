var directionDisplay;
var directionsService = new google.maps.DirectionsService();
var map;

function initialize() {
    directionsDisplay = new google.maps.DirectionsRenderer({
        suppressMarkers: true
    });

    var myOptions = {
        zoom: 3,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    }

    map = new google.maps.Map(document.getElementById("map-canvas"), myOptions);
    directionsDisplay.setMap(map);
    calcRoute();
}

function calcRoute() {

    var waypts = [];

    stop = new google.maps.LatLng(7.6166823, 100.07402309999998)
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



    start = new google.maps.LatLng(7.005198611113918, 100.49956991183467);
    end = new google.maps.LatLng(8.430519548419,99.9622689575333);
    
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
        label: { text: 'P'+mlabel },
    });
}

initialize();