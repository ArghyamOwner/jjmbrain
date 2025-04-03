<div>
    <x-slot name="title">Cluster Map</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:title>
                Cluster Map
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered-wide>
        <x-card card-classes="mb-5">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                <x-select no-margin id="division" label="Division" name="division" class="filter-input w-full">
                    <option value="all">All divisions</option>
                    @foreach($this->divisions as $divisionKey => $divisionValue)
                        <option value="{{ $divisionKey }}">{{ $divisionValue }}</option>
                    @endforeach
                </x-select>

                <div class="md:col-span-3">
                    <x-label for="scheme_working_status" class="mb-1 font-semibold">Scheme Work Status</x-label>
                    <div class="flex flex-wrap space-x-4">
                        <label class="flex items-center space-x-2 mb-1">
                            <input type="checkbox" class="filter-input focus:outline-none rounded border-gray-300 h-4 w-4 text-indigo-600 focus:ring-indigo-500" name="scheme_working_status" checked="true" value="handed-over">
                            <span class="text-sm">Handed-Over</span>
                        </label>
    
                        <label class="flex items-center space-x-2">
                            <input type="checkbox" class="filter-input focus:outline-none rounded border-gray-300 h-4 w-4 text-indigo-600 focus:ring-indigo-500" name="scheme_working_status" checked="true" value="ongoing">
                            <span class="text-sm">Ongoing</span>
                        </label>

						<label class="flex items-center space-x-2">
                            <input type="checkbox" class="filter-input focus:outline-none rounded border-gray-300 h-4 w-4 text-indigo-600 focus:ring-indigo-500" name="scheme_working_status" checked="true" value="completed">
                            <span class="text-sm">Completed</span>
                        </label>

						<label class="flex items-center space-x-2">
                            <input type="checkbox" class="filter-input focus:outline-none rounded border-gray-300 h-4 w-4 text-indigo-600 focus:ring-indigo-500" name="scheme_working_status" checked="true" value="not-started">
                            <span class="text-sm">Not Started</span>
                        </label>

						<label class="flex items-center space-x-2">
                            <input type="checkbox" class="filter-input focus:outline-none rounded border-gray-300 h-4 w-4 text-indigo-600 focus:ring-indigo-500" name="scheme_working_status" checked="true" value="no-status">
                            <span class="text-sm">No Status</span>
                        </label>
                    </div>
                </div>
            </div>
            <x-slot:footer>
                <div class="grid grid-cols-2 md:grid-cols-6 md:divide-x space-y-2 md:space-y-0">
                    <div>
                        <div class="text-xs uppercase tracking-wider font-semibold text-slate-500">Total Schemes</div>
                        <div class="font-bold tracking-tight text-lg font-mono" id="totalSchemes">0</div>
                    </div>
                    <div class="md:pl-4">
                        <div class="text-xs uppercase tracking-wider font-semibold text-slate-500 flex items-center space-x-2">
                            <span>Handed-over</span>
                            <span class="bg-green-100 ring-4 ring-green-500 w-2 h-2 inline-block rounded-full"></span>
                        </div>
                        <div class="font-bold tracking-tight text-lg font-mono" id="totalHandedoverSchemes">0</div>
                    </div>
                    <div class="md:pl-4">
                        <div class="text-xs uppercase tracking-wider font-semibold text-slate-500 flex items-center space-x-2">
                            <span>Ongoing</span>
                            <span class="bg-red-100 ring-4 ring-red-500 w-2 h-2 inline-block rounded-full"></span>
                        </div>
                        <div class="font-bold tracking-tight text-lg font-mono" id="totalOngoingSchemes">0</div>
                    </div>
					<div class="md:pl-4">
                        <div class="text-xs uppercase tracking-wider font-semibold text-slate-500 flex items-center space-x-2">
                            <span>Completed</span>
                            <span class="bg-yellow-100 ring-4 ring-yellow-500 w-2 h-2 inline-block rounded-full"></span>
                        </div>
                        <div class="font-bold tracking-tight text-lg font-mono" id="totalSchemesCompleted">0</div>
                    </div>
					<div class="md:pl-4">
                        <div class="text-xs uppercase tracking-wider font-semibold text-slate-500 flex items-center space-x-2">
                            <span>Not-Started</span>
                            <span class="bg-cyan-100 ring-4 ring-cyan-500 w-2 h-2 inline-block rounded-full"></span>
                        </div>
                        <div class="font-bold tracking-tight text-lg font-mono" id="totalSchemesNotStarted">0</div>
                    </div>
					<div class="md:pl-4">
                        <div class="text-xs uppercase tracking-wider font-semibold text-slate-500 flex items-center space-x-2">
                            <span>Without Status</span>
                            <span class="bg-purple-100 ring-4 ring-purple-500 w-2 h-2 inline-block rounded-full"></span>
                        </div>
                        <div class="font-bold tracking-tight text-lg font-mono" id="totalSchemesWithoutStatus">0</div>
                    </div>
                </div>
            </x-slot>
        </x-card>

        <x-card no-padding overflow-hidden>
			<div class="relative" wire:ignore>
				<div id="map" class="w-full overflow-hidden" style="height: 65vh;"></div>
			</div>
		</x-card>
    </x-section-centered-wide>

    @push('styles')
	<!-- Load Leaflet from CDN -->
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>

	<!-- Leaflet Mapbox CSS file for Fullscreen option on map-->
	<link rel='stylesheet' href='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/leaflet.fullscreen.css' />
	<link rel="stylesheet" href="https://leaflet.github.io/Leaflet.markercluster/dist/MarkerCluster.css">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.min.css">
@endpush

@push('scripts-footer')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

<!-- Load Esri Leaflet from CDN -->
<script src="https://unpkg.com/esri-leaflet@3.0.10/dist/esri-leaflet.js"></script>
<script src="https://unpkg.com/esri-leaflet-vector@4.1.0/dist/esri-leaflet-vector.js"></script>

<!-- Leaflet Mapbox js file for Fullscreen option on map-->
<script src='https://api.mapbox.com/mapbox.js/plugins/leaflet-fullscreen/v1.0.1/Leaflet.fullscreen.min.js'></script>
<!-- Leaflet MarkerCluster-->
<script src="https://cdn.jsdelivr.net/npm/leaflet.markercluster@1.5.3/dist/leaflet.markercluster-src.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/leaflet-boundary-canvas@1.0.0/src/BoundaryCanvas.min.js"></script>

<script>
document.addEventListener('livewire:load', function () {
	let locations = @json($locations);
	let map = null;
 
	let filterStates = {
		division: 'all',
		statuses: []
	}
	 
	let statuses = @json($this->statuses);
 
	var markers = L.markerClusterGroup({
		chunkedLoading: true,
		// spiderfyOnMaxZoom: true,
		showCoverageOnHover: false,
		// zoomToBoundsOnClick: true,
		// removeOutsideVisibleBounds: true
	});

	// Init map
	map = L.map('map', {maxZoom: 18 }).setView([26.2006, 92.9376], 7);

    // Add a zoom control to the toolbar container
    map.zoomControl.setPosition('bottomright'); // Zoom control

	let osmUrl = 'http://{s}.tile.osm.org/{z}/{x}/{y}.png';
    let osmAttribution = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';

	// L.TileLayer.boundaryCanvas(osmUrl, {
	// 	boundary: assamBoundary,
	// 	attribution: osmAttribution,
	// 	trackAttribution: true
	// }).addTo(map);

	// Add ESRI Map Layer
	const apiKey = "AAPKebb4404d33324a7cb37d3cfba41264d23f8bxdtdYcnp2Qz5TIai2tELmtX1AZK1nl6CS_5gnTNkQ9Y80WAr9wHf0CpSPWYJ";
	const basemapEnum = "arcgis/imagery";
	L.esri.Vector.vectorBasemapLayer(basemapEnum, {
		apiKey: apiKey
	}).addTo(map);

    // let layer = L.esri.basemapLayer('Imagery').addTo(map);
    // let layerLabels = L.esri.basemapLayer('ImageryLabels').addTo(map);

	fetch('{{ $assamDistrictBoundary }}')
		.then(response => response.json())
		.then(data => {
			// Add GeoJSON layer to the map
			let geojsonLayer = L.geoJSON(data, {
				style: {
					// fillColor: "#ff7800",
					color: "#f00",
					weight: 2,
					opacity: 1,
					fillOpacity: 0
				}
			}).addTo(map);
			
			// Optionally, fit the map bounds to the GeoJSON layer
			map.fitBounds(geojsonLayer.getBounds());
		})
		.catch(error => console.error('Error fetching District GeoJSON:', error));
 
	const geojsonLayer = L.geoJSON(null, {
		filter: (feature) => {
			// const isSchemeTypeChecked = filterStates.schemeTypes.includes(feature.properties.scheme_type);
			const isStatusChecked = filterStates.statuses.includes(feature.properties.scheme_working_status);
			 
			if (filterStates.division === 'all') {
				return isStatusChecked;
			} else {
				return isStatusChecked && (feature.properties.division_id == filterStates.division);
			}
		},
		pointToLayer: function(feature, latlng) {
			const customColor = getMarkerDetail(feature.properties.scheme_working_status);
			const workingStatus = checkSchemeWorkingStatus(feature.properties.scheme_working_status);

			if (workingStatus) {
				return L.circleMarker(latlng, {
					color: customColor
				});
			} else {
				return L.circleMarker(latlng, {
					color: customColor,
					fillOpacity: 1,
					fillColor: customColor
				});
			}
		},
	    onEachFeature: function (feature, layer) {
			layer.bindPopup(bindPopupData(feature));
		}
	});

	function getCheckedValues(fieldName) {
		return Array.from(document.querySelectorAll(fieldName))
			.filter((checkbox) => checkbox.checked)
			.map((checkbox) => checkbox.value);
	}

	function updateFilterStates() {
		filterStates.statuses = getCheckedValues('input[type="checkbox"][name="scheme_working_status"]');
		filterStates.division = document.getElementById('division').value || 'all';
		// console.log(filterStates)
        getSchemeStats(locations, filterStates.division)
	}

	for (let input of document.querySelectorAll('.filter-input')) {
		// Listen to 'change' event of all inputs
		input.onchange = (e) => {
			geojsonLayer.clearLayers()
			markers.clearLayers();

			updateFilterStates()
			geojsonLayer.addData(locations)

			if (filterStates.division !== 'all') {
				map.fitBounds(geojsonLayer.getBounds(), {
					padding: [20, 20]
				});
			}

			// Cluster
			markers.addLayer(geojsonLayer);
			map.addLayer(markers);

			// map.addLayer(geojsonLayer);
		}
	}

	updateFilterStates()
    // console.log(locations)
	geojsonLayer.addData(locations)
   
	// Add Leaflet markercluster to all geojson layers
	markers.addLayer(geojsonLayer);
	map.addLayer(markers);

	// map.addLayer(geojsonLayer);

    // Fullscreen option on map
   map.addControl(new L.Control.Fullscreen({
        position: 'bottomright',
   }))
    
	// Marker Color
    function getMarkerDetail(type){
		switch(type) {
            case 'handed-over':
                return '#2FB981';
				break;
            case 'ongoing':
                return '#EF4444';
				break;
			case 'completed':
                return '#eab308';
				break;
			case 'no-status':
                return '#9333ea';
				break;
			case 'not-started':
                return '#22d3ee';
				break;
            default:
                return '#333333';
				break;
        }
    }

	// Popup Content
    function bindPopupData(feature) {
        return `
			<a class="hover:underline" target="_blank" href="${feature.properties.links}">${feature.properties.scheme_name}</a><br>
			IMIS ID: <strong>${feature.properties.imis_id}</strong><br>
			SMT ID: <strong>${feature.properties.smt_id}</strong><br>
			Scheme Type: <strong>${feature.properties.scheme_type}</strong><br>
			Division: <strong>${feature.properties.division_name}</strong><br>
			LAC: <strong>${feature.properties.lac_name}</strong><br>
			District: <strong>${feature.properties.district_name}</strong><br>
			Block: <strong>${feature.properties.block_names}</strong><br>
			Working Status: <strong>${feature.properties.scheme_working_status}</strong>
		`;
    }

	function checkSchemeWorkingStatus(status) {
		return statuses.includes(status);
    }

    function getSchemeStats(locations, divisions) {
		let totalSchemes = document.getElementById('totalSchemes');
		let totalHandedoverSchemes = document.getElementById('totalHandedoverSchemes');
		let totalOngoingSchemes = document.getElementById('totalOngoingSchemes');
		let totalSchemesWithoutStatus = document.getElementById('totalSchemesWithoutStatus')
		let totalSchemesCompleted = document.getElementById('totalSchemesCompleted')
		let totalSchemesNotStarted = document.getElementById('totalSchemesNotStarted')
	 
        if (divisions == 'all') {
            totalSchemes.innerHTML = locations.features?.length ?? 0;
            totalHandedoverSchemes.innerHTML = locations.features.filter((item) => item.properties.scheme_working_status === 'handed-over')?.length ?? 0;
            totalOngoingSchemes.innerHTML = locations.features.filter((item) => item.properties.scheme_working_status === 'ongoing')?.length ?? 0;
            totalSchemesWithoutStatus.innerHTML = locations.features.filter((item) => item.properties.scheme_working_status === 'no-status')?.length ?? 0;
            totalSchemesCompleted.innerHTML = locations.features.filter((item) => item.properties.scheme_working_status === 'completed')?.length ?? 0;
            totalSchemesNotStarted.innerHTML = locations.features.filter((item) => item.properties.scheme_working_status === 'not-started')?.length ?? 0;
        } else {
            totalSchemes.innerHTML = locations.features.filter((item) => item.properties.division_id == filterStates.division)?.length ?? 0;
            totalHandedoverSchemes.innerHTML = locations.features.filter((item) => item.properties.division_id == filterStates.division && item.properties.scheme_working_status === 'handed-over')?.length ?? 0;
            totalOngoingSchemes.innerHTML = locations.features.filter((item) => item.properties.division_id == filterStates.division && item.properties.scheme_working_status === 'ongoing')?.length ?? 0;
            totalSchemesWithoutStatus.innerHTML = locations.features.filter((item) => item.properties.division_id == filterStates.division && item.properties.scheme_working_status === 'no-status')?.length ?? 0;
            totalSchemesCompleted.innerHTML = locations.features.filter((item) => item.properties.division_id == filterStates.division && item.properties.scheme_working_status === 'completed')?.length ?? 0;
            totalSchemesNotStarted.innerHTML = locations.features.filter((item) => item.properties.division_id == filterStates.division && item.properties.scheme_working_status === 'not-started')?.length ?? 0;
			
        }
    }
})
</script>
@endpush
</div>