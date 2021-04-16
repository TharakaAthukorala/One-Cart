<!-- <!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
    *{
      margin: 0;
      padding-left: 3px;
    }
      #map{
        height: 600px;
        width: -20%;
      }
    </style>
  </head>
  <body>

    <div id="map">

    </div>

    <script>
      function initMap(){
        var location = {lat: 6.902148, lng: 79.861152};
        var map = new google.maps.Map(document.getElementById("map"), {
          zoom: 4,
          center: location
        });
        var marker = new google.maps.Marker({
          position: location,
          map: map
        });
      }
    </script>

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUi-v7pX2AyOuevGcA80dFz4-3OgiRNj0&callback=initMap"></script>

  </body>
</html> -->

<!-- <!DOCTYPE html>
<html>
  <body>

    <h1>My First Google Map</h1>

      <div id="googleMap" style="width:100%;height:600px;"></div>

    <script>
    function myMap() {
      var mapProp= {
        center:new google.maps.LatLng(51.508742,-0.120850),
        zoom:5,
      };
      var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
      }
    </script>

    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUi-v7pX2AyOuevGcA80dFz4-3OgiRNj0&callback=myMap"></script>

  </body>
</html> -->

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
<div id="bodyright">
  <body>
    <iframe width="1215" height="580" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas" src="https://maps.google.com/maps?width=520&amp;height=400&amp;hl=en&amp;q=%20Colombo+()&amp;t=&amp;z=17&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe> <a href='https://embed-map.org/'>add map to website</a> <script type='text/javascript' src='https://embedmaps.com/google-maps-authorization/script.js?id=b16cde2083f7c0ee5b79f1047542d8d50cbe95fe'></script>
  </body>
</div>
</html>
