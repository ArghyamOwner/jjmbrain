<div>
    <x-slot name="title">Edit Office</x-slot>

    <x-slot name="secondaryTopbar">
        <x-navbar-top-transparent>
            <x-slot:beforeTitle>
                <x-text-link with-back-icon href="{{ route('offices') }}">Go Back</x-text-link>
    </x-slot>
    <x-slot:title>
        Edit Office : {{ $this->office->name }}
        </x-slot>
        </x-navbar-top-transparent>
        </x-slot>

        <x-section-centered>
            <x-card form-action="update">
                <x-card-form :with-shadow="false" no-padding>
                    <x-slot name="title">Office Details</x-slot>
                    <x-slot name="description">Edt the necessary details.</x-slot>

                    <x-input readonly label="Office Name" name="name" wire:model.defer="name" />

                    <div class="mb-4">
                        <x-textarea 
                            label="Enter Address" 
                            id="address" 
                            name="address" 
                            wire:model.defer="address"
                            with-error-message error-message-for="address">
                        </x-textarea>
                    </div>

                    <x-input-number 
                        maxlength="10" 
                        minlength="10" 
                        input-mode="numeric" 
                        label="Phone" 
                        name="phone"
                        wire:model.defer="phone" 
                        placeholder="eg. 7896XXXXXX" 
                    />

                    <x-filepond 
                        optional
                        label="Office Image"
                        wire:model="image" 
                        name="image"
                        accept="image/jpg,image/jpeg,image/png"
                        hint="Maximum File Size: 2 MB. File types allowed: JPG, JPEG, PNG."
                    />

                    <x-section-border />

                    <div class="grid md:grid-cols-2 gap-4">
                        <x-input label="Latitude" name="latitude" wire:model.defer="latitude" />
                        <x-input label="Longitude" name="longitude" wire:model.defer="longitude" />
            
                        <div class="col-span-2">
                            <div wire:ignore class="mb-4">
                                <div id="mapid" class="rounded-md overflow-hidden"></div>
                            </div>
                        </div>
                    </div>
                </x-card-form>

                <x-slot name="footer" class="text-right">
                    <div class="mr-4">
                        <x-inline-toastr on="updated">Updated.</x-inline-toastr>
                    </div>

                    <x-button with-spinner wire:target="update">Update</x-button>
                </x-slot>
            </x-card>
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