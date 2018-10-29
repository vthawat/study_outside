$(function () {
    
var waypts = [];
var location_selected=[];
    $('.place-selected').change(function(){
           waypts = []; // clear point
           location_selected=[];
        $('.place-selected').each(function (i) {
            
            if (this.checked) {
                //console.log($(this).val()); 
                var str=$(this).val();
               var stop_location=str.split(':');
                stop = new google.maps.LatLng(stop_location[0],stop_location[1]);
                //stop=stop_location[0]+','+stop_location[1];
                waypts.push({
                    location: stop,
                    stopover: true
                });
                //test1=new google.maps.Lat(stop_location[0]);
                location_selected.push({"place_id":stop_location[2],
                                        "place_name":stop_location[3],
                                        "place_location":stop,
                                        "location_address":stop_location[4]
                                    });
             
            }
        });
         console.log(location_selected);
        initialize()
    });

  /*  $('.place-selected').click(function()
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
          //  initialize()

    });*/



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
   /* var trafficLayer = new google.maps.TrafficLayer();
        trafficLayer.setMap(map);*/

    calcRoute();
}

function calcRoute() {

   start = new google.maps.LatLng(7.005286399999999,100.49978550000003);
   //end ='<?=$trips->end_location?>';
   end = new google.maps.LatLng(7.005286399999999,100.49978550000003);
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
            var start_location_name;
            var end_location_name;
            $('#directions-panel').empty();
            $('#directions-panel').append('<ul class="timeline">');
            //summaryPanel.innerHTML+='<ul class="timeline">';
            
            
						for (var i = 0; i < route.legs.length; i++) {

                                                 
                            start_address=route.legs[i].start_address;
    
                           if(i==0)
                           {
                            if(start_address=='Unnamed Road, ตำบล คอหงส์ อำเภอ หาดใหญ่ สงขลา 90110 ประเทศไทย')
                                start_location_name='คณะทรัพยากรธรรมชาติ';
                           }
                           else
                            {
                                if(location_selected[route.waypoint_order[i-1]].location_address==start_address)
                                 
                                      //  console.log("ok");  
                                      start_location_name=location_selected[route.waypoint_order[i-1]].place_name;
                            }     

                            end_address=route.legs[i].end_address;
                           
                            if(i==0)
                            {
                             if(end_address=='Unnamed Road, ตำบล คอหงส์ อำเภอ หาดใหญ่ สงขลา 90110 ประเทศไทย')
                             end_location_name='คณะทรัพยากรธรรมชาติ';
                             if(route.waypoint_order.length>0) end_location_name=location_selected[route.waypoint_order[i]].place_name;
                            }
                            else
                             {
                                if(end_address=='Unnamed Road, ตำบล คอหงส์ อำเภอ หาดใหญ่ สงขลา 90110 ประเทศไทย')
                                    end_location_name='คณะทรัพยากรธรรมชาติ';
                                
                                else if(location_selected[route.waypoint_order[i-1]].location_address==start_address)
                                  
                                         end_location_name=location_selected[route.waypoint_order[i]].place_name;
                             }     

                       
                            createMarker(route.legs[i].end_location,i+1,end_location_name);

                            // display segment
                            var routeSegment = i + 1;
                           /* summaryPanel.innerHTML += '<b>Segment: ' + routeSegment +'</b><br>';
                            summaryPanel.innerHTML += start_location_name + '<i class="fa fa-fw fa-angle-double-right"></i>';
                            summaryPanel.innerHTML += end_location_name + '<br>';
                           // summaryPanel.innerHTML += route.legs[i].end_location.lat() + '<br>';
                            summaryPanel.innerHTML += route.legs[i].duration.text + ' ระยะทาง ';
                            summaryPanel.innerHTML += route.legs[i].distance.text + '<br><br>';
                            */
                           $('#directions-panel ul.timeline').append('<li class="time-circle"><b>Segment: ' + routeSegment +'</b><span><i class="fa fa-fw fa-angle-double-right"></i>เวลา '+route.legs[i].duration.text+'</span><span><i class="fa fa-fw fa-angle-double-right"></i>ระยะทาง '+route.legs[i].distance.text+'</span></li>');
                           $('#directions-panel ul.timeline').append('<li>จาก'+start_location_name+'</li>');
                           $('#directions-panel ul.timeline').append('<li>ถึง'+end_location_name+'</li>');

                          

                    }
                    $('#directions-panel').append('</ul>');

        }
        
    });
     
}

function createMarker(latlng,label,title) {
   // console.log(latlng);
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        label: { text: 'P'+label },
        title:title,
    });
}

initialize();

});