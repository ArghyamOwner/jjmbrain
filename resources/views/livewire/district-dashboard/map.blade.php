<div>
    <div class="md:w-full mb-4">
        <x-card no-padding>
            <div wire:ignore id="mapid" class="w-full overflow-hidden rounded-lg" style="min-height: 500px;">
            </div>
        </x-card>
    </div>

    @once
    @push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css"
        integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ=="
        crossorigin="" />
    <style>
        #mapid {
            height: 300px;
        }
    </style>
    @endpush

    @push('scripts')
    <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js"
        integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw=="
        crossorigin=""></script>

    <script>
        document.addEventListener('livewire:load', function() {
            let geoData = @json($locations);
            var map = L.map('mapid').setView([26.1445, 91.7362], 10);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);
            maplayer = L.geoJSON(geoData, {
                pointToLayer: function(feature, latlng) {
                    return L.marker(latlng);
                },
                onEachFeature: function(feature, layer) {
                    layer.bindPopup(
                        `<a href="${feature.properties.links}">${feature.properties.name}</a><br>IMIS-ID: ${feature.properties.imis_id}`
                    );
                }
            }).addTo(map);
            map.fitBounds([maplayer.getBounds()], {
                padding: [24.826494, 92.797919]
            });
        });
    </script>
    @endpush
    @endonce
</div>