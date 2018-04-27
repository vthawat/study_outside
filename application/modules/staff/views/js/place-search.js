$(document).ready(function(){
	
            $("#gm-map").locationpicker({
                location: {
                    latitude: $('#latitude').val(),
                    longitude:  $('#longtitude').val(),
                },
                maptype: 'ROADMAP',
                radius: 180,
                inputBinding: {
                    latitudeInput: $('#latitude'),
                    longitudeInput: $('#longtitude'),
                  //  radiusInput: 300,
                    locationNameInput: $('#map-address')
                },
                enableAutocomplete: true,
                onchanged: function (currentLocation, radius, isMarkerDropped) {
                    // Uncomment line below to show alert on each Location Changed event
                    //alert("Location changed. New location (" + currentLocation.latitude + ", " + currentLocation.longitude + ")");
                   // var mapContext = $(this).locationpicker('map');
                }
            })


});
