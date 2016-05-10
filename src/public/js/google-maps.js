function initMap() {  
  var input = (
      document.getElementById('name'));

  var autocomplete = new google.maps.places.Autocomplete(input);
  autocomplete.setTypes(["establishment"]);

  autocomplete.addListener('place_changed', function() {
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      window.alert("Autocomplete's returned place contains no geometry");
      return;
    }

    $("#address").val(place.formatted_address);
  });
}

function geocodePlaceId(placeId) {
  var geocoder = new google.maps.Geocoder;
  var infowindow = new google.maps.InfoWindow;
  var map = new google.maps.Map(document.getElementById('map-container'), {
    center: {lat: -33.8688, lng: 151.2195},
    zoom: 16
  });

  geocoder.geocode({'placeId': placeId}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      if (results[0]) {
        map.setZoom(16);
        map.setCenter(results[0].geometry.location);
        var marker = new google.maps.Marker({
          map: map,
          position: results[0].geometry.location
        });
        infowindow.setContent(results[0].formatted_address);
        infowindow.open(map, marker);
      } else {
        window.alert('No map results found');
      }
    } else {
      window.alert('Geocoder failed due to: ' + status);
    }
  });
}