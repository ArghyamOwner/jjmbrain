@props([
	'id' => 'map-'. Str::random(10), 
	'markers' => [],
	'centerPoint' => [],
	'zoomLevel' => 12,
    'showPopup' => true
])

@once
@push('styles')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css"
        integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A=="
        crossorigin=""/>
@endpush

<div {{ $attributes->merge(['class' => 'max-w-full w-full']) }} id="{{ $id }}"></div>

@push('scripts-footer')
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"
        integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA=="
        crossorigin="anonymous"></script>
<script>
    document.addEventListener('livewire:load', function () {
        let mymap = L.map('{{ $id }}').setView([{{ implode(", ", $centerPoint) }}], {{ $zoomLevel }});

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(mymap);
		
        @foreach($markers as $marker)
			@if(isset($marker['icon']))
				var icon = L.icon({
					iconUrl: '{{ $marker['icon'] }}',
					iconSize: [{{ $marker['iconSizeX'] ?? 32 }} , {{ $marker['iconSizeY'] ?? 32 }}],
				});
			@endif

        	let marker = L.marker([{{$marker['lat'] ?? $marker[0]}}, {{$marker['long'] ?? $marker[1]}},], {{ isset($marker['icon']) ? '{icon: icon}' : '' }}).addTo(mymap);

            @if($showPopup)
                marker.bindPopup(`<div class="text-xs">{{ $marker['popupContent'] }}</div>`);
            @endif
        @endforeach
    });
</script>
@endpush
@endonce
