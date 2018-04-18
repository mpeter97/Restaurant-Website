<?php
	session_start();
echo('
<!DOCTYPE html >
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="content-type" content="text/html; charset=UTF-8"/>
    <title>Three Guys</title>
    <style>
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 100%;
      }
      /* Optional: Makes the sample page fill the window. */
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="../CSS/Head.css" type="text/css">
    <link rel="stylesheet" href="../CSS/Body.css" type="text/css">
    <link rel="stylesheet" href="../CSS/Footer.css" type="text/css">
  </head>

  <body>');
  include 'Head.php';
  echo('
    <div id="map"></div>

    <script>
      var customLabel = {
        restaurant: {
          label: "R"
        },
        bar: {
          label: "B"
        }
      };

        function initMap() {
        var map = new google.maps.Map(document.getElementById("map"), {
          center: new google.maps.LatLng(42.2741366,-85.6671886),
          zoom: 12
        });
        var infoWindow = new google.maps.InfoWindow;

          // Change this depending on the name of your PHP or XML file
          downloadUrl("locations.xml", function(data) {
            var xml = data.responseXML;
            var markers = xml.documentElement.getElementsByTagName("marker");
            Array.prototype.forEach.call(markers, function(markerElem) {
              var id = markerElem.getAttribute("id");
              var name = markerElem.getAttribute("name");
              var address = markerElem.getAttribute("address");
              var type = markerElem.getAttribute("type");
              var point = new google.maps.LatLng(
                  parseFloat(markerElem.getAttribute("lat")),
                  parseFloat(markerElem.getAttribute("lng")));

              var infowincontent = document.createElement("div");
              var strong = document.createElement("strong");
              strong.textContent = name
              infowincontent.appendChild(strong);
              infowincontent.appendChild(document.createElement("br"));

              var text = document.createElement("text");
              text.textContent = address
              infowincontent.appendChild(text);
              var icon = customLabel[type] || {};
              var marker = new google.maps.Marker({
                map: map,
                position: point,
                label: icon.label
              });
              marker.addListener("click", function() {
                infoWindow.setContent(infowincontent);
                infoWindow.open(map, marker);
              });
            });
          });
        }



      function downloadUrl(url, callback) {
        var request = window.ActiveXObject ?
            new ActiveXObject("Microsoft.XMLHTTP") :
            new XMLHttpRequest;

        request.onreadystatechange = function() {
          if (request.readyState == 4) {
            request.onreadystatechange = doNothing;
            callback(request, request.status);
          }
        };

        request.open("GET", url, true);
        request.send(null);
      }

      function doNothing() {}
    </script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBEz8uDgASvThW73JnDTDJE8siGXQmK1DU&callback=initMap">
    </script>
  </body>
</html>
');
