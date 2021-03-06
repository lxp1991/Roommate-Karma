@extends ('layouts.dashboard')
@section('page_heading','Find On Map')
@section('section')
<div id="locations-target" style="display: none;">
@for ($i = 0; $i < count($locations); $i++)
    <p>{{ $locations[$i] }}</p>
    <h5>{{ $userIds[$i] }}</h5>  
@endfor
</div>
<div class="col-sm-12"> 
    <div class="row">
        <div id="map"></div>
        <script type="text/javascript">
            var map;
            // var infoWindow = new google.maps.InfoWindow();
            var bounds;
            var userIds;
            function initMap() {
                var entries = document.getElementById("locations-target").getElementsByTagName("p");
                var userIdEntries = document.getElementById("locations-target").getElementsByTagName("h5");
                userIds = [];
                var locations = [];
                bounds = new google.maps.LatLngBounds();
                for (var i = 0; i < entries.length; i++) {
                    locations.push(entries[i].innerText);
                    userIds.push(userIdEntries[i].innerText);
                }
                console.log(userIds);
                map = new google.maps.Map(document.getElementById('map'), {
                    center: {lat: -34.397, lng: 150.644},
                    zoom: 6
                });

                var geocoder = new google.maps.Geocoder();

                // var marker = new google.maps.Marker({
                //     position: {
                //         lat: -34.397, 
                //         lng: 150.644
                //     },  
                //     map: map,
                //     draggable: true,
                // });

                for (var i = 0; i < locations.length; i++) {
                    geocodeAddress(geocoder, map, locations[i], userIds[i]);
                }
                
            }
            
            function geocodeAddress(geocoder, resultsMap, address, userId) {
                geocoder.geocode({ 'address': address}, function(results, status) {
                    if (status == google.maps.GeocoderStatus.OK) {
                        resultsMap.setCenter(results[0].geometry.location);
                        var marker = new google.maps.Marker({
                            map: resultsMap,
                            position: results[0].geometry.location,
                            animation: google.maps.Animation.DROP
                        });
                        
                        google.maps.event.addListener(marker, 'click', function () {
                            window.location.href = "/profile/" + userId;
                        });
                        
                        bounds.extend(results[0].geometry.location);
                        map.fitBounds(bounds);
                    } else {
                        alert('Geocode was not successful for the following reason: ' + status);
                    }
                });
            }
        </script>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVw5ZBZD0bWcS240Z3NsUGurUvMCm-4EQ&callback=initMap"></script>
@endsection