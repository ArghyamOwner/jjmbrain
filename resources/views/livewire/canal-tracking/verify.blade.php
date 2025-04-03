<div>
    <x-slot name="title">Scheme Pipe Network</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon
                    href="{{ route('schemes.show', ['scheme' => $network->scheme_id, 'tab' => 'details']) }}">Go to
                    Scheme
                </x-text-link>
    </x-slot>
    <x-slot:title>
        Detailed Analysis of Uploaded Pipe Network
        </x-slot>
        <x-slot:action>
            @if($network->verification_status == 'Accepted')

            <x-badge variant="success">
                <span class="uppercase p-2">
                    {{ $network->verification_status." by
                    ".$network->verifiedBy?->role." ".$network->verifiedBy?->name." :
                    ".$network->verified_at?->diffForHumans() }}
                </span>
            </x-badge>

            @elseif ($network->verification_status == 'Rejected')
            <x-badge variant="danger">
                <span class="uppercase p-2">
                    {{ $network->verification_status." by
                    ".$network->verifiedBy?->role." ".$network->verifiedBy?->name." :
                    ".$network->verified_at?->diffForHumans() }}
                </span>
            </x-badge>

            @else
            <x-badge variant="warning">{{ $network->verification_status }}</x-badge>
            @endif

            </x-slot>
            </x-navbar-top-transparent>
            </x-slot>

            <x-section-centered-wide>
                @if($locations)
                <x-card no-padding overflow-hidden>
                    <div class="relative" wire:ignore>
                        <div id="map" class="w-full overflow-hidden -z-0" style="height: calc(100vh - 120px)"></div>
                    </div>
                </x-card>
                @else
                <x-card-empty />
                @endif

                <div class="mt-6 mb-6">
                    <x-heading size="md" class="mb-1">Pipe Networks</x-heading>
                    @if($locations && isset($locations['features']))
                        <x-table.table>
                            <thead>
                                <tr>
                                    <x-table.thead>Type</x-table.thead>
                                    <x-table.thead>Size</x-table.thead>
                                    <x-table.thead>Distance</x-table.thead>
                                    <x-table.thead>Quality</x-table.thead>
                                    <x-table.thead>Color</x-table.thead>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($locations['features'] as $canal)
                                <tr>
                                    <x-table.tdata>{{ data_get($canal, 'properties.type') }}</x-table.tdata>
                                    <x-table.tdata>{{ data_get($canal, 'properties.size') }} mm</x-table.tdata>
                                    <x-table.tdata>{{ data_get($canal, 'properties.distance') }} Km</x-table.tdata>
                                    <x-table.tdata>{{ data_get($canal, 'properties.quality') }}</x-table.tdata>
                                    <x-table.tdata>
                                        <div style="background-color:{!! data_get($canal, 'properties.color') !!} "
                                            class="w-3 h-2.5 ">
                                        </div>
                                    </x-table.tdata>
                                </tr>
                                @endforeach
                            </tbody>
                        </x-table.table>

                        @if($showVerificationButton)
                        <x-card overflow-hidden cardClasses="mt-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <x-button type="button" x-data="" color="indigo" class="w-full"
                                        x-on:click.prevent="$dispatch('show-modal', 'network-accept-model')" x-cloak>
                                        Approve
                                    </x-button>
                                </div>
                                <div>
                                    <x-button type="button" x-data="" color="red" class="w-full"
                                        x-on:click.prevent="$dispatch('show-modal', 'network-reject-model')" x-cloak>
                                        Reject
                                    </x-button>
                                </div>
                            </div>
                        </x-card>
                        @endif

                    @else
                    <x-card-empty />
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
                integrity="sha384-P9DABSdtEY/XDbEInD3q+PlL+BjqPCXGcF8EkhtKSfSTr/dS5PBKa9+/PMkW2xsY"
                crossorigin="anonymous">

            <link rel="stylesheet"
                href="https://cdn.jsdelivr.net/npm/leaflet-measure@3.1.0/dist/leaflet-measure.min.css">
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
                    Length: <strong>${feature.properties.distance}</strong> Km<br>
                    Size: <strong>${feature.properties.size}</strong> mm<br>
                    Type: <strong>${feature.properties.type}</strong><br>
                    Quality: <strong>${feature.properties.quality}</strong><br>
                `;
            }
        });
            </script>
            @endpush

            <livewire:canal-tracking.delete />

            <x-modal-simple name="network-accept-model" form-action="verify">
                <x-slot name="title">Approve Pipe Network</x-slot>
                <x-textarea-simple label="Final Comment by GIS Team" name="comment" wire:model.defer="comment" />

                <x-slot name="footer" class="text-right">
                    <x-button color="indigo" with-spinner wire:target="verify">Approve</x-button>
                </x-slot>
            </x-modal-simple>

            <x-modal-simple name="network-reject-model" form-action="reject">
                <x-slot name="title">Reject Pipe Network</x-slot>

                <x-textarea-simple label="Final Comment by GIS Team" name="comment" wire:model.defer="comment" />

                <x-slot name="footer" class="text-right">
                    <x-button color="red" with-spinner wire:target="reject">Reject</x-button>
                </x-slot>
            </x-modal-simple>
</div>