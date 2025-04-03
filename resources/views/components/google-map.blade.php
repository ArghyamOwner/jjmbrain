@props([
	'id' => 'map',
	'coordinates' => [
		'lat' => -34.397, 
		'lng' => 150.644
	],
	'zoom' => 8,
	'key' => 'AIzaSyDaDnZlozbQxmvDtPh072TphyYqkUYk4V8',
	'infoContent' => ''
])

<div id="{{ $id }}" {{ $attributes->merge(['class' => 'w-full h-96']) }}></div>

@once
	@push('scripts')
		<script> 
			function initMap() {
				const map = new google.maps.Map(document.getElementById('{{ $id }}'), {
			  		center: @json($coordinates),
			  		zoom: {{ $zoom }},
				});

				const infowindow = new google.maps.InfoWindow({
				    content: '{!! $infoContent !!}'
				});

				const marker = new google.maps.Marker({
		          	position: @json($coordinates),
		          	map: map
		        });

		        marker.addListener("click", () => {
    				infowindow.open(map, marker);
  				});
			}
		</script>
		<script src="https://maps.googleapis.com/maps/api/js?key={{ $key }}&callback=initMap&libraries=places&v=weekly" async></script>
	@endpush
@endonce