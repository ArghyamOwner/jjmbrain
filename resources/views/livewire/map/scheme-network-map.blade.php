<div>
	<x-slot name="title">Scheme Network Map</x-slot>

	<x-slot name="secondaryTopbar">
		<x-navbar-top-transparent>
			<x-slot:beforeTitle>
				<x-text-link with-back-icon
					href="{{ route('schemes.show', ['scheme' => $schemeId, 'tab' => 'details']) }}">Go Back
				</x-text-link>
			</x-slot>

			<x-slot:title>
				Scheme Network Map for: {{ $schemeName }}
			</x-slot>
		</x-navbar-top-transparent>
	</x-slot>

		<x-section-centered-wide>
			<x-card no-padding overflow-hidden>
				<div class="relative" wire:ignore>
					<div id="map" class="w-full overflow-hidden" style="height: calc(100vh - 120px)"></div>
				</div>
			</x-card>
		</x-section-centered-wide>

		@push('styles')
		<!-- Load Leaflet from CDN -->
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
			integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
			crossorigin="" />

		<!-- Leaflet Mapbox CSS file for Fullscreen option on map-->
		<link rel='stylesheet'
			href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' />

		<!-- Leaflet Ruler CSS file to measure distance between points on map-->
		<link rel="stylesheet"
			href="https://cdn.jsdelivr.net/gh/gokertanrisever/leaflet-ruler@master/src/leaflet-ruler.css"
			integrity="sha384-P9DABSdtEY/XDbEInD3q+PlL+BjqPCXGcF8EkhtKSfSTr/dS5PBKa9+/PMkW2xsY" crossorigin="anonymous">

		<!-- Laeflet Measure Path CSS -->
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-measure-path@1.5.0/leaflet-measure-path.css">

		@endpush

		@push('scripts-footer')
		<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
			integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
			crossorigin=""></script>

		<!-- Load Esri Leaflet from CDN -->
		<script src="https://unpkg.com/esri-leaflet@3.0.10/dist/esri-leaflet.js"></script>
		<script src="https://unpkg.com/esri-leaflet-vector@4.1.0/dist/esri-leaflet-vector.js"></script>

		<!-- Leaflet-measure-path -->
		<script src="https://cdn.jsdelivr.net/npm/leaflet-measure-path@1.5.0/leaflet-measure-path.min.js" defer>
		</script>

		<!-- Leaflet Mapbox js file for Fullscreen option on map-->
		<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'>
		</script>
		<script src="https://unpkg.com/turf/turf.min.js"></script>
		<script>
			document.addEventListener('livewire:load', function () {
	// console.log('{{ $geojsonUrl }}')
	let map = null;
	let beneficiary = @json($locations);
	let canal = @json($canalTracks);
 
	// Init map
	map = L.map('map').setView([{{ $latitude }},{{ $longitude }}], 8);

    // Add a zoom control to the toolbar container
    map.zoomControl.setPosition('bottomright'); // Zoom control

	let osmUrl = 'http://{s}.tile.osm.org/{z}/{x}/{y}.png';
    let osmAttribution = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';

	// Add ESRI Map Layer
	const apiKey = "AAPKebb4404d33324a7cb37d3cfba41264d23f8bxdtdYcnp2Qz5TIai2tELmtX1AZK1nl6CS_5gnTNkQ9Y80WAr9wHf0CpSPWYJ";
	const basemapEnum = "arcgis/imagery";
	L.esri.Vector.vectorBasemapLayer(basemapEnum, {
		apiKey: apiKey
	}).addTo(map);
 
	if (beneficiary != undefined ) {
		let beneficiaryLayer = L.geoJSON(beneficiary, {
			onEachFeature: function (feature, layer) {
				layer.bindPopup(bindPopupData(feature));
			}
		}).addTo(map);
	}

	fetch('{{ $geojsonUrl }}')
		.then(response => response.json())
		.then(data => {
			// Add GeoJSON layer to the map
			let geojsonLayer = L.geoJSON(data).addTo(map);
			
			// Optionally, fit the map bounds to the GeoJSON layer
			map.fitBounds(geojsonLayer.getBounds());
		})
		.catch(error => console.error('Error fetching GeoJSON:', error));

    // Fullscreen option on map
    map.addControl(new L.Control.Fullscreen({
            position: 'bottomright',
    }))

	if (canal != undefined ) {
            let canalLayer = L.geoJSON(canal, {
                type:"Polyline",
                style:function(feature){

                    var lineWidth = scaleValue(feature.properties.size, 0, 700, 0, 10)

                    // console.log(lineWidth);

                    return {
                        color : feature.properties.color,
                        weight : lineWidth
                    };
                },
                onEachFeature: function (feature, layer) {
                                    
                    // Calculate the length of each LineString
                    var coordinates = feature.geometry.coordinates;
                    var totalLength = 0;

                    for (var i = 0; i < coordinates.length - 1; i++) {
                        var latlng1 = L.latLng(coordinates[i][1], coordinates[i][0]);
                        var latlng2 = L.latLng(coordinates[i + 1][1], coordinates[i + 1][0]);

                        // Calculate the distance between consecutive points and add to the total length
                        totalLength += latlng1.distanceTo(latlng2);
                    }

                    // Display the total length on the console (you can use it as needed)
                    var roundLength = (totalLength / 1000).toFixed(2);

                    // console.log('Length: ', roundLength , 'Km');

                    layer.bindPopup(bindCanalPopupData(feature, roundLength));

                    // Get the center of the polyline
                    var bounds = layer.getBounds();
                    var center = bounds.getCenter();

                    // Create a custom div icon with the rounded total length
                    var labelIcon = L.divIcon({
                        className: 'line-label text-white',
                        html: roundLength + ' km'
                    });

                    // Add a marker with the custom div icon to show the label
                    L.marker(center, { icon: labelIcon }).addTo(map);
                }
            }).addTo(map);
            map.fitBounds(canalLayer.getBounds());
        }

		var customIcon = L.icon({
                iconUrl: "{{ url('img/icons/marker-red.png') }}",
                iconSize: [25, 40], // size of the icon
            });

		L.marker([{{ $latitude }},{{ $longitude }}], {icon: customIcon}).addTo(map);

		function scaleValue(value, minValue, maxValue, minScale, maxScale) {
            return ((value - minValue) / (maxValue - minValue)) * (maxScale - minScale) + minScale;
        }

        // Popup Content
        function bindCanalPopupData(feature, roundLength) {
            return `
                Length: <strong>${roundLength}</strong> Km<br>
                Size: <strong>${feature.properties.size}</strong> mm<br>
                Type: <strong>${feature.properties.type}</strong><br>
                Quality: <strong>${feature.properties.quality}</strong><br>
            `;
        }

	// Popup Content
    function bindPopupData(feature) {
        return `
			Name: <strong>${feature.properties.beneficiary_name}</strong><br>
			Phone: <strong>${feature.properties.phone}</strong><br>
			Address: <strong>${feature.properties.address}</strong><br>
		`;
    }
})
		</script>
		@endpush
</div>