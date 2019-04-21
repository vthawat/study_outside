$(function () {
$.ajaxSetup({ cache: false });    
var waypts = [];
var location_selected=[];
var map_routing=[];
var place_ordering=[];
    $('.place-selected').change(function(){
           waypts = []; // clear point
           location_selected=[]; // clear location selected
           map_routing=[]; // clear map routing
           place_ordering=[];
        $('.place-selected').each(function (i) {
            
            if (this.checked) {
                var str=$(this).val();
               var stop_location=str.split(':');
                stop = new google.maps.LatLng(stop_location[0],stop_location[1]);
                waypts.push({
                    location: stop,
                    stopover: true
                });
                location_selected.push({"place_id":stop_location[2],
                                        "place_name":stop_location[3],
                                        //"place_location":stop,
                                        "location_address":stop_location[4]
                                    });
                 // update location selected
                     $.ajax({ method: "POST",
                        url: "<?=base_url('staff/put/place_selected/'.$trips->id)?>",
                        data:{place_selected:location_selected}
                                      })
                                        .fail(function(){
                                            alert('ไม่สามารถบันทึกได้')
                                        })
                                        .done(function( msg ) {
                                              });
  
                
            }
        });
              initialize();
              

    });



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

    map = new google.maps.Map(document.getElementById("map-waypoint"), myOptions);
    directionsDisplay.setMap(map);
   /* var trafficLayer = new google.maps.TrafficLayer();
        trafficLayer.setMap(map);*/

    calcRoute();
    //console.log(map_routing);

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
    var totaldistance=0;
    var totalduration=0;
       directionsService.route(request, function (response, status) {
        if (status == google.maps.DirectionsStatus.OK) {
            directionsDisplay.setDirections(response);
            var route = response.routes[0];
           // var summaryPanel = document.getElementById('directions-panel');
            var start_location_name;
            var end_location_name;
           // console.log(route.legs);
            $('#directions-panel').empty();
            $('#directions-panel').append('<ul class="timeline">');
            //summaryPanel.innerHTML+='<ul class="timeline">';
            
            
                    for (var i = 0; i < route.legs.length; i++)
                    {

                                                 
                            start_address=route.legs[i].start_address;
    
                           if(i==0)
                           {
                            if(start_address==='Unnamed Road, ตำบล คอหงส์ อำเภอ หาดใหญ่ สงขลา 90110 ประเทศไทย')
                              {  start_location_name='คณะทรัพยากรธรรมชาติ';
                                    start_place_id=0;
                                 }
                           }
                           else
                            {
                                if(location_selected[route.waypoint_order[i-1]].location_address==start_address)
                                 {
                                      //  console.log("ok");  
                                      start_location_name=location_selected[route.waypoint_order[i-1]].place_name;
                                      start_place_id=location_selected[route.waypoint_order[i-1]].place_id;
                                 }
                            }     

                            end_address=route.legs[i].end_address;
                           
                            if(i==0)
                            {
                                 if(end_address==='Unnamed Road, ตำบล คอหงส์ อำเภอ หาดใหญ่ สงขลา 90110 ประเทศไทย')
                                {
                                    end_location_name='คณะทรัพยากรธรรมชาติ';
                                    end_place_id=0;
                               }
                             if(route.waypoint_order.length>0){
                              end_location_name=location_selected[route.waypoint_order[i]].place_name;
                              end_place_id=location_selected[route.waypoint_order[i]].place_id;
                             } 
                            }
                            else
                             {
                                 //console.log(start_address);
                                if(end_address==='Unnamed Road, ตำบล คอหงส์ อำเภอ หาดใหญ่ สงขลา 90110 ประเทศไทย')
                                    {
                                        end_location_name='คณะทรัพยากรธรรมชาติ';
                                        end_place_id=0;
                                    }
                                
                                else if(location_selected[route.waypoint_order[i-1]].location_address==start_address)
                                {                                
                                         end_location_name=location_selected[route.waypoint_order[i]].place_name;
                                         end_place_id=location_selected[route.waypoint_order[i]].place_id;
                                }
                             }     

                             totaldistance = totaldistance + route.legs[i].distance.value;
                             totalduration=totalduration+route.legs[i].duration.value;
                            createMarker(route.legs[i].end_location,i+1,end_location_name);
                            place_ordering.push({"place_id":end_place_id,"place_name":end_location_name});
                            // display segment
                            var routeSegment = i + 1;

                           // calculate segment distance
                           segment_distance=route.legs[i].distance.value;
                           segment_distance=(segment_distance/1000);
                           segment_distance=segment_distance.toFixed(1) + " กม.";
                           // calculate segment duration
                             segment_duration=secondsToDhms(route.legs[i].duration.value);
                           $('#directions-panel ul.timeline').append('<li class="time-circle"><b>Segment: ' + routeSegment +'</b><span><i class="fa fa-fw fa-angle-double-right"></i>เวลา '+segment_duration+'</span><span><i class="fa fa-fw fa-angle-double-right"></i>ระยะทาง '+segment_distance+'</span></li>');
                           $('#directions-panel ul.timeline').append('<li><span>จาก<i class="fa fa-fw fa-angle-double-right"></i>'+start_location_name+'</span></li>');
                           $('#directions-panel ul.timeline').append('<li><span>ถึง<i class="fa fa-fw fa-angle-double-right"></i>'+end_location_name+'</span></li>');                        
                            
                           // keep map routing pathway
                           map_routing.push({"segment":routeSegment,
                                            "start_location":start_location_name,
                                            "end_location":end_location_name,
                                            "duration":route.legs[i].duration.value,
                                            "distance":route.legs[i].distance.value,
                                            "start_place_id":start_place_id,
                                            "end_place_id":end_place_id
                                            });
                    }
                    $('#directions-panel').append('</ul>');
                    
                    // keep map totatal routing
                    map_routing.push({"total_duration":totalduration,"total_distance":totaldistance});
                    // display total trip routing
                    totaldistance=(totaldistance/1000);
                    $('#directions-panel').append('<h4>รวมระยะทาง '+totaldistance.toFixed(1) + " กม."+' ระยะเวลา '+secondsToDhms(totalduration)+'</h4>')
                   console.log(place_ordering);
                       // update trip routing
                    $.ajax({ method: "POST",
                    url: "<?=base_url('staff/put/trip_routing/'.$trips->id)?>",
                    data:{routing:map_routing}
                                })
                                    .fail(function(){
                                        alert('ไม่สามารถบันทึกได้')
                                    })
                                    .done(function( msg ) {
                                    // alert(msg);
                                   // console.log(msg);
                                        });
                     // update place ordering
                               $.ajax({ method: "POST",
                                               url: "<?=base_url('staff/put/place_ordering/'.$trips->id)?>",
                                               data:{place_ordering:place_ordering}
                                                             })
                                                               .fail(function(){
                                                                   alert('ไม่สามารถบันทึกได้')
                                                               })
                                                               .done(function( msg ) {
                                                                     });

        }
        
    });
     
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

function loadWayPoint()
{
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
                                    //"place_location":stop,
                                    "location_address":stop_location[4]
                                });
            
        }
    });
}

initialize();
<?php if(!empty($trips->place_selected)):?>
loadWayPoint();
<?php endif?>

});