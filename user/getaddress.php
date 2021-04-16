<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>One Cart Shopping</title>
    <link rel="stylesheet" href="css/style1.css">
    <link rel="stylesheet" href="css/style2.css">
    <link href="https://fonts.googleapis.com/css2?family=Lemonada:wght@600&display=swap" rel="stylesheet">

    <script type="text/javascript"
          src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBzSnah4pBNvwR3PN53ZaezSBUmNGNuf3U"></script>
    <script src="https://unpkg.com/location-picker/dist/location-picker.min.js"></script>
    <style type="text/css">
      #map {
        width: 100%;
        height: 480px;
      }
    </style>

</head>
<body>
<?php
include("include/header.php"); 
 ?>

<div class="row">
<div class="col-75">
<center>
<div class="container" style="width:90%">

<form method="post" action="process.php">
<div class="row">
<div class="col-50" >
<center><h3>Billing Address</h3></center>
    
        <label><i class="fa fa-user"></i>Full Name</label>
        <Input type="text" name="fname" placeholder="John M. Doe" required/>        
        
        <label><i class="fa fa-envelope"></i>Email</label>
        <Input type="text" name="email" placeholder="john@example.com" required/>
        
        <label>Shipping Address</label>
        <Input type="text" name="u_address" placeholder="address" required/>
        
        <label>Current City</label>
        <Input type="text" name="city" placeholder="Name" required/>
        
        <label>Postal Code</label>
        <Input type="text" name="zip" placeholder="Name" required/>     
        

    <div id="map"></div>
    <br>
    <center>
    <button id="confirmPosition" style="width:45% ;color: 	#006400 !important;
text-transform: uppercase;
background: #ffffff;
padding: 10px;
border: 4px solid 	#006400 !important;
border-radius: 6px;
display: inline-block;
transition: all 0.3s ease 0s;"><b> Next </b></button>
    <br><br>
    </center>    

        <input type="text" id="longtitude" name="longtitude" hidden>
        <input type="text" id="latitude" name="latitude" hidden>

    </form>
    </center>
    <script>
  
        var longt = document.getElementById('longtitude');
        var latt = document.getElementById('latitude');

        // Initialize locationPicker plugin
        var lp = new locationPicker('map', {
            setCurrentPosition: true, // You can omit this, defaults to true
        }, {
            zoom: 15 // You can set any google map options here, zoom defaults to 15
        });

        // Listen to map idle event, listening to idle event more accurate than listening to ondrag event
        google.maps.event.addListener(lp.map, 'idle', function (event) {

            var location = lp.getMarkerPosition();
            longt.value = location.lng;
            latt.value = location.lat;
        });
    </script>

<?php
include("include/footer.php"); 
 ?>
</body>
</html>