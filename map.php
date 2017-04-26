<?php
?>


    <!--<form>
      <input type="text" id="search" class="controls" placeholder="Search Box"/>
      <input type="submit" value="Submit">
    </form>-->
    <div id="map"></div>
    <script>
      function initMap() {
          var fjerdingen = {lat: 59.9160539, lng: 10.7599923};
        var map = new google.maps.Map(document.getElementById('header'), {
          zoom: 15,
          center: fjerdingen
        });

        var fjerdingenImg = {
              url: 'img/GreenIcon.png',
          scaledSize: new google.maps.Size(20,30)};

        var fjerdingenMrk = new google.maps.Marker({
          position: fjerdingen,
          map: map,
          icon: fjerdingenImg
        });

          

        var input = document.getElementById('search');
        var searchBox = new google.maps.places.SearchBox(input);
        map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

          // Bias the SearchBox results towards current map's viewport.
                  map.addListener('bounds_changed', function() {
                      searchBox.setBounds(map.getBounds());
                  });

                  var markers = [];
        // Listen for the event fired when the user selects a prediction and retrieve
        // more details for that place.
        searchBox.addListener('places_changed', function() {
            var places = searchBox.getPlaces();

            if (places.length == 0) {
                return;
            }
            // Clear out the old markers.
            markers.forEach(function(marker) {
                marker.setMap(null);
            });
          markers = [];

          // For each place, get the icon, name and location.
          var bounds = new google.maps.LatLngBounds(fjerdingen);
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

            // Create a marker for each place.
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
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD1IhX-ZfFJSXeY0rTkotYPIj8V2s2BXFs&libraries=places&callback=initMap">
    </script>