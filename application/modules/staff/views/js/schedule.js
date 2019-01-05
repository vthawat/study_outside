$(document).ready(function(){
    
    $.ajaxSetup({ cache: false });
    var waypts = [];
    var directionsService = new google.maps.DirectionsService();
    var map;
    //*** select plce button click */
  //  initialize();
    $('.select-rest-place').click(function(){
    // initialize();
        waypts = [];
        $('.modal-select-place-rest').modal('show')
     
      //console.log(getObjectByValue(cut_waypoint,'rest_place_id',parseInt($(this).val())));
      var place_rest_select=getObjectByValue(cut_waypoint,'rest_place_id',parseInt($(this).val()));
      console.log(place_rest_select);
      
      stop_place_rest = new google.maps.LatLng(place_rest_select.rest_place_lat,place_rest_select.rest_place_lng);
     waypts.push({
        location: stop_place_rest,
        stopover: true
    });
      calcRoute(place_rest_select);

    });

    $('.modal-select-place-rest').on('hidden.bs.modal', function (e) {
        ///$(this).removeData();
        $('#map-waypoint-place-rest').empty();

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

    end = new google.maps.LatLng(waypoint.cut_end_place_lat,waypoint.cut_end_place_lng);
    location_name=[];
    location_name.push(waypoint.rest_place_name,waypoint.cut_end_place_name);
    // console.log(location_name);
    // createMarker(start,1);
    createMarker(start,1,waypoint.cut_start_place_name);
   // createMarker(end,2,'ทีพักค้างคืน');
     
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
            $('#directions-panel').empty();
            $('#directions-panel').append('<ul class="timeline">');
                     for (var i = 0; i < route.legs.length; i++)
                     {
                                                    // display segment
                                                    var routeSegment = i + 1;
                                                     // calculate segment distance
                                                     segment_distance=route.legs[i].distance.value;
                                                     segment_distance=(segment_distance/1000);
                                                     segment_distance=segment_distance.toFixed(1) + " กม.";
                                                     // calculate segment duration
                                                       segment_duration=secondsToDhms(route.legs[i].duration.value);
                                                       $('#directions-panel ul.timeline').append('<li class="time-circle"><b>Segment: ' + routeSegment +'</b><span><i class="fa fa-fw fa-angle-double-right"></i>เวลา '+segment_duration+'</span><span><i class="fa fa-fw fa-angle-double-right"></i>ระยะทาง '+segment_distance+'</span></li>');
                                                       $('#directions-panel ul.timeline').append('<li><span>จาก<i class="fa fa-fw fa-angle-double-right"></i>'+route.legs[i].start_address+'</span></li>');
                                                       $('#directions-panel ul.timeline').append('<li><span>ถึง<i class="fa fa-fw fa-angle-double-right"></i>'+route.legs[i].end_address+'</span></li>');    
                                                       createMarker(route.legs[i].end_location,i+2,"ที่พักค้างคืน"+location_name[i]);
                     }
            $('#directions-panel').append('</ul>');

         }
         
     });
      
 }
   function initialize() {
    directionsDisplay = new google.maps.DirectionsRenderer({
        suppressMarkers: true
    });

    var myOptions = {
        zoom: 5,
      // zoomControl: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        //gestureHandling: 'none',
       // zoomControl: false
       // center: {lat: 7.557865957483602, lng: 99.6024086306885}

    }
    map = new google.maps.Map(document.getElementById("map-waypoint-place-rest"), myOptions);
    directionsDisplay.setMap(map);

}
function secondsToDhms(seconds) {
    seconds = Number(seconds);
    var d = Math.floor(seconds / (3600*24));
    var h = Math.floor(seconds % (3600*24) / 3600);
    var m = Math.floor(seconds % 3600 / 60);
    var s = Math.floor(seconds % 3600 % 60);
    
    var dDisplay = d > 0 ? d + (d == 1 ? " วัน " : " วัน ") : "";
    var hDisplay = h > 0 ? h + (h == 1 ? " ชั่วโมง " : " ชั่วโมง ") : "";
    var mDisplay = m > 0 ? m + (m == 1 ? " นาที " : " นาที ") : "";
    var sDisplay = s > 0 ? s + (s == 1 ? " วินาที" : " วินาที") : "";
    if(seconds!=0)
        return dDisplay + hDisplay + mDisplay + sDisplay;
    else return 0+' นาที';
    }
function createMarker(latlng,label,title) {

    // console.log(latlng);
 if(label===2){
 maker_url='<?=base_url()?>/images/map-place-rest.png';
  //  map_label='';
  numberMarkerImg = {
    url: maker_url,
    size: new google.maps.Size(42, 42),
    scaledSize: new google.maps.Size(42, 42),
    labelOrigin: new google.maps.Point(20,15)
};
// map_label=label.toString();
var marker = new google.maps.Marker({
    position: latlng,
    map: map,
  //  label: { text: 'ff'},
    title:title,
    icon: numberMarkerImg
});
}
 else {
     maker_url='<?=base_url()?>/images/map-maker.png';
     numberMarkerImg = {
        url: maker_url,
        size: new google.maps.Size(42, 42),
        scaledSize: new google.maps.Size(42, 42),
        labelOrigin: new google.maps.Point(20,15)
    };
    // map_label=label.toString();
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        label: { text: label.toString()},
        title:title,
        icon: numberMarkerImg
    });
 }


 }

});


