<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <title>Geocoding service</title>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
        function codeAddress() {
        var address = document.getElementById("address").value;
        var geocoder = new google.maps.Geocoder();

        geocoder.geocode( { 'address': address}, function(results, status) {
          var location = results[0].geometry.location;
          alert('LAT: ' + location.lat() + ' LANG: ' + location.lng());
        });
        }
        google.maps.event.addDomListener(window, 'load', codeAddress);
    </script>
  </head>
  <body>
    <div id="panel">
      <input id="address" type="textbox" value="Tembhurkheda, Maharashtra, INDIA">
      <input type="button" value="Geocode" onclick="codeAddress()">
    </div>
  </body>
</html>