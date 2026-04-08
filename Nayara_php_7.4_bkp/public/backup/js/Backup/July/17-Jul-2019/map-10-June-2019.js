    var geocoder;
    var map;
    var address = "new york city";
    var dat_lat;
    var dat_long; 
    //var App_Url =  window.location.origin;
    console.log(APP_URL);
    function initMap() {
      var myLatlng = new google.maps.LatLng(18.9690, 72.8205);
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 8,
          center: myLatlng,
          mapTypeId: 'roadmap'  
        });
    var geocoder = new google.maps.Geocoder();
    google.maps.event.addDomListener(window, "load", initMap);
    //console.log(geocoder);
    //codeAddress(geocoder, map);
      function codeAddress(geocoder, map) {
        geocoder.geocode({'address': address}, function(results, status) {
          if (status === 'OK') {
            map.setCenter(results[0].geometry.location);
            var marker = new google.maps.Marker({
              map: map,
              position: results[0].geometry.location
            });
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
      }

      var input = document.getElementById('enter-location');
      var searchBox = new google.maps.places.SearchBox(input);
      //console.log(searchBox);
      //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

      map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
      });

      var markers = [];

      searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();
        geocoder.geocode({'address': places[0].formatted_address}, function(results, status) {
          if (status === 'OK') {
            //console.log(results[0].geometry.location.lng());
            $(".location_coordinates").attr('data-lat', results[0].geometry.location.lat());
            $(".location_coordinates").attr('data-long', results[0].geometry.location.lng());
            //map.setCenter(results[0].geometry.location);
            /*var marker = new google.maps.Marker({
              map: map,
              position: results[0].geometry.location
            });*/
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
        //console.log(places[0].formatted_address);
        if (places.length == 0) {
          return;
        }
        markers.forEach(function(marker) {
        marker.setMap(null);
      });
      markers = [];

      var bounds = new google.maps.LatLngBounds();
      places.forEach(function(place) {
        if (!place.geometry) {
          console.log("Returned place contains no geometry");
          return;
        }
        var icon = {
          url: place.icon,
          size: new google.maps.Size(71, 71),
          origin: new google.maps.Point(0, 0),
          anchor: new google.maps.Point(17, 34),
          scaledSize: new google.maps.Size(25, 25)
        };

        markers.push(new google.maps.Marker({
          map: map,
          icon: icon,
          title: place.name,
          position: place.geometry.location
        }));

        if (place.geometry.viewport) {
        // Only geocodes have viewport.
          bounds.union(place.geometry.viewport);
        } else {
          bounds.extend(place.geometry.location);
        }
      });
      map.fitBounds(bounds);
  });
}
$('#current-btn').on('click', function() {
  if ("geolocation" in navigator){ 
    navigator.geolocation.getCurrentPosition(function(position, html5Error){ 
        geo_loc = processGeolocationResult(position);
        //console.log(geo_loc);
         currLatLong = geo_loc.split(",");
         initializeCurrent(currLatLong[0], currLatLong[1]);
      });
  }else{
    console.log("Browser doesn't support geolocation!");
  }
  function processGeolocationResult(position) {
       html5Lat = position.coords.latitude; //Get latitude
       html5Lon = position.coords.longitude; //Get longitude
       html5TimeStamp = position.timestamp; //Get timestamp
       html5Accuracy = position.coords.accuracy; //Get accuracy in meters
       return (html5Lat).toFixed(8) + ", " + (html5Lon).toFixed(8);
 }
 function initializeCurrent(latcurr, longcurr) {
       currgeocoder = new google.maps.Geocoder();
       //console.log(latcurr + "-- ######## --" + longcurr);
       dat_lat = latcurr;
       dat_long = longcurr;
       if (latcurr != '' && longcurr != '') {
           var myLatlng = new google.maps.LatLng(latcurr, longcurr);
           return getCurrentAddress(myLatlng);
       }
 }
 function getCurrentAddress(location) {
        currgeocoder.geocode({
            'location': location

      }, function(results, status) {
          //console.log(results, status);
          if (status == google.maps.GeocoderStatus.OK) {
              //console.log(results);
              //console.log(results[0].formatted_address);
              $("#enter-location").val(results[0].formatted_address);
              $(".location_coordinates").attr('data-lat', dat_lat);
              $(".location_coordinates").attr('data-long', dat_long);
          } else {
              alert('Geocode was not successful for the following reason: ' + status);
          }
      });
   }
});

$('#location_button').on('click', function() {
  //alert($('.find-ro-url').val());
  var markers = [];
  var marker =[];
  var key;
  var activeInfo = new google.maps.InfoWindow();
  var infoWindow = '';
  var radius = $('#location-radius').val();
  var location = $('#enter-location').val();
  var curr_lat = $('.location_coordinates').attr('data-lat');
  var curr_long = $('.location_coordinates').attr('data-long');
  var App_Url =  window.location.origin;

  $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

  $.ajax({
    type: 'POST',
    url: $('.find-ro-url').val(),
    data:{
      radius: radius,
      location: location,
      curr_lat: curr_lat,
      curr_long: curr_long
    },
    success: function(data) {
      //console.log(data);
      var json = jQuery.parseJSON(JSON.stringify(data));
      console.log(json);
      var mumbai = {lat: 19.0760, lng: 72.8777};
      var bounds = new google.maps.LatLngBounds();
      var map = new google.maps.Map(
            document.getElementById('map'), {zoom: 8, center: mumbai });
      $.each(json, function(key,value){
        lat = value.latitude;
        lng = value.longitude;
        var position = new google.maps.LatLng(lat, lng);
                      bounds.extend(position);
        var marker = new google.maps.Marker({
                          position: position,
                          map: map,
                          title: value.created_at
                      });
        var infoWindowContent = [
                    ['<div class="info_content " style="width:170px">' +
                    '<h3 style= "font-weight: bold;margin-bottom: 10px;">'+value.ro_name+'</h3>' +
                    '<p style="line-height: 1.5">'+value.address+'</p>' +'</div>'],
                    ];
        var infoWindow = new google.maps.InfoWindow();
        infoWindow.setContent(infoWindowContent[0][0]);
        google.maps.event.addListener(marker, 'click', (function(marker, key) {

            return function() {
              activeInfo.close();
              infoWindow.open(map, this);
              activeInfo = infoWindow;
            }          
        })(marker, key));
        markers.push(marker);
        map.fitBounds(bounds);

      });
    }
  });
});

$('#code_button').on('click', function(){
  var ro_code = $('#search-ro').val();
  var markers = [];
  var marker =[];
  var key;
  var activeInfo = new google.maps.InfoWindow();
  var infoWindow = '';
  if(ro_code != ''){
    $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
      type: 'POST',
      url: $('.ro-code-url').val(),
      data:{
        ro_code: ro_code
      },
      success: function(data){
        if(data == 0){
          alert('Please Enter Correct Code.');
        }
        else{
          var mumbai = {lat: 19.0760, lng: 72.8777};
          var bounds = new google.maps.LatLngBounds();
          var map = new google.maps.Map(
                document.getElementById('map'), {zoom: 8, center: mumbai });
          $.each(data, function(key,value){
          lat = value.latitude;
          lng = value.longitude;
          var position = new google.maps.LatLng(lat, lng);
                        bounds.extend(position);
          var marker = new google.maps.Marker({
                            position: position,
                            map: map,
                            title: value.created_at
                        });
          var infoWindowContent = [
                      ['<div class="info_content ">' +
                      '<h3>'+value.ro_name+'</h3>' +
                      '<p>'+value.address+'</p>' +'</div>'],
                      ];
          var infoWindow = new google.maps.InfoWindow();
          infoWindow.setContent(infoWindowContent[0][0]);
          google.maps.event.addListener(marker, 'click', (function(marker, key) {

              return function() {
                activeInfo.close();
                infoWindow.open(map, this);
                activeInfo = infoWindow;
              }          
          })(marker, key));
          markers.push(marker);
          map.fitBounds(bounds);

        });
        }
      }
    });
  }
  else{
    alert('Please Enter RO Code');
  }
});