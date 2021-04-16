<?php
    /* Database configuration */
    $dbHost     = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName     = "onecart";

    /* Create database connection */
    $db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    /* Check connection */
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    /* Include the database configuration file */
    // require_once 'dbConfig.php';

    /* Fetch the marker info from the database */
    $result = $db->query("SELECT * FROM locations");

    /* Fetch the info-window data from the database */
    $result2 = $db->query("SELECT * FROM locations");
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyD2_dWZypBFtjVVXN3gFU8wsqP5qpPM6Tk"></script>

<script>
function initMap() {
    var map;
    var bounds = new google.maps.LatLngBounds();
    var mapOptions = {
        mapTypeId: 'roadmap'
    };

    /* Display a map on the web page */
    map = new google.maps.Map(document.getElementById("mapCanvas"), mapOptions);
    map.setTilt(100);

    /* Multiple markers location, latitude, and longitude */
    var markers = [
        <?php if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                echo '["'.$row['name'].'", '.$row['latitude'].', '.$row['longitude'].', "'.$row['icon'].'"],';
            }
        }
        ?>
    ];

    /* Info window content */
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

     /* Add multiple markers to map */
    var infoWindow = new google.maps.InfoWindow(), marker, i;

     /* Place each marker on the map  */
    for( i = 0; i < markers.length; i++ ) {
        var position = new google.maps.LatLng(markers[i][1], markers[i][2]);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            map: map,
			icon: markers[i][3],
            title: markers[i][0]
        });

         /* Add info window to marker   */
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
            return function() {
                infoWindow.setContent(infoWindowContent[i][0]);
                infoWindow.open(map, marker);
            }
        })(marker, i));

       /* Center the map to fit all markers on the screen */
        map.fitBounds(bounds);
    }

   /* Set zoom level */
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(14);
        google.maps.event.removeListener(boundsListener);
    });
}

/* Load initialize function */
google.maps.event.addDomListener(window, 'load', initMap);
</script>


</body>
</html>
