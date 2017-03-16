<?php
require_once 'header.php';

if (!$loggedin) die();
?>

<meta name="viewport" content="initial-scale=1.0, user-scalable=no">
<meta charset="utf-8">
<script  src="https://code.jquery.com/jquery-3.1.1.min.js"
integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
crossorigin="anonymous"></script>
<style>

	#map {
		height: 100%;
	}

	html, body {
		height: 100%;
		margin: 0;
		padding: 0;
	}
</style>
</head>
<body>
	<div id="map"></div>
	<script>

		function initMap() {

			if (navigator.geolocation) {
				navigator.geolocation.getCurrentPosition(function(position) {
					var pos = {
						lat: position.coords.latitude,
						lng: position.coords.longitude
					};

					var map = new google.maps.Map(document.getElementById('map'), {
						zoom: 12,
						center: pos
					});
					var infoWindow = new google.maps.InfoWindow();

					$.ajax({
						method: "POST",
						url: "updatelocation.php",
						data: { longitude: position.coords.longitude, latitude: position.coords.latitude}
					})
					.done(function( msg ) {
						console.log( "Data Saved: " + msg );
					});   

					$.ajax({
						url: "getMembers.php"
					})
						.done(function( msg ) {
							$.each(JSON.parse(msg), function(i, item) {
								console.log(item);
								var pos = {
									lat: parseFloat(item.Latitude),
									lng: parseFloat(item.Longitude)
								};
								console.log(pos);

							if (item.friends == 1 ){
								//friend marker
								var marker = new google.maps.Marker({
									title: 'Friend',
									position: pos,
									map: map,
									icon: 'http://maps.google.com/mapfiles/ms/icons/green-dot.png',
									contentString: "Username: " + item.user + ("<br/>") + " Last Updated: " + item.LastInserted							
								});
								
							} else if (item.loggedin == 1){
								
								var marker = new google.maps.Marker({
									title: 'Your Location',
									position: pos,
									map: map,
									icon: 'http://maps.google.com/mapfiles/ms/icons/blue-dot.png',
									contentString: "Your current position" + ("<br/>") + item.LastInserted
								});
							} else if (item.friends == 0){
								//not friends
									var marker = new google.maps.Marker({
									title: 'Unknown',
									position: pos,
									map: map,
									icon: 'http://maps.google.com/mapfiles/ms/icons/red-dot.png',
									contentString: 'Unknown'
								});
							} 								
								marker.addListener('click', function() {
									infoWindow.setContent(this.contentString);
									infoWindow.open(map, this);
									map.setCenter(this.getPosition());
								});
							}); 
						}); 


				}, function() {
					handleLocationError(true, infoWindow, map.getCenter());
				});
			} else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
      }
  }

  function handleLocationError(browserHasGeolocation, infoWindow, pos) {
  	infoWindow.setPosition(pos);
  	infoWindow.setContent(browserHasGeolocation ?
  		'Error: The Geolocation service failed.' :
  		'Error: Your browser doesn\'t support geolocation.');
  }
</script>
<script async defer
src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDn9Y3FqxaJWqPw2vdZolJRh0MmE-NHWoU&callback=initMap">
</script>
</body>
</html>