$(document).ready(function(){
    
    $.ajaxSetup({ cache: false });
    var waypts = [];
    var directionsService = new google.maps.DirectionsService();
    var map;
    var place_rest_select;
    var route_place_rest=[];
    var route_with_place_rest=[];
    //*** select plce button click */
  initialize();
    $('.select-rest-place').click(function(){
   // initialize();
        waypts = [];
        $('.modal-select-place-rest').modal('show')
       // initialize();
      //console.log(getObjectByValue(cut_waypoint,'rest_place_id',parseInt($(this).val())));
      place_rest_select=getObjectByValue(cut_waypoint,'rest_place_id',parseInt($(this).val()));
      //console.log(place_rest_select);
      
      stop_place_rest = new google.maps.LatLng(place_rest_select.rest_place_lat,place_rest_select.rest_place_lng);
     waypts.push({
        location: stop_place_rest,
        stopover: true
    });
      calcRoute(place_rest_select);

    });

    $('.modal-select-place-rest').on('hidden.bs.modal', function (e) {
        ///$(this).removeData();
     //   $('#map-waypoint-place-rest').empty();
     route_place_rest=[];
     route_with_place_rest=[];
     //alert('fg')
    });
    $('.modal-select-place-rest').on('shown.bs.modal', function (e) {

       i=0;
        $(this).find('.save-rest-place').click(function(){ // Save Place Selection
         
           if(i===0)
           {
                  
                // console.log('save'+i);
                // console.log(place_rest_select);
                route_with_place_rest.push({
                  "place_rest_selected":place_rest_select,
                    "route_place_rest":route_place_rest
                });
                console.log(route_with_place_rest);
                place_rest_duration=route_with_place_rest[0].route_place_rest[0].duration;
                place_stat_time=$('.place-'+route_with_place_rest[0].place_rest_selected.rest_place_id+'-start-time').text();
                $.ajax({
                  method: "GET",
                  url: "<?=base_url('staff/json_get_end_time')?>",
                  data: { start_time: place_stat_time, duration: place_rest_duration }
                })
                  .done(function( res_data ) {
                    //cut schedule item
                    $('.cut-schedule:input').filter(function(){return this.value==route_with_place_rest[0].place_rest_selected.cut_start_place_id}).parent().parent().remove();
                    // insert schedule next day first item
                    
                    var place_set_time='<select class="form-control" name="study_time[]">'
                    place_set_time+='<option value="3600" selected="">1:00</option>'
                    place_set_time+='<option value="5400">1:30</option>'
                    place_set_time+='<option value="7200">2:00</option>'
                    place_set_time+='<option value="9000">2:30</option>'
                    place_set_time+='<option value="10800">3:00</option></select>'
                    var schedule_insert='<tr class="insert-schedule"><td class="text-center"><span class="schedule-start-time-day'+(route_with_place_rest[0].place_rest_selected.schedule_days+1)+'">?</span> - <span class="schedule-end-time-day'+(route_with_place_rest[0].place_rest_selected.schedule_days+1)+'">'+secondsToDhms(route_with_place_rest[0].route_place_rest[1].duration)+'</span></td>';
                        schedule_insert+='<td>'+place_set_time+'</td>';
                        schedule_insert+='<td>จาก'+'<span class="schedule-arrive-place-day'+(route_with_place_rest[0].place_rest_selected.schedule_days+1)+'">'+route_with_place_rest[0].place_rest_selected.rest_place_name+'</span> <i class="fa fa-fw fa-angle-double-right"></i>ถึง<span class="schedule-depart-place-day'+(route_with_place_rest[0].place_rest_selected.schedule_days+1)+'">'+route_with_place_rest[0].place_rest_selected.cut_end_place_name+'</span></td></tr>';
                        
                        
                        $('.cut-schedule:input').filter(function(){return this.value==route_with_place_rest[0].place_rest_selected.cut_end_place_id}).parent().parent().before(schedule_insert);
                   // if()
                    

                    
          
                    $('.place-'+route_with_place_rest[0].place_rest_selected.rest_place_id+'-end-time').text(res_data);
                    $('ul.place-listed li.list-group-item').removeClass('bg-gray');
                    $('ul.place-listed span.place-rest-selected').removeClass('place-rest-selected');
                    $('ul.place-listed li.list-group-item').find('.arrive-place').removeClass('selected');
                    $('ul.place-listed li.list-group-item').find('.depart-place').removeClass('selected');

                    $('.place-'+route_with_place_rest[0].place_rest_selected.rest_place_id+'-end-time').parent().parent().addClass('bg-gray');
                    $('.place-'+route_with_place_rest[0].place_rest_selected.rest_place_id+'-end-time').parent().parent().find('.arrive-place').addClass('selected');
                    $('.place-'+route_with_place_rest[0].place_rest_selected.rest_place_id+'-end-time').parent().parent().find('.depart-place').addClass('selected');

                    $('.place-'+route_with_place_rest[0].place_rest_selected.rest_place_id+'-start-time').addClass('place-rest-selected');
                    $('.place-'+route_with_place_rest[0].place_rest_selected.rest_place_id+'-end-time').addClass('place-rest-selected');

                  });
                  console.log(optimize_routing);
                $('.modal-select-place-rest').modal('hide');
              //  console.log(route_with_place_rest);
           }
         i++;
        });


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
           // console.log(route.legs);
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
                                                     if(i==0) {
                                                         start_location=waypoint.cut_start_place_name;
                                                         end_location='ที่พัก '+waypoint.rest_place_name;
                                                          }
                                                    else{
                                                        start_location='ที่พัก '+waypoint.rest_place_name;
                                                        end_location=waypoint.cut_end_place_name
                                                    }
                                                     // calculate segment duration
                                                       segment_duration=secondsToDhms(route.legs[i].duration.value);
                                                       $('#directions-panel ul.timeline').append('<li class="time-circle"><b>Segment: ' + routeSegment +'</b><span><i class="fa fa-fw fa-angle-double-right"></i>เวลา '+segment_duration+'</span><span><i class="fa fa-fw fa-angle-double-right"></i>ระยะทาง '+segment_distance+'</span></li>');
                                                       $('#directions-panel ul.timeline').append('<li><span>จาก<i class="fa fa-fw fa-angle-double-right"></i>'+start_location+'</span></li>');
                                                       $('#directions-panel ul.timeline').append('<li><span>ถึง<i class="fa fa-fw fa-angle-double-right"></i>'+end_location+'</span></li>');    
                                                      if(i==0) createMarker(route.legs[i].end_location,i+2,"ที่พักค้างคืน"+location_name[i]);
                                                      else createMarker(route.legs[i].end_location,i+2,location_name[i]);
                        route_place_rest.push({
                                "segment":routeSegment,
                                "duration":route.legs[i].duration.value,
                                "distance":route.legs[i].distance.value
                        });
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
        zoom: 6,
       zoomControl: true,
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

// Create Schedule 
 $('.schedule-create').click(function(){
    var schedule_plan=[];
    var schedule_day_title=[];
    var schedule_start_time=[];
    var schedule_end_time=[];
    var schedule_arrive_place=[];
    var schedule_depart_place=[];
      //console.log(trip_duration);
    var day=1;
     // for(day=1;day<=trip_duration;day++){
    $('.schedule-day-title').each(function (i) {
      
        schedule_day_title.push({
            "days":day,
            "title":$(this).text()
        });

        // keep all schedule  
        $('.schedule-start-time-day'+day.toString()).each(function (i) {
          
          if($(this).hasClass('place-rest-selected'))  // mark place rest selected
          {
            //*** start-time */
            schedule_start_time.push({
              "days":day,
              "time":$(this).text(),
              "is_rest_place":true
            });  
            //**** end-time */
            schedule_end_time.push({
              "days":day,
              "time":$(this).text(),
              "is_rest_place":true
            });  

          }
          else if($(this).hasClass('lunch-break')) // mark lunch time
          {
            /*** start break time */
            schedule_start_time.push({
              "days":day,
              "time":$(this).text(),
              "is_lunch":true
            }); 
            /*** end break time */
            schedule_end_time.push({
              "days":day,
              "time":$(this).text(),
              "is_lunch":true
            }); 
          }
          else if(!$(this).hasClass('place-rest'))
          {
            schedule_start_time.push({
              "days":day,
              "time":$(this).text()
            });  
            schedule_end_time.push({
              "days":day,
              "time":$(this).next().text()
            }); 
          }


          });



     // keep end arrive place of schedule
         $('.schedule-arrive-place-day'+day.toString()).each(function (i) {
            
         if($(this).is('input:text'))
         {
          schedule_arrive_place.push({
            "days":day,
            "place":$(this).val(),
            "is_lunch":true

          });  
         }
         else if($(this).hasClass('selected')){
          schedule_arrive_place.push({
            "days":day,
            "place":$(this).text(),
            "is_rest_place":true
          });  
         }
         else if(!$(this).hasClass('arrive-place')){
          schedule_arrive_place.push({
            "days":day,
            "place":$(this).text()
          });  
         }
       

        });

             // keep end depart place of schedule
             $('.schedule-depart-place-day'+day.toString()).each(function (i) {
            
              if($(this).is('input:text'))
              {
               schedule_depart_place.push({
                 "days":day,
                 "place":$(this).val(),
                 "is_lunch":true
               });  
              }
              else if($(this).hasClass('selected')){
                schedule_depart_place.push({
                 "days":day,
                 "place":$(this).text(),
                 "is_rest_place":true
               });  
              }
              else if(!$(this).hasClass('depart-place')){
                schedule_depart_place.push({
                 "days":day,
                 "place":$(this).text(),
                 "end_place_id":$(this).next().val()
               });  
              }
            
     
             });
             day++
      }) // end for days
     // console.log(schedule_end_time);
     schedule_plan.push({
        "schedule_days":schedule_day_title,
        "start_time":schedule_start_time,
        "end_time":schedule_end_time,
        "arrive_place":schedule_arrive_place,
        "depart_place":schedule_depart_place
     });
    //  console.log(schedule_plan);
         // post schedule plan
                 $.ajax({ method: "POST",
                 url: "<?=base_url('staff/post/schedule/'.$trips->id)?>",
                 data:{schedule_json:schedule_plan}
                               })
                                 .fail(function(){
                                     alert('ไม่สามารถบันทึกได้')
                                 })
                                 .done(function( msg ) {
                                   var trip_id="<?=$trips->id?>";
                                   var url="<?=base_url('staff/trip/custom_schedule/')?>";
                                   url+=trip_id;
                                   //alert(url);
                                   window.location.href=url;
                                       });
                   
   

 });

});


