var geocoder;
var map;
var address = "new york city";
var dat_lat;
var dat_long;
var pump,
    result_slider1,
    directionsService,
    directionsDisplay,
    pump1,
    calculateAndDisplayRoute,
    originInput,
    destinationInput;

    function loadGoogleMapsApi() {
        fetch('/api-key')
    .then(response => {
        if (!response.ok) {
            return response.text().then(text => {
                throw new Error('Network response was not ok: ' + text);
            });
        }
        return response.json();
    })
    .then(data => {
        const script = document.createElement('script');
        script.src = `https://maps.googleapis.com/maps/api/js?key=${data.key}&libraries=places&callback=initMap&loading=async`;
        script.async = true; // Set async attribute
        document.head.appendChild(script);
    })
    .catch(error => console.error('Error fetching API key:', error));
    };

    $(document).ready(function() {
        loadGoogleMapsApi();
    });       

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function() {
    $.ajax({
        type: 'POST',
        url: $('.ro_pumps').val(),
        success: function(data) {
            pump1 = data;
            console.log("PUMPS1" + pump1);
        },
        complete: function(){

        }
    });
});

//console.log(calculateAndDisplayRoute);
$('.locate-a-pump__results').hide();
//var App_Url =  window.location.origin;
//console.log(APP_URL);

function initMap() {
    //console.log('in');
    myLatlng = new google.maps.LatLng(18.9690, 72.8205);
    map = new google.maps.Map(document.getElementById('map'), {
        zoom: 8,
        center: myLatlng,
        mapTypeId: 'roadmap'
    });
    var geocoder = new google.maps.Geocoder();
        directionsService = new google.maps.DirectionsService;
        directionsDisplay = new google.maps.DirectionsRenderer;
    //codeAddress(geocoder, map);
    /*function codeAddress(geocoder, map) {
        geocoder.geocode({
            'address': address
        }, function(results, status) {
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
    }*/

        input = document.getElementById('enter-location');
        searchBox = new google.maps.places.SearchBox(input);
        originInput = document.getElementById('enter-source-location');
        destinationInput = document.getElementById('enter-destination-location');
        searchBox1 = new google.maps.places.SearchBox(originInput);
        searchBox2 = new google.maps.places.SearchBox(destinationInput);
        activeInfo = new google.maps.InfoWindow();
        result_slider1 = '';
        count1 = 0;
        //directionsDisplay.setMap(null);
        calculateAndDisplayRoute = function(directionsService, directionsDisplay) {
            /*myLatlng = new google.maps.LatLng(18.9690, 72.8205);
            map = new google.maps.Map(document.getElementById('map'), {
                zoom: 8,
                center: myLatlng,
                mapTypeId: 'roadmap'
            });*/
                console.log(originInput);
                console.log(destinationInput);
                console.log(directionsDisplay);
                console.log(directionsService);
              directionsService.route({
                  origin: originInput.value,
                  destination: destinationInput.value,
                  travelMode: 'DRIVING'
              }, function(response, status) {
                  if (status === 'OK') {
                      directionsDisplay.setDirections(response);
                      //console.log(response);
                      //var myPosition = new google.maps.LatLng(18.7557, 73.4091);

                      var points = new google.maps.Polyline({
                          path: response.routes[0].overview_path
                      });
                      result_slider1 = '';
                      count1 = 0;

                      $.each(pump1, function(key, value) {
                          var myPosition = new google.maps.LatLng(value.latitude, value.longitude);
                          var edge = google.maps.geometry.poly.isLocationOnEdge(myPosition, points, 10e-3);
                          if (edge == true) {
                              count1++;
                              var marker = new google.maps.Marker({
                                  position: myPosition,
                                  map: map
                              });
                              var infoWindowContent = [
                                  ['<div class="info_content " style="width:170px">' +
                                      '<h3 style= "font-weight: bold;margin-bottom: 10px;">' + value.outlet_name + '</h3>' +
                                      '<p style="line-height: 1.5">' + value.address_line2 + '</p>' + '</div>'
                                  ],
                              ];
                              var petrol_price, diesel_price, efp_facility;
                              if(value.petrol_price == ''){
                                petrol_price = '<div class="locate-a-pump__slide_price_container">' +
                                                '<h6 class="locate-a-pump__slide_price_title">Petrol / ltr</h6>' +
                                                '<i class="fa fa-inr"></i> N/A' +
                                                '</div>';
                              }
                              else{
                                petrol_price = '<div class="locate-a-pump__slide_price_container">' +
                                                '<h6 class="locate-a-pump__slide_price_title">Petrol / ltr</h6>' +
                                                '<i class="fa fa-inr"></i>' + parseFloat(value.petrol_price).toFixed(2) +
                                                '</div>'; 
                              }
                              if(value.diesel_price == ''){
                                diesel_price = '<div class="locate-a-pump__slide_price_container">' +
                                                '<h6 class="locate-a-pump__slide_price_title">Diesel / ltr</h6>' +
                                                '<i class="fa fa-inr"></i> N/A' +
                                                '</div>';
                              }
                              else{
                                diesel_price = '<div class="locate-a-pump__slide_price_container">' +
                                                '<h6 class="locate-a-pump__slide_price_title">Diesel / ltr</h6>' +
                                                '<i class="fa fa-inr"></i>' + parseFloat(value.diesel_price).toFixed(2) +
                                                '</div>'; 
                              }
                              if(value.Is_Fleet_Operation == 1){
                                efp_facility = '<div class="locate-a-pump__slide_prices_container-2">'+
                                                  '<h6 class="locate-a-pump__slide_price_title">Fleet Plus Facility</h6>'+
                                                  '<span>YES</span>'+
                                              '</div>';
                              }
                              else{
                                efp_facility = '<div class="locate-a-pump__slide_prices_container-2">'+
                                                  '<h6 class="locate-a-pump__slide_price_title">Fleet Plus Facility</h6>'+
                                                  '<span>NO</span>'+
                                              '</div>';
                              }
                              result_slider1 += '<div class="locate-a-pump__slide">' +
                                  '<h5 class="locate-a-pump__slide_title theme-gradient">' + value.outlet_name + '</h5>' +
                                  '<div class="locate-a-pump__slide_address_container">' +
                                  '<address class="locate-a-pump__slide_address">' + value.address_line2 + '</address>' +
                                  '<div class="locate-a-pump__slide_prices_container">' +
                                  petrol_price +
                                  diesel_price +
                                  '</div>' +
                                  efp_facility +
                                  '<div class="locate-a-pump__slide_ro_container">' +
                                  '<b class="locate-a-pump__slide_ro_title">RO code</b>' + value.outlet_cmscode +
                                  '</div>' +
                                  '</div>' +
                                  '</div>';
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
                              //map.fitBounds(bounds);

                          }
                      });
                      $('.locate-a-pump__results').show();
                      $('.result_count').html('About ' + count1 + ' Results');

                      $('.locate-a-pump__slider')
                          .slick('unslick')
                          .html(result_slider1);

                      window.locatepump__slider();
                      //var edge = google.maps.geometry.poly.isLocationOnEdge(myPosition, points, 10e-1);
                      //console.log(edge);
                  } else {
                      window.alert('Directions request failed due to ' + status);
                  }
              });
          };
    directionsDisplay.setMap(map);
    
    $(document).on("click","#hid_route", function(){
        var btn = this;
        btn.disabled = true;
        $(this).addClass('btn-loading');
        $('.locate-a-pump__slider').empty();

        calculateAndDisplayRoute(directionsService, directionsDisplay);
        btn.disabled = false;
        $(this).removeClass('btn-loading');
    });
    /*$(document).on("click","#ro_route", function(){
        $('.locate-a-pump__slider').empty();

        calculateAndDisplayRoute(directionsService, directionsDisplay);
    });*/
    //console.log(searchBox);
    //map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

    map.addListener('bounds_changed', function() {
        searchBox.setBounds(map.getBounds());
        searchBox1.setBounds(map.getBounds());
        searchBox2.setBounds(map.getBounds());
    });
    /*document.getElementById('ro_route').onclick = function(e) {
        
    };*/
    /*$(document).on('click', '#ro_route',function(e){
      $('.locate-a-pump__slider').empty();
        calculateAndDisplayRoute(directionsService, directionsDisplay);
    });*/

    var markers = [];

    searchBox.addListener('places_changed', function() {
        var places = searchBox.getPlaces();
        geocoder.geocode({
            'address': places[0].formatted_address
        }, function(results, status) {
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

//$(document).on("click","#ro_route", function(){
    
    //$('.locate-a-pump__slider').empty();
    //initMap();
   // $('#hid_route').trigger('click');
    //calculateAndDisplayRoute(directionsService, directionsDisplay);
//});

$('#ro_route').on('click',function() {
    $('.locate-a-pump__slider').empty();
    initMap();
    $('#hid_route').trigger('click');
})


$('#current-btn').on('click', function() {
    if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(function(position, html5Error) {
            geo_loc = processGeolocationResult(position);
            //console.log(geo_loc);
            currLatLong = geo_loc.split(",");
            initializeCurrent(currLatLong[0], currLatLong[1]);
        });
    } else {
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
    var count = 0;
    var markers = [];
    var marker = [];
    var key;
    var activeInfo = new google.maps.InfoWindow();
    var infoWindow = '';
    var radius = $('#location-radius').val();
    var location = $('#enter-location').val();
    var curr_lat = $('.location_coordinates').attr('data-lat');
    var curr_long = $('.location_coordinates').attr('data-long');
    var App_Url = window.location.origin;
    var btn = this;
    if(location == ''){
      $('.radius-label').addClass('input-error');
      return;
    }
    else{
      $('.radius-label').removeClass('input-error');
    }
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    btn.disabled = true;
    $(this).addClass('btn-loading');
    $.ajax({
        type: 'POST',
        url: $('.find-ro-url').val(),
        data: {
            radius: radius,
            location: location,
            curr_lat: curr_lat,
            curr_long: curr_long
        },

        success: function(data) {
          btn.disabled = false;
          $(this).removeClass('btn-loading');
            var result_slider = '';
            //console.log(data);
            var json = jQuery.parseJSON(JSON.stringify(data));
            //console.log(json);
            var mumbai = {
                lat: 19.0760,
                lng: 72.8777
            };
            var bounds = new google.maps.LatLngBounds();
            var map = new google.maps.Map(
                document.getElementById('map'), {
                    zoom: 8,
                    center: mumbai
                });
            $.each(json, function(key, value) {
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
                    [' <div class="info_content " style="width:170px">' +
                    'https://www.google.com/maps/place/Nayara+OUTLET+NAME+Petrol+Pump/@LAT,LONG,17z/data=!4m14!1m7!3m6!1s0x3be7bd1b6b7fc751:0x701b29c5718db00e!2sNayara+OUTLET+NAME+Petrol+Pump!8m2!3d1LAT!4dLONG!16s%2Fg%2F11f29zz_1y!3m5!1s0x3be7bd1b6b7fc751:0x701b29c5718db00e!8m2!3d19.2986009!4d73.0477296!16s%2Fg%2F11f29zz_1y?entry=ttu' + '</div>'
                    ],
                ];
                var petrol_price, diesel_price;
                if(value.PETROL == ''){
                  petrol_price = '<div class="locate-a-pump__slide_price_container">' +
                                  '<h6 class="locate-a-pump__slide_price_title">Petrol / ltr</h6>' +
                                  '<i class="fa fa-inr"></i> N/A' +
                                  '</div>';
                }
                else{
                  petrol_price = '<div class="locate-a-pump__slide_price_container">' +
                                  '<h6 class="locate-a-pump__slide_price_title">Petrol / ltr</h6>' +
                                  '<i class="fa fa-inr"></i>' + parseFloat(value.PETROL).toFixed(2) +
                                  '</div>'; 
                }
                if(value.DIESEL == ''){
                  diesel_price = '<div class="locate-a-pump__slide_price_container">' +
                                  '<h6 class="locate-a-pump__slide_price_title">Diesel / ltr</h6>' +
                                  '<i class="fa fa-inr"></i> N/A' +
                                  '</div>';
                }
                else{
                  diesel_price = '<div class="locate-a-pump__slide_price_container">' +
                                  '<h6 class="locate-a-pump__slide_price_title">Diesel / ltr</h6>' +
                                  '<i class="fa fa-inr"></i>' + parseFloat(value.DIESEL).toFixed(2) +
                                  '</div>'; 
                }
                result_slider += '<div class="locate-a-pump__slide">' +
                    '<h5 class="locate-a-pump__slide_title theme-gradient">' + value.ro_name + '</h5>' +
                    '<div class="locate-a-pump__slide_address_container">' +
                    '<address class="locate-a-pump__slide_address">' + value.address + '</address>' +
                    '<div class="locate-a-pump__slide_prices_container">' +
                    petrol_price +
                    diesel_price +
                    '</div>' +
                    '<div class="locate-a-pump__slide_prices_container-2">'+
                        '<h6 class="locate-a-pump__slide_price_title">Fleet Plus Facility</h6>'+
                        '<span>'+ value.efp +'</span>'+
                    '</div>'+
                    '<div class="locate-a-pump__slide_ro_container">' +
                    '<b class="locate-a-pump__slide_ro_title">RO code</b>' + value.cms_code +
                    '</div>' +
                    '</div>' +
                    '</div>';
                var infoWindow = new google.maps.InfoWindow();
                infoWindow.setContent(infoWindowContent[0][0]);
                google.maps.event.addListener(marker, 'click', (function(marker, key) {
                    return function() {
                        //alert(value.outlet_name);
                        var url='https://www.google.com/maps?q='+value.latitude+','+ value.longitude;
                        window.open(url,'_blank');
                        
                    }
                })(marker, key));
                markers.push(marker);
                map.fitBounds(bounds);
                count++;
            });
            $('.locate-a-pump__results').show();
            $('.result_count').html('About ' + count + ' Results');

            $('.locate-a-pump__slider')
                .slick('unslick')
                .html(result_slider);

            window.locatepump__slider();
        }
    });
});

$('#code_button').on('click', function() {
    var ro_code = $('#search-ro').val();
    var btn = this;
    var markers = [];
    var marker = [];
    var key;
    var activeInfo = new google.maps.InfoWindow();
    var infoWindow = '';
    if (ro_code != '') {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        //btn.disabled = true;
        //debugger
        $.ajax({
            type: 'POST',
            url: $('.ro-code-url').val(),
            data: {
                ro_code: ro_code
            },
            beforeSend: function() {
              //$('#code_button').addClass('btn-loading');
              //console.log(this);
            },
            success: function(data) {
              btn.disabled = false;
                $('#code_button').removeClass('btn-loading');
                var result_slider = '';
                if (data == 0) {
                    alert('Please Enter Correct Code.');
                } else {
                    var mumbai = {
                        lat: 19.0760,
                        lng: 72.8777
                    };
                    var bounds = new google.maps.LatLngBounds();
                    var map = new google.maps.Map(
                        document.getElementById('map'), {
                            zoom: 4,
                            center: mumbai
                        });
                    $.each(data, function(key, value) {
                        lat = value.latitude;
                        lng = value.longitude;
                        var position = new google.maps.LatLng(lat, lng);
                        bounds.extend(position);
                        var marker = new google.maps.Marker({
                            position: position,
                            map: map,
                            title: value.address1
                        });
                        var infoWindowContent = [
                            ['<div class="info_content ">' +
                                '<h3>' + value.address1 + '</h3>' +
                                '<p>' + value.address + '</p>' + '</div>'
                            ],
                        ];
                        var petrol_price, diesel_price;
                        if(value.PETROL == ''){
                          petrol_price = '<div class="locate-a-pump__slide_price_container">' +
                                          '<h6 class="locate-a-pump__slide_price_title">Petrol / ltr</h6>' +
                                          '<i class="fa fa-inr"></i> N/A' +
                                          '</div>';
                        }
                        else{
                          petrol_price = '<div class="locate-a-pump__slide_price_container">' +
                                          '<h6 class="locate-a-pump__slide_price_title">Petrol / ltr</h6>' +
                                          '<i class="fa fa-inr"></i>' + parseFloat(value.PETROL).toFixed(2) +
                                          '</div>'; 
                        }
                        if(value.DIESEL == ''){
                          diesel_price = '<div class="locate-a-pump__slide_price_container">' +
                                          '<h6 class="locate-a-pump__slide_price_title">Diesel / ltr</h6>' +
                                          '<i class="fa fa-inr"></i> N/A' +
                                          '</div>';
                        }
                        else{
                          diesel_price = '<div class="locate-a-pump__slide_price_container">' +
                                          '<h6 class="locate-a-pump__slide_price_title">Diesel / ltr</h6>' +
                                          '<i class="fa fa-inr"></i>' + parseFloat(value.DIESEL).toFixed(2) +
                                          '</div>'; 
                        }
                        result_slider += '<div class="locate-a-pump__slide">' +
                            '<h5 class="locate-a-pump__slide_title theme-gradient">' + value.ro_name + '</h5>' +
                            '<div class="locate-a-pump__slide_address_container">' +
                            '<address class="locate-a-pump__slide_address">' + value.address + '</address>' +
                            '<div class="locate-a-pump__slide_prices_container">' +
                            petrol_price +
                            diesel_price +
                            '</div>' +
                            '<div class="locate-a-pump__slide_prices_container-2">'+
                                '<h6 class="locate-a-pump__slide_price_title">Fleet Plus Facility</h6>'+
                                '<span>'+ value.efp +'</span>'+
                            '</div>'+
                            '<div class="locate-a-pump__slide_ro_container">' +
                            '<b class="locate-a-pump__slide_ro_title">RO code</b>' + value.cms_code +
                            '</div>' +
                            '</div>' +
                            '</div>';
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
                    $('.locate-a-pump__results').show();
                    $('.result_count').html('About 1 Results');

                    $('.locate-a-pump__slider')
                        .slick('unslick')
                        .html(result_slider);
                }
            },
            error: function(xhr, textStatus, error) {
                if (xhr.status == 500) {
                    alert('Something Went wrong');
                }
            }
        });
    } else {
        alert('Please Enter RO Code');
    }
});