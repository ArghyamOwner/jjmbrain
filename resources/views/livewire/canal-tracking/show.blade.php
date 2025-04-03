<div>
    <x-slot name="title">Scheme Pipe Network Map</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon
                    href="{{ route('schemes.show', ['scheme' => $schemeId, 'tab' => 'details']) }}">Go Back
                </x-text-link>
            </x-slot>
            <x-slot:title>
                Pipe Network Map for: {{ $schemeName }}
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered-wide>
        @if($locations)
        <div class="flex space-x-2 justify-between mb-2 items-center no-padding">
            <x-button class="text-indigo-600" with-icon icon="download" color="white" type="button"
                onclick="downloadKml()">KML
            </x-button>
            <div class="flex flex-wrap-reverse justify-end space-x-2 text-sm text-right">
                <div class="flex items-center space-x-1">
                    <div class="w-2.5 h-2.5 mb-2">
                        <img src="{{ url('img/icons/marker-red.png') }}" />
                    </div>
                    <div>Scheme Location</div>
                </div>

                @foreach ($colorIndicators as $detail)
                <div class="flex items-center space-x-1">
                    <div style="background-color:{!! $detail->color_code !!} "
                        class="w-2.5 h-2.5 rounded-full border border-black">
                    </div>
                    <div>{{ (int)$detail->size }} mm</div>
                </div>
                @endforeach
            </div>
        </div>
        <x-card no-padding overflow-hidden>
            <div class="relative" wire:ignore>
                <div id="map" class="w-full overflow-hidden" style="height: calc(100vh - 120px)"></div>
            </div>
        </x-card>
        @else
        <x-card-empty />
        @endif

        <livewire:canal-tracking.pipe-network-summary :schemeId="$schemeId" />

        <div class="mt-6 mb-6">
            <x-heading size="md" class="mb-1">Pipe Networks</x-heading>
            @if($locations)
            <x-table.table>
                <thead>
                    <tr>
                        <x-table.thead>Reference No</x-table.thead>
                        <x-table.thead>Type</x-table.thead>
                        <x-table.thead>Size</x-table.thead>
                        <x-table.thead>Distance</x-table.thead>
                        <x-table.thead>Quality</x-table.thead>
                        <x-table.thead>Color</x-table.thead>
                        <x-table.thead>Action</x-table.thead>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($locations['features'] as $canal)
                    <tr>
                        <x-table.tdata>{{ data_get($canal, 'properties.reference_no') }}</x-table.tdata>
                        <x-table.tdata>{{ data_get($canal, 'properties.type') }}</x-table.tdata>
                        <x-table.tdata>{{ data_get($canal, 'properties.size') }} mm</x-table.tdata>
                        <x-table.tdata>{{ data_get($canal, 'properties.distance') }} Km</x-table.tdata>
                        <x-table.tdata>{{ data_get($canal, 'properties.quality') }}</x-table.tdata>
                        <x-table.tdata>
                            <div style="background-color:{!! data_get($canal, 'properties.color') !!} "
                                class="w-2.5 h-2.5 rounded-full border border-black">
                            </div>
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($showDeleteButton)
                            <x-button-icon-delete x-cloak x-on:click.prevent="$wire.emitTo(
                                'canal-tracking.delete',
                                'showDeleteModal',
                                '{{ data_get($canal, 'properties.id') }}',
                                'Confirm Deletion',
                                'Are you sure you want to delete this Track ?',
                                '{{ data_get($canal, 'properties.type') }}'
                            )" />
                            @endif
                        </x-table.tdata>
                    </tr>
                    @endforeach
                </tbody>
            </x-table.table>
            @else
            <x-card-empty />
            @endif
        </div>

        <div class="mt-6 mb-10">
            <x-heading size="md" class="mb-1">Pipe Attributes</x-heading>
            @if ($this->canalTrackingPoints)
            <x-table.table>
                <thead>
                    <tr>
                        <x-table.thead>Image</x-table.thead>
                        <x-table.thead>Type</x-table.thead>
                        <x-table.thead>Category</x-table.thead>
                        <x-table.thead>Casing Type</x-table.thead>
                        <x-table.thead>Size</x-table.thead>
                        <x-table.thead>Valve Manufacturer</x-table.thead>
                        <x-table.thead>Action</x-table.thead>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($this->canalTrackingPoints['features'] as $canalTrackingPoint)
                    <tr>
                        <x-table.tdata>
                            <x-lightbox>
                                <x-lightbox.item
                                    image-url="{{ data_get($canalTrackingPoint, 'properties.image') }}">
                                    <img src="{{ data_get($canalTrackingPoint, 'properties.image') }}" alt=""
                                        class="h-16 object-fit" />
                                </x-lightbox.item>
                            </x-lightbox>
                        </x-table.tdata>
                        <x-table.tdata>{{ data_get($canalTrackingPoint, 'properties.type') }}</x-table.tdata>
                        <x-table.tdata>{{ data_get($canalTrackingPoint, 'properties.category') }}</x-table.tdata>
                        <x-table.tdata>{{ data_get($canalTrackingPoint, 'properties.casing_type') }}</x-table.tdata>
                        <x-table.tdata>{{ data_get($canalTrackingPoint, 'properties.size') }}</x-table.tdata>
                        <x-table.tdata>{{ data_get($canalTrackingPoint, 'properties.valve_manufacturer') }}
                        </x-table.tdata>
                        <x-table.tdata>
                            @if($showDeletePointButton)
                            <x-button-icon-delete x-cloak x-on:click.prevent="$wire.emitTo(
                                'canal-tracking.delete-points',
                                'showDeleteModal',
                                '{{ data_get($canalTrackingPoint, 'properties.id') }}',
                                'Confirm Deletion',
                                'Are you sure you want to delete this Attribute ?',
                                '{{ data_get($canalTrackingPoint, 'properties.type') }}'
                            )" />
                            @endif
                        </x-table.tdata>
                    </tr>
                    @endforeach
                </tbody>
            </x-table.table>
            @endif
        </div>
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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet-measure@3.1.0/dist/leaflet-measure.min.css">
    @endpush

    @push('scripts-footer')
    <script src="https://cdn.jsdelivr.net/npm/tokml@0.4.0/tokml.min.js"></script>
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
    <script src="https://cdn.jsdelivr.net/npm/leaflet-measure@3.1.0/dist/leaflet-measure.min.js"></script>

    <script>
        let canal = @json($locations);
        let canalPoints = @json($this->canalTrackingPoints);
        var latlng = @json($this->schemeLocation);
        let kmlData = tokml(canal, canalPoints);

        function downloadKml() {
            let downloadLink = document.createElement('a');
            downloadLink.href = 'data:application/xml;charset=utf-8,' + encodeURIComponent(kmlData);
            downloadLink.download = '{{ $schemeName.".kml" }}';
            downloadLink.click();
        }

        document.addEventListener('livewire:load', function () {
            let map = null;

            // let osmUrl = 'http://{s}.tile.osm.org/{z}/{x}/{y}.png';
            // let osmAttribution = 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';

            var osm = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 19,
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            });
            
            // Init map
            map = L.map('map', {
                center: [24.826494, 92.797919],
                zoom: 10,
                layers: [osm]
            });

            // Leaflet Measure
            var measureControl = new L.Control.Measure({
                primaryLengthUnit: 'kilometers', 
                secondaryLengthUnit: 'kilometers',
                activeColor: '#FF0000'
            });
            measureControl.addTo(map);

            // Add a zoom control to the toolbar container
            map.zoomControl.setPosition('bottomright'); // Zoom control

            // Add ESRI Map Layer
            const apiKey = "AAPKebb4404d33324a7cb37d3cfba41264d23f8bxdtdYcnp2Qz5TIai2tELmtX1AZK1nl6CS_5gnTNkQ9Y80WAr9wHf0CpSPWYJ";
            const basemapEnum = "arcgis/imagery";
            const arcgisImagery = L.esri.Vector.vectorBasemapLayer(basemapEnum, {
                apiKey: apiKey
            });
            
            const baseLayers = {
                'OpenStreetMap': osm,
                'ARCGIS/Imagery': arcgisImagery
            }

            L.control.layers(baseLayers).addTo(map);

            if (canal != undefined) {
                let canalLayer = L.geoJSON(canal, {
                    type:"Polyline",
                    style:function(feature){
                        var lineWidth = scaleValue(feature.properties.size, 0, 700, 0, 30)
                        // console.log(lineWidth);

                        return {
                            color : feature.properties.color,
                            weight : lineWidth
                        };
                    },
                    onEachFeature: function (feature, layer) {
                                        
                        // Calculate the length of each LineString
                        // var coordinates = feature.geometry.coordinates;
                        // var totalLength = 0;

                        // for (var i = 0; i < coordinates.length - 1; i++) {
                        //     var latlng1 = L.latLng(coordinates[i][1], coordinates[i][0]);
                        //     var latlng2 = L.latLng(coordinates[i + 1][1], coordinates[i + 1][0]);

                        //     // Calculate the distance between consecutive points and add to the total length
                        //     totalLength += latlng1.distanceTo(latlng2);
                        // }

                        // // Display the total length on the console (you can use it as needed)
                        // var roundLength = (totalLength / 1000).toFixed(2);

                        // console.log('Length: ', roundLength , 'Km');

                        layer.bindPopup(bindPopupData(feature));

                        // Get the center of the polyline
                        var bounds = layer.getBounds();
                        var center = bounds.getCenter();

                        // Create a custom div icon with the rounded total length
                        var labelIcon = L.divIcon({
                            className: 'line-label text-red-500 font-bold',
                            html: feature.properties.distance + ' km'
                        });

                        // Add a marker with the custom div icon to show the label
                        L.marker(center, { icon: labelIcon }).addTo(map);
                    }
                }).addTo(map);

                map.fitBounds(canalLayer.getBounds());
            }

            if (canalPoints != undefined) {
                L.geoJSON(canalPoints, {
                    type: "Point",
                    onEachFeature: function (feature, layer) {
                        layer.bindPopup(bindPopupCanalPointData(feature));
                    }
                }).addTo(map);
            }

            
            var customIcon = L.icon({
                iconUrl: "{{ url('img/icons/marker-red.png') }}",
                iconSize: [25, 40], // size of the icon
            });

            L.marker(latlng, {icon: customIcon}).addTo(map);

            // Fullscreen option on map
            map.addControl(new L.Control.Fullscreen({
                position: 'bottomright',
            }))

            function scaleValue(value, minValue, maxValue, minScale, maxScale) {
                return ((value - minValue) / (maxValue - minValue)) * (maxScale - minScale) + minScale;
            }

            // Popup Content
            function bindPopupData(feature) {
                return `
                    Reference_No: <strong>${feature.properties.reference_no}</strong><br>
                    Length: <strong>${feature.properties.distance}</strong> Km<br>
                    Size: <strong>${feature.properties.size}</strong> mm<br>
                    Type: <strong>${feature.properties.type}</strong><br>
                    Quality: <strong>${feature.properties.quality}</strong><br>
                `;
            }

            function bindPopupCanalPointData(feature) {
                return `
                    <img src="${feature.properties.image}" height="60px" /><br>
                    Type: <strong>${feature.properties.type}</strong><br>
                    Size: <strong>${feature.properties.size}</strong><br>
                    Casing Type: <strong>${feature.properties.casing_type}</strong><br>
                    Category: <strong>${feature.properties.category}</strong><br>
                    Valve Manufacturer: <strong>${feature.properties.valve_manufacturer}</strong>
                `;
            }
        });
    </script>
    @endpush
    <livewire:canal-tracking.delete />
    <livewire:canal-tracking.delete-points />
</div>