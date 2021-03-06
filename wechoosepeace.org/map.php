<?php require_once("wp-config.php"); ?>



<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <style type="text/css">
      html { height: 100% }
      body { height: 100%; margin: 0; padding: 0 }
      #map_canvas { height: 100% }
    </style>
    <script type="text/javascript"
      src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAVYozvwG3T9P5vysSyBs2vqb67EyAhvss&sensor=false">
    </script>
    <script type="text/javascript">
    //<![CDATA[
    
        var customIcons = {
      		default: {
        		icon: 'http://labs.google.com/ridefinder/images/mm_20_blue.png',
        		shadow: 'http://labs.google.com/ridefinder/images/mm_20_shadow.png'
      		}
    	};
    
		function load() {
      		var map = new google.maps.Map(document.getElementById("map_place"), {
        		center: new google.maps.LatLng(47.6145, -122.3418),
        		zoom: 2,
        		mapTypeId: 'terrain'
        	});
       		var infoWindow = new google.maps.InfoWindow;

        
        	// Change this depending on the name of your PHP file
	     	downloadUrl("phpsqlajax_genxml.php", function(data) {
	        	var xml = data.responseXML;
	        	var markers = xml.documentElement.getElementsByTagName("marker");
	        	for (var i = 0; i < markers.length; i++) {
		          var name = markers[i].getAttribute("name");
		          var address = markers[i].getAttribute("address");
		          var point = new google.maps.LatLng( 
		              parseFloat(markers[i].getAttribute("lat")),
		              parseFloat(markers[i].getAttribute("lng")));
		          var html = "<b>" + name + "</b><br /> <img src='" + markers[i].getAttribute('img') +"' width='100' height='100' />";
		          var icon = customIcons[markers[i].getAttribute("type")] || {};
		          var marker = new google.maps.Marker({
		            map: map,
		            position: point,
		            icon: icon.icon,
		            shadow: icon.shadow
		          });
		          bindInfoWindow(marker, map, infoWindow, html);	
	        	}
	         }); 
        }
       
        function bindInfoWindow(marker, map, infoWindow, html) {
      		google.maps.event.addListener(marker, 'click', function() {
        		infoWindow.setContent(html);
        		infoWindow.open(map, marker);
      		});
    	}

    	function downloadUrl(url, callback) {
      		var request = window.ActiveXObject ?
         		new ActiveXObject('Microsoft.XMLHTTP') :
          		new XMLHttpRequest;

      		request.onreadystatechange = function() {
        		if (request.readyState == 4) {
          			request.onreadystatechange = doNothing;
          			callback(request, request.status);
        		}
      		};

      		request.open('GET', url, true);
      		request.send(null);
    	}

    	function doNothing() {}
    	
    	
    	
   	//]]>
    </script>
  </head>
  <body onload="load()">
    <div id="map_place" style="width:100%; height:100%"></div>
  </body>
</html>