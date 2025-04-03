<div>
    <x-alert :close="false" variant="error" class="mb-5">It is advisable to update the scheme location form the JJM
        Assam App to get the accurate-location. To know more about the how to update location see documentation 
        <a target="_blank" class="text-indigo-600 hover:text-indigo-700 hover:underline"
            href="https://kb.phone91.com/sumato/jjmbrain/how-to-update-scheme-location">here
        </a>
    </x-alert>
    
    <x-card-form form-action="save">
        <x-slot name="title">Scheme Location</x-slot>
        <x-slot name="description">Add/Update the location of the scheme</x-slot>

        <div class="grid md:grid-cols-2 gap-4">
            <x-input label="Latitude" name="latitude" wire:model.defer="latitude" />
            <x-input label="Longitude" name="longitude" wire:model.defer="longitude" />

            <div class="col-span-2">
                <div wire:ignore class="mb-4">
                    <div id="mapid" class="rounded-md overflow-hidden"></div>
                </div>
            </div>
        </div>
        <x-slot name="footer" class="text-right">
            <div class="mr-4">
                <x-inline-toastr on="saved">Saved.</x-inline-toastr>
            </div>

            <x-button with-spinner wire:target="save">Save</x-button>
        </x-slot>
    </x-card-form>

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
                    var mapCenter = [{{ $latitude ?? 26.1445 }}, {{ $longitude ?? 91.7362 }}];
                    var map = L.map('mapid').setView(mapCenter, 10);

                    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
                    }).addTo(map);

                    var marker = L.marker(mapCenter).addTo(map);

                    function updateMarker(lat, lng) {
                        marker.setLatLng([lat, lng])
                            .bindPopup("Your location :  " + marker.getLatLng().toString())
                            .openPopup();
                        return false;
                    };

                    map.on('click', function(e) {
                        let latitude = e.latlng.lat.toString().substring(0, 11);
                        let longitude = e.latlng.lng.toString().substring(0, 11);
                        @this.set('latitude', latitude);
                        @this.set('longitude', longitude);
                        updateMarker(latitude, longitude);
                    });

                    var updateMarkerByInputs = function() {
                        return updateMarker(@this.get('latitude'), @this.get('longitude'));
                    }

                    document.getElementById('latitude').addEventListener("input", updateMarkerByInputs);
                    document.getElementById('longitude').addEventListener("input", updateMarkerByInputs);
                });
            </script>
        @endpush
    @endonce
</div>
