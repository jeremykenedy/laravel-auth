@if ($user->profile && $user->profile->location)

	<script type="text/javascript">

		function google_maps_geocode_and_map() {

			var geocoder = new google.maps.Geocoder();
			var address = '{{$user->profile->location}}';

			geocoder.geocode( { 'address': address}, function(results, status) {

				if (status == google.maps.GeocoderStatus.OK) {

					var latitude = results[0].geometry.location.lat();
					var longitude = results[0].geometry.location.lng();

					// SHOW LATITUDE AND LONGITUDE
					document.getElementById('latitude').innerHTML += latitude;
					document.getElementById('longitude').innerHTML += longitude;

					// CHECK IF HTML DOM CONTAINER IS FOUND
					if (document.getElementById('map-canvas')){

						function getMap() {

						    // Coordinates to center the map
						    var LatitudeAndLongitude = new google.maps.LatLng(latitude,longitude);

							var mapOptions = {
								scrollwheel: false,
								disableDefaultUI: false,
								draggable: false,
								zoom: 14,
								center: LatitudeAndLongitude,
								mapTypeId: google.maps.MapTypeId.TERRAIN // HYBRID, ROADMAP, SATELLITE, or TERRAIN
							};

							var map = new google.maps.Map(document.getElementById("map-canvas"), mapOptions);

						  	// MARKER
						    var marker = new google.maps.Marker({
						        map: map,
						        //icon: "",
						        title: '<strong>{{$user->first_name}}</strong> <br />  {{$user->email}}',
						        position: map.getCenter()
						    });

						    // INFO WINDOW
							var infowindow = new google.maps.InfoWindow();
							infowindow.setContent('<strong>{{$user->first_name}}</strong> <br />  {{$user->email}}');

						    infowindow.open(map, marker);
							google.maps.event.addListener(marker, 'click', function() {
								infowindow.open(map, marker);
							});

						}

						// ATTACH MAP TO DOM HTML ELEMENT
						google.maps.event.addDomListener(window, 'load', getMap);

					}

				}

			});

		}

		google_maps_geocode_and_map();

	</script>

@endif