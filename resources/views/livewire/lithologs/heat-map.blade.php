<div>
    <x-heading size="md" class="mb-2 mt-6">Litholog Depth Heat Map</x-heading>
    <x-card no-padding overflow-hidden>
        <div class="md:w-full relative">
            <div id="map" class="w-100" style="height: calc(80vh - 10px)"></div>
            <div class="absolute bottom-0 right-1 mb-5">
                <div class="relative">
                    <div id="minValue" class="absolute left-0 -mt-6">0</div>
                    <div id="maxValue" class="absolute right-0 -mt-6">0</div>
                    <div class="h-10 w-64 "
                        style="background-image: linear-gradient(to right, #00ff00, #a0d600, #d7a700, #f66d00, #ff0000);">
                    </div>
                </div>
            </div>
        </div>
    </x-card>

    @once
    @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin="" />
    <link rel="stylesheet" href="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.css" />

    <style>
        #map {
            height: 300px;
        }
    </style>
    @endpush

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet-boundary-canvas@1.0.0/src/BoundaryCanvas.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/leaflet.heat@0.2.0/dist/leaflet-heat.min.js"></script>
    <script src="https://unpkg.com/leaflet-control-geocoder/dist/Control.Geocoder.js"></script>

    <script>
        document.addEventListener('livewire:load', function() {
                let map = new L.Map('map').setView([26.4164, 92.8415], 7);

                var values = @json($lithologs).map(function (item) {
                    return item.count;
                });

                // Calculate min and max values
                var minValue = Math.min.apply(null, values)+' Feet';
                var maxValue = Math.max.apply(null, values)+' Feet';

                document.getElementById("minValue").innerHTML=minValue;
                document.getElementById("maxValue").innerHTML=maxValue;

                console.log(minValue);
                console.log(maxValue);

                var assamBoundary = {
                    "type": "FeatureCollection",
                    "features": [{
                        "type": "Feature",
                        "properties": {},
                        "geometry": {
                            "type": "Polygon",
                            "coordinates": [
                                @json($mapBoundaryPolygon)
                            ]
                        }
                    }]
                };
                osmUrl = 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                    osmAttribution =
                    'Map data &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors';

                osm = L.TileLayer.boundaryCanvas(osmUrl, {
                    boundary: assamBoundary,
                    attribution: osmAttribution,
                    trackAttribution: true
                }).addTo(map);

                L.geoJSON(assamBoundary, {
                    style: {
                        // fillColor: "#FF0000",
                        color: "#FF0000",
                        weight: 1,
                        opacity: 1,
                        fillOpacity: 0
                    }
                }).addTo(map);

                heat = L.heatLayer(@json($lithologs), {
                    radius: 25,
                    max: 1.0,
                    blur: 15,              
                    gradient: {
                        0.0: 'green',
                        0.5: 'yellow',
                        1.0: 'red'
                    },
                    minOpacity: 0.7
                }).addTo(map);
            });
    </script>
    @endpush
    @endonce
</div>