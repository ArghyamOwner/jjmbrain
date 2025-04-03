<div>
    <x-slot name="title">Litholog Map</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('dashboard') }}">Go Back</x-text-link>
            </x-slot>
            <x-slot:title>
                Litholog Map
            </x-slot>
        </x-navbar-top-transparent>
    </x-slot>

    <x-section-centered>
        <div class="md:w-full mb-4">
            <x-card no-padding>
                <div wire:ignore id="mapid" class="w-full overflow-hidden rounded-lg" style="min-height: 560px;">
                </div>
            </x-card>
        </div>
    </x-section-centered>

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
                        // return L.marker(latlng);
                        const customColor = getMarkerDetail(feature.properties);
                        
                        return L.circleMarker(latlng, {
                            color: customColor
                        });
                    },
                    onEachFeature: function(feature, layer) {
                        layer.bindPopup(
                            `LITHOLOG NUMBER: <a class="hover:underline" target="_blank" href="${feature.properties.link}">${feature.properties.well_id}</a><br/>DATE OF CREATION: ${feature.properties.created_at}<br/>TYPE: ${feature.properties.type}`
                        );
                    }
                }).addTo(map);

                map.fitBounds([maplayer.getBounds()], {
                    padding: [24.826494, 92.797919]
                });

                function getMarkerDetail(litholog){
                    if(litholog.verified_by){
                        return '#facc15';
                    }
                    return '#EF4444';
                }

            });
    </script>
    @endpush
    @endonce
</div>