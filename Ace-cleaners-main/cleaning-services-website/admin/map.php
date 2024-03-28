<!-- <div id='storemapper' style='width:100%;'>
    <p>Store Locator is loading from <a href='https://www.storemapper.co'>Storemapper</a>...</p>
  </div>
  <script data-storemapper-start='2024,03,25'
          data-storemapper-id='25062-H0edSYzIiCWE7zJ7'>
          (function() {var script = document.createElement('script');
            script.type  = 'text/javascript';script.async = true;
            script.src = 'https://www.storemapper.co/js/widget-3.min.js';
            var entry = document.getElementsByTagName('script')[0];
            entry.parentNode.insertBefore(script, entry);}
          ());
  </script>
   -->


   <?php 
// Include the database configuration file 
require_once 'cn.php'; 
 
// Fetch the marker info from the database 
$result = $corn->query("SELECT * FROM locations"); 
 
// Fetch the info-window data from the database 
$result2 = $corn->query("SELECT * FROM locations"); 
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
    <button>SELECT LOCATION</button>
</div>
<script>
mapboxgl.accessToken = 'pk.eyJ1IjoibGVzdG9ub3NvaSIsImEiOiJjbHU2d2Nsd24yNHk1Mm1wZDh0M2hqOHRuIn0.TMrQ_iTkYo9jbEg8qN50_Q';
if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
        const lng = position.coords.longitude;
        const lat = position.coords.latitude;

        // Create a new map instance centered on the user's location
        const map = new mapboxgl.Map({
            container: 'map',
            style: 'mapbox://styles/mapbox/streets-v12',
            center: [lng, lat], // Set the map's center to the user's location
            zoom: 14 // Adjust the zoom level as needed
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
    var markers = [
        <?php if($result->num_rows > 0){ 
            while($row = $result->fetch_assoc()){ 
                echo '["'.$row['name'].'", '.$row['latitude'].', '.$row['longitude'].', "'.$row['icon'].'"],'; 
            } 
        } 
        ?>
    ];
                        
    // Info window content
    var infoWindowContent = [
        <?php if($result2->num_rows > 0){ 
            while($row = $result2->fetch_assoc()){ ?>
                ['<div class="info_content">' +
                '<h3><?php echo $row['name']; ?></h3>' +
                '<p><?php echo $row['info']; ?></p>' + '</div>'],
        <?php } 
        } 
        ?>
    ];
        
    // Add multiple markers to map
    var infoWindow = new google.maps.InfoWindow(), marker, i;
    
    // Place each marker on the map  
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
			icon: markers[i][3],
            title: markers[i][0]
        });
        
        // Add info window to marker    
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
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
