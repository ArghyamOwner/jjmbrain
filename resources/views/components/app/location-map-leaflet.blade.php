@php
    $coordinates = [
        'lat' => floatval($siteSettings['latitude']) ?? 26.1427,
        'lng' => floatval($siteSettings['longitude']) ?? 91.6597
    ]
@endphp

<div class="max-w-full w-full h-96 rounded" id="contact-map"></div>

@once
    @push('styles')
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
            integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
            crossorigin=""/>
    @endpush

    @push('scripts-bottom')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
            integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
            crossorigin="anonymous"></script>

    <script src="/js/TileLayer.Grayscale.js"></script>
    <script>
        const map = L.map('contact-map', { zoomControl: false }).setView([{{ $coordinates['lat'] }}, {{ $coordinates['lng'] }}], 16);
        
        L.control.zoom({position: 'topright'}).addTo(map);
    
        L.tileLayer.grayscale('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        const icon = L.icon({
            iconUrl: "{{ url('img/location-marker.svg') }}",
            iconSize: [32,32],
        });

        L.marker([{{ $coordinates['lat'] }}, {{ $coordinates['lng'] }}], {
            icon: icon
        }).addTo(map).bindPopup(`<div class="text-xs">{{ $siteSettings['address'] ?? '' }}</div>`);    
    </script>
    @endpush
@endonce