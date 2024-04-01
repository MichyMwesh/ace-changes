<?php 
// Include the database configuration file 
include "dconn.php";

// Fetch the marker info and info window content from the database 
$result = $conne->query("SELECT * FROM cart"); 
$markers = [];
$infoWindowContent = [];
$regions=[];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $lat = $row['lat'];
        $longVal = $row['longVal'];
        $phoneNumber = $row['number'];
        $markers[] = array($lat, $longVal, $phoneNumber);
       $regions[]=array($row['region'],$row['number']);
        // Prepare data for info window content
        $infoWindowContent[] = '<div class="info_content">' .
            '<h3>Client</h3>' .
            '<p>This is a client</p>' .
            '</div>';
    }
}
?>
   <!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Add User Location to Map</title>
<meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no">
<link href="https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.css" rel="stylesheet">
<script src="https://api.mapbox.com/mapbox-gl-js/v3.2.0/mapbox-gl.js"></script>
<style>
body { margin: 0; padding: 0; }
#map { position: absolute; top: 0; bottom: 0; width: 100%; }
</style>
</head>
<body>
<div id="map">
   
</div>
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoibGVzdG9ub3NvaSIsImEiOiJjbHU2d2Nsd24yNHk1Mm1wZDh0M2hqOHRuIn0.TMrQ_iTkYo9jbEg8qN50_Q';
var markers = <?php echo json_encode($markers); ?>; 
var markersRegions = <?php echo json_encode($regions); ?>;
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
        const lng = position.coords.longitude;
        const lat = position.coords.latitude;
        // Create a new map instance centered on the user's location
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v12',
            center: [lng, lat], // Set the map's center to the user's location
            zoom: 5 // Adjust the zoom level as needed
        });

        // Add geolocate control to the map
        map.addControl(
            new mapboxgl.GeolocateControl({
                positionOptions: {
                    enableHighAccuracy: true
                },
                trackUserLocation: true,
                showUserHeading: true
            })
        );

        // Add markers to the map
        markers.forEach(marker => {
            // Extract latitude, longitude, and phone number from the marker array
            const lat = marker[0];
            const lng = marker[1];
            const phoneNumber = marker[2];
            // Create a marker at the specified coordinates with custom icon
            const newMarker = new mapboxgl.Marker({
                color: "red",
                scale: 0.7,
                rotation: 45,
                anchor: 'bottom'
            })
                .setLngLat([lng, lat])
                .setPopup(new mapboxgl.Popup().setHTML('<h3>Client Live Location</h3><h3>Phone Number: ' + phoneNumber + '</h3>')).addTo(map)
                .getElement()
            .addEventListener('click', function() {
                // Do something when the marker is clicked
                //alert('Marker clicked! Phone Number: ' + phoneNumber);
            });;
        });
        markersRegions.forEach(latlong => {
    // Extract latitude and phone number from the marker array
    var ltlng=latlong[0].split(",");
    const lng = ltlng[0];
    const lat=ltlng[1]
    const phoneNumber = latlong[1];
    alert(lat);
    // Create a marker at the specified latitude with custom icon and click event listener
    const newMarker = new mapboxgl.Marker()
        .setLngLat([lng,lat]) // Assuming you want to set longitude to 0
        .setPopup(new mapboxgl.Popup().setHTML('<h3>Client Region</h3><h3>Phone Number: ' + phoneNumber + '</h3>')) // Popup content
        .addTo(map);
});

        // Add marker for user's location
        /*new mapboxgl.Marker()
            .setLngLat([lng, lat])
            .addTo(map);*/
    });
} else {
    // Handle the case where geolocation is not supported
    alert("Geolocation is not supported by this browser.");
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=pk.eyJ1IjoibGVzdG9ub3NvaSIsImEiOiJjbHU2d2Nsd24yNHk1Mm1wZDh0M2hqOHRuIn0.TMrQ_iTkYo9jbEg8qN50_Q"></script>


<script>
    
function initMap() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };
    // Display a map on the web page
    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
    map.setTilt(100);
        
    // Multiple markers location, latitude, and longitude
    var markers = <?php echo json_decode($markers); ?>;
    var infoWindowContent = <?php echo json_encode($infoWindowContent); ?>;
          // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Place each marker on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
            title: markers[i][0]
        });
        
        // Add info window to marker    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

        // Center the map to fit all markers on the screen
        map.fitBounds(bounds);
    }

    // Set zoom level
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });
}

// Load initialize function
google.maps.event.addDomListener(window, 'load', initMap);
</script>


</body>
</html>
