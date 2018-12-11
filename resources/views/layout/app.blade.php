<!DOCTYPE html>
<html lang="en" class="height100">

<head>
	<title>Valid Address</title>
	<!-- For-Mobile-Apps -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="" />


	<script type="application/x-javascript">
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!-- //For-Mobile-Apps -->
	<link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" type="text/css" media="all" />
	<link rel="stylesheet" href="{{asset('css/style.css')}}" type="text/css" media="all" />
	<link rel="stylesheet" href="{{asset('css/bootstrap-select.min.css')}}" type="text/css" media="all" />
	<!-- //Custom-Stylesheet-Links -->
	<style>
		#markerLayer img {
			width: 25px;
			height: 35px;
		}
	</style>
	<!--<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyCr1qT7x8shgPRvAfujWmyEbZguMcf5Cdk"></script>-->


	<!-- Custom-JavaScript-File-Links -->
	<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/jquery-ui.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/bootstrap-select.min.js')}}"></script>
	<!-- Popup-Box-JavaScript -->
	<script src="{{asset('js/modernizr.custom.97074.js')}}"></script>
	<script src="{{asset('js/jquery.chocolat.js')}}"></script>
	<script type="text/javascript">
		$(document).ready(function () {
			var defaults = {
				containerID: 'toTop', // fading element id
				containerHoverID: 'toTopHover', // fading element hover id
				scrollSpeed: 100,
				easingType: 'linear'
			};
			$().UItoTop({
				easingType: 'easeOutQuart'
			});
		});
	</script>

	<script type="text/javascript" src="{{asset('js/move-top.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/easing.js')}}"></script>
	<script src="{{asset('js/menu.js')}}"></script>

</head>

<body style="height:100%; overflow-x:hidden;">

	@yield('content')


	<script defer src="{{asset('js/jquery.flexslider.js')}}"></script>
	<!-- //FlexSlider-JavaScript -->
	<!-- //Custom-JavaScript-File-Links -->
	<script>
		// This example requires the Places library. Include the libraries=places
		// parameter when you first load the API. For example:
		// <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
		function initMap() {
			var mapOptions = {
				// How zoomed in you want the map to start at (always required)
				zoom: 5,
				// The latitude and longitude to center the map (always required)
				center: new google.maps.LatLng(-24.672043, 147.031499), // New York
				mapTypeControlOptions: {
					style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
					position: google.maps.ControlPosition.BOTTOM_LEFT
				},
				// How you would like to style the map.
				// This is where you would paste any style found on Snazzy Maps.
				styles: [{
					"featureType": "water",
					"elementType": "geometry",
					"stylers": [{
						"color": "#e9e9e9"
					}, {
						"lightness": 17
					}]
				}, {
					"featureType": "landscape",
					"elementType": "geometry",
					"stylers": [{
						"color": "#f5f5f5"
					}, {
						"lightness": 20
					}]
				}, {
					"featureType": "road.highway",
					"elementType": "geometry.fill",
					"stylers": [{
						"color": "#ffffff"
					}, {
						"lightness": 17
					}]
				}, {
					"featureType": "road.highway",
					"elementType": "geometry.stroke",
					"stylers": [{
						"color": "#ffffff"
					}, {
						"lightness": 29
					}, {
						"weight": 0.2
					}]
				}, {
					"featureType": "road.arterial",
					"elementType": "geometry",
					"stylers": [{
						"color": "#ffffff"
					}, {
						"lightness": 18
					}]
				}, {
					"featureType": "road.local",
					"elementType": "geometry",
					"stylers": [{
						"color": "#ffffff"
					}, {
						"lightness": 16
					}]
				}, {
					"featureType": "poi",
					"elementType": "geometry",
					"stylers": [{
						"color": "#f5f5f5"
					}, {
						"lightness": 21
					}]
				}, {
					"featureType": "poi.park",
					"elementType": "geometry",
					"stylers": [{
						"color": "#dedede"
					}, {
						"lightness": 21
					}]
				}, {
					"elementType": "labels.text.stroke",
					"stylers": [{
						"visibility": "on"
					}, {
						"color": "#ffffff"
					}, {
						"lightness": 16
					}]
				}, {
					"elementType": "labels.text.fill",
					"stylers": [{
						"saturation": 36
					}, {
						"color": "#333333"
					}, {
						"lightness": 40
					}]
				}, {
					"elementType": "labels.icon",
					"stylers": [{
						"visibility": "off"
					}]
				}, {
					"featureType": "transit",
					"elementType": "geometry",
					"stylers": [{
						"color": "#f2f2f2"
					}, {
						"lightness": 19
					}]
				}, {
					"featureType": "administrative",
					"elementType": "geometry.fill",
					"stylers": [{
						"color": "#fefefe"
					}, {
						"lightness": 20
					}]
				}, {
					"featureType": "administrative",
					"elementType": "geometry.stroke",
					"stylers": [{
						"color": "#fefefe"
					}, {
						"lightness": 17
					}, {
						"weight": 1.2
					}]
				}]
			};
			/*var map = new google.maps.Map(document.getElementById('map', mapOptions), {
			 center: {lat: -26.160329, lng: 143.104808},
			 zoom: 13
			 });*/
			var map = new google.maps.Map(document.getElementById('map'), mapOptions);
			var image1 = 'images/marker1.png';
			var input = /** @type {!HTMLInputElement} */ (
					document.getElementById('address-input'));
			var types = document.getElementById('type-selector');
			//map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
			map.controls[google.maps.ControlPosition.TOP_LEFT].push(types);
			var autocomplete = new google.maps.places.Autocomplete(input);
			autocomplete.bindTo('bounds', map);
			var infowindow = new google.maps.InfoWindow();
			var marker = new google.maps.Marker({
				map: map,
				icon: image1,
				anchorPoint: new google.maps.Point(0, -15)
			});
			autocomplete.addListener('place_changed', function () {
				infowindow.close();
				marker.setVisible(false);
				var place = autocomplete.getPlace();
				if (!place.geometry) {
					window.alert("Autocomplete's returned place contains no geometry");
					marker.setVisible(false);
					return;
				}
				// If the place has a geometry, then present it on a map.
				if (place.geometry.viewport) {
					map.fitBounds(place.geometry.viewport);
				} else {
					map.setCenter(place.geometry.location);
					map.setZoom(17); // Why 17? Because it looks good.
				}
				//marker.setIcon(/** @type {google.maps.Icon} */({
				//url: place.icon,
				//size: new google.maps.Size(71, 71),
				//origin: new google.maps.Point(0, 0),
				//anchor: new google.maps.Point(17, 34),
				//scaledSize: new google.maps.Size(35, 35)
				//}));
				marker.setPosition(place.geometry.location);
				marker.setVisible(true);
				var address = '';
				if (place.address_components) {
					address = [
						(place.address_components[0] && place.address_components[0].short_name || ''),
						(place.address_components[1] && place.address_components[1].short_name || ''),
						(place.address_components[2] && place.address_components[2].short_name || '')
					].join(' ');
				}
				infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
				infowindow.open(map, marker);
			});

			function removeMark() {
				if (input.value == "") {
					marker.setVisible(false);
					alert('hi');
				}
			}
			// Sets a listener on a radio button to change the filter type on Places
			// Autocomplete.
			function setupClickListener(id, types) {
				var radioButton = document.getElementById(id);
				radioButton.addEventListener('click', function () {
					autocomplete.setTypes(types);
				});
			}
			setupClickListener('changetype-all', []);
			setupClickListener('changetype-address', ['address']);
			setupClickListener('changetype-establishment', ['establishment']);
			setupClickListener('changetype-geocode', ['geocode']);
		}
	</script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCr1qT7x8shgPRvAfujWmyEbZguMcf5Cdk&libraries=places&callback=initMap" async defer></script>
	<script type="text/javascript">
		function load() {
			$('.pin1').animate({
				opacity: 1
			}, 1000, completeone);
		}

		function completeone() {
			//alert('h1')
			$('.pin1').animate({
				opacity: 0
			}, 1000);
			$('.pin2').animate({
				opacity: 1
			}, 1000, completetwo);
		}

		function completetwo() {
			$('.pin2').animate({
				opacity: 0
			}, 1000);
			$('.pin3').animate({
				opacity: 1
			}, 1000, completeloop);
		}

		function completeloop() {
			$('.pin3').animate({
				opacity: 0
			}, 1000);
			setTimeout(function () {
				load();
			}, 1000);
		}
	</script>

</body>

</html>
