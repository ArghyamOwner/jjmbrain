<x-guest-layout>
    <div class="px-4 py-4" style="background-color: #0f4497;">
        <div class="flex justify-center">
            <div class="shrink-0 mr-3">
                <img src="{{ url('img/jjm-logo.png') }}" alt="jjm-logo" loading="lazy" class="object-fit h-16">
            </div>
            <div class="text-left">
                <div class="text-2xl font-bold text-white">Jal Jeevan Mission</div>
                <div class="text-xl font-medium text-white">PHED Assam</div>
            </div>
        </div>
    </div>
    <div class="px-4 py-8" style="background-color: #056fd2;">
        <div>
            <img src="{{ url('img/emblem.png') }}" alt="emblem" loading="lazy" class="object-fit h-32 mx-auto block">
            <div class="uppercase text-md tracking-wider text-center font-medium text-white">GOVERNMENT OF ASSAM</div>
        </div>

        {{-- <div class="text-3xl font-bold text-white text-center my-2">
            {{ $scheme->name }}
        </div>

        <div class="text-lg font-medium text-white text-center mb-2">
            {{ $scheme->villages?->pluck('village_name')->join(', ') }}, {{ $scheme->district?->name }}
        </div>

        <div class="text-lg font-medium text-white text-center">
            Public Health Engineering Department <br>
            {{ $scheme->division?->name }} Division
        </div> --}}
    </div>

    <x-section-centered class="py-4">
        <div class="relative" wire:ignore x-data>
            <x-card no-padding overflow-hidden>
                <div id="map" class="w-full overflow-hidden" style="height: 80vh;"></div>
            </x-card>
        </div>
    </x-section-centered>

    @once
        @push('styles')
            <!-- Load Leaflet from CDN -->
            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
                integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
                crossorigin="" />
        @endpush

        @push('scripts-footer')
            <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
                integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
                crossorigin=""></script>


            <script>
                document.addEventListener('livewire:load', function() {
                    let area = @json($area);
                    let line = @json($line);
                    let point = @json($point);

                    let map = L.map('map').setView([26.4463, 92.0322], 12);

                    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
                    }).addTo(map);


                    let areaLayer = L.geoJson(area).addTo(map);

                    let lineLayer = L.geoJson(line).addTo(map);

                    let pointLayer = L.geoJson(point).addTo(map);


                });
            </script>
        @endpush

    @endonce
</x-guest-layout>
